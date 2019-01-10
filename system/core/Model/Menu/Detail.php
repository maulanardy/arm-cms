<?php
namespace Ma\Model\Menu;

use ActiveRecord\Model;


class Detail extends Model
{
    static $table_name = 'ar_menu_detail';

    static $belongs_to = array(
        array('main', 'class_name' => '\Ma\Model\Menu\Main'),
    );
}