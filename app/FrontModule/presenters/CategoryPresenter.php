<?php

namespace App\FrontModule\Presenters;

class CategoryPresenter extends BasePresenter
{

	/**
	 * Current category object
	 *
	 * @var string
	 */
	private $category;


	/**
	 * Show category
	 *
	 * @param type $id
	 * @param type $name
	 */
	public function actionShow($id, $name)
	{
		//var_dump(\Nette\Utils\Strings::webalize($name));
		$categoryManager = $this->getCategoryManager();
		$this->category = $categoryManager->find($id);

	}

	public function renderShow()
	{
		$this->template->category = $this->category;
	}

}

