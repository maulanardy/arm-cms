<?php 
namespace GuestBook;

use GuestBook\Model;

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
	}

	public function getById($id = false){
		if($id){
			return $this->model->find($id);
		}
		
		return null;
	}

	public function getAll(){
		$data = $this->model->find('all',array('order' => 'id desc'));
		
		return $data;
	}
	
	public function register(){
		\validation::set_message('required', '%field% is required');
		\validation::set_message('email', '%field% should entered with correct email format');
		\validation::set_message('equals', '%reference% not match');

		\validation::set_rule('name', 'Name', 'required');
		\validation::set_rule('email', 'Email', 'required|email');
		\validation::set_rule('subject', 'Subject', 'required');
		\validation::set_rule('phone', 'Phone', 'required');
		\validation::set_rule('company', 'Company', 'required');
		\validation::set_rule('messages', 'Messages', 'required');

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('email')){
				$this->model->name         = \Io::param('name');
				$this->model->email        = \Io::param('email');
				$this->model->phone        = \Io::param('phone');
				$this->model->company      = \Io::param('company');
				$this->model->subject      = \Io::param('subject');
				$this->model->messages     = \Io::param('messages');
				$this->model->created_date = date("Y-m-d H:i:s");
				
				if($this->model->save()){
					\helper::flashdata("successSubmit", '<div class="alert alert-success">Thanks for your submit</div>');
					return true;
				} else {
					$this->error_msg = "An error occurred";
					return false;
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