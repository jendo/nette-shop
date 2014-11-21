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


	/** @var \Core\ManagerFactory */
	private $managerFactory;

	public function __construct(\Core\ManagerFactory $managerFactory)
	{
		$this->managerFactory = $managerFactory;
	}

	public function authenticate(array $credentials)
	{
		$userName = $credentials[self::USERNAME];
		$password = $credentials[self::PASSWORD];
		$userManager = $this->managerFactory->user();
		$user = $userManager->findUser($userName);

		if (!$user) {
				throw new NS\AuthenticationException('Užívateľ nebol nájdený',self::IDENTITY_NOT_FOUND);
		}

		if (!NS\Passwords::verify($password, $user->password)) {
				throw new NS\AuthenticationException('Neplatné heslo',self::INVALID_CREDENTIAL);
		}

		// For security reason we remove password from user
		unset($user->password);
		return new NS\Identity($user->id, $user->role);

	}
}