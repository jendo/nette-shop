<?php

namespace Components;

/**
 * Extending component form to upload images
 *
 * @author Michal Jenis <jenis.michal@gmail.com>
 * @package Components
 */
class UploadForm extends \Components\BaseFormComponent
{

	/**
	 * Upload dir for files
	 *
	 * @var string
	 */
	private $uploadDir;

	/**
	 * File manager
	 *
	 * @var \App\Model\FileManager
	 */
	private $fileManager;

	public function __construct(\Closure $formFactory, \App\Model\FileManager $manager, \Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct($formFactory, $parent, $name);
		$this->fileManager = $manager;
	}

	/**
	 * Save uploaded file
	 *
	 * @param \Nette\Http\FileUpload $image
	 */
	public function saveFile(\Nette\Http\FileUpload $image)
	{
		// if file was uploaded, do stuff
		if ($image && $image->isOk()) {
			try {
				$imageBaseFilename = $this->fileManager->generateName($image->getName());
			} catch (\InvalidArgumentException $e) {
				try {
					$format = null;
					$extension = null;
					Nette\Image::fromFile($image->getTemporaryFile(), $format);
					switch ($format) {
						case Nette\Image::JPEG:
							$extension = 'jpg';
							break;
						case Nette\Image::PNG:
							$extension = 'png';
							break;
						case Nette\Image::GIF:
							$extension = 'gif';
							break;
						default:
							throw new \Nette\UnknownImageFileException();
					}
					$imageBaseFilename = $this->fileManager->generateName(trim($image->getName(), '.') . '.' . $extension);
				} catch (\Nette\UnknownImageFileException $e) {
					return null;
				}
			}

			$imageFilename =  rtrim($this->getUploadDir(), '/') . '/'. $imageBaseFilename;
			$image->move($imageFilename);
			@chmod($imageFilename, 0775);

		}
	}

	/**
	 * Gets upload dir
	 *
	 * @return string
	 */
	protected function getUploadDir()
	{
		if (!$this->uploadDir) {
			throw new \InvalidArgumentException('No upload directory!');
		}
		return $this->uploadDir;
	}

	/**
	 * Set upload dir
	 *
	 * @param string $uploadDir
	 * @return BaseForm
	 */
	public function setUploadDir($uploadDir)
	{
		$uploadDir = (string) $uploadDir;
		if (!is_dir($uploadDir)) {
			throw new \InvalidArgumentException('Given param: '.$uploadDir.'  is not directory!');
		}
		$this->uploadDir = $uploadDir;
		return $this;
	}

}