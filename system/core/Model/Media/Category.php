<?php
namespace Ma\Model\Media;

use ActiveRecord\Model;


class Category extends Model
{
	static $table_name = 'ar_media_category';

	static $has_many = array(
	  array('media', 'foreign_key'=> 'category_id', 'class_name' => '\Ma\Model\Media\Main')
	);
}