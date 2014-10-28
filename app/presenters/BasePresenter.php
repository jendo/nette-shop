<?php

/**
 * Base presenter for whole application
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	protected function beforeRender()
	{
		parent::beforeRender();
		// Add custom template vars
		\Application\Templates\TemplateVars::setVars($this->template);
	}

}
