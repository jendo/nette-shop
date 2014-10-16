<?php

namespace Application\Forms;

/**
 * Extenstion for own form validators
 *
 * @author Michal Jenis <jenis.michal@gmai.com>
 */
final class CustomValidators
{


	const CLASS_NAME = '\Application\Forms\CustomValidators';

	/*
	 * Validators constants
	 */
	const IS_DIVISIBLE = '::divisibilityValidator';

	/*
	 * Get full class name with namespace
	 */
	public static function getClassName()
	{
		return self::CLASS_NAME;
	}

	public static function divisibilityValidator($item, $arg)
	{
		return $item->value % $arg === 0;
	}
}
