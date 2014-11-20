<?php

namespace App\FrontModule\Presenters;

/**
 * Base presenter for all Front module presenters.
 */
abstract class BasePresenter extends \App\Presenters\BasePresenter
{

	/** @var \App\Model\CategoryManager  */
	private $categoryManager;

	protected function startup()
	{
		parent::startup();
		$this->categoryManager = $this->getManagerFactory()->category();
	}

	protected function beforeRender()
	{
		parent::beforeRender();
		$categories = $this->categoryManager->findAll();
		$this->template->navig = $categories;
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
