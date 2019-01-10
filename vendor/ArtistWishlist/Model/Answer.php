<?php
namespace ArtistWishlist\Model;

use ActiveRecord\Model;


class Answer extends Model
{
	static $table_name = 'web_artist_wishlist';

	static $belongs_to = array(
	  array('artist', 'foreign_key'=> 'artist_id', 'class_name' => '\ArtistWishlist\Model\Main'),
	  array('user', 'foreign_key'=> 'user_id', 'class_name' => '\User\Model\Main')
	);
}