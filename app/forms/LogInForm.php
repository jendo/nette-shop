<?php

namespace Forms;

final class LogInForm extends BaseForm
{
	/*
	 * Implemented abstract method - creates body of form
	 *
	 * @see \Forms\BaseForm
	 */

	protected function init()
	{
		$this->setMethod('GET');

		// Text inpout -  email
		$textControls[] = $this->addText('email', 'Email')
						->setAttribute('placeholder', 'Email');

		// Text input - password
		$textControls[] = $this->addPassword('pass', 'Password')
						->setAttribute('placeholder', 'Password');

		// Submit button
		$submit = $this->addSubmit('signup', 'Log in');

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

}
