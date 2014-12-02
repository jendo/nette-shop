<?php

namespace Core\Base;

use Nette;

/**
 * Base Object
 */
abstract class BaseObject extends \Nette\Object
{

	public function __construct(\DibiRow $object = null)
	{
		if ($object) {
			$this->init($object);
		}
	}

	/**
	 * Initialize object from dabase DibiRow object
	 *
	 * @param \DibiRow $object
	 */
	public function init(\DibiRow $object)
	{

		$properties = $this->reflection->getProperties();

		foreach($properties as $property){
			$property = $property->getName();
			if (isset($object->$property)) {
				$this->$property = $object->$property;
			}
		}
	}

	/**
	 * Converts object to array
	 */
	abstract public function toArray();
}
