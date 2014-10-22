<?php

namespace Application\Templates;

use Nette;
use Nette\Templating\Template;
use Core;

/**
 * Class adding variables to template
 *
 * @package Application\Templates
 * @author Michal Jenis <jenis.michal@gmail.com>
 */
class TemplateVars
{

	/**
	 * Constructor.
	 *
	 * @throws LogicException
	 */
	public final function __construct()
	{
		throw new \LogicException('Could not inicialize static class.');
	}

	/**
	 * Set vars to template
	 *
	 * @param Template $template
	 * @return void
	 */
	public static function setVars(Nette\Bridges\ApplicationLatte\Template $template)
	{
		//		$config = Core\Context::getInstance()->config()->getConfig();
		//		$vars = new \stdClass();
		//		foreach ($config as $var => $value) {
		//			$var = preg_replace('/-(.?)/e', 'strtoupper(\'\1\')', $var);
		//			$vars->$var = $value;
		//		}
		//		$vars->environment = APPLICATION_ENV;
		//		$template->config = $vars;
		//		$template->staticBaseUrl = trim($template->config->staticBaseUrl, '/');
		//		$template->tkStaticBaseUrl = trim($template->config->tkStaticBaseUrl, '/');
		//		$template->serverName = Nette\Environment::getHttpRequest()->getUrl()->host;
		$template->frontAppDir = Nette\Environment::getVariable('frontAppDir') . '/templates/';
	}
}
