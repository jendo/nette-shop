<?php

namespace App\Model\Product;

final class Product extends \Core\Base\BaseObject
{

	private $id;

	private $name;

	private $webname;

	private $price;

	private $description;


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

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	
	public function toArray()
	{

	}

}