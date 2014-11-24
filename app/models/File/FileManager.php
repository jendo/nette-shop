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


	public function add(File $file)
	{

		//$this->dibi()->insert($this->getName(), $file->toArray())->execute();

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
