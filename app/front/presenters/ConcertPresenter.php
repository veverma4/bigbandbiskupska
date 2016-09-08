<?php

namespace App\FrontModule\Presenters;

use App\Model\ConcertModel;

class ConcertPresenter extends BasePresenter
{

    /**
     * @var ConcertModel
     * @inject
     */
    public $concerts;

    public function actionDefault () {
        $paginator = $this -> getPaginator();
        $paginator -> itemCount = $this -> concerts -> count( [ "visible" => true ], [ "start" => "DESC", "end" => "DESC" ] );
        $this -> template -> concerts = $this -> concerts -> limit( $paginator -> itemsPerPage, $paginator -> offset, [ "visible" => true ], [ "start" => "DESC", "end" => "DESC" ] );
        if ( $this -> isAjax() ) {
            $this -> invalidateControl( "concerts" );
        }
    }

}
