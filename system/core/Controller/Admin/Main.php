<?php 
namespace Ma\Controller\Admin;

use Ma\Model\Admin as Model;

class Main
{
	public $id = false;
	
	function __construct(Model\Main $model)
	{
		$this->model = $model;

		$this->id = @$_SESSION['admin']['id'];

	}

	public function isLoged()
	{
		if($this->id){
			$data = $this->retrieve($this->id);
			$this->detail = $data;

			return true;
		}else{
			return false;
		}
	}

	public function retrieve($id = false){
		if($id){
			$data = $this->model->find($id);
		}else{
			$data = $this->model->find('all');
		}
		
		return $data;
	}

	public function login()
	{
		if(\Io::param('name') && \Io::param('password')){
			$res = $this->model->first('all', array(
					'conditions' => array(
						'name = ? AND password = ? AND status = 1', \Io::param('name') , md5(\Io::param('password'))
					)
				)
			);

			if($res){
				$res->last_login = date("Y-m-d h:i:s");
				$res->save();

				$_SESSION['admin']['id'] = $res->id;

				$this->id = $res->id;
				
				return true;
			}else{
				$this->error = '<div class="alert alert-danger">wrong username or password</div>';
				return false;
			}
		}
	}

	public function save(){
		\validation::set_message('required', '%field% tidak boleh kosong');
		\validation::set_message('email', '%field% harus dengan format email yang benar');
		\validation::set_message('equals', '%reference% tidak sesuai');
		\validation::set_message('is_unique', '%field% sudah terdaftar');

		\validation::set_rule('username', 'Username', 'required|is_unique.\Ma\Model\Admin\Main.name');
		\validation::set_rule('initial', 'Initial', 'required|is_unique.\Ma\Model\Admin\Main.initial');
		\validation::set_rule('fullname', 'Full Name', 'required');
		\validation::set_rule('email', 'Email', 'required|email');
		\validation::set_rule('password', 'Password', 'required');
		\validation::set_rule('re_password', 'Retype Password', 'equals.password');

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('username')){
				$this->model->name        = \Io::param('username');
				$this->model->full_name   = \Io::param('fullname');
				$this->model->initial      = \Io::param('initial');
				$this->model->email       = \Io::param('email');
				$this->model->password    = md5(\Io::param('password'));
				$this->model->category_id = \Io::param('role');
				$this->model->status      = \Io::param('status');
				
				if($this->model->save()){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
	public function update(){
		$data = $this->model->find(\Io::param('id'));

		\validation::set_message('required', '%field% tidak boleh kosong');
		\validation::set_message('email', '%field% harus dengan format email yang benar');
		\validation::set_message('equals', '%reference% tidak sesuai');
		\validation::set_message('is_unique', '%field% sudah terdaftar');

		if($data->name != \Io::param('username')){
			\validation::set_rule('username', 'Username', 'required|is_unique.\Ma\Model\Admin\Main.name');
		}
		if($data->initial != \Io::param('initial')){
			\validation::set_rule('initial', 'Initial', 'required|is_unique.\Ma\Model\Admin\Main.initial');
		}
		\validation::set_rule('fullname', 'Full Name', 'required');
		\validation::set_rule('email', 'Email', 'required|email');

		if(\Io::param('password')){
			\validation::set_rule('password', 'Password', 'required');
			\validation::set_rule('re_password', 'Retype Password', 'equals.password');
		}

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('id')){
				

				$data->name        = \Io::param('username');
				$data->initial     = \Io::param('initial');
				$data->full_name   = \Io::param('fullname');
				$data->email       = \Io::param('email');
				$data->category_id = \Io::param('role');
				$data->status      = \Io::param('status');

				if(\Io::param('password')) $data->password    = md5(\Io::param('password'));
				
				if($data->save())
					return true;
				else
					return false;
			}
		}else{
			return false;
		}
	}
	
	public function delete($id = false){
		if($id){
			if(is_array($id)){
				$this->model->table()->delete(array('id' => $id));

				return true;
			}else{
				$data = $this->model->find($id);

				if($data->delete())
					return true;
				else
					return false;
			}
		}
	}
}