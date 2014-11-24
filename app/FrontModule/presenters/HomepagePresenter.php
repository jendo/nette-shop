<?php

namespace App\FrontModule\Presenters;

use Nette;

/**
 * Homepage presenter.
 *
 */
class HomepagePresenter extends BasePresenter
{

	/**
	 *
	 */
	public function renderDefault()
	{
		$categoryManager = $this->getCategoryManager();
		$this->template->anyVariable = 'any value';
	}

	/**
	 *
	 * @param string $name
	 * @return \Components\BaseFormComponent
	 */
	public function createComponentLogInForm($name)
	{
		$manager = null;
		$form = new \Components\BaseFormComponent(function($parent,$name) use($manager) {
							return new \Forms\LogInForm($manager,$parent,$name);
						}, $this, $name);
		$form->directRender = false;
		return $form;
	}

}
