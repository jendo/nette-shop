<?php

namespace App\Model\Category;

final class Category extends \Core\Base\BaseObject
{

	private $id;

	private $name;

	private $webname;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getWebname()
	{
		return $this->webname;
	}

	public function setWebname($webname)
	{
		$this->webname = $webname;
	}

	
	public function toArray()
	{

	}
}