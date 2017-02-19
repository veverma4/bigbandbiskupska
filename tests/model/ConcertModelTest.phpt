<?php

use Nette\DI\Container;
use Tester\Assert;
use Tester\TestCase;

use Nette\Utils\Strings;

$container = require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "bootstrap.php";

class ConcertModelTest extends TestCase {

    protected $model;
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function setUp() {
        $this->model = $this->container->getService('concerts');
    }

    public function tearDown() {
        
    }

    public function testAll() {
        Assert::true(count($this->model->all()) > 0);
    }
}

# Spuštění testovacích metod
run(new ConcertModelTest($container));
