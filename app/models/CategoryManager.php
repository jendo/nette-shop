<?php

namespace App\Model;

use Nette;

final class CategoryManager extends \Core\Base\BaseManager
{
	
	/**
	 * Manager name
	 *
	 * @var string
	 */
	const NAME = 'category';

	public function findAll()
	{
		return $this->dibi()->query('SELECT * FROM category ORDER BY `order`')->fetchAll();
	}

	public function getName()
	{
		self::NAME;
	}

}
