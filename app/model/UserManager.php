<?php

namespace App\Model;

use Nette;

/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator
{


	/** @var \DibiConnection  */
	protected $dibi;

	public function __construct(\DibiConnection $dibi)
	{
		$this->dibi = $dibi;
	}

	public function authenticate(array $credentials)
	{
		
	}

}
