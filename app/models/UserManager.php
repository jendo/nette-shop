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
	
	public function getName()
	{
		return self::NAME;
	}	
}
