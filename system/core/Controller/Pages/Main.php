<?php
namespace Ma\Controller\Pages;

use Ma\Model\Pages as Model;

/**
* 
*/
class Main
{
	
	function __construct(Model\Main $model)
	{
		$this->model = $model;
	}

	public function setLanguageController(\Ma\Controller\Language\Main $lang)
	{
		$this->Language = $lang;
	}

	public function setDetailController(Detail $detail)
	{
		$this->Detail = $detail;
	}

	public function retrieve($id = false){
		if($id){
			$data = $this->model->find($id);
		}else{
			$data = $this->model->find('all');
		}
		
		return $data;
	}

	public function findBySlug($slug)
	{
		$data = $this->model->first('all', array('conditions' => array('slug = ? AND status = 1', $slug)));

		return $data;
	}

	public function findById($id)
	{
		$data = $this->model->first('all', array('conditions' => array('id = ? AND status = 1', $id)));

		return $data;
	}

	public function save(){
		if(\Io::param('title_id')){
			// $this->model->title = \Io::param('title');
			$this->model->slug = \helper::slugify(\Io::param('title_id'));
			// $this->model->content = \Io::param('content','html');
			// $this->model->excerpt = \Io::param('excerpt');
			$this->model->admin_id = $_SESSION['admin']['id'];
			$this->model->featured_image = \Io::param('file');
			$this->model->date_created = date('Y-M-d h:i:s');
			$this->model->status = \Io::param('status');
			
			if($this->model->save()){

				$menu_id = $this->model->id;

				foreach ($this->Language->retrieve() as $key => $value) {
					$data['title'] = \Io::param('title_' . $value->kode);
					$data['content'] = \Io::param('content_' . $value->kode,'html');
					$data['excerpt'] = \Io::param('excerpt_' . $value->kode);

					$this->Detail->create($menu_id, $value->id, $data);
				}

				return true;
			}else{
				return false;
			}
		}
	}
	public function update(){
		if(\Io::param('title_id')){
			$data = $this->model->find(\Io::param('id'));

			foreach ($this->Language->retrieve() as $key => $value) {
				$arr['title'] = \Io::param('title_' . $value->kode);
				$arr['content'] = \Io::param('content_' . $value->kode,'html');
				$arr['excerpt'] = \Io::param('excerpt_' . $value->kode);

				$this->Detail->update(\Io::param('id'), $value->id, $arr);
			}

			// $data->title = \Io::param('title');
			$data->slug = \helper::slugify(\Io::param('title_id'));
			// $data->content = \Io::param('content','html');
			// $data->excerpt = \Io::param('excerpt');
			$data->featured_image = \Io::param('file');
			$data->date_updated = date('Y-M-d h:i:s');
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