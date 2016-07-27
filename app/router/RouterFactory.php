<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;


class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList;

		$router[] = new Route('[home]', 'Front:Homepage:default');
		$router[] = new Route('kapela', 'Front:Band:default');
		$router[] = new Route('kontakt', 'Front:Contact:default');
		$router[] = new Route('historie', 'Front:History:default');
		$router[] = new Route('repertoar', 'Front:Repertoir:default');
		$router[] = new Route('videa', 'Front:Video:default');
		$router[] = new Route('koncerty', 'Front:Concert:default');
		$router[] = new Route('koncert/<id>', 'Front:Concert:detail');
		$router[] = new Route('galerie', 'Front:Gallery:default');
		$router[] = new Route('galerie/<id>', 'Front:Gallery:detail');

		#$router[] = new Route('<presenter>/<action>[/<id>]', 'Front:Homepage:default');
		return $router;
	}

}
