<?php

namespace Components;

/**
 * Zakladna komponenta pre vsetky formulare
 * Nastavuje pre vsetky formualre vlastne templaty
 */
class BaseFormComponent extends BaseComponent
{

	/**
	 * Form component factory
	 *
	 * @var \Closure
	 */
	private $formFactory;

	/**
	 * Render form directly (without template)
	 *
	 * @var bool
	 */
	public $directRender = false;

	/**
	 * Function proceed after form submit
	 *
	 * @var array
	 */
	public $onSuccess;

	/**
	 * Constructor
	 *
	 * @param \Closure $formFactory
	 * @param Nette\ComponentModel\IContainer
	 * @param string $name
	 */
	public function __construct(\Closure $formFactory, \Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct(null, $parent, $name);
		$this->formFactory = $formFactory;
		$this->onBeforeRender[] = array($this, 'beforeRender');
	}

	/**
	 * Before render function
	 *
	 * @return void
	 */
	public function beforeRender()
	{
		$form = $this->getForm();
		//Toto uz nie je potreba, nette automaticky predava object form do sablon
		//$this->template->form = $form;
	}

	/**
	 * Gets template file name
	 *
	 * @return string
	 */
	protected function getTemplateFileName()
	{
		return $this->getForm()->getTemplateFileName();
	}

	/**
	 * Create component with form
	 *
	 * @param string $name
	 */
	public function createComponentForm($name)
	{
		$formFactory = $this->formFactory;
		$form = $formFactory($this, $name);
		// Sometimes its usefull to have call back outside form in presneter
		$form->onSuccess[] = callback($this, 'processFormInPresneter');
		return $form;
	}

	/**
	 * Submit form
	 *
	 * @param Forms\BaseForm $form
	 * @return void
	 */
	public function processFormInPresneter( \Forms\BaseForm $form )
	{
		$this->onSuccess($this, $form);
	}

	/**
	 * Gets stored form
	 *
	 */
	public function getForm()
	{
		return $this['form'];
	}

	/**
	 * Set translator to actual form
	 * All text form script (NOT on template) will be translated
	 *
	 * @param \LiveTranslator\Translator $translator
	 * @return type
	 */
	public function setTranslator(\LiveTranslator\Translator  $translator)
	{
		$args = array($translator);
		// Call on ACTUAL FORM method set translator with param : \LiveTranslator\Translator
		return call_user_func_array(callback($this['form'], 'setTranslator'), $args);
	}


	/**
	 * Renders form.
	 * @return void
	 */
	public function render($args = null)
	{
		if ($this->directRender) {
			$this->getForm()->render($args);
		} else {
			parent::render($args);
		}
	}

}