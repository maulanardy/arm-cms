<?php
namespace Polling\Model;

use ActiveRecord\Model;


class Option extends Model
{
	static $table_name = 'ar_polling_option';

	static $belongs_to = array(
	  array('polling', 'foreign_key'=> 'polling_id', 'class_name' => '\Polling\Model\Main'),
	);

	static $has_many = array(
	  array('answer', 'foreign_key'=> 'polling_option_id', 'class_name' => '\Polling\Model\Answer'),
	);
}