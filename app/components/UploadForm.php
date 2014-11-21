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
	 * File manager
	 *
	 * @var \App\Model\FileManager
	 */
	private $fileManager;

	public function __construct(\Closure $formFactory,  \App\Model\FileManager $manager, \Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
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
				var_dump($imageBaseFilename);
			} catch (\InvalidArgumentException $e) {

			}
		}
	}

}