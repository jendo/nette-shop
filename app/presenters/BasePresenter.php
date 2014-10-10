<?php

namespace App\Presenters;

use Nette,
		App\Model;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/** @var \App\Model\CategoryManager  */
	private $categoryManager;

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
