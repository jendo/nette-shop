<?php

namespace Components;

use Nette\Utils\Paginator;

/**
 * Paginator (encapsulates Nette Paginator component to setup its)
 *
 * @package Components
 * @author Michal Jenis <jenis.michal@gmail.com>
 */
final class Pagination extends BaseComponent
{

	/** @persistent */
	public $page = 1;

	/**
	 * Size of pages (left or right)
	 *
	 * @var int
	 */
	public static $pageWidth = 5;

	/** @var Paginator */
	private $paginator;

	public function __construct(Core\Base\BaseManager $manager = null, \Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct($manager, $parent, $name);
		$this->onBeforeRender[] = callback($this, 'beforeRender');
	}

	/**
	 * Another algorithm for counting paginator steps
	 *
	 *
	 * @return array
	 */
	private function getPaginatorSteps()
	{
		$paginator = $this->getPaginator();
		if ($paginator->pageCount >= 2) {
			$max = min($paginator->pageCount, $page + static::$pageWidth - 1);
			$min = max(1, $page - static::$pageWidth + 1);
			$steps = range($min, $max);
		}
		return $steps;
	}

	/**
	 * Render component
	 *
	 * @return void
	 */
	public function beforeRender()
	{
		$paginator = $this->getPaginator();
		$page = $paginator->page;
		$border = ceil(self::$pageWidth / 2);

		if ($paginator->pageCount < 2) {
			$steps = array($page);
		} else {
			$count = $paginator->pageCount - 1;

			//naplnim si pole od prvej po poslednu stranku
			for ($i = 0; $i <= $count; $i++) {
				$arr[] = $i + $paginator->firstPage;
			}

			//vyber len tolko stran z celkoveho poctu kolko chcem ukazat
			//ak je aktulna strana viac ako polovica poctu ukazanych stran
			if ($page > $border) {
				//ak uz nemam dost stran zlavej strany
				if ($paginator->pageCount < $page + $border)
					$steps = array_slice($arr, $paginator->pageCount - self::$pageWidth, self::$pageWidth);
				else
					$steps = array_slice($arr, $page - $border, self::$pageWidth);
			}
			//inak ukazujeme prych X maximalne zovelnych stranok
			else {
				$steps = array_slice($arr, 0, self::$pageWidth);
			}
		}
		$this->template->steps = $steps;
		$this->template->paginator = $paginator;
	}

	/**
	 * Gets paginator
	 *
	 * @return Nette\Utils\Paginator
	 */
	public function getPaginator()
	{
		if (!$this->paginator) {
			$this->paginator = new Paginator();
		}
		return $this->paginator;
	}

	/**
	 * Loads state informations.
	 * Metóda loadState je volaná vždy pri pripojení komponenty k presenteru.
	 * @param  array
	 * @return void
	 */
	public function loadState(array $params)
	{
		parent::loadState($params);
		$this->getPaginator()->setPage($this->page);
	}

}