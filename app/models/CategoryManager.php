<?php

namespace App\Model;

use Nette;

class CategoryManager extends Nette\Object
{

	/** @var \DibiConnection */
	private $dibi;

	public function __construct(\DibiConnection $dibi)
	{
		$this->dibi = $dibi;
	}

	public function findAll()
	{
		return $this->dibi->query('SELECT * FROM category ORDER BY `order`')->fetchAll();
	}

}
