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

	/**
	 * Find category
	 *
	 * @param id $id
	 * @return \DibiRow
	 */
	public function find($id)
	{
		return $this->dibi()->select('*')->from($this->getName())->where(array('id' => $id))->fetch();
	}


	/**
	 * Finds all categories
	 *
	 * @return array
	 */
	public function findAll()
	{
		return $this->dibi()->query('SELECT * FROM category ORDER BY `order`')->fetchAll();
	}

	public function getName()
	{
		return self::NAME;
	}

}
