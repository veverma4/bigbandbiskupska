<?php

namespace App\FrontModule\Presenters;

use Nette;
use App;

class SongPresenter extends BasePresenter
{

	/**
	 * @var App\Model\SongModel
	 * @inject
	 */
	public $songs;


	public function actionDefault ()
	{
		$this -> template -> songsByName = $this -> songs -> by ( [], [ "name" => "ASC" ] );
		$this -> template -> songsByInterpreter = $this -> songs -> by ( [], [ "interpreter" => "ASC" ] );
	}
}
