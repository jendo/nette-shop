<?php

namespace Application\Templates;

/**
 * Extension template helpers (my template helpers)
 *
 * @package Libs\Templates
 * @author Michal JEnis <jenis.michal@gmail.com>
 */
class TemplateHelpers extends \Nette\Object
{

	/** @var string */
	private $wwwDir;

	/** @var Nette\Http\IRequest */
	private $httpRequest;

	/** @var array */
	private $parameters;

	public function __construct($wwwDir, \Nette\Http\IRequest $httpRequest)
	{
		$this->wwwDir = $wwwDir;
		$this->httpRequest = $httpRequest;
		$this->parameters = \Nette\Environment::getVariables();
	}

	public function loader($helper)
	{

		if (method_exists($this, $helper)) {
			return callback($this, $helper);
		}
	}

	public function formatPrice($price){
		$decimals = $this->parameters['price']['decimals'];
		$decimalpoint = $this->parameters['price']['decimalpoint'];
		$separator = $this->parameters['price']['separator'];
		$currency = $this->parameters['price']['currency'];

		$foramttedNumber = number_format($price,$decimals,$decimalpoint,$separator);

		return html_entity_decode($foramttedNumber . '&nbsp;' . $currency);
	}

	public function getThumbnail($img, $w = NULL, $h = NULL, $q = 100)
	{

		if ($w === NULL && $h === NULL)
			$w = 100;

		//dir with original images
		$photoDir = $this->httpRequest->url->scriptPath . $this->parameters['photo']['photoDir'];
		//temp dir for new images with new dimension
		$tempPhotoDir = $this->httpRequest->url->scriptPath . $this->parameters['photo']['tempPhotoDir'];
		//original img
		$imgSrc = $photoDir . $img;
		//full filename with original img
		$imgPath = $this->wwwDir .'/'. $this->parameters['photo']['photoDir'] . $img;
		//temp dir for new images with new dimension
		$tempPhotoDirPath = $this->wwwDir . '/' . $this->parameters['photo']['tempPhotoDir'];

		if (!\file_exists($tempPhotoDirPath)){
			\mkdir($tempPhotoDirPath, 0777, true);
		}

		// if the source file does not exist, dont modify the path; let the browser handle broken image itself
		//TODO: if the source file  does not exist, create image with no_iamge.jpg
                //if $img is empty (f.e. in DB) we get error code 403...
		if (!\file_exists($imgPath) || strlen($img) < 1 ){
			return $imgSrc;
		}

		// create hash that specifies the path and the settings
		$info = \pathinfo($imgPath);
		$ext = $info['extension'];
		$hash = md5($imgPath) . '_' . $w . '_' . $h . '_' . $q;
		$newImgPath = $tempPhotoDirPath . $hash . '.' . $ext;
		$newImgSrc = $tempPhotoDir . $hash . '.' . $ext;

		// is the file cached?
		if (\file_exists($newImgPath)) {
			return $newImgSrc;
		}

		// create new file
		$image = \Nette\Image::fromFile($imgPath);

		// calculate missing dimensions to keep proportions
		if ($w === NULL)
		$w = ($image->getWidth() / $image->getHeight()) * $h;
		if ($h === NULL)
		$h = ($image->getHeight() / $image->getWidth()) * $w;

		// save
		$image->resize($w, $h, \Nette\Image::FILL)
						->crop('50%', '50%', $w, $h)
						->save($newImgPath, $q);

		// it is cached now
		return $newImgSrc;
	}

	public function fullImgUrl(\App\Model\File\File $image)
	{
		return '/core/tools/';
	}


}