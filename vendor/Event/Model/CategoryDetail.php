<?php
namespace Event\Model;

use ActiveRecord\Model;


class CategoryDetail extends Model
{
    static $table_name = 'ar_event_category_detail';

    static $belongs_to = array(
        array('category', 'class_name' => '\Event\Model\Category'),
    );
}