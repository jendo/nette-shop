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

	public function createComponentOrderForm($name)
	{
			$orderForm = new \App\FrontModule\Forms\OrderForm();
			$formComponent = new \Components\FormComponent($orderForm, $this, $name);
			return $formComponent->create();
	}

		/**
	 *
	 * @param int $id
	 * @param string $name
	 */
	public function actionShow($id, $name)
	{
		$productManager = $this->getManagerFactory()->product();
		$fileManager = $this->getManagerFactory()->file();
		$this->product = $productManager->find($id);
		$this->product->setMainProductFile($fileManager->findMainProductFile($id));
	}

	public function renderShow()
	{
		$photo = $this->getPhotoProperties();
		$this->template->product = $this->product;
		$this->template->width = $photo['mainPhotoProperties']['width'];
		$this->template->height = $photo['mainPhotoProperties']['height'];
	}

}