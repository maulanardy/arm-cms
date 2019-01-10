<?php
namespace Ma\Controller\Language;

use Ma\Model\Language as Model;

/**
* 
*/
class Main
{
	public $admin_mode = false;

	function __construct(Model\Main $model)
	{
		$this->model = $model;
	}

	public function retrieve($id = false){
		
		if($id){
			if($admin_mode){
				$data = $this->model->first($id);
			}else{
				$data = $this->model->first(array('conditions' => array('id = ? AND status = 1', $id)));
			}
		}else{
			if($admin_mode){
				$data = $this->model->find('all');
			}else{
				$data = $this->model->find('all', array('conditions' => array('status = 1')));
			}
		}
		
		return $data;
	}

	public function findByCode($code){
		if($code){
			$data = $this->model->first(array('conditions' => array('kode = ?', $code)));
			return $data;
		}
	}

	public function getCodeById($id){
		if($id){
			$data = $this->model->find($id);
			return $data->kode;
		}
	}

	public function save(){
		if(\Io::param('kode')){
			$this->model->kode = \Io::param('kode');
			$this->model->nama = \Io::param('nama');
			$this->model->status = \Io::param('status');
			
			if($this->model->save())
				return true;
			else
				return false;
		}
	}

	public function update(){
		if(\Io::param('kode')){
			$data = $this->model->find(\Io::param('id'));

			$data->kode = \Io::param('kode');
			$data->nama = \Io::param('nama');
			$data->status = \Io::param('status');
			
			if($data->save())
				return true;
			else
				return false;
		}
	}

	public function delete($id = false){
		if($id){
			if(is_array($id)){
				$this->model->table()->delete(array('id' => $id));
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