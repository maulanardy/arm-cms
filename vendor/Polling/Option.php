<?php 
namespace Polling;

use Polling\Model;

/**
* 
*/
class Answer
{
	private $model;
	
	function __construct()
	{
		$this->model = new Model\Option();
	}

	public function save(){

		$this->model->polling_id = $ip_address;
		$this->model->value      = \Io::param('polling_id');
		
		if($this->model->save()){
			return true;
		}else{
			return false;
		}

		return false;
	}
}

?>