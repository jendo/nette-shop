<?php

namespace App\FrontModule\Presenters;

use Nette;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$categoryManager = $this->getCategoryManager();
		$this->template->anyVariable = 'any value';
	}

	public function createComponentLogInForm($name)
	{
		$form = new \Components\BaseFormComponent(function($parent,$name) {
							return new \Forms\LogInForm($parent,$name);
						}, $this, $name);
		$form->directRender = false;
		return $form;
	}

}
