<?php

interface IForm
{

	/**
	 * Creates form
	 *
	 * @return void
	 */
	public function init();

	/**
	 * Get name of div id or class for form messages
	 *
	 * @return string
	 */
	public function getMsgTarget();


}