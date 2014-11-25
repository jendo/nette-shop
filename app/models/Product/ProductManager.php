<?php

namespace App\Model\Product;

final class ProductManager extends \Core\Base\BaseManager
{
	/**
	 * Manager name
	 *
	 * @var string
	 */

	const NAME = 'product';

	/**
	 *
	 */
	public function findAllByCategory($catId)
	{
		return $this->dibi()->query('
			SELECT * FROM [' . $this->getName() . '] p
			INNER JOIN  [product_category] pc ON (p.id = pc.product_id)
			WHERE pc.category_id = %i',
			$catId
			)->fetchAll();
	}

	public function getName()
	{
		return self::NAME;
	}

}