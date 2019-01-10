<?php
namespace Ma\Model\Posts;

use ActiveRecord\Model;


class CategoryDetail extends Model
{
    static $table_name = 'ar_posts_category_detail';

    static $belongs_to = array(
        array('category', 'class_name' => '\Ma\Model\Posts\Category'),
    );
}