<?php

namespace App\FrontModule\Forms;

final class OrderForm extends BaseForm
{

	const MSG_TARGET = 'error';

	public function init()
	{
		$this->setMethod('POST');

		$textControls[] = $this->addText('name', 'Vaše meno')
						->setAttribute('placeholder', '*VAŠE MENO');

		//CSRF protection
		$this->addProtection();

		// Submit button
		$submit = $this->addSubmit('send', 'Odoslať');
	}

	public function getMsgTarget()
	{
		return self::MSG_TARGET;
	}

	public function formSubmitted(\IForm $form)
	{

	}

	public function formValidate(\IForm $form)
	{

	}

	public function processError(\IForm $form)
	{

	}

	public function processForm(\IForm $form)
	{

	}
}