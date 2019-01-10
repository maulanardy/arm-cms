<?php
namespace Installment\Model;

use ActiveRecord\Model;


class Main extends Model
{
	static $table_name = 'web_installment';

	static $has_many = array(
	  array('data', 'foreign_key'=> 'installment_id', 'class_name' => '\Installment\Model\Data'),
	);
}