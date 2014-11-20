<?php

namespace Application\Component;

use Core;

/**
 * Store manager stores one default manager and some additional managers for components (forms include)
 *
 * @author Michal JEnis <jenis.michal@gmail.com>
 * @package Applicaton\Component
 */
class ManagerStore extends \Nette\Object
{

	/**
	 * Object manager
	 *
	 * Core\Base\BaseManager
	 */
	private $manager;
	/**
	 * Additional managers
	 *
	 * @var array
	 */
	private $managers = array();

	/**
	 * Constructor
	 *
	 * @param Core\Base\BaseManager $manager
	 */
	public function __construct(Core\Base\BaseManager $manager = null)
	{
		$this->manager = $manager;
	}

	/**
	 * Gets manager for actual entity (or additional manager)
	 *
	 * @param string $ident
	 * @return Core\Base\BaseManager
	 * @throws \LogicException
	 */
	public function getManager($ident = null)
	{
		$ident = strtolower($ident);
		if ($ident) {
			if (!isset($this->managers[$ident])) {
				throw new \LogicException(sprintf('Manager with "%s" name could not be found.', $ident));
			}
			return $this->managers[$ident];
		} else {
			if (null === $this->manager) {
				throw new \LogicException('Manager for this form has not been set!');
			}
			return $this->manager;
		}
	}

	/**
	 * Adds manager to object
	 *
	 * @param Core\Base\BaseManager $manager
	 * @return BaseFrom
	 */
	public function addManager(Core\Base\BaseManager $manager)
	{
		$ident = strtolower($manager->getName());
		$this->managers[$ident] = $manager;
		return $this;
	}
}
