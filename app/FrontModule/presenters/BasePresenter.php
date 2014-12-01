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
	 * @param type $name
	 * @return \Components\Pagination
	 */
	public function createComponentPagination($name)
	{
		return new \Components\Pagination(null, $this, $name);
	}

	/**
	 *
	 * @return \Components\Pagination
	 */
	public function getPagination()
	{
		return $this['pagination'];
	}

	/**
	 * Get Paginagtor from pagination component
	 *
	 * @return \Nette\Utils\Paginator
	 */
	public function getPaginator()
	{
		return $this->getPagination()->getPaginator();
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
