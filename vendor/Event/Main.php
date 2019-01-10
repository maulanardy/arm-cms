<?php
namespace Event;

use Event\Model as Model;

/**
* 
*/
class Main
{
  public $Detail;

	public $admin_mode = false;
	public $record = 0;
	public $updated_id;
	
	function __construct()
	{
		$this->model = new Model\Main;
    $this->Detail = new Detail();
    $this->setLanguageController();
    $this->setCategoryController();
    $this->setViewController();
	}

	public function setLanguageController()
	{
		$this->Language = new \Ma\Controller\Language\Main(new \Ma\Model\Language\Main());
	}

	public function setDetailController()
	{
	}

	public function setCategoryController()
	{
		$this->Category = new Category();
	}

	public function setViewController()
	{
		$this->View = new View();
	}

	public function getAll(){
		$data = $this->model->find('all',array('order' => 'id desc'));
		
		return $data;
	}

	public function getById($id = false){
		
		if($id){
				$data = $this->model->first($id);
		}
		
		return $data;
	}

	public function getActive($id = false){
		$now = date("Y-m-d");
		
		if($id){
				$data = $this->model->first(array('conditions' => array('id = ? AND date_publish <= ? AND (date_unpublish >= ? OR date_unpublish = 0) AND status = 1', $id, $now, $now)));
		}else{
				$data = $this->model->find('all', array('conditions' => array('date_publish <= ? AND (date_unpublish >= ? OR date_unpublish = 0) AND status = 1', $now, $now)));
		}
		
		return $data;
	}

	public function getFeatured($category = 'all', $limit = 0)
	{
		$now = date("Y-m-d");

		$conditions = 'ar_posts.featured = 1 ';

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';

		if($category != 'all'){
			$conditions .= "AND (ar_posts_category.id = ? OR ar_posts_category.parent = ?) ";
			$cond_val[] = $this->Category->getBySlug($category)->id;
			$cond_val[] = $this->Category->getBySlug($category)->id;
		}
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'joins' => array('category'),
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'date_publish desc',
			'limit' => $limit
			));

		return $data;
	}

	public function getLatest($category = 'all', $limit = 0)
	{
		$now = date("Y-m-d");

		$conditions .= 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';

		if($category != 'all'){
			$conditions .= "AND (ar_posts_category.id = ? OR ar_posts_category.parent = ?) ";
			$cond_val[] = $this->Category->getBySlug($category)->id;
			$cond_val[] = $this->Category->getBySlug($category)->id;
		}
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'joins' => array('category'),
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'featured desc, date_publish desc',
			'limit' => $limit
			));

		return $data;
	}

	public function getPopular($category = 'all', $limit = 0)
	{
		$now = date("Y-m-d");

		$conditions .= 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';

		if($category != 'all'){
			$conditions .= "AND (ar_posts_category.id = ? OR ar_posts_category.parent = ?) ";
			$cond_val[] = $this->Category->getBySlug($category)->id;
			$cond_val[] = $this->Category->getBySlug($category)->id;
		}
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'select' => 'ar_posts.*, COUNT(ar_posts_view.posts_id) as view_count',
			'joins' => array('category', 'LEFT JOIN ar_posts_view ON(ar_posts.id = ar_posts_view.posts_id)'),
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'view_count desc',
			'group' => 'ar_posts.id',
			'limit' => $limit
			));

		return $data;
	}

	public function findHighlight($category = 'all', $order)
	{
		$now = date("Y-m-d");

		$conditions .= 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';

		$conditions .= 'AND ar_posts.highlight = 1 ';

		if($category != 'all'){
			$conditions .= "AND (ar_posts_category.id = ? OR ar_posts_category.parent = ?) ";
			$cond_val[] = $this->Category->getBySlug($category)->id;
			$cond_val[] = $this->Category->getBySlug($category)->id;
		}
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'select' => 'ar_posts.*',
			'joins' => array('category'),
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'view_count desc',
			'group' => 'ar_posts.id',
			'order' => $order
			));

		return $data;
	}

	public function getByKeyword($keyword)
	{
		$detail = $this->Detail->model->find('all', array(
			'conditions' => array('(title LIKE ? OR content LIKE ? OR excerpt LIKE ?)', '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%'),
			'group' => 'menu_id',
			));

		foreach ($detail as $key => $value) {
			$id[] = $value->menu_id;
		}

		$post = $this->model->find("all", array(
			'conditions' => array('id in(?)', $id),
			'order' => 'date_publish desc',
			));

		return $post;
	}

	public function getBySlug($category, $slug)
	{
		// Post with subcategory
		// $data = $this->model->first('all', array(
		// 	'joins' => array('category'),
		// 	'conditions' => array('ar_posts.slug = ? AND ar_posts_category.parent = ? AND ar_posts_category.slug = ?', $slug, $category, $sub_category),
		// 	));
			
		$data = $this->model->first('all', array(
			'joins' => array('category'),
			'conditions' => array('ar_event.slug = ? AND ar_event_category.id = ?', $slug, $category),
			));

		return $data;
	}

	public function getByCategoryId($id, $limit = 0, $offset = 0)
	{
		$now = date("Y-m-d");

		$conditions = '(category_id = ? OR ar_posts_category.parent = ?) ';
		$cond_val[] = $id;
		$cond_val[] = $id;

		$conditions .= 'AND ar_posts.date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (ar_posts.date_unpublish >= ? OR ar_posts.date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'joins' => array('category'),
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'ar_posts.featured desc, ar_posts.date_publish desc',
			'limit' => $limit,
			'offset' => $offset
			));

		$this->record = $this->model->count(array('joins' => array('category'), 'conditions' => array_merge($cond_var, $cond_val) ));

		return $data;
	}

	public function getByCategorySlug($slug, $limit = 0, $offset = 0)
	{
		$categoryRelationModel = new Model\Category();

		$data = $categoryRelationModel->find('all', array(
			'joins' => array('category'),
			'conditions' => array('ar_posts_category.slug = ?', $slug),
			'order' => 'featured desc, date_publish desc',
			'limit' => $limit,
			'offset' => $offset
			));

		return $data;
	}

	public function getByPositionId($id, $limit = 0, $offset = 0)
	{
		$positionRelationModel = new Model\PositionRelation();

		$now = date("Y-m-d");

		$conditions = '(posts_position_id = ?) ';
		$cond_val[] = $id;

		$conditions .= 'AND ar_posts.date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (ar_posts.date_unpublish >= ? OR ar_posts.date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';
		
		$cond_var[] = $conditions;

		$data = $positionRelationModel->find('all', array(
			'joins' => array('posts','position'),
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'ar_posts.featured desc, ar_posts.date_publish desc, ar_posts.id desc',
			'limit' => $limit,
			'offset' => $offset
			));

		return $data;
	}

	public function getRelated($arr_tag, $limit = 0){
		$now = date("Y-m-d");

		$conditions = 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND status = 1 ';

		if(is_array($arr_tag)){
			$conditions .= " AND (";
			$or = "";

			foreach ($arr_tag as $k => $v) {
				$conditions .= $or.'tags LIKE ? ';
				$or = 'OR ';
				$cond_val[] = "%" . $v . "%";
			}

			$conditions .= " )";
		}
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'date_publish desc',
			'limit' => $limit
			));

		return $data;
	}

	public function getByHashtag($hashtag, $limit = 0){
		$now = date("Y-m-d");

		$conditions = 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND status = 1 ';

		$conditions .= 'AND hashtag = ? ';
		$cond_val[] = $hashtag;
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'date_publish desc',
			'limit' => $limit
			));

		return $data;
	}

	public function getNextEvent($limit = 0, $offset = 0){
		$now = date("Y-m-d");

		$conditions = 'end_date >= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND status = 1 ';
		
		$cond_var[] = $conditions;

		return $this->defaultQuery($cond_var, $cond_val, $limit, $offset);
	}

	public function getNextEventByCategory($category_id, $limit = 0, $offset = 0){
		$now = date("Y-m-d");

		$conditions = 'end_date >= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND category_id = ? ';
		$cond_val[] = $category_id;

		$conditions .= 'AND status = 1 ';
		
		$cond_var[] = $conditions;

		return $this->defaultQuery($cond_var, $cond_val, $limit, $offset);
	}

	public function getPastEvent($limit = 0, $offset = 0){
		$now = date("Y-m-d");

		$conditions = 'end_date < ? ';
		$cond_val[] = $now;

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND status = 1 ';
		
		$cond_var[] = $conditions;

		return $this->defaultQuery($cond_var, $cond_val, $limit, $offset);
	}

	public function getPastEventByCategory($category_id, $limit = 0, $offset = 0){
		$now = date("Y-m-d");

		$conditions = 'end_date < ? ';
		$cond_val[] = $now;

		$conditions .= 'AND date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND category_id = ? ';
		$cond_val[] = $category_id;

		$conditions .= 'AND status = 1 ';
		
		$cond_var[] = $conditions;

		return $this->defaultQuery($cond_var, $cond_val, $limit, $offset);
	}

	public function getNewVisitor($timestamp)
	{
		$visitorModel = new Model\Visitor();

		$conditions = 'date_created >= ? ';
		$cond_val[] = $timestamp;
		
		$cond_var[] = $conditions;

		$data = $visitorModel->find('first', array(
			'conditions' => array_merge($cond_var, $cond_val)
			));

		return $data;
	}

	private function defaultQuery($cond_var, $cond_val, $limit = 0, $offset = 0, $order = 'featured desc, start_date asc'){
		$data = $this->model->find('all', array(
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => $order,
			'limit' => $limit,
			'offset' => $offset
			));

		$this->record = $this->model->count(array('conditions' => array_merge($cond_var, $cond_val) ));

		return $data;
	}

	public function save(){
		if(\Io::param('title_id')){
			$this->model->slug               = \helper::slugify(\Io::param('title_id'));
			$this->model->category_id        = \Io::param('category');
			$this->model->contact            = \Io::param('contact','html');
			$this->model->event_organizer    = \Io::param('event_organizer');
			$this->model->ticket_price       = \Io::param('ticket_price');
			$this->model->location           = \Io::param('location');
			// $this->model->latitude        = \Io::param('latitude');
			// $this->model->longitude       = \Io::param('longitude');
			$this->model->ticket_maps_widget = \Io::param('ticket_maps_widget', 'html');
			$this->model->ticket_url         = \Io::param('ticket_url');
			$this->model->admin_id           = $_SESSION['admin']['id'];
			$this->model->author_id          = $_SESSION['admin']['id'];
			$this->model->tags               = str_replace(" ", "", \Io::param('tags'));
			$this->model->featured_image     = \Io::param('file');
			$this->model->date_created       = date('Y-M-d h:i:s');
			$this->model->start_date         = date('Y-M-d',strtotime(\Io::param('start_date')));
			$this->model->end_date           = date('Y-M-d',strtotime(\Io::param('end_date')));
			$this->model->event_time         = \Io::param('event_time');
			$this->model->date_publish       = date('Y-M-d',strtotime(\Io::param('published')));

			if(\Io::param('unpublished')) $this->model->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));

			$this->model->featured  = \Io::param('featured');
			$this->model->status    = \Io::param('status');
			
			if($this->model->save()){

				$this->addTag(explode(",", \Io::param('tags')));

				$event_id = $this->model->id;

				foreach ($this->Language->retrieve() as $key => $value) {
					$data['title'] = \Io::param('title_' . $value->kode);
					$data['content'] = \Io::param('content_' . $value->kode,'html');
					$data['excerpt'] = \Io::param('excerpt_' . $value->kode);

					$this->Detail->create($event_id, $value->id, $data);
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
				$arr['title']   = \Io::param('title_' . $value->kode);
				$arr['content'] = \Io::param('content_' . $value->kode,'html');
				$arr['excerpt'] = \Io::param('excerpt_' . $value->kode);
				
				$this->Detail->update(\Io::param('id'), $value->id, $arr);
			}

			$data->slug               = \helper::slugify(\Io::param('title_id'));
			$data->category_id        = \Io::param('category');
			$data->contact            = \Io::param('contact','html');
			$data->event_organizer    = \Io::param('event_organizer');
			$data->ticket_price       = \Io::param('ticket_price');
			$data->location           = \Io::param('location');
			// $data->latitude        = \Io::param('latitude');
			// $data->longitude       = \Io::param('longitude');
			$data->ticket_maps_widget = \Io::param('ticket_maps_widget', 'html');
			$data->ticket_url         = \Io::param('ticket_url');
			$data->start_date         = date('Y-M-d',strtotime(\Io::param('start_date')));
			$data->end_date           = date('Y-M-d',strtotime(\Io::param('end_date')));
			$data->event_time         = \Io::param('event_time');
			$data->tags               = str_replace(" ", "", \Io::param('tags'));
			$data->featured_image     = \Io::param('file');
			$data->date_updated       = date('Y-M-d h:i:s');
			$data->date_publish       = date('Y-M-d',strtotime(\Io::param('published')));

			if(\Io::param('unpublished')) $data->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));
			//else  $data->date_unpublish = '0';
			
			$data->featured = \Io::param('featured');
			$data->status   = \Io::param('status');
			
			if($data->save()){
				$this->addTag(explode(",", \Io::param('tags')));

				return true;
			} else {
				return false;
			}
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

				if($data->delete())
					return true;
				else
					return false;
			}
		}
	}

	public function addVisitor($user_id = false){
		if($user_id){
			$visitorModel = new Model\Visitor();

			$visitorModel->event_id     = \Io::param('event_id');
			$visitorModel->user_id      = $user_id;
			$visitorModel->date_created = date('Y-M-d H:i:s');
			
			if($visitorModel->save()){
				return true;
			}else{
				return false;
			}
		}
	}

	public function addTag($arr_tag){
		if(is_array($arr_tag)){
			foreach ($arr_tag as $key => $value) {
				$tags_model = new \Ma\Model\Posts\Tags();

				if(!empty($value) && !$tags_model->find("all", array("conditions" => array("name = ?", $value)))){
					$tags_model->name = str_replace(" ", "", $value);
					$tags_model->save();
				}
			}
		}
	}
}