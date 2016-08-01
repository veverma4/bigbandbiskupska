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
		$paginator = $this -> getPaginator ();
		$paginator -> itemCount = $this -> concerts -> count ( [ "visible" => true ], [ "start" => "DESC", "end" => "DESC" ] );
		$this -> template -> concerts = $this -> concerts -> limit ( $paginator -> itemsPerPage, $paginator -> offset, [ "visible" => true ], [ "start" => "DESC", "end" => "DESC" ] );
		if($this->isAjax()) {
			$this->invalidateControl("concerts");
		}
	}
}

