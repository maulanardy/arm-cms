<?php
namespace Ma\Model\Posts;

use ActiveRecord\Model;


class Category extends Model
{
	static $table_name = 'ar_posts_category';

	static $has_many = array(
	  array('posts', 'class_name' => '\Ma\Model\Posts\Main')
	);
}