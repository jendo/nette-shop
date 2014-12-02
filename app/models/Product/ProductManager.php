<?php

namespace App\Model\Product;

final class ProductManager extends \Core\Base\BaseManager
{

	/**
	 * Name column
	 *
	 * @var string
	 */
	const COLUMN_NAME = 'name';

	/**
	 * Webname column
	 *
	 * @var string
	 */
	const COLUMN_WEBNANE = 'webname';

	/**
	 * Filename price
	 *
	 * @var float
	 */
	const COLUMN_PRICE = 'price';

	/**
	 * Manager name
	 *
	 * @var string
	 */

	const NAME = 'product';

	/**
	 * Find product
	 *
	 * @param id $id
	 * @return \DibiRow
	 */
	public function find($id)
	{
		return $this->dibi()->select('*')->from($this->getName())->where(array('id' => $id))->fetch();
	}

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