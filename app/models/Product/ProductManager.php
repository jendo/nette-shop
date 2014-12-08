<?php

namespace App\Model\Product;

final class ProductManager extends \Core\Base\BaseManager
{

	/**
	 * Id column
	 *
	 * @var string
	 */
	const COLUMN_ID = 'id';

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
	 * Product price
	 *
	 * @var float
	 */
	const COLUMN_PRICE = 'price';

	/**
	 * Product desc.
	 *
	 * @var float
	 */
	const COLUMN_DESC = 'description';

	/**
	 * Product created date
	 *
	 * @var float
	 */
	const COLUMN_CREATED = 'created';

	/**
	 * Product modified date
	 *
	 * @var float
	 */
	const COLUMN_MODIFIED = 'modified';

	/**
	 * Product deleted date
	 *
	 * @var float
	 */
	const COLUMN_DELETED = 'deleted';

	/**
	 * Product flag new
	 *
	 * @var float
	 */
	const COLUMN_NEW_FLAG = 'new';

	/**
	 * Product flag top
	 *
	 * @var float
	 */
	const COLUMN_TOP_FLAG = 'top';

	/**
	 * Product flag top
	 *
	 * @var float
	 */
	const COLUMN_AVAIBLE_FLAG = 'avaible';

	/**
	 * Product flag active
	 *
	 * @var float
	 */
	const COLUMN_ACTIVE_FLAG = 'active';


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
	 * Get products count in desired category
	 *
	 * @param int $catId
	 * @return int
	 */
	public function getCountByCategory($catId)
	{
		return $this->dibi()->query('
			SELECT COUNT(id) FROM [' . $this->getName() . '] p
			INNER JOIN  [product_category] pc ON (p.id = pc.product_id)
			WHERE pc.category_id = %i',
			$catId
			)->fetchSingle();
	}


	/**
	 * Get products by category
	 *
	 * @param type $catId
	 * @param type $limit
	 * @param type $offset
	 * @return array
	 */
	public function findAllByCategory($catId, $limit = null, $offset = null)
	{
		$data = array();

		$result =  $this->dibi()->query('
			SELECT
				' . self::COLUMN_ID . ',
				' . self::COLUMN_NAME . ',
				' . self::COLUMN_WEBNANE . ',
				' . self::COLUMN_PRICE . ',
				' . self::COLUMN_DESC . ',
				' . self::COLUMN_CREATED . ',
				' . self::COLUMN_MODIFIED . ',
				' . self::COLUMN_DELETED . ' ,
				' . self::COLUMN_NEW_FLAG . ',
				' . self::COLUMN_TOP_FLAG . ',
				' . self::COLUMN_AVAIBLE_FLAG . ',
				' . self::COLUMN_ACTIVE_FLAG . ',
				file_id,
				filename
			FROM [' . $this->getViewName() . ']
			WHERE ' . self::COLUMN_AVAIBLE_FLAG . ' = 1 AND category_id = %i %lmt %ofs',
			$catId, $limit, $offset
			);

		while($row = $result->fetch()){
			$data[] =  new Product($row);
		}

		return $data;
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

	public function getViewName()
	{
		return 'view_product';
	}

}