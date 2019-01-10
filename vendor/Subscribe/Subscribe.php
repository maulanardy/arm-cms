<?php 
namespace Subscribe;

use Subscribe\Model;
/**
* 
*/
class Subscribe
{
	private $model;

	function __construct()
	{
		$this->model = new Model\Main();
	}

	public function register($email){
		if(!empty($email)){
			if($this->validateEmail($email)){

				if($this->insert($email)){
					echo Wording::$REGISTER_SUCCESS;
				}

			} else {
				echo Wording::$WRONG_EMAIL_FORMAT;
			}
		} else {
				echo Wording::$WRONG_EMAIL_EMPTY;
		}
	}

	public function unregister($email){
		if(!empty($email)){
			if($this->validateEmail($email)){

				if($this->cancel($email)){
					echo Wording::$UNREGISTER_SUCCESS;
				}

			} else {
				echo Wording::$WRONG_EMAIL_FORMAT;
			}
		} else {
				echo Wording::$WRONG_EMAIL_EMPTY;
		}
	}

	private function validateEmail($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	private function find($email){
		$data = $this->model->first("all", array(
			"conditions" => array("email = ?", $email)
		));

		return $data;
	}

	private function findSubscribed($email){
		$data = $this->model->first("all", array(
			"conditions" => array("email = ? AND is_subscribe = 1 ", $email)
		));

		return $data;
	}

	private function insert($email){
		$data = $this->find($email);

		if(empty($data)){
			$mModel = $this->model;
		} else {
			$mModel = $data;

			if($data->is_subscribe == 1){
				return true;
			}
		}

		$mModel->email = $email;
		$mModel->is_subscribe = 1;
		if(empty($data)) $mModel->subscribe_date = date("Y-m-d H:i:s");

		if($mModel->save()){
			return true;
		} else {
			echo Wording::$REGISTER_FAILED;

			return false;
		}
	}

	private function cancel($email){
		$dataEmail = $this->findSubscribed($email);

		if(empty($dataEmail)){
			echo Wording::$EMAIL_NOT_FOUND;

			return false;

		} else {
			$dataEmail->is_subscribe = 0;
			$dataEmail->unsubscribe_date = date("Y-m-d H:i:s");

			if($dataEmail->save()){
				return true;
			} else {
				echo Wording::$REGISTER_FAILED;

				return false;
			}
		}
	}
}
?>