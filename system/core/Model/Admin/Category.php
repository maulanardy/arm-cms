<?php
namespace Ma\Model\Admin;

use ActiveRecord\Model;


class Category extends Model
{
	static $table_name = 'ar_admin_category';

	static $has_many = array(
	  array('admin', 'class_name' => '\Ma\Model\Admin\Main')
	);
}