<?php 
namespace ArtistWishlist;

use ArtistWishlist\Model;

/**
* 
*/
class Answer
{
	private $model;
	public $error_msg = "";
	
	function __construct()
	{
		$this->model = new Model\Answer();
	}

	public function getByArtistId($artistId = false)
	{
		if($artistId){

			$data = $this->model->find('all', array(
				'conditions' => array("artist_id = ?", $artistId),
				'order' => 'date_created desc',
				));

			return $data;

		}
	}

	public function getById($userId = false)
	{
		if($userId){

			$data = $this->model->find('all', array(
				'conditions' => array("user_id = ?", $userId)
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

	public function getMyPolling($userId = false, $artist_id)
	{
		if($userId){

			$data = $this->model->find('all', array(
				'conditions' => array("user_id = ? AND artist_id = ?", $userId, $artist_id)
				));

			return $data;

		}
	}

	public function save(){
		if(\Io::param('artist')){

			if(\Io::param('user_id')){

				if(!$this->getMyPolling(\Io::param('user_id'), \Io::param('artist'))){

					if($this->insert(\Io::param('user_id'), \Io::param('artist'), date('Y-M-d h:i:s'), 1)){
						\helper::flashdata("successVote", '<div class="alert alert-success">'.Wording::$POLLING_SUCCESS.'</div>');
						return true;
					} else {
						$this->error_msg = Wording::$POLLING_ERROR;
						return false;
					}
				} else {
					$this->error_msg = Wording::$POLLING_DOUBLE;
					return false;
				}

			}
		}

		$this->error_msg = Wording::$POLLING_ERROR;
		return false;
	}

	public function insert($userId, $artistId, $createdDate, $status){
		$this->model->user_id      = $userId;
		$this->model->artist_id    = $artistId;
		$this->model->created_date = $createdDate;
		$this->model->status       = $status;
		
		if($this->model->save()){
			$this->error_msg = Wording::$POLLING_SUCCESS;
			return true;
		}else{
			$this->error_msg = Wording::$POLLING_ERROR;
			return false;
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