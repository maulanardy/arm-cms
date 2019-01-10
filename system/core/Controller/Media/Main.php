<?php
namespace Ma\Controller\Media;

use Ma\Model\Media as Model;

class Main
{
	
	function __construct(Model\Main $model)
	{
		$this->model = $model;
	}

	public function setCategoryController(Category $category)
	{
		$this->Category = $category;
	}

	public function retrieve($id = false){
		if($id){
			$data = $this->model->find($id);
		}else{
			$data = $this->model->find('all', array('order' => 'id DESC'));
		}
		
		return $data;
	}

	public function findAllByCategoryId($categoryId = false){
		if($categoryId){
			$data = $this->model->find('all', array('conditions' => array("category_id = ?", $categoryId),'order' => 'id DESC'));
		}
		
		return $data;
	}

	public function findFirstByCategory($category){
		$data = $this->model->first('all',array(
			'joins' => array('category'),
			'conditions' => array('ar_media.category_id = ? AND ar_media.status = 1', $category), 
			'order' => 'id ASC'
			)
		);

		return $data;
	}

	public function findByCategory($category){
		$data = $this->model->find('all',array(
			'joins' => array('category'),
			'conditions' => array('(ar_media.category_id = ? OR ar_media_category.parent = ?) AND ar_media.status = 1', $category, $category), 
			'order' => 'id DESC'
			)
		);

		return $data;
	}

	public function findBySlugCategory($slug){
		$cat_id = $this->Category->findActive($slug);

		$data = $this->findByCategory($cat_id->id);

		return $data;
	}

	public function save(){
		if(\Io::param('title')){
			$this->model->title = \Io::param('title');
			$this->model->category_id = \Io::param('category');
			$this->model->content = \Io::param('content', 'html');
			$this->model->url = \Io::param('url');
			$this->model->file = \Io::param('file');
			$this->model->date_created = date('d-M-Y h:i:s');
			$this->model->date_publish = date('d-M-Y',strtotime(\Io::param('published')));
			if(\Io::param('unpublished')) $this->model->date_unpublish = date('d-M-Y',strtotime(\Io::param('unpublished')));
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
			$data->category_id = \Io::param('category');
			$data->content = \Io::param('content', 'html');
			$data->url = \Io::param('url');
			$data->file = \Io::param('file');
			$data->date_updated = date('d-M-Y h:i:s');
			$data->date_publish = date('d-M-Y',strtotime(\Io::param('published')));
			if(\Io::param('unpublished')) $data->date_unpublish = date('d-M-Y',strtotime(\Io::param('unpublished')));
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