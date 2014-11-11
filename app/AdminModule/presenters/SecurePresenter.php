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

			$logoutReason = $this->getUser()->getLogoutReason();
			switch ($logoutReason) {
				// User call logOut method
				case \Nette\Http\UserStorage::MANUAL:
					break;
				// User was log out due to inactivity
				case \Nette\Http\UserStorage::INACTIVITY:
					$this->flashMessage('Boli ste odhlaseí zo systému pretože ste neboli viac ako 60 minút aktívny.', 'warn');
					break;
				// User close the browser
				case \Nette\Http\UserStorage::BROWSER_CLOSED:
					$this->flashMessage('Boli ste odhlasení zo systému pretože ste zatvorili váš prehliadač.', 'warn');
					break;
				case \Nette\Http\UserStorage::CLEAR_IDENTITY:
					break;
				default:
					break;
			}

			$this->redirect(':Admin:Auth:login');
		}

	}
}
