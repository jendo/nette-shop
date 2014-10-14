<?php

namespace Components;

/**
 * Zakladna komponenta pre vsetky formulare
 * Nastavuje pre vsetky formualre vlastne templaty
 */
final class BaseFormComponent extends BaseComponent
{

	/**
	 * Form component factory
	 *
	 * @var \Closure
	 */
	private $formFactory;

	/**
	 * Render form directly (without template)
	 *
	 * @var bool
	 */
	public $directRender = false;

	/**
	 * Constructor
	 *
	 * @param \Closure $formFactory
	 * @param Nette\ComponentModel\IContainer
	 * @param string $name
	 */
	public function __construct(\Closure $formFactory, \Nette\ComponentModel\IContainer $parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);
		$this->formFactory = $formFactory;

	}

	/**
	 * Gets template file name
	 *
	 * @return string
	 */
	protected function getTemplateFileName()
	{
		return $this->getForm()->getTemplateFileName();
	}

	/**
	 * Create component with form
	 *
	 * @param string $name
	 */
	public function createComponentForm($name)
	{
		$formFactory = $this->formFactory;
		$form = $formFactory($this,$name);
		return $form;
	}

	/**
	 * Gets stored form
	 *
	 */
	public function getForm()
	{
		return $this['form'];
	}

	/**
	 * Renders form.
	 * @return void
	 */
	public function render($args = null)
	{
		if ($this->directRender) {
			$this->getForm()->render($args);
		} else {
			parent::render($args);
		}
	}

}