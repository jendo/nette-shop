<?php

namespace App\AdminModule\Presenters;

use Nette;

/**
 * Login presenter for Admin module
 *
 * @author Michal  Jenis <jenis.michal@gmail.com>
 */
class LoginPresenter extends BasePresenter
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