<?php

namespace App\FrontModule\Presenters;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \App\Presenters\BasePresenter
{

	/** @var \App\Model\CategoryManager  */
	private $categoryManager;

	protected function beforeRender()
	{
		parent::beforeRender();
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
