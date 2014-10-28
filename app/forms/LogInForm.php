<?php

namespace Forms;

use \Application\Forms\CustomValidators;

final class LogInForm extends BaseForm
{
	
	/**
	 * @var Nette\Security\User 
	 */
	private $user;
	
	/*
	 * Implemented abstract method - creates body of form
	 *
	 * @see \Forms\BaseForm
	 */
	protected function init()
	{
		$this->setMethod('POST');

		// Text inpout -  email
		$textControls[] = $this->addText('login', 'Login')
						->setAttribute('placeholder', 'Login');
						//->addRule(\Nette\Forms\Form::EMAIL, 'Zadali ste neplatný email!');
						//Custom validator testing
						//->addRule($this->getCustomValidtorsClassName() . CustomValidators::IS_DIVISIBLE,'First number must be %d multiple', 2);

		// Text input - password
		$textControls[] = $this->addPassword('pass', 'Password')
						->setAttribute('placeholder', 'Password');

		// Submit button
		$submit = $this->addSubmit('signup', 'Log in');
	}
	
	/**
	 * 
	 */
	public function addUserObject(\Nette\Security\User $user)
	{
		$this->user = $user;
	}


	/**
	 *
	 * @param LogInForm $form
	 */
	public function formValidate($form)
	{
		
	}

	public function processForm($form)
	{
		try {
			$values = $form->getValues();
			//$this->user->setExpiration('+ 400 minutes', true);
			$this->user->login($values['login'], $values['pass']);
			//nasledne redirect
			$this->getPresenter()->redirect(':Front:Homepage:default');
			
		} catch (\Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

	public function formSubmitted($form)
	{
		
	}

	public function processError($form)
	{

	}

}
