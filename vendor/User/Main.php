<?php 
namespace User;

use User\Model;

/**
* 
*/
class Main
{
	public $isLogin   = false;
	public $detail    = null;
	public $error_msg = '';
	public $limit     = 0;
	public $offset    = 0;
	
	function __construct()
	{
		$this->model = new Model\Main();

		$this->id = @$_SESSION['user']['id'];
	}

	public function isLogin()
	{
		if($this->id){
			return true;
		}else{
			return false;
		}
	}

	public function logedUser()
	{
		if($this->id){
			return $this->getById($this->id);
		}else{
			return false;
		}
	}

	public function login()
	{
		if(\Io::param('email') && \Io::param('password')){
			$res = $this->model->first('all', array(
					'conditions' => array(
						'email = ? AND password = ? AND status = 1', \Io::param('email') , md5(\Io::param('password'))
					)
				)
			);

			if($res){
				$res->last_login = date("Y-m-d H:i:s");
				$res->save();

				$_SESSION['user']['id'] = $res->id;
				$_SESSION['user']['name'] = $res->name;
				$_SESSION['user']['email'] = $res->email;

				$this->id = $res->id;

				
				return true;
			}else{
				\helper::flashdata("errorLogin", '<div class="alert alert-danger">wrong username or password</div>');
				$this->error = '<div class="alert alert-danger">wrong username or password</div>';
				return false;
			}
		}
	}

	public function getById($id = false){
		if($id){
			return $this->model->find($id);
		}
		
		return null;
	}

	public function getByEmail($email = false){
		if($email){
			
			$data = $this->model->find('first', array(
					'conditions' => array("email = ?", $email),
				));

			return $data;
		}
		
		return null;
	}
	

	public function register(){
		\validation::set_message('required', '%field% is required');
		\validation::set_message('email', '%field% should entered with correct email format');
		\validation::set_message('equals', '%reference% not match');
		\validation::set_message('is_unique', '%field% is already registered');

		\validation::set_rule('name', 'Name', 'required');
		\validation::set_rule('email', 'Email', 'required|email|is_unique.\User\Model\Main.email');
		\validation::set_rule('phone', 'Phone', 'required');
		\validation::set_rule('password', 'Password', 'required');
		\validation::set_rule('repassword', 'Retype Password', 'equals.password');

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('email')){

				$find = $this->model->find("first", array("conditions" => array("email = ?", \Io::param('email'))));

				if($find){

						$this->error_msg = "Email is already registered";
						return false;

				} else {

					$this->model->name       = \Io::param('name');
					$this->model->email      = \Io::param('email');
					$this->model->gender     = \Io::param('gender');
					$this->model->birth_date = date("Y-m-d", strtotime(\Io::param('dob_year') . "-" . \Io::param('dob_month') . "-" . \Io::param('dob_date')));
					$this->model->phone      = \Io::param('phone');
					$this->model->password   = md5(\Io::param('password'));
					$this->model->status     = 1;
					
					if($this->model->save()){
						return true;
					} else {
						$this->error_msg = "An error occurred";
						return false;
					}
				}
			}
		} else {
			return false;
		}
	}

	public function update(){
		if(\Io::param('nama')){
			$data = $this->model->find(\Io::param('id'));

			// $data->nama = \Io::param('nama');
			// $data->picture = \Io::param('file');
			// $data->ponsel = \Io::param('ponsel');
			// $data->bbm = \Io::param('bbm');
			// $data->kota = \Io::param('kota');
			// $data->place_birth = \Io::param('ponsel');
			// $data->content = \Io::param('content','html');
			// $data->excerpt = \Io::param('excerpt');
			// $data->keywords = \Io::param('keyword');
			// $this->tags = "tags";
			// $data->date_updated = date('Y-M-d h:i:s');
			// $data->date_publish = date('Y-M-d',strtotime(\Io::param('published')));
			// if(\Io::param('unpublished')) $data->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));
			$data->status = \Io::param('status');
			
			if($data->save())
				return true;
			else
				return false;
		}
	}
}