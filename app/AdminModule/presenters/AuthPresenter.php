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
		$form->onSuccess[] = callback($this, 'processFormInPresneter');
		return $form;
	}

	public function processFormInPresneter(\Components\BaseFormComponent $sender, \Forms\LogInForm $form)
	{
		try {
			$values = $form->getValues();
			// User will be automaticly logout after 1 hour
			// or when close the browser (TRUE)
			$this->user->setExpiration('60 minutes', FALSE);
			$this->user->login($values['login'], $values['pass']);
			// Redirect to dashboard
			$this->redirect(':Admin:Dashboard:default');
		} catch (\Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
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