<?php

namespace App\FrontModule\Presenters;

use Nette;
use App;


class GalleryPresenter extends BasePresenter
{
	/**
	 * @var App\Model\GalleryModel
	 * @inject
	 */
	public $galleries;

	public function actionDefault ()
	{
		$this -> template -> galleries = $this -> galleries -> all ();
	}

	public function actionDetail ( $id )
	{
		//if ( ( $gallery = $this -> galleries -> item ( $id ) ) == NULL )
		//	$this -> notFoundException ();
		
		//$images = $this -> galleries -> images ( $gallery );

		$this -> template -> gallery = (object) [ "id" => $id ];
		//$this -> template -> images = $images;
	}

	public function handleLogError ($id) {
		$this->notFoundException("Error handling " . $id);		
	}
}

