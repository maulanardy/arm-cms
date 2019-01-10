<?php
namespace Installment\Model;

use ActiveRecord\Model;


class Data extends Model
{
	static $table_name = 'web_installment_data';

	static $belongs_to = array(
	  array('program', 'foreign_key'=> 'installment_id', 'class_name' => '\Installment\Model\Main'),
	);
}