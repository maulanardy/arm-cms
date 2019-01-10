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
		$this->model = new Model\Answer();
	}

	public function getByPollingId($pollingId = false)
	{
		if($pollingId){

			$data = $this->model->find('all', array(
				'conditions' => array("polling_id = ?", $pollingId),
				'order' => 'date_created desc',
				));

			return $data;

		}
	}

	public function getByIpAddress($ip_address = false)
	{
		if($ip_address){

			$data = $this->model->find('all', array(
				'conditions' => array("ip_address = ?", $ip_address)
				));

			return $data;

		}
	}

	public function getMyPolling($ip_address = false, $polling_id)
	{
		if($ip_address){

			$data = $this->model->find('all', array(
				'conditions' => array("ip_address = ? AND polling_id = ?", $ip_address, $polling_id)
				));

			return $data;

		}
	}

	public function save(){
		if(\Io::param('polling_val')){
			$ip_address = \helper::get_client_ip();

			if($ip_address != "" && $ip_address != "UNKNOWN"){

				if(!$this->getMyPolling($ip_address, \Io::param('polling_id'))){
					$this->model->ip_address        = $ip_address;
					$this->model->polling_id        = \Io::param('polling_id');
					$this->model->polling_option_id = \Io::param('polling_val');
					$this->model->date_created      = date('Y-M-d h:i:s');
					
					if($this->model->save()){
						echo Wording::$POLLING_SUCCESS;
						return true;
					}else{
						echo Wording::$POLLING_ERROR;
						return false;
					}
				} else {
					echo Wording::$POLLING_DOUBLE;
					return false;
				}

			}
		}

		echo Wording::$POLLING_ERROR;
		return false;
	}
}

?>