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
		$productManager = $this->getManagerFactory()->product();
		$categoryDibiObject = $categoryManager->find($id);

		//Check kategory ID in url
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

		// Check category webname in url
		if ($this->category->webname != $name) {
			$this->redirect(301,'Category:show', array('id' => $id, 'name' => $this->category->webname));
		}

		// Paginator
		$totalProductsCount = $productManager->getCountByCategory($this->category->id);
		$paginator = $this->getPaginator();
		$paginator->setItemCount($totalProductsCount);
		$paginator->setItemsPerPage($this->getPaginatorItemsPerPage());

		// GEt products of category
		$limit = $paginator->getLength();
		$offset = $paginator->getOffset();
		$this->products = $productManager->findAllByCategory($this->category->id, $limit, $offset);
	}

	public function renderShow()
	{
		$this->template->category = $this->category;
		$this->template->products = $this->products;
	}

}

