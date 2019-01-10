<?php
namespace ArtistWishlist\Model;

use ActiveRecord\Model;


class Main extends Model
{
	static $table_name = 'web_artist';

	static $has_many = array(
	  array('answer', 'foreign_key'=> 'artist_id', 'class_name' => '\ArtistWishlist\Model\Answer'),
	);
}