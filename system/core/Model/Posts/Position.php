<?php
namespace Ma\Model\Posts;

use ActiveRecord\Model;


class Position extends Model
{
    static $table_name = 'ar_posts_position';

    static $has_many = array(
        array('position_relation', 'class_name' => '\Ma\Model\Posts\PositionRelation')
    );
}