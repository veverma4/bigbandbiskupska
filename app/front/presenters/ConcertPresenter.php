<?php

namespace App\FrontModule\Presenters;

use Nette;
use App;


class ConcertPresenter extends BasePresenter
{
	/**
	 * @var App\Model\ConcertModel
	 * @inject
	 */
	public $concerts;

	public function actionDefault ()
	{
		$this -> template -> concerts = $this -> concerts -> all ( [ "date" => "DESC" ] );
	}
}

