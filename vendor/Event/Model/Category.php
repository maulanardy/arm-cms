<?php
namespace Event\Model;

use ActiveRecord\Model;


class Category extends Model
{
	static $table_name = 'ar_event_category';

	static $has_many = array(
	  array('event', 'class_name' => '\Event\Model\Main')
	);
}