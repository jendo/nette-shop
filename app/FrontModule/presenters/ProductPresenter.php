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
		$fileManager = $this->getManagerFactory()->file();
		$dibiObject = $productManager->find($id);
		$this->product = new \App\Model\Product\Product($dibiObject);
		$this->product->setFiles($fileManager->findProductFiles($id));
	}

	public function renderShow()
	{
		$photo = $this->getPhotoProperties();
		$this->template->product = $this->product;
		$this->template->width = $photo['mainPhotoProperties']['width'];
		$this->template->height = $photo['mainPhotoProperties']['height'];
	}

}