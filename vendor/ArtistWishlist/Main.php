<?php 
namespace ArtistWishlist;

use ArtistWishlist\Model;

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

	public function getByName($name = false)
	{
		if($name){
			$data = $this->model->find('first', array(
				'conditions' => array("name = ?", $name)
				));

			return $data;
		}
	} 

	public function getAll($limit = 0)
	{
		$data = $this->model->find('all', array(
			'order' => 'created_date desc',
			'limit' => $limit
			));

		return $data;
	} 

	public function getActive($limit = 0)
	{
		$data = $this->model->find('all', array(
			'conditions' => array("status = 1"),
			'order' => 'name asc',
			'limit' => $limit
			));

		return $data;
	} 

	public function update(){
		if(\Io::param("id")){
			$edit = $this->model->find(\Io::param("id"));

			$edit->name        = \Io::param("name");
			$edit->status     = \Io::param("status");

			if($edit->save()){
				return true;
			} else {
				return false;
			}
		}
	}

	public function insert(){

		if(!empty(\Io::param("name"))){
			$data = $this->getByName(\Io::param("name"));

			if(!$data){
				$this->model->name         = \Io::param("name");
				$this->model->created_date = date('Y-M-d h:i:s');
				$this->model->status       = 1;

				if($this->model->save()){
					$artistId = $this->model->id;

					$this->addAnswer($artistId);
					\helper::flashdata("successVote", '<div class="alert alert-success">Thanks for your suggestion</div>');
					return true;
				} else {
					$this->error_msg = "An error occurred";
					return false;
				}
			} else {
				if($this->addAnswer($data->id)){
					\helper::flashdata("successVote", '<div class="alert alert-success">Thanks for your suggestion</div>');

					return true;
				}
			}
		} else {
			$this->error_msg = "Empty name not allowed";
		}

		return false;
	}

	public function addAnswer($artistId){
		$answer = new Answer();

		if(!$answer->getMyPolling(\Io::param('user_id'), $artistId)){
			if($answer->insert(\Io::param('user_id'), $artistId, date('Y-M-d h:i:s'), 1)){
				return true;
			} else {
				$this->error_msg = "Empty name not allowed";
				return false;
			}
		} else {
			$this->error_msg = "You've already vote this artist";
		}
		return false;
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