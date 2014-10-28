<?php

namespace Core\Base;

use Nette;

/**
 * Base of managers
 * 
 * @package Core\Base
 * @author Michal Jenis <jenis.michal@gmail.com>
 */
abstract class BaseManager extends Nette\Object
{

	/** @var \DibiConnection */
	private $dibi;

	public function __construct(\DibiConnection $dibi)
	{
		$this->dibi = $dibi;
	}
	
	/**
	 * Gets dibi connection
	 * 
	 * @return \DibiConnection;
	 */
	public function dibi()
	{
		return $this->dibi;
	}
	
	/**
	 * Gets manager name
	 *
	 * @return string
	 */
	abstract public function getName();

}
