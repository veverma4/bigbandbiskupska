<?php

namespace App\FrontModule\Presenters;

use Nette;
use App;

class RepertoirPresenter extends BasePresenter
{

	/**
	 * @var App\Model\RepertoirModel
	 * @inject
	 */
	public $repertoir;


	public function actionDefault ()
	{
		$this -> template -> songsByName = $this -> repertoir -> by ( [], [ "name" => "ASC" ] );
		$this -> template -> songsByInterpreter = $this -> repertoir -> by ( [], [ "interpreter" => "ASC" ] );
	}
}
