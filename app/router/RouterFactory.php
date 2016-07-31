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

		$router[] = new Route('[<locale=cs cs|en>/][home]', 'Front:Homepage:default');
		$router[] = new Route('[<locale=cs cs|en>/]kapela', 'Front:Band:default');
		$router[] = new Route('[<locale=cs cs|en>/]kontakt', 'Front:Contact:default');
		$router[] = new Route('[<locale=cs cs|en>/]historie', 'Front:History:default');
		$router[] = new Route('[<locale=cs cs|en>/]repertoar', 'Front:Song:default');
		$router[] = new Route('[<locale=cs cs|en>/]videa', 'Front:Video:default');
		$router[] = new Route('[<locale=cs cs|en>/]koncerty', 'Front:Concert:default');
		$router[] = new Route('[<locale=cs cs|en>/]koncert/<id>', 'Front:Concert:detail');
		$router[] = new Route('[<locale=cs cs|en>/]galerie', 'Front:Gallery:default');
		$router[] = new Route('[<locale=cs cs|en>/]galerie/<id>', 'Front:Gallery:detail');

		#$router[] = new Route('<presenter>/<action>[/<id>]', 'Front:Homepage:default');
		return $router;
	}

}
