<?php

namespace App\FrontModule\Presenters;

final class ProductPresenter extends BasePresenter
{

	/**
	 * Current product object
	 *
	 * @var \App\Model\Product\Product
	 */
	private $product;

	/**
	 *
	 * @param int $id
	 * @param string $name
	 */
	public function actionShow($id, $name)
	{
		$productManager = $this->getManagerFactory()->product();
		$dibiObject = $productManager->find($id);
		$this->product = new \App\Model\Product\Product($dibiObject);

	}

	public function renderShow()
	{
		$this->template->product = $this->product;
	}

}