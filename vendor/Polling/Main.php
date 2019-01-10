<?php 
namespace Polling;

use Polling\Model;

/**
* 
*/
class Main
{
	private $model;

	function __construct()
	{
		$this->model = new Model\Main();
	}

	public function getById($id = false, $limit = 0)
	{
		if($id){
			$data = $this->model->find('first', array(
				'conditions' => array("id = ?", $id),
				'limit' => $limit
				));

			return $data;
		}
	} 

	public function getAll($limit = 0)
	{
		$data = $this->model->find('all', array(
			'order' => 'date_publish desc',
			'limit' => $limit
			));

		return $data;
	} 

	public function getActive($limit = 0)
	{
		$now = date("Y-m-d");

		$conditions = 'is_active = 1 ';

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'date_publish desc',
			'limit' => $limit
			));

		return $data;
	} 

	public function getFeatured($limit = 0)
	{
		$now = date("Y-m-d");

		$conditions = 'is_active = 1 AND is_featured = 1 ';

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;

		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'date_publish desc',
			'limit' => $limit
			));

		return $data;
	} 

	public function update(){
		if(\Io::param("id")){
			$edit = $this->model->find(\Io::param("id"));

			$edit->title        = \Io::param("title");
			$edit->question     = \Io::param("question");
			$edit->date_publish = date('Y-M-d',strtotime(\Io::param('date_publish')));
			$edit->is_active    = \Io::param("status");
			$edit->is_featured  = \Io::param('featured');

			if($edit->save()){
				return true;
			} else {
				return false;
			}
		}
	}

	public function insert(){

		$this->model->title        = \Io::param("title");
		$this->model->question     = \Io::param("question");
		$this->model->date_created = date('Y-M-d h:i:s');
		$this->model->date_publish = date('Y-M-d',strtotime(\Io::param('date_publish')));
		$this->model->is_active    = \Io::param("status");
		$this->model->is_featured  = \Io::param('featured');

		if($this->model->save()){
			$pollingId = $this->model->id;

			$this->addOption($pollingId, explode(",", \Io::param('option')));
			return true;
		} else {
			return false;
		}
	}

	public function addOption($pollingId, $arrOption){
		if(is_array($arrOption)){
			foreach ($arrOption as $key => $value) {
				$optionModel = new Model\Option();

				$optionModel->polling_id = $pollingId;
				$optionModel->value      = $value;
				$optionModel->save();
			}
		}
	}

  public function delete($id = false){
      if($id){
          if(is_array($id)){
              $this->model->table()->delete(array('id' => $id));

              return true;
          }else{
              $conditions['id'] = $id;

              $this->model->delete_all(array('conditions' => array($conditions) ));

              return true;
          }
      }
  }
}

?>