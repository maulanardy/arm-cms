<?php
namespace Ma\Controller\Posts;

use Ma\Model\Posts as Model;

/**
* 
*/
class View
{	
	
	function __construct(Model\View $model)
	{
		$this->model = $model;
	}

	public function getView($posts_id){
		if($posts_id){
			$data = $this->model->count(array('conditions' => array('posts_id = ?', $posts_id)));
			return $data;
		}
	}

	public function addView($posts_id){
		if($posts_id){
			$datetime = date("Y-m-d h:i:s");
			$datetimeplus = date( "Y-m-d h:i:s", strtotime("-5 min", strtotime($datetime)) );

			$data = $this->model->first(
				array(
					'conditions' => array(
						'posts_id = ? AND user_ip = ? AND viewed > ?', 
						$posts_id, 
						\helper::get_client_ip(), 
						$datetimeplus
						)
					)
				);

			if(!$data){
				$this->model->posts_id = $posts_id;
				$this->model->user_ip = \helper::get_client_ip();
				$this->model->viewed = $datetime;
				
				if($this->model->save())
					return true;
				else
					return false;
			}

		}
	}
}