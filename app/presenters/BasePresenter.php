<?php

namespace App\Presenters;

use Nette;

/**
 * Base presenter for whole application
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/**
	 * @persistent
	 * @var string
	 */
	public $lang = 'cs';

	/**
	 * @var \LiveTranslator\Translator
	 */
	public $translator;

	/**
	 * Connect translator model into presenter
	 *
	 * @param \LiveTranslator\Translator $translator
	 */
	public function injectTranslator(\LiveTranslator\Translator $translator)
	{
		$this->translator = $translator;
	}

	/**
	 *
	 * @return \LiveTranslator\Translator
	 */
	public function getTranslator()
	{
		return $this->translator;
	}

	/**
	 *
	 */
	protected function startup()
	{
		parent::startup();
		$this->translator->setCurrentLang($this->lang);
	}

	protected function beforeRender()
	{
		parent::beforeRender();
		// Add custom template vars
		\Application\Templates\TemplateVars::setVars($this->template);
	}

	/**
	 * Overwrite this method to add translator in template
	 *
	 * @param type $class
	 * @return ITemplate
	 */
	protected function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		// Add translator to all templates
		$template->setTranslator($this->translator);
		return $template;
	}

	/**
	 * Overwrite this method to add translator in ALL form components
	 *
	 * @param type $name
	 * @return \App\Presenters\BaseFormComponent
	 */
	protected function createComponent($name)
	{
		$component = parent::createComponent($name);
		// Add translator to all form components (this is not for compnents templates!!)
		if ($component instanceof \Components\BaseFormComponent) {
			$component->setTranslator($this->translator);
		}
		return $component;
	}

}
