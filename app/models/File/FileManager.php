<?php

namespace App\Model\File;

use Nette;

/**
 * Users management.
 */
final class FileManager extends \Core\Base\BaseManager
{

	const DEFAULT_FILE_TYPE = 1;

	/**
	 * Filename column
	 *
	 * @var string
	 */
	const COLUMN_FILENAME = 'filename';

	/**
	 * Filename column
	 *
	 * @var string
	 */
	const COLUMN_FILE_TYPE = 'file_type_id';

	/**
	 * Manager name
	 *
	 * @var string
	 */
	const NAME = 'file';


	/**
	 * Insert file into database
	 *
	 * @param \App\Model\File\File $file
	 * @return int Last inserted id
	 */
	public function add(File $file)
	{
		return $this->dibi()->insert($this->getName(), $file->toArray())->execute(\dibi::IDENTIFIER);
	}

	/**
	 *
	 * @param int $id Product ID
	 * @return array Product files
	 */
	public function findProductFiles($id)
	{
		$data = array();
		$result = $this->dibi()->select('*')
						->from($this->getName(),'f')
						->innerJoin('product_file', 'pf')
						->on('f.id = pf.file_id')
						->where('pf.product_id = %i',$id)
						->execute();
		
		while($row = $result->fetch()){
			$data[] = new File($row);
		}
		return $data;
	}

	/**
	 *
	 * @param \App\Model\Trip\Trip $trip
	 * @param \App\Model\File\File $file
	 * @return boolean
	 */
	public function addTripFile(\App\Model\Trip\Trip $trip, File $file)
	{
		$table = 'file_trip';
		$data = array('trip_id' => $trip->getId(), 'file_id' => $file->getId());
		$this->dibi()->insert($table, $data)->execute();
		return true;
	}

	/**
	 *
	 * @param \App\Model\File\Trip $trip
	 * @param array $files
	 * @return boolean
	 */
	public function addTripFiles(\App\Model\Trip\Trip $trip,  array $files)
	{
		foreach ($files as $file) {
			$this->addTripFile($trip, $file);
		}
		return true;
	}

	/**
	 * Generate file name for storing image
	 *
	 * @param string $fileName
	 * @param int $id
	 * @param string $ident
	 * @return string
	 * @throws \InvalidArgumentException for empty extension
	 */
	public function generateName($fileName, $id = null, $ident = null)
	{
		$extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		if (!$extension) {
			throw new \InvalidArgumentException('The extension of file is empty!');
		}
		$fileName = ($id ? str_pad($id, 8, '0', STR_PAD_LEFT) : '') . ($ident ?: '') . substr(md5(uniqid(rand())), 0, 10);
		return $fileName . '.' . $extension;
	}


	public function getName()
	{
		return self::NAME;
	}

}
