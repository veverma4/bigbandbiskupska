<?php

require __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

define ( "APP_DIR", __DIR__ . "/../app");
define ('TMP_DIR', __DIR__ . "/temp/" . getmypid() );
@mkdir(__DIR__."/temp");
Tester\Helpers::purge(TMP_DIR);

$configurator = new Nette\Configurator;

$configurator->setDebugMode(FALSE);
$configurator->setTempDirectory(TMP_DIR);

$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->register();

$configurator->addConfig(APP_DIR . '/config/config.neon');
$configurator->addConfig(APP_DIR . '/config/config.local.neon');

$container = $configurator->createContainer();

return $container;