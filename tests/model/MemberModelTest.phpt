<?php

use Nette\DI\Container;
use Tester\Assert;
use Tester\TestCase;

$container = require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "bootstrap.php";

class MemberModelTest extends TestCase {

    protected $model;
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function setUp() {
        $this->model = $this->container->getService('members');
    }

    public function tearDown() {
        
    }

    public function testAll() {
        Assert::true(count($this->model->all()) > 0);
    }

}

# Spuštění testovacích metod
run(new MemberModelTest($container));
