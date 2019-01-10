<?php
namespace Event\Model;

use ActiveRecord\Model;


class Detail extends Model
{
    static $table_name = 'ar_event_detail';

    static $belongs_to = array(
        array('event', 'foreign_key'=> 'event_id', 'class_name' => '\Event\Model\Main'),
    );
}