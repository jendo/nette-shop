<?php

namespace App\AdminModule\Presenters;

use Nette;

/**
 * Login presenter for Admin module
 *
 * @author Michal  Jenis <jenis.michal@gmail.com>
 */
class AuthPresenter extends BasePresenter
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

	/**
	 * Logout action
	 *
	 * @return void
	 */
	public function actionLogout()
	{
		$clearIdentity = false;
		$this->getUser()->logout($clearIdentity);
		$this->flashMessage('You have been logged out.');
		$this->redirect('Auth:login');
	}

}