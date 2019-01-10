<?php
namespace Ma\Controller\Visitor;

use Ma\Model\Visitor as Model;

/**
* 
*/
class Main
{	
	
	function __construct(Model\Main $model)
	{
		$this->model = $model;
	}

	public function getView(){
		$data = $this->model->count();
		return $data;
	}

	public function addView(){
		$datetime = date("Y-m-d h:i:s");
		$datetimeplus = date( "Y-m-d H:i:s", strtotime("-30 min", strtotime($datetime)) );

		$data = $this->model->first(
			array(
				'conditions' => array(
					'user_ip = ? AND viewed > ?', 
					\helper::get_client_ip(), 
					$datetimeplus
					)
				)
			);

		if(!$data){
			$this->model->user_ip = \helper::get_client_ip();
			$this->model->viewed = $datetime;
			
			if($this->model->save())
				return true;
			else
				return false;
		}
	}
}