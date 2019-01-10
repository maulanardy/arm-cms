<?php
namespace Ma\Model\Posts;

use ActiveRecord\Model;


class View extends Model
{
	static $table_name = 'ar_posts_view';

	static $belongs_to = array(
	  array('posts', 'class_name' => '\Ma\Model\Posts\Main')
	);
}