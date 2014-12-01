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

	/**
	 *
	 * @param type $catId
	 * @return \DibiFluent
	 */
	public function findAllByCategoryFluent($catId)
	{
		$products = $this->dibi()->select('*')
						->from($this->getName(),'p')
						->innerJoin('product_category', 'pc')
						->on('p.id = pc.product_id')
						->where('pc.category_id = %i',$catId);

		return $products;
	}

	public function getName()
	{
		return self::NAME;
	}

}