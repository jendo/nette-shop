<?php

namespace Forms;

use \Application\Forms\CustomValidators;

final class LogInForm extends BaseForm
{

	const MSG_TARGET = 'error';

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
						->setAttribute('placeholder', 'Login')
						->addRule(\Nette\Forms\Form::FILLED, 'Prosím vyplňte vyznačené pole.');
						//Custom validator testing
						//->addRule($this->getCustomValidtorsClassName() . CustomValidators::IS_DIVISIBLE,'First number must be %d multiple', 2);

		// Text input - password
		$textControls[] = $this->addPassword('pass', 'Password')
						->setAttribute('placeholder', 'Password')
						->addRule(\Nette\Forms\Form::FILLED, 'Prosím vyplňte vyznačené pole.');

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
		
	}

	public function formSubmitted($form)
	{

	}

	public function processError($form)
	{

	}

	public function getMsgTarget()
	{
		return self::MSG_TARGET;
	}

}
