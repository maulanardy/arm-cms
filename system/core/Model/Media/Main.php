<?php
namespace Ma\Model\Media;

use ActiveRecord\Model;


class Main extends Model
{
	static $table_name = 'ar_media';

	static $belongs_to = array(
	  array('category', 'class_name' => '\Ma\Model\Media\Category')
	);
}