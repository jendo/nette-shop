<?php

namespace App\FrontModule\Forms;

abstract class BaseForm extends \Forms\BaseForm
{

	public function getTemplateFileName()
	{
		$class = get_called_class();
		//app/templates/forms/nazovTriedy.latte
		$dir = \Nette\Environment::getVariable('frontAppDir') . '/templates/forms/';
		$class = substr($class, strrpos($class, '\\') + 1);
		$class = strtolower(substr($class, 0, 1)) . substr($class, 1);
		return $dir . $class . '.latte';
	}

}
