<?php

$container = require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "bootstrap.php";

use Tester\Assert;

class GalleryModelTest extends Tester\TestCase
{
	protected $model;
	protected $container;


	public function __construct(Nette\DI\Container $container) {
		$this->container = $container;
	}


    public function setUp() {
    	$this->model = $this->container->getService('galleries');
    }

    public function tearDown() {
    }

    public function testAll() {
    	Assert::true (count($this->model->all()) > 0);
    }
}

# Spuštění testovacích metod
run(new GalleryModelTest($container));
