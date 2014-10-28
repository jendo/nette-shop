<?php

namespace App\Model;

use Nette;

/**
 * Users management.
 */
final class UserManager extends \Core\Base\BaseManager
{
	
	/**
	 * Manager name
	 *
	 * @var string
	 */
	const NAME = 'user';

	/**
	 * Username column
	 * 
	 * @var string
	 */
	const COLUMN_NAME = 'login';

	public function findUser($username)
	{
		 return $result = $this->dibi()
							->select('id, login, password, role')
							->from($this->getName())
							->where(self::COLUMN_NAME . ' = %s',$username)
						 ->fetch();
				
	}

	public function getName()
	{
		return self::NAME;
	}

}
