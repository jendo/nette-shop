<?php

namespace App\FrontModule\Presenters;

use Nette;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/** @var \App\Model\CategoryManager  */
	private $categoryManager;

	protected function beforeRender()
	{
		parent::beforeRender();
		\Application\Templates\TemplateVars::setVars($this->template);
		$categories = $this->categoryManager->findAll();
		$this->template->navig = $categories;
	}

	/**
	 * Inject model CategoryManager into presenter
	 */
	public function injectCategoryRepository(\App\Model\CategoryManager $categoryManager)
	{
		$this->categoryManager = $categoryManager;
	}

	/**
	 *
	 * @return \App\Model\CategoryManager
	 */
	public function getCategoryManager()
	{
		return $this->categoryManager;
	}

}
