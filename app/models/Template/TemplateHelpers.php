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

	public function fullImgUrl(\App\Model\File\File $image, \Nette\Application\UI\Presenter $presenter, $maxwidth = 100, $maxheight = 100)
	{
		$fakeFilename = md5($image->getFilename()). '.png';
		$attrs = array('id' => $image->getId(), 'name' => $fakeFilename, 'maxwidth' => $maxwidth, 'maxheight' => $maxheight);
		return $presenter->link(':Core:Tools:showFullImage', $attrs);
	}


}