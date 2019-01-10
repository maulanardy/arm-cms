<?php
namespace Event\Model;

use ActiveRecord\Model;


class Main extends Model
{
	static $table_name = 'ar_event';

	static $belongs_to = array(
	  array('category', 'class_name' => '\Event\Model\Category'),
	  // array('gallery', 'foreign_key'=> 'gallery_id', 'class_name' => '\Ma\Model\Media\Category'),
	  // array('author', 'foreign_key' => 'author_id', 'class_name' => '\Ma\Model\Admin\Main'),
	  // array('admin', 'foreign_key' => 'admin_id', 'class_name' => '\Ma\Model\Admin\Main')
	);

	static $has_many = array(
		array('visitor', 'foreign_key'=> 'posts_id', 'class_name' => '\Event\Model\Visitor'),
		// array('position_relation', 'foreign_key'=> 'posts_id', 'class_name' => '\Ma\Model\Posts\PositionRelation'),
	);
}