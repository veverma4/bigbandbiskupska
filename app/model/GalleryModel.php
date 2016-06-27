<?php

namespace App\Model;

use Nette;
use Tulinkry;

class GalleryModel extends Tulinkry\Model\BaseModel
{
	private $galleries;

	public function __construct ()
	{
		$lorem = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua.";

		$this -> galleries = array (
			"Zbraslav 2012" => (object) [
				"date" => Nette\Utils\DateTime::from ( "2012" ),
				"name" => "Zbraslav 2012",
				"description" => $lorem,
			],
			"První koncert Zbraslav" => (object) [
				"date" => Nette\Utils\DateTime::from ( "2009" ),
				"name" => "První koncert Zbraslav",
				"description" => $lorem,
			],
			"Černošice jazz festival" => (object) [
				"date" => Nette\Utils\DateTime::from ( "2013" ),
				"name" => "Černošice jazz festival",
				"description" => $lorem,
			],
		);
	}

	public function item ( $id )
	{
		return isset($this->galleries[$id]) ? $this->galleries[$id] : NULL;
	}

	public function limit ( $limit = 10, $offset = 0, $by = array (), $order = array () )
	{
		$limited = [];
		for ( $i = $offset; $i < $limit + $offset; $i ++ )
			if ( isset ($this->galleries[$i]) )
				$limited [] = $this->galleries[$i];
		return $limited;
	}

	public function all ()
	{
		return $this->galleries;
	}

	public function images ( $gallery )
	{
		$dir = APP_DIR . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "www" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "gallery";
		$dir .= DIRECTORY_SEPARATOR . $gallery -> name;

		return $files = Nette\Utils\Finder::findFiles( "*" )
						-> exclude ( "title.jpg" )
						-> from ( $dir ) -> getIterator ();
	}
};

// TODO: https://picasaweb.google.com/data/feed/api/user/112403309322454687848?alt=json
// 		 https://picasaweb.google.com/data/feed/api/user/112403309322454687848/albumid/6295996672417703393

// BETTER: https://picasaweb.google.com/data/feed/api/user/112403309322454687848/albumid/6295996672417703393?alt=json&authkey=Gv1sRgCPjusPOarbzhYw
// = only with the link