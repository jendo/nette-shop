<?php

namespace App\Model\Product;

final class Product extends \Core\Base\BaseObject
{

	/**
	 * Product ID
	 *
	 * @var int
	 * @generatedValue
	 * @column(type="integer")
	 */
	private $id;

	/**
	 * Product name
	 *
	 * @var string Product name
	 * @column(name="name",type="string")
	 */
	private $name;

	/**
	 * Product webname
	 *
	 * @var string Product webname
	 * @column(name="webname",type="string")
	 */
	private $webname;

	/**
	 * Product webname
	 *
	 * @var string Product price
	 * @column(name="price",type="decimal", precision=4,scale=2)
	 */
	private $price;

	/**
	 * Product webname
	 *
	 * @var string Product description
	 * @column(name="description",type="text",nullable=true)
	 */
	private $description;

	/**
	 * Product created date
	 *
	 * @var \DateTime
	 * @column(name="created",type="datetime",)
	 */
	private $created;

	/**
	 * Product modified date
	 *
	 * @var \DateTime
	 * @column(name="modified",type="datetime",nullable=true)
	 */
	private $modified;

	/**
	 * Product deleted date
	 *
	 * @var \DateTime
	 * @column(name="deleted",type="datetime",nullable=true)
	 */
	private $deleted;

	/**
	 * Flag if product is new
	 *
	 * @var int
	 * @column(name="new",type="int")
	 */
	private $new;

	/**
	 * Flag if product is top
	 *
	 * @var int
	 * @column(name="top",type="int")
	 */
	private $top;

	/**
	 * Flag if product is avaible
	 *
	 * @var int
	 * @column(name="avaible",type="int")
	 */
	private $avaible;

	/**
	 * Flag if product is active
	 *
	 * @var int
	 * @column(name="active",type="int")
	 */
	private $active;

	/**
	 * Product
	 *
	 * @var type
	 */
	private $files;

	/**
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 *
	 * @param type $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 *
	 * @param type $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 *
	 * @return string
	 */
	public function getWebname()
	{
		return $this->webname;
	}

	/**
	 *
	 * @param string $webname
	 */
	public function setWebname($webname)
	{
		$this->webname = $webname;
	}

	/**
	 *
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 *
	 * @param float $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 *
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 *
	 * @param \DateTime $created
	 */
	public function setCreated(\DateTime $created)
	{
		$this->created = $created;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getModified()
	{
		return $this->modified;
	}

	/**
	 *
	 * @param \DateTime $modified
	 */
	public function setModified(\DateTime $modified)
	{
		$this->modified = $modified;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getDeleted()
	{
		return $this->deleted;
	}

	/**
	 *
	 * @param \DateTime $deleted
	 */
	public function setDeleted(\DateTime $deleted)
	{
		$this->deleted = $deleted;
	}

	/**
	 *
	 * @return int
	 */
	public function getNew()
	{
		return $this->new;
	}

	/**
	 *
	 * @param int $new
	 */
	public function setNew($new)
	{
		$this->new = $new;
	}

	/**
	 *
	 * @return int
	 */
	public function getTop()
	{
		return $this->top;
	}

	/**
	 *
	 * @param int $active
	 */
	public function setTop($top)
	{
		$this->top = $top;
	}

	/**
	 *
	 * @return int
	 */
	public function getAvaible()
	{
		return $this->avaible;
	}

	/**
	 *
	 * @param int $active
	 */
	public function setAvaible($avaible)
	{
		$this->avaible = $avaible;
	}

	/**
	 *
	 * @return int
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 *
	 * @param int $active
	 */
	public function setActive($active)
	{
		$this->active = $active;
	}

	/**
	 *
	 * @return type
	 */
	public function getFiles()
	{
		return $this->files;
	}

	/**
	 *
	 * @param \App\Model\File\File $file
	 */
	public function setFile(\App\Model\File\File $file)
	{
		$this->files[] = $file;
	}

	/**
	 *
	 * @param array $files
	 */
	public function setFiles(array $files)
	{
		foreach ($files as $file) {
			$this->setFile($file);
		}
	}

	public function toArray()
	{

	}

}