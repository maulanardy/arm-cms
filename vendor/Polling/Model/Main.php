<?php
namespace Polling\Model;

use ActiveRecord\Model;


class Main extends Model
{
	static $table_name = 'ar_polling';

	static $has_many = array(
		array('option', 'foreign_key'=> 'polling_id', 'class_name' => '\Polling\Model\Option'),
		array('answer', 'foreign_key'=> 'polling_id', 'class_name' => '\Polling\Model\Answer'),
	);
}