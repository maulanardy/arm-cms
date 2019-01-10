<?php
namespace Event\Model;

use ActiveRecord\Model;


class View extends Model
{
	static $table_name = 'ar_event_view';

	static $belongs_to = array(
	  array('event', 'class_name' => '\Event\Model\Main')
	);
}