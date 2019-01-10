<?php
namespace Ma\Model\Posts;

use ActiveRecord\Model;


class PositionRelation extends Model
{
    static $table_name = 'ar_posts_position_relation';

    static $belongs_to = array(
        array('posts', 'foreign_key'=> 'posts_id', 'class_name' => '\Ma\Model\Posts\Main'),
        array('position', 'foreign_key'=> 'posts_position_id', 'class_name' => '\Ma\Model\Posts\Position')
    );
}