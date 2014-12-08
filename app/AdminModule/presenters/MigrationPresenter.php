<?php

namespace App\AdminModule\Presenters;

class MigrationPresenter extends SecurePresenter
{

	/** @var \DibiConnection */
	private $dibi;

	private $fromTable = 'old_product';

	private $toTable = 'product';

	private $mapping = array();

	private $categories = array();

	public function __construct(\DibiConnection $dibi)
	{
		parent::__construct();
		$this->dibi = $dibi;
	}


	public function actionDefault()
	{
		$this->setMapping();
		$oldData = $this->getOldData();
		$this->importData($oldData);
	}


	public function setMapping()
	{
		$this->mapping['p_price'] = 'price';
		$this->mapping['p_name'] = 'name';
		$this->mapping['p_access_key'] = 'webname';
		$this->mapping['p_desc'] = 'description';
		$this->mapping['p_new'] = 'new';
		$this->mapping['p_top'] = 'top';
		$this->mapping['p_avaible'] = 'avaible';
		$this->mapping['p_active'] = 'active';

		$this->categories['2'] =  1;
		$this->categories['4'] =  2;
		$this->categories['6'] =  3;
		$this->categories['53'] =  4;

	}

	public function getOldData()
	{
		return $this->dibi->select('*')->from($this->fromTable)->execute()->fetchAll();
	}

	public function importData($data)
	{
		foreach($data as $rowdata) {
			$finalData = array();
			$rowdata = (array) $rowdata;

			foreach ($rowdata as $key => $value) {
				if (isset($this->mapping[$key])) {
					$finalData[$this->mapping[$key]] = $value;
				}
			}

			$oldProductId = (int) $rowdata['id'];

			// Ak existuje vazba na existujucu kategoriu
			if (isset($this->categories[$rowdata['c_id']])) {
				$this->dibi->begin();
				// Table product
				$productId = $this->dibi->insert($this->toTable, $finalData)->execute(\dibi::IDENTIFIER);

				// Table product_category
				$data = array('product_id' => $productId, 'category_id' => $this->categories[$rowdata['c_id']] );
				$this->dibi->insert('product_category', $data)->execute();

				// TODO: Table file and file_product
				$oldProductId = rand(40, 387);
				$files = $this->dibi->query('SELECT imgfile FROM old_product2 WHERE id = %i',$oldProductId)->fetchAll();
				foreach($files as $file){
					$fileId = $this->dibi->insert('file', array('filename' => $file->imgfile, 'file_type_id' => 1 ))->execute(\dibi::IDENTIFIER);
					$data = array('product_id' => $productId, 'file_id' => $fileId );
					$this->dibi->insert('product_file', $data)->execute();
				}

				$this->dibi->commit();
			}
		}
		echo "OK";
	}

}

?>
