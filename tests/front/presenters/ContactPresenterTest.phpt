<?php

$container = require __DIR__ . "/../../bootstrap.php";

use Tester\Assert;

class ContactPresenterTest extends Tester\TestCase
{
	protected $presenter;
	protected $container;


	public function __construct(Nette\DI\Container $container) {
		$this->container = $container;
	}


    public function setUp() {
    	$factory = $this->container->getByType('Nette\Application\IPresenterFactory');
        $this->presenter = $factory->createPresenter('Front:Contact');
        $this->presenter->autoCanonicalize = false;
    }

    public function testRender() {
        $request = new Nette\Application\Request('Front:Contact', 'GET', array () );
        $response = $this->presenter->run($request);

        Assert::type('Nette\Application\Responses\TextResponse', $response);
        Assert::type('Nette\Bridges\ApplicationLatte\Template', $response->getSource());

        $html = (string) $response->getSource();

        $dom = Tester\DomQuery::fromHtml($html);

        Assert::true( $dom->has('#kontakt') );
        Assert::true( $dom->has('#top') );
    }
}

# Spuštění testovacích metod
$testCase = new ContactPresenterTest($container);
$testCase->run();