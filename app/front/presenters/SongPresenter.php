<?php

namespace App\FrontModule\Presenters;

use App\Model\SongModel;

class SongPresenter extends BasePresenter
{

    /**
     * @var SongModel
     * @inject
     */
    public $songs;

    public function actionDefault () {
        $this -> template -> songsByName = $this -> songs -> by( [ ], [ "name" => "ASC" ] );
        $this -> template -> songsByInterpreter = $this -> songs -> by( [ ], [ "interpreter" => "ASC" ] );
    }

}
