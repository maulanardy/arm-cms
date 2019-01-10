<?php
namespace Polling\Model;

use ActiveRecord\Model;


class Answer extends Model
{
	static $table_name = 'ar_polling_answer';

	static $belongs_to = array(
	  array('option', 'foreign_key'=> 'polling_option_id', 'class_name' => '\Polling\Model\Option'),
	  array('polling', 'foreign_key'=> 'polling_option_id', 'class_name' => '\Polling\Model\Main'),
	);
}