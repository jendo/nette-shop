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

		$textControls[] = $this->addText('email', 'Email')
						->setAttribute('placeholder', '*EMAIL');

		$this->addTextArea('notice', 'Poznámka')
						->setAttribute('placeholder', 'Váše prípadné poznámky, otázky k tomuto produktu ...');

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
		$values = $form->getValues(TRUE);
		$this->presenter->payload->target['class'] = $this->getMsgTarget();
		//$this->presenter->payload->focus['name'] = $key;
		$form->addError('Prosím vyplňte všetky polia');
		$this->presenter->invalidateControl('orderFormSnippet');
		return $form->hasErrors();
	}

	public function processError(\IForm $form)
	{

	}

	public function processForm(\IForm $form)
	{

	}
}