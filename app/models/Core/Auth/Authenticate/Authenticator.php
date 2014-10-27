<?php

namespace Core\Auth\Authenticate;

use Nette;
use Nette\Security as NS;

/**
 * First own authenticator - object to verifiy username and password
 * 
 * @package Core\Auth
 * @author Michal Jenis <jenis.michal@gmail.com>
 */
final class Authenticator extends Nette\Object implements NS\IAuthenticator
{
	
	/** @var \DibiConnection */
	private $dibi;
	
	/** \App\Model\UserManager */
	private $userManager;
	
	public function __construct(\App\Model\UserManager $userManager)
	{
		$this->userManager = $userManager;
	}
	
	public function authenticate(array $credentials)
	{
		$userName = $credentials[self::USERNAME];
		$pass = $credentials[self::PASSWORD];
		
		$row = false;
		if (!$row) {
				throw new NS\AuthenticationException('User not found.');
		}
		
	}	
}