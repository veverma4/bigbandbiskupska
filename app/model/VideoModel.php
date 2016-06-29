<?php

namespace App\Model;

use Nette;
use Tulinkry;

class VideoModel extends Tulinkry\Model\BaseModel
{
	protected $videos;

	public function __construct ()
	{
		$this -> videos = array (
			(object) [
				"name" => "Vánoční koncert 2015",
				"url" => "https://www.youtube.com/embed/p5VvFPVF4sc",
				"link" => "https://www.youtube.com/watch?v=p5VvFPVF4sc",
			],
			(object) [
				"name" => "Vánoční koncert 2014",
				"url" => "https://www.youtube.com/embed/YyMEaS-o2e0",
				"link" => "https://www.youtube.com/watch?v=YyMEaS-o2e0",
			],
		);
	}

	public function item ( $id )
	{
		return isset($this->videos[$id]) ? $this->videos[$id] : NULL;
	}

	public function limit ( $limit = 10, $offset = 0, $by = array (), $order = array () )
	{
		$limited = [];
		for ( $i = $offset; $i < $limit + $offset; $i ++ )
			if ( isset ($this->videos[$i]) )
				$limited [] = $this->videos[$i];
		return $limited;
	}

	public function by ( $by = [], $order = [] ) 
	{
		return $this->all();
	}

	public function all ()
	{
		return $this->videos;
	}

};