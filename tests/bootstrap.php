<?php

require __DIR__ . '/../vendor/autoload.php';

define ( "APP_DIR", __DIR__ . "/../app");
define ( "WWW_DIR", __DIR__ . "/../www");

define ('TMP_DIR', __DIR__ . "/temp/" . getmypid() );

register_shutdown_function(function() {
    Tester\Helpers::purge(TMP_DIR);
    @rmdir(TMP_DIR);
});

Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');

@mkdir(__DIR__."/temp");
Tester\Helpers::purge(TMP_DIR);


$configurator = new Nette\Configurator;

$configurator->setDebugMode(FALSE);
$configurator->setTempDirectory(TMP_DIR);

$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(APP_DIR . '/config/config.neon', Nette\Configurator::AUTO);
$configurator->addConfig(APP_DIR . '/config/config.local.neon', Nette\Configurator::AUTO);
$configurator->addParameters(array("wwwDir" => TMP_DIR));
$configurator->addParameters(array("appDir" => APP_DIR));
$configurator->addParameters(array("testDir" => __DIR__));

$configurator->addParameters([
	'appDir' => APP_DIR,
	'wwwDir' => TMP_DIR
]);

$container = $configurator->createContainer();


/** helpers */

function run($testcase) {
    $testcase->run();
}

return $container;