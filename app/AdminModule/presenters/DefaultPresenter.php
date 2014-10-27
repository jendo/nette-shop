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
		$user = $this->getUser();
		$form = new \Components\BaseFormComponent(function($parent,$name) use($user) {
							$loginForm = new \Forms\LogInForm($parent,$name);
							$loginForm->addUserObject($user);
							return $loginForm;
						}, $this, $name);
		$form->directRender = false;
		return $form;
	}

}