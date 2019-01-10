<?php
namespace Ma\Model\Pages;

use ActiveRecord\Model;


class Detail extends Model
{
    static $table_name = 'ar_pages_detail';

    static $belongs_to = array(
        array('main', 'class_name' => '\Ma\Model\Pages\Main'),
    );
}