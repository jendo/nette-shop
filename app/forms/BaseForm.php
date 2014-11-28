<?php

namespace Forms;

use Nette;

/**
 * Spolocny predok pre vsetky formulare, kotre maju vlastny template a vlastne callbacky na signaly
 * Formular musi dedit od Nette\Application\UI\Form (formular priamo presenteroch) a nie od Nette\Forms\Form ak chceme mat platne valstne callbacky
 */
abstract class BaseForm extends Nette\Application\UI\Form implements \IForm
{

	/**
	 * Object manager store
	 *
	 * @var Applicaion\Component\ManagerStore
	 */
	private $managerStore;

	/**
	 * Custom validator full class name with namespace
	 *
	 * @var string
	 */
	private $customValidtorsClassName;

	/**
	 *
	 * @param \Core\Base\BaseManager $manager
	 * @param Nette\ComponentModel\IContainer $parent
	 * @param type $name
	 */
	public function __construct(\Core\Base\BaseManager $manager = null, Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);
		$this->managerStore = $this->createManagerStore($manager);
		$this->customValidtorsClassName = \Application\Forms\CustomValidators::getClassName();
		// From callbacks
		$this->onValidate[] = array($this, 'formValidate');
		$this->onSubmit[] = array($this, 'formSubmitted');
		$this->onSuccess[] = array($this, 'processForm');
		$this->onError[] = array($this, 'processError');
	}

	/**
	 * Gets template file name
	 *
	 * @return string
	 */
	public function getTemplateFileName()
	{
		$class = get_called_class();
		//app/templates/forms/nazovTriedy.latte
		$dir = Nette\Environment::getVariable('appDir') . '/templates/forms/';
		$class = substr($class, strrpos($class, '\\') + 1);
		$class = strtolower(substr($class, 0, 1)) . substr($class, 1);
		return $dir . $class . '.latte';
	}

	/**
	 * Creates manager store
	 *
	 * @param Core\Base\BaseManager $manager
	 * @return ManagerStore
	 */
	protected function createManagerStore(\Core\Base\BaseManager $manager = null)
	{
		return new \Application\Component\ManagerStore($manager);
	}

	/**
	 * Gets manager for actual entity (or additional manager)
	 *
	 * @param string $ident
	 * @return Core\Base\BaseManager
	 */
	protected function manager($ident = null)
	{
		return $this->managerStore->getManager($ident);
	}

	/**
	 * Adds manager to object
	 *
	 * @param Core\Base\BaseManager $manager
	 * @return BaseFrom
	 */
	public function addManager(\Core\Base\BaseManager $manager)
	{
		$this->managerStore->addManager($manager);
		return $this;
	}

	/**
	 * Occurs when the form is validated
	 */
	abstract public function formValidate(\IForm $form);

	/**
	 * Occurs when the form is submitted
	 */
	abstract public function formSubmitted(\IForm $form);

	/**
	 * Occurs when the form is submitted and successfully validated
	 */
	abstract public function processForm(\IForm $form);

	/**
	 * Occurs when the form is submitted and is not valid
	 */
	abstract public function processError(\IForm $form);

}
