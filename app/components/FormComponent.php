<?php

namespace Components;

use Nette;
use Nette\Application\UI\Control;

/**
 * Zakladna komponenta pre vsetky formulare
 * Nastavuje pre vsetky formualre vlastne templaty
 * NAstvaju translator pre vsetky formulare
 */
class FormComponent extends BaseComponent
{

	/**
	 *
	 * @var \IForm
	 */
	private $form;

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
	 *
	 * @param \IForm $form
	 * @param Nette\ComponentModel\IContainer $parent
	 * @param type $name
	 */
	public function __construct(\IForm $form, Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct(null, $parent, $name);
		$this->form = $form;
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
	 * Create component with form
	 *
	 * @param string $name
	 */
	function createComponentForm($name)
	{
		$form = $this->form;
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
	 * Gets template file name
	 *
	 * @return string
	 */
	protected function getTemplateFileName()
	{
		return $this->getForm()->getTemplateFileName();
	}

		/**
	 * Set's own templates
	 *
	 * @param type $class
	 * @return Nette\Templating\ITemplate
	 */
	protected function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		// Set own template
		$template->setFile($this->getTemplateFileName());
		//Templates\TemplateHelpers::registerTemplates($template);
		\Application\Templates\TemplateVars::setVars($template);
		return $template;
	}

	/**
	 *
	 * @return \IForm
	 */
	protected function getForm()
	{
		return $this['form'];
		//return $this->form;
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

	/**
	 * Create desired form
	 *
	 * @return type
	 */
	public function create()
	{
		$form = $this->getForm();
		return $form->init();
	}

}