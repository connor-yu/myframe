<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 2018/6/23
 * Time: 14:56
 */

namespace app\controllers;

use Latte\Engine;

class BaseController
{
	public $config;
	public $latte;

	public function __construct()
	{
		$this->loadConfig();
		$this->initDb();
		$this->initTpl();
	}

	public function loadConfig()
	{
		$this->config = require APP_ROOT. '/config/base.php';
	}

	public function initDb()
	{
		\Pheasant::setup($this->config['dsn']);
	}

	public function initTpl()
	{
		$this->latte = new Engine();
		$this->latte->setTempDirectory(APP_ROOT.'/storage/views');
		$set = new \Latte\Macros\MacroSet($this->latte->getCompiler());
		$set->addMacro('url', function ($writer) {
			return $writer->write('echo "'.SITE_URL.'%node.args'.'"');
		});
	}

	public function render($name, $params = [], $block = null)
	{
		$params['sitename'] = $this->config['sitename'];
		$tplFile = APP_ROOT.'/views/'.$name.'.latte';
		$this->latte->render($tplFile, $params, $block);
	}

	public function redirect($name)
	{
		header('Location:'.SITE_URL.'/'.$name);
		exit;
	}
}