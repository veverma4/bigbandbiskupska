<?php

$container = require __DIR__ . "/../../bootstrap.php";

use Tester\Assert;

class GalleryPresenterTest extends Tester\TestCase
{
	protected $presenter;
	protected $container;


	public function __construct(Nette\DI\Container $container) {
		$this->container = $container;
	}


    public function setUp() {
    	$factory = $this->container->getByType('Nette\Application\IPresenterFactory');
        $this->presenter = $factory->createPresenter('Front:Gallery');
        $this->presenter->autoCanonicalize = false;
    }

    public function testRenderDefault() {
        // TODO: Tests are not working because of JS
        $request = new Nette\Application\Request('Front:Gallery', 'GET', array ( 'action' => 'default') );
        $response = $this->presenter->run($request);

        Assert::type('Nette\Application\Responses\TextResponse', $response);
        Assert::type('Nette\Bridges\ApplicationLatte\Template', $response->getSource());
    }

    public function testRenderDetail() {
        $request = new Nette\Application\Request('Front:Gallery', 'GET', array ( 'action' => 'detail') );
        $response = $this->presenter->run($request);

        Assert::type('Nette\Application\Responses\TextResponse', $response);
        Assert::type('Nette\Bridges\ApplicationLatte\Template', $response->getSource());
    }
}

# Spuštění testovacích metod
$testCase = new GalleryPresenterTest($container);
$testCase->run();