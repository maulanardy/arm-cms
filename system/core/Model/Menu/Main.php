<?php
namespace Ma\Model\Menu;

use ActiveRecord\Model;


class Main extends Model
{
    static $table_name = 'ar_menu';

    static $belongs_to = array(
        array('pages', 'foreign_key' => 'pages_id', 'class_name' => '\Ma\Model\Pages\Main'),
    );

    static $has_many = array(
        array('detail', 'foreign_key' => 'menu_id',  'class_name' => '\Ma\Model\Menu\Detail'),
    );
}