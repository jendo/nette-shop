<?php

namespace App\Presenters;

use Nette,
	App\Model;


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

	public function createComponentSignInForm($name)
	{
		$form = new \Components\BaseFormComponent(function($parent,$name) {
							return new \Forms\LogInForm($parent,$name);
						}, $this, $name);
		$form->directRender = false;
		return $form;
	}

}
