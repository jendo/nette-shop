<?php

namespace App\Model\File;

final class File extends \Core\Base\BaseObject
{

	/**
	 * File ID
	 *
	 * @var int
	 * @generatedValue
	 * @column(type="integer")
	 */
	private $id;

	/**
	 * Filename
	 *
	 * @var string Filename
	 * @column(name="name",type="string")
	 */
	private $filename;

	/**
	 * Tyep of file
	 *
	 * @var int
	 */
	private $fileTypeId;

	/**
	 * File created date
	 *
	 * @var \DateTime
	 * @column(name="created",type="datetime",)
	 */
	private $created;

	/**
	 * File modified date
	 *
	 * @var \DateTime
	 * @column(name="modified",type="datetime",nullable=true)
	 */
	private $modified;

	/**
	 * File deleted date
	 *
	 * @var \DateTime
	 * @column(name="deleted",type="datetime",nullable=true)
	 */
	private $deleted;

	/**
	 *
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 *
	 * @return string
	 */
	public function getFilename()
	{
		return $this->filename;
	}

	/**
	 *
	 * @param string $filename
	 */
	public function setFilename($filename)
	{
		$this->filename = $filename;
	}

	/**
	 *
	 * @return int
	 */
	public function getFileTypeId()
	{
		return $this->fileTypeId;
	}

	/**
	 *
	 * @param int $fileType
	 */
	public function setFileTypeId($fileType)
	{
		$this->fileTypeId = $fileType;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 *
	 * @param \DateTime $created
	 */
	public function setCreated(\DateTime $created)
	{
		$this->created = $created;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getModified()
	{
		return $this->modified;
	}

	/**
	 *
	 * @param \DateTime $modified
	 */
	public function setModified(\DateTime $modified)
	{
		$this->modified = $modified;
	}

	/**
	 *
	 * @return \DateTime
	 */
	public function getDeleted()
	{
		return $this->deleted;
	}

	/**
	 *
	 * @param \DateTime $deleted
	 */
	public function setDeleted(\DateTime $deleted)
	{
		$this->deleted = $deleted;
	}

	public function toArray()
	{
		return array(
				FileManager::COLUMN_FILENAME => $this->getFilename(),
				FileManager::COLUMN_FILE_TYPE => $this->getFileTypeId()
		);
	}

}