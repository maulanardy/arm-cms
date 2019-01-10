<?php
namespace Ma\Controller\Posts;

use Ma\Model\Posts as Model;

/**
* 
*/
class Hashtag
{	
	
	function __construct()
	{
		$this->model = new Model\Hashtag();
	}

	public function getPopular($limit = 0)
	{		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'select' => 'ar_posts_hashtag.*, COUNT(ar_posts.id) as postcount',
			'joins' => array('LEFT JOIN ar_posts ON(ar_posts_hashtag.name = ar_posts.hashtag)'),
			'order' => 'postcount desc',
			'group' => 'ar_posts_hashtag.id',
			'limit' => $limit
			));

		return $data;
	}
}