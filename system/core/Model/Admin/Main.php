<?php
namespace Ma\Model\Admin;

use ActiveRecord\Model;


class Main extends Model
{
	static $table_name = 'ar_admin';

	static $belongs_to = array(
	  array('category', 'class_name' => '\Ma\Model\Admin\Category')
	);
}