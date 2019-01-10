<?php
namespace Ma\Model\Posts;

use ActiveRecord\Model;


class Detail extends Model
{
    static $table_name = 'ar_posts_detail';

    static $belongs_to = array(
        array('main', 'foreign_key'=> 'menu_id', 'class_name' => '\Ma\Model\Posts\Main'),
    );
}