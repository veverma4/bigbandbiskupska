<?php

use Nette\Application\Request;
use Nette\DI\Container;
use Tester\Assert;
use Tester\DomQuery;
use Tester\TestCase;

$container = require __DIR__ . "/../../bootstrap.php";

class BandPresenterTest extends TestCase
{

    protected $presenter;
    protected $container;

    public function __construct ( Container $container ) {
        $this -> container = $container;
    }

    public function setUp () {
        $factory = $this -> container -> getByType( 'Nette\Application\IPresenterFactory' );
        $this -> presenter = $factory -> createPresenter( 'Front:Band' );
        $this -> presenter -> autoCanonicalize = false;
    }

    public function testRender () {
        $request = new Request( 'Front:Band', 'GET', array () );
        $response = $this -> presenter -> run( $request );

        Assert::type( 'Nette\Application\Responses\TextResponse', $response );
        Assert::type( 'Nette\Bridges\ApplicationLatte\Template', $response -> getSource() );

        $html = (string) $response -> getSource();

        $dom = DomQuery::fromHtml( $html );

        Assert::true( $dom->has('#' + $this->presenter->translator->translate('front.presenters.band.default.hash.photo') ) );
        Assert::true( $dom->has('#' + $this->presenter->translator->translate('front.presenters.band.default.hash.members') ) );
        Assert::true( $dom->has('#' + $this->presenter->translator->translate('front.layout.hash.top')) );
    }

}

# Spuštění testovacích metod
run( new BandPresenterTest( $container ) );
