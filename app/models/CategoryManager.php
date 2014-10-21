<?php

namespace App\Model;

class CategoryManager
{

	/** @var \DibiConnection */
	private $dibi;

	public function __construct(\DibiConnection $dibi)
	{
		$this->dibi = $dibi;
	}

	public function findAll()
	{
		return $this->dibi->query('SELECT * FROM categories ORDER BY `order`')->fetchAll();
	}

}
