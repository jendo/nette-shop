<?php

namespace Forms;

use Nette;

/**
 * Spolocny predok pre vsetky formulare, kotre maju vlastny template a vlastne callbacky na signaly
 * Formular musi dedit od Nette\Application\UI\Form (formular priamo presenteroch) a nie od Nette\Forms\Form ak chceme mat platne valstne callbacky
 */
abstract class BaseForm extends Nette\Application\UI\Form
{

	/**
	 * Custom validator full class name with namespace
	 *
	 * @var string
	 */
	private $customValidtorsClassName;


	public function __construct(Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);
		$this->customValidtorsClassName = \Application\Forms\CustomValidators::getClassName();
		$this->init();
		// From callbacks
		$this->onValidate[] = array($this, 'formValidate');
		$this->onSubmit[] = array($this, 'formSubmitted');
		$this->onSuccess[] = array($this, 'processForm');
		$this->onError[] = array($this, 'processError');
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
	 * Get custom validators class name
	 *
	 * @return string
	 */
	public function getCustomValidtorsClassName()
	{
		return $this->customValidtorsClassName;
	}

	/**
	 * Creates form
	 *
	 * @return void
	 */
	abstract protected function init();

	/**
	 * Occurs when the form is validated
	 */
	abstract public function formValidate($form);

	/**
	 * Occurs when the form is submitted
	 */
	abstract public function formSubmitted($form);

	/**
	 * Occurs when the form is submitted and successfully validated
	 */
	abstract public function processForm($form);

	/**
	 * Occurs when the form is submitted and is not valid
	 */
	abstract public function processError($form);

}
