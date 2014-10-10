<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$categoryManager = $this->getCategoryManager();
		$this->template->anyVariable = 'any value';
	}

}
