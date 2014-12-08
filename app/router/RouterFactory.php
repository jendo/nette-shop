<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 * Text wrapped in [] in  mask is optional
 * Text wrapped in <> in mask is variable paramaters passed to presenter
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		/**
		 * Object Route
		 * 1 parameter is mask
		 * 2 parameter is default action of presenter
		 * 3 optional parameter is for flags Route::ONE_WAY or Route::SECURED
		 */
		$router = new RouteList();

		// Admin
		$router[] = new Route(
						'admin/<presenter>/<action>/<id>',
						array(
							'module' => 'Admin',
							'presenter' => 'Dashboard',
							'action' => 'default',
							'id' => NULL
						)
		);

		// Category
		$router[] = new Route(
						'c/<id>/<name .*>',
						array(
							'module' => 'Front',
							'presenter' => 'Category',
							'action'	=> 'show'
						)
		);

		// Product
		$router[] = new Route(
						'p/<id>/<name .*>',
						array(
								'module' => 'Front',
								'presenter' => 'Product',
								'action' => 'show'
						)
		);

		$router[] = new Route(
						'data/images/<id>/<maxwidth>/<maxheight>/<filename>',
						array(
								'module' => 'Core',
								'presenter' => 'Tools',
								'action' => 'ShowFile'
						)
		);

		$router[] = new Route('<presenter>/<action>[/<id>]', array(
				'module' => 'Front',
				'presenter' => 'Homepage',
				'action' =>	'default',
				'id' => NULL
		));

		return $router;
	}

}
