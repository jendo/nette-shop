<?php

namespace App\FrontModule\Presenters;

class CategoryPresenter extends BasePresenter
{

	/**
	 * Current category object
	 *
	 * @var \App\Model\Category\Category
	 */
	private $category;

	/**
	 * Products of current category
	 *
	 * @var array
	 */
	private $products;


	/**
	 * Show category
	 *
	 * @param type $id
	 * @param type $name
	 */
	public function actionShow($id, $name)
	{
		$categoryManager = $this->getCategoryManager();
		$categoryDibiObject = $categoryManager->find($id);

		if (FALSE === $categoryDibiObject) {

			// Set 404 by set new template
			//$this->setView('notFound');
			//return;

			// Ot throw exception for ErrorPresenter
			$message = '';
			$code = 404;
			throw new \Nette\Application\BadRequestException($message, $code);
		}

		// Initialize object Category
		$this->category = new \App\Model\Category\Category($categoryDibiObject);

		if ($this->category->webname != $name) {
			$this->redirect(301,'Category:show', array('id' => $id, 'name' => $this->category->webname));
		}

		$productManager = $this->getManagerFactory()->product();

		$products = $productManager->findAllByCategoryFluent($this->category->id);
		/** @var \DibiFluent $products */

		$paginator = $this->getPaginator();
		$paginator->setItemCount(count($products));
		$paginator->setItemsPerPage($this->getPaginatorItemsPerPage());

		// GEt products of category
		$limit = $paginator->getLength();
		$offset = $paginator->getOffset();
		$products->limit($limit);
		$products->offset($offset);
		$this->products = $products->fetchAll();

	}

	public function renderShow()
	{
		$this->template->category = $this->category;
		$this->template->products = $this->products;
	}

}

