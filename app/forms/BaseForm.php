<?php

namespace Forms;

use Nette;

abstract class BaseForm extends Nette\Application\UI\Form
{
	public function __construct(Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);
		$this->init();
	}
	
	/**
	 * Gets template file name
	 *
	 * @return string
	 */
	public function getTemplateFileName()
	{
		$class = get_called_class();
		//app/templates/forms/nazovTriedy.latte
		$dir = Nette\Environment::getVariable('appDir') . '/templates/forms/';
		$class = substr($class, strrpos($class, '\\') + 1);
		$class = strtolower(substr($class, 0, 1)) . substr($class, 1);
		return $dir . $class . '.latte';
	}
	
	/**
	 * Creates form
	 *
	 * @return void
	 */
	abstract protected function init();
	
}
