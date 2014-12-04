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
	 * @var \Core\ManagerFactory
	 */
	private $managerFactory;

	/**
	 *
	 * @var \Application\Templates\TemplateHelpers
	 */
	private $templateHelpers;

	/**
	 * Main upload dir
	 *
	 * @var string
	 */
	public $mainUplodaDir;

	/**
	 * Alert succes class
	 */
	const ALERT_SUCCESS = 'alert-success';

	/**
	 * Alert info class
	 */
	const ALERT_INFO = 'alert-info';

	/**
	 * Alert error class
	 */
	const ALERT_ERROR = 'alert-error';

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
	 * Gets main upload dir
	 *
	 * @return string
	 */
	public function getMainUplodaDir()
	{
		return $this->mainUplodaDir;
	}


	/**
	 *
	 * @param \Core\ManagerFactory $managerFactory
	 */
	public function injectManagerFactory(\Core\ManagerFactory $managerFactory)
	{
		$this->managerFactory = $managerFactory;
	}

	/**
	 * Gets manager facotry
	 *
	 * @return type
	 */
	public function getManagerFactory()
	{
		return $this->managerFactory;
	}

	/**
	 *
	 * @param \Application\Templates\TemplateHelpers $templateHelpers
	 */
	public function injectTemplateHelpers(\Application\Templates\TemplateHelpers $templateHelpers)
	{
		$this->templateHelpers = $templateHelpers;
	}

	/**
	 *
	 */
	protected function startup()
	{
		parent::startup();
		$this->translator->setCurrentLang($this->lang);
		$this->mainUplodaDir = Nette\Environment::getVariable('uploadDir');
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
		// Register my own template helpers
		$template->registerHelperLoader(callback($this->templateHelpers, 'loader'));

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
