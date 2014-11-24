<?php

namespace App\Model\File;

class File
{

	private $id;

	private $filename;

	private $fileTypeId;

	public function getId()
	{
		return $this->id;
	}

	public function getFilename()
	{
		return $this->filename;
	}

	public function setFilename($filename)
	{
		$this->filename = $filename;
	}

	public function getFileTypeId()
	{
		return $this->fileTypeId;
	}

	public function setFileTypeId($fileType)
	{
		$this->fileTypeId = $fileType;
	}

	public function toArray()
	{
		return array(
				FileManager::COLUMN_FILENAME => $this->getFilename(),
				FileManager::COLUMN_FILE_TYPE => $this->getFileTypeId()
				);
	}

}