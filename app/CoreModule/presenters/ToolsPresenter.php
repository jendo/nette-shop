<?php

namespace App\CoreModule\Presenters;
;

use Nette;

/**
 * Tools presenter - global tools
 *
 * @author Michal Jenis <jenis.mihcal@gmail.com>
 * @package CoreModule\Presenters
 */
class ToolsPresenter extends \App\Presenters\BasePresenter
{

	private $httpRequest;

	public function __construct(Nette\Http\IRequest $httpRequest)
	{
		parent::__construct();
		$this->httpRequest = $httpRequest;
	}

	public function actionShowFullImage($id, $name, $maxwidth, $maxheight, $q = 100)
	{
		if (!$id) {
			throw new \InvalidArgumentException('No id!');
		}

		$fileManager = $this->getManagerFactory()->file();
		$file = $fileManager->find($id);

		//TODO: if the source file  does not exist, create image with no_iamge.jpg
    //if $img is empty (f.e. in DB) we get error code 403...
		if (!$file){
			return $imgSrc;
		}

		//dir with original images
		$uploadDir = $this->getMainUplodaDir();
		// dir for new images with new dimension
		$fileDir = $this->getFileDir();
		//full filename with original img
		$imgPath = $uploadDir . '/' . $file->getFilename();

		// create hash that specifies the path and the settings
		$info = \pathinfo($imgPath);
		$ext = $info['extension'];
		$hash = md5($imgPath) . '_' . $maxwidth . '_' . $maxheight . '_' . $q;
		$newImgSrc = $fileDir . '/' . $hash . '.' . $ext;

		// is the file cached?
		if (\file_exists($newImgSrc)) {
			$image = \Nette\Image::fromFile($newImgSrc);
			$image->send();
			$this->terminate();
		}

		// create new file from uploaded file
		$image = \Nette\Image::fromFile($imgPath);

		// coutn new image dimensions
		if ($maxwidth >= $image->getWidth() && $maxheight >= $image->getHeight()) {
			$width = $image->getWidth();
			$height = $image->getHeight();
		} else {
			$width = (!$maxwidth || $maxwidth >= $image->getWidth()) ? $image->getWidth() : $maxwidth;
			$height = (!$maxheight || $maxheight >= $image->getHeight()) ? $image->getHeight() : $maxheight;

			if ($image->getWidth() == $image->getHeight()) {
				if ($width > $height) {
					$width = $height;
				} else {
					$height = $width;
				}
			}
		}

			// save
			$image->resize($width, $height, \Nette\Image::FILL)
							->crop('50%', '50%', $width, $height)
							->save($newImgSrc, $q);

			$image->send();
			$this->terminate();
		}
	}

