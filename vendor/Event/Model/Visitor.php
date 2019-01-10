<?php
namespace Event\Model;

use ActiveRecord\Model;


class Visitor extends Model
{
	static $table_name = 'ar_event_visitor';

	static $belongs_to = array(
	  array('event', 'foreign_key'=> 'event_id', 'class_name' => '\Event\Model\Main'),
	  array('user', 'foreign_key'=> 'user_id', 'class_name' => '\User\Model\Main'),
	  // array('gallery', 'foreign_key'=> 'gallery_id', 'class_name' => '\Ma\Model\Media\Category'),
	  // array('author', 'foreign_key' => 'author_id', 'class_name' => '\Ma\Model\Admin\Main'),
	  // array('admin', 'foreign_key' => 'admin_id', 'class_name' => '\Ma\Model\Admin\Main')
	);

	static $has_many = array(
		// array('view', 'foreign_key'=> 'posts_id', 'class_name' => '\Ma\Model\Posts\View'),
		// array('position_relation', 'foreign_key'=> 'posts_id', 'class_name' => '\Ma\Model\Posts\PositionRelation'),
	);
}