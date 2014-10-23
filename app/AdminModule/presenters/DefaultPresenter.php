<?php

namespace App\AdminModule\Presenters;

use Nette;

/**
 * Homepage presenter.
 */
class DefaultPresenter extends BasePresenter
{

	public function createComponentLogInForm($name)
	{
		$form = new \Components\BaseFormComponent(function($parent,$name) {
							return new \Forms\LogInForm($parent,$name);
						}, $this, $name);
		$form->directRender = false;
		return $form;
	}

}