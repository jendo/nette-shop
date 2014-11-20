<?php

namespace Core;

/**
 * Factory for other managers
 *
 * @package Core
 * @author Jan Pěček <pecek@internettrading.cz>
 */
class ManagerFactory extends \Core\Base\BaseFactory
{

	/** @var \DibiConnection */
	private $dibi;

	public function __construct(\DibiConnection $dibi)
	{
		$this->dibi = $dibi;
	}

	/**
	 * Returns File manager
	 *
	 * @return App\Model\FileManager
	 */
	public function file()
	{
		$dibi = $this->dibi;
		return $this->factory(__FUNCTION__, function() use($dibi) {
			return new \App\Model\FileManager($dibi);
		});
	}

	/**
	 * Returns Category manager
	 *
	 * @return App\Model\CategoryManager
	 */
	public function category()
	{
		$dibi = $this->dibi;
		return $this->factory(__FUNCTION__, function() use($dibi) {
			return new \App\Model\CategoryManager($dibi);
		});
	}

}