<?php

$container = require __DIR__ . "/../../bootstrap.php";

use Tester\Assert;

class VideoPresenterTest extends Tester\TestCase
{
	protected $presenter;
	protected $container;


	public function __construct(Nette\DI\Container $container) {
		$this->container = $container;
	}


    public function setUp() {
    	$factory = $this->container->getByType('Nette\Application\IPresenterFactory');
        $this->presenter = $factory->createPresenter('Front:Video');
        $this->presenter->autoCanonicalize = false;
    }

    public function testRender() {
        $request = new Nette\Application\Request('Front:Video', 'GET', array () );
        $response = $this->presenter->run($request);

        Assert::type('Nette\Application\Responses\TextResponse', $response);
        Assert::type('Nette\Bridges\ApplicationLatte\Template', $response->getSource());

        $html = (string) $response->getSource();

        $dom = Tester\DomQuery::fromHtml($html);

        Assert::true( $dom->has('#top') );
    }
}

# Spuštění testovacích metod
run(new VideoPresenterTest($container));
