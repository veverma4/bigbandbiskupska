<?php

namespace App\Model;

use Tulinkry\Model\BaseModel;
use Nette\DateTime;

class VideoModel extends BaseModel
{

    protected $videos;

    public function __construct () {
        $this -> videos = array (
            (object) [
                "name" => "Vánoční koncert 2016",
                "date" => DateTime::from("2016-12-18 20:00:00"),
                "url" => "https://www.youtube.com/embed/vLD3zqgyRpg",
                "link" => "https://www.youtube.com/watch?v=vLD3zqgyRpg",
            ],
            (object) [
                "name" => "Vánoční koncert 2015",
                "date" => DateTime::from("2015-12-20 20:00:00"),
                "url" => "https://www.youtube.com/embed/HyTUZ_jC0bk",
                "link" => "https://www.youtube.com/watch?v=HyTUZ_jC0bk",
            ],
            (object) [
                "name" => "Vánoční koncert 2014",
                "date" => DateTime::from("2014-12-20 20:00:00"),
                "url" => "https://www.youtube.com/embed/sDD11ZJUQfU",
                "link" => "https://www.youtube.com/watch?v=sDD11ZJUQfU",
            ],
        );
    }

    public function item ( $id ) {
        return isset( $this -> videos[ $id ] ) ? $this -> videos[ $id ] : NULL;
    }

    public function limit ( $limit = 10, $offset = 0, $by = array (), $order = array () ) {
        $limited = [ ];
        for ( $i = $offset; $i < $limit + $offset; $i ++ )
            if ( isset( $this -> videos[ $i ] ) )
                $limited [] = $this -> videos[ $i ];
        return $limited;
    }

    public function by ( $by = [ ], $order = [ ] ) {
        return $this -> all();
    }

    public function all () {
        return $this -> videos;
    }

}

;
