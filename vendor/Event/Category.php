<?php
namespace Event;

use Event\Model as Model;

/**
* 
*/
class Category
{		
	function __construct()
	{
		$this->model = new Model\Category();
		$this->setLanguageController();
		$this->setDetailController();
	}

	public function setLanguageController()
	{
		$this->Language = new \Ma\Controller\Language\Main(new \Ma\Model\Language\Main());
	}

	public function setDetailController()
	{
		$this->Detail = new CategoryDetail();
	}

	public function getAll(){
		$data = $this->model->find('all');
		
		return $data;
	}

	public function getActive($id = false){
		if($id){
			$data = $this->model->first(array('conditions' => array('id = ? AND status = 1', $id)));
		}else{
			$data = $this->model->find('all', array('conditions' => array('status = 1')));
		}
		
		return $data;
	}

	public function getById($id = false){
		if($id){
				$data = $this->model->first($id);
		}

		return $data;
	}

	public function getChildByid($id = false){
		if($id){
			$data = $this->model->find('all', array('conditions' => array('parent = ? AND status = 1', $id), 'order' => 'title asc'));
			
			return $data;
		}
	}

	// public function getAll($limit = 0){
	// 	$data = $this->model->find('all', array('conditions' => array('status = 1'), 'limit' => $limit, 'order' => 'id desc'));
		
	// 	return $data;
	// }

	public function getBySlug($slug = false, $parent = false){
		if($slug){

			$conditions["slug"] = $slug;
			if($parent) $conditions["parent"] = $parent;

			$data = $this->model->first('all', array('conditions' => $conditions));
		}else{
			$data = $this->model->find('all', array(
					'conditions' => array('status = 1')
				));
		}
		
		return $data;
	}

	public function getCategorySlug($id){
		if($id){
			$data = $this->model->find(array("conditions" => array("id = ?", $id)));
			
			if($data){
				if($data->parent > 0){
					return $this->getCategorySlug($data->parent) . "/" . $data->slug;
				}else{
					return $data->slug;
				}
			} else{
				return "";
			}
		}
	}

	public function save(){
		if(\Io::param('title_id')){
			$this->model->slug = \helper::slugify(\Io::param('title_id'));
			$this->model->parent = \Io::param('parent');
			$this->model->picture = \Io::param('file');
			$this->model->status = \Io::param('status');
			
			if($this->model->save()){

				$post_id = $this->model->id;

				foreach ($this->Language->retrieve() as $key => $value) {
					$data['title'] = \Io::param('title_' . $value->kode);
					$data['description'] = \Io::param('description_' . $value->kode);

					$this->Detail->create($post_id, $value->id, $data);
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
				$arr['description'] = \Io::param('description_' . $value->kode);

				$this->Detail->update(\Io::param('id'), $value->id, $arr);
			}

			// $data->title = \Io::param('title');
			$data->slug = \helper::slugify(\Io::param('title_id'));
			$data->parent = \Io::param('parent');
			// $data->description = \Io::param('description','html');
			$data->picture = \Io::param('file');
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
				
				$this->Detail->delete($id);

				$this->deleteChild($id);

				if($data->delete())
					return true;
				else
					return false;
			}
		}
	}

	public function deleteChild($parent = false){
		if($parent){
			$child = $this->model->find('all', array('conditions' => array('parent = ?', $parent)));

			foreach ($child as $k => $v) {
				$this->deleteChild($v->id);
				$v->delete();
			}
		}
	}
}