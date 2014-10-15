<?php

namespace Components;

use Nette\Application\UI\Control;
use Nette;

abstract class BaseComponent extends Control
{

	/**
	 * Before render event
	 *
	 * @var event
	 */
	public $onBeforeRender;

	/**
	 * Set's own templates
	 *
	 * @param type $class
	 * @return Nette\Templating\ITemplate
	 */
	protected function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		$template->setFile($this->getTemplateFileName());
		//Templates\TemplateHelpers::registerTemplates($template);
		//Templates\TemplateVars::setVars($template);
		return $template;
	}

	/**
	 * Gets current component template file name
	 *
	 * @return string
	 */
	protected function getTemplateFileName()
	{
		$dir = Nette\Environment::getVariable('appDir') . '/' . 'templates/components/';
		return $dir . $this->getComponentName() . '.latte';
	}

	/**
	 * Gets component name from class name
	 *
	 * @return string
	 */
	private function getComponentName()
	{
		$class = get_called_class();
		$class = substr($class, strrpos($class, '\\') + 1);
		return strtolower(substr($class, 0, 1)) . substr($class, 1);
	}

	/**
	 * Render component
	 *
	 * @return void
	 */
	public function render($args = null)
	{
		$args = $args ?: func_get_args();
		foreach ((array) $args as $arg => $value) {
			$this->template->$arg = $value;
		}
		parent::__call('onBeforeRender', (array) $args);
		$this->template->render();
		//parent::__call('onAfterRender', (array) $args);
	}

}

