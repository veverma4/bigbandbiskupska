<?php

use Nette\Application\Request;
use Nette\DI\Container;
use Tester\Assert;
use Tester\DomQuery;
use Tester\TestCase;

$container = require __DIR__ . "/../../bootstrap.php";

class HomepagePresenterTest extends TestCase
{

    protected $presenter;
    protected $container;

    public function __construct ( Container $container ) {
        $this -> container = $container;
    }

    public function setUp () {
        $factory = $this -> container -> getByType( 'Nette\Application\IPresenterFactory' );
        $this -> presenter = $factory -> createPresenter( 'Front:Homepage' );
        $this -> presenter -> autoCanonicalize = false;
    }

    public function testRender () {
        $request = new Request( 'Front:Homepage', 'GET', array () );
        $response = $this -> presenter -> run( $request );

        Assert::type( 'Nette\Application\Responses\TextResponse', $response );
        Assert::type( 'Nette\Bridges\ApplicationLatte\Template', $response -> getSource() );

        $html = (string) $response -> getSource();

        $dom = DomQuery::fromHtml( $html );

        Assert::true( $dom -> has( '#bigband' ) );
        Assert::true( $dom -> has( '#historie' ) );
        Assert::true( $dom -> has( '#zusbiskupska' ) );
        Assert::true( $dom -> has( '#top' ) );
    }

}

# Spuštění testovacích metod
run( new HomepagePresenterTest( $container ) );
