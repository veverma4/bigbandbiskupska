<?php

$container = require __DIR__ . "/../../bootstrap.php";

use Tester\Assert;

class SongPresenterTest extends Tester\TestCase
{
	protected $presenter;
	protected $container;


	public function __construct(Nette\DI\Container $container) {
		$this->container = $container;
	}


    public function setUp() {
    	$factory = $this->container->getByType('Nette\Application\IPresenterFactory');
        $this->presenter = $factory->createPresenter('Front:Song');
        $this->presenter->autoCanonicalize = false;
    }

    public function testRender() {
        $request = new Nette\Application\Request('Front:Song', 'GET', array () );
        $response = $this->presenter->run($request);

        Assert::type('Nette\Application\Responses\TextResponse', $response);
        Assert::type('Nette\Bridges\ApplicationLatte\Template', $response->getSource());

        $html = (string) $response->getSource();

        $dom = Tester\DomQuery::fromHtml($html);

        Assert::true( $dom->has('#filtrovani') );
        Assert::true( $dom->has('#pisen') );
        Assert::true( $dom->has('#autor') );
        Assert::true( $dom->has('#top') );
    }
}

# Spuštění testovacích metod
run(new SongPresenterTest($container));
