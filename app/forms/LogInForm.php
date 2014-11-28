<?php

namespace Forms;

use \Application\Forms\CustomValidators;
use Nette\Application\Responses\JsonResponse;

final class LogInForm extends BaseForm
{

	const MSG_TARGET = 'error';

	public function init()
	{
		$this->setMethod('POST');

		// Text inpout -  email
		$textControls[] = $this->addText('login', 'Login')
						->setAttribute('placeholder', 'Login');
						//->addRule(\Nette\Forms\Form::FILLED, 'Prosím vyplňte vyznačené pole.');
						//Custom validator testing
						//->addRule($this->getCustomValidtorsClassName() . CustomValidators::IS_DIVISIBLE,'First number must be %d multiple', 2);

		// Text input - password
		$textControls[] = $this->addPassword('pass', 'Heslo')
						->setAttribute('placeholder', 'Heslo');
						//->addRule(\Nette\Forms\Form::FILLED, 'Prosím vyplňte vyznačené pole.');


		//CSRF protection
		$this->addProtection();

		// Submit button
		$submit = $this->addSubmit('signup', 'Prihlásiť');
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
		// Full control for response
		// This terminates life cycle of presenter
		//$this->getPresenter()->sendResponse(new JsonResponse(array('asdasd' => 'asdasd')));
		//$this->getPresenter()->sendJson($form)
		//$this->getPresenter()->sendPayload()

		$values = $form->getValues(TRUE);

		// all fields are manfatory
		foreach ($values as $key => $value) {
			if (empty($value)) {
				$this->presenter->payload->target['class'] = $this->getMsgTarget();
				$this->presenter->payload->focus['name'] = $key;
				$form->addError('Prosím vyplňte všetky polia');
				$this->presenter->invalidateControl('loginFormSnippet');
				return false;
			}
		}

		return $form->hasErrors();
	}

	public function processError(\IForm $form)
	{

	}

	public function processForm(\IForm $form)
	{

	}

}
