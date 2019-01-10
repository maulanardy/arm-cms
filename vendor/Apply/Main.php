<?php 
namespace Apply;

use Apply\Model;

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
	
	public function register(){
		\validation::set_message('required', '%field% is required');
		\validation::set_message('email', '%field% should entered with correct email format');
		\validation::set_message('equals', '%reference% not match');

		\validation::set_rule('name', 'Name', 'required');
		\validation::set_rule('email', 'Email', 'required|email');
		\validation::set_rule('phone', 'Phone', 'required');

		\validation::run();

		if(\validation::$validate_status){
			if(\Io::param('email')){

				$this->model->post_id    = \Io::param('post_id');
				$this->model->user_id    = \Io::param('user_id');
				$this->model->name       = \Io::param('name');
				$this->model->email      = \Io::param('email');
				$this->model->gender     = \Io::param('gender');
				$this->model->birth_date = date("Y-m-d", strtotime(\Io::param('dob_year') . "-" . \Io::param('dob_month') . "-" . \Io::param('dob_date')));
				$this->model->phone      = \Io::param('phone');
				$this->model->created_date     = date("Y-m-d H:i:s");
				
				if($this->model->save()){
					if($this->uploadResume($this->model->id)){
						\helper::flashdata("successApply", '<div class="alert alert-success">Thanks for your submit</div>');
						return true;
					} else {
						return false;
					}
				} else {
					$this->error_msg = "An error occurred";
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function uploadResume($id){
		if($id){
			if(($_FILES['resume']['size'] > 0)){
				$config = array(
					'file'            => $_FILES['resume'],
					'legal_extension' =>  array('pdf', 'doc', 'docx'),
					'legal_size'      => 10000000,
					'prefix'          => 'resume-'.date("YmdHis").'-'.$id.'-'.strtolower(\Io::param('name')),
					'path'            => PATH.'media/',
					'folder'          => 'resume/',
					'tree'            => '',
					'encryptName'			=> false
				);

				$uploadObj = new \upload();

				$uploadObj->initialize($config);

				if($uploadObj->upload_image()){
					return $this->addResumeFile($id, $uploadObj->filename);
				} else {
					$this->error_msg = $uploadObj->err_msg;
					return false;
				}

			} else {
				$this->error_msg = "There's no resume selected";
				return false;
			}


		} else {
			$this->error_msg = "Invalid Id";
			return false;
		}
	}

	public function addResumeFile($id, $filename){
		if($id){
			$data = $this->model->find($id);

			$data->file = $filename;

			if($data->save()){
				return true;
			} else {
				$this->error_msg = "An error occurred";
				return false;
			}
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