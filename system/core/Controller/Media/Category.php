<?php
namespace Ma\Controller\Media;

use Ma\Model\Media as Model;

class Category
{
	
	function __construct(Model\Category $model)
	{
		$this->model = $model;
	}
	public function retrieve($id = false){
		if($id){
			$data = $this->model->find($id);
		}else{
			$data = $this->model->find('all');
		}
		
		return $data;
	}

	public function findActive($slug = false){
		if($slug){
			$data = $this->model->first('all', array(
					'conditions' => array('slug = ?', $slug)
				));
		}else{
			$data = $this->model->find('all', array(
					'conditions' => array('status = 1')
				));
		}
		
		return $data;
	}

	public function getBySlug($slug){
		if($slug){
			$data = $this->model->first('all', array(
					'conditions' => array('slug = ?', $slug)
				));
		
				return $data;
		}
	}

	public function getCategorySlug($id){
		if($id){
			$data = $this->model->find($id);
			
			if($data->parent > 0){
				return $this->getCategorySlug($data->parent) . "/" . $data->slug;
			}else{
				return $data->slug;
			}
		}
	}

	public function getChildByCategorySlug($slug){
		if($slug){			
			$parent = $this->model->first('all', array(
					'conditions' => array('slug = ?', $slug)
				));

			$data = $this->model->find('all', array(
					'conditions' => array('parent = ?', $parent->id)
				));

			return $data;
		}
	}
	
	public function save(){
		if(\Io::param('title')){
			$this->model->title = \Io::param('title');
			$this->model->parent = \Io::param('parent');
			$this->model->slug = \helper::slugify(\Io::param('title'));
			$this->model->description = \Io::param('description');
			$this->model->status = \Io::param('status');
			
			if($this->model->save())
				return true;
			else
				return false;
		}
	}
	public function update(){
		if(\Io::param('title')){
			$data = $this->model->find(\Io::param('id'));

			$data->title = \Io::param('title');
			$data->parent = \Io::param('parent');
			$data->slug = \helper::slugify(\Io::param('title'));
			$data->description = \Io::param('description');
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