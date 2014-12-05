<?php

namespace App\FrontModule\Presenters;

/**
 * Base presenter for all Front module presenters.
 */
abstract class BasePresenter extends \App\Presenters\BasePresenter
{

	/** @var \App\Model\CategoryManager  */
	private $categoryManager;

	/**
	 * Genereal photo properties
	 *
	 * @var array
	 */
	private $photo;

	protected function startup()
	{
		parent::startup();
		$this->categoryManager = $this->getManagerFactory()->category();
		$this->photo = \Nette\Environment::getVariable('photo');
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

	/**
	 * Gets paginator count of items per page
	 *
	 * @return int Number of items per page
	 */
	public function getPaginatorItemsPerPage()
	{
		$paginator =  \Nette\Environment::getVariable('paginator');
		return $paginator['itemsPerPage'];
	}

	/**
	 * Gets general photyo properties
	 *
	 * @return array
	 */
	public function getPhotoProperties()
	{
		return $this->photo;
	}

}
