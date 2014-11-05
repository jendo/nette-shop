<?php

namespace App\AdminModule\Presenters;

use Nette;

/**
 * Presenter for secure requests (need logged user)
 *
 * @package App\AdminModule\Presenters
 * @author Michal Jenis <jenis.michal@gmail.com>
 */
class SecurePresenter extends BasePresenter
{
	protected function startup()
	{
		parent::startup();

		// Check if user is logged in
		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect(':Admin:Auth:login');
		}

	}
}
