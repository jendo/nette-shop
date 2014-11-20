<?php

namespace Core\Base;

use Nette;

/**
 * Base of managers
 *
 * @package Core\Base
 * @author Michal Jenis <jenis.michal@gmail.com>
 */
abstract class BaseFactory extends Nette\Object
{
	/**
	 * Factories
	 *
	 * @var array
	 */
	private $factories = array();

	/**
	 * Factory for other objects
	 *
	 * @param string $name
	 * @param string|\Closure $class
	 * @return IDataFactory
	 */
	protected function factory($ident, $class)
	{
		if (!isset($this->factories[$ident])) {
			if (is_string($class)) {
				$this->factories[$ident] = new $class($this->context());
			} elseif ($class instanceof \Closure) {
				$this->factories[$ident] = $class();
			} else {
				throw new \InvalidArgumentException('Invalid factory create.');
			}
		}
		return $this->factories[$ident];
	}
}
