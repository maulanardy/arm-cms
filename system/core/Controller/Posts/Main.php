<?php
namespace Ma\Controller\Posts;

use Ma\Model\Posts as Model;

/**
* 
*/
class Main
{
    public $Detail;

	public $admin_mode = false;
	public $limit = 10;
	public $offset = 0;
	public $record = 0;
	public $updated_id;
	
	function __construct(Model\Main $model)
	{
		$this->model = $model;

        $this->Detail = new Detail( new Model\Detail());
	}

	public function setLimit($i)
	{
		$this->limit = $i;
	}

	public function setOffset($i)
	{
		$this->offset = $i;
	}

	public function setLanguageController(\Ma\Controller\Language\Main $lang)
	{
		$this->Language = $lang;
	}

	public function setDetailController()
	{
	}

	public function setCategoryController(Category $category)
	{
		$this->Category = $category;
	}

	public function setViewController(View $view)
	{
		$this->View = $view;
	}

	public function retrieve($id = false){
		$now = date("Y-m-d");
		
		if($id){
			if(isset($_SESSION['admin']['id'])){
				$data = $this->model->first($id);
			}else{
				$data = $this->model->first(array('conditions' => array('id = ? AND date_publish <= ? AND (date_unpublish >= ? OR date_unpublish = 0) AND status = 1', $id, $now, $now)));
			}
		}else{
			if(isset($_SESSION['admin']['id'])){
				$data = $this->model->find('all',array('order' => 'id desc'));
			}else{
				$data = $this->model->find('all', array('conditions' => array('date_publish <= ? AND (date_unpublish >= ? OR date_unpublish = 0) AND status = 1', $now, $now)));
			}
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

	public function getLatest($category = 'all', $limit = 0, $offset = 0)
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
			'limit' => $limit,
			'offset' => $offset
			));

		$this->record = $this->model->count(array('joins' => array('category'), 'conditions' => array_merge($cond_var, $cond_val) ));

		return $data;
	}

	public function getLatestBuild($limit = 0)
	{
		$now = date("Y-m-d");

		$conditions .= 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND ar_posts.status = 1 ';
		
		$cond_var[] = $conditions;

		$data = $this->model->find('all', array(
			'conditions' => array_merge($cond_var, $cond_val),
			'order' => 'date_publish desc',
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
			'conditions' => array('ar_posts.slug = ? AND ar_posts_category.id = ?', $slug, $category),
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

	public function getRelatedByCategory($category_id, $arr_tag, $limit = 0){
		$now = date("Y-m-d");

		$conditions = 'date_publish <= ? ';
		$cond_val[] = $now;

		$conditions .= 'AND (date_unpublish >= ? OR date_unpublish = 0) ';
		$cond_val[] = $now;

		$conditions .= 'AND status = 1 ';

		$conditions .= 'AND category_id = ? ';
		$cond_val[] = $category_id;

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

	public function save(){
		if(\Io::param('title_id')){
			// $this->model->title       = \Io::param('title');
			$this->model->slug           = \helper::slugify(\Io::param('title_id'));
			$this->model->category_id    = \Io::param('category');
			// $this->model->content     = \Io::param('content','html');
			// $this->model->excerpt     = \Io::param('excerpt');
			$this->model->admin_id       = $_SESSION['admin']['id'];
			$this->model->author_id      = $_SESSION['admin']['id'];
			$this->model->hashtag        = str_replace(" ", "", \Io::param('hashtag'));
			$this->model->tags           = str_replace(" ", "", \Io::param('tags'));
			$this->model->template       = \Io::param('template');
			$this->model->featured_image = \Io::param('file');
			$this->model->video          = \Io::param('video');
			$this->model->gallery_id     = \Io::param('gallery');
			$this->model->youtube        = \Io::param('youtube');
			$this->model->media_caption  = \Io::param('media_caption');
			$this->model->document       = \Io::param('document');
			$this->model->date_created   = date('Y-M-d h:i:s');
			$this->model->date_publish   = date('Y-M-d',strtotime(\Io::param('published')));

			if(\Io::param('unpublished')) $this->model->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));
			//else  $this->model->date_unpublish = '0000-00-00';

			$this->model->featured  = \Io::param('featured');
			$this->model->highlight = \Io::param('highlight');
			$this->model->status    = \Io::param('status');
			
			if($this->model->save()){

				$this->addTag(explode(",", \Io::param('tags')));
				$this->addHashTag(\Io::param('hashtag'));

				$menu_id = $this->model->id;

				foreach (\Io::param('position') as $key => $value) {
					$rel = new Model\PositionRelation();

                    $rel->posts_id =$this->model->id;
                    $rel->posts_position_id = $value;

                    $rel->save();
				}

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

	public function saveOnly(){
		if(\Io::param('title_id')){
			// $this->model->title       = \Io::param('title');
			$this->model->slug           = \helper::slugify(\Io::param('title_id'));
			if(\Io::param('category')) $this->model->category_id    = \Io::param('category');
			// $this->model->content     = \Io::param('content','html');
			// $this->model->excerpt     = \Io::param('excerpt');
			$this->model->admin_id       = $_SESSION['admin']['id'];
			$this->model->author_id      = $_SESSION['admin']['id'];
			if(\Io::param('hashtag')) $this->model->hashtag             = str_replace(" ", "", \Io::param('hashtag'));
			if(\Io::param('tags')) $this->model->tags                   = str_replace(" ", "", \Io::param('tags'));
			if(\Io::param('template')) $this->model->template           = \Io::param('template');
			if(\Io::param('file')) $this->model->featured_image         = \Io::param('file');
			if(\Io::param('video')) $this->model->video                 = \Io::param('video');
			if(\Io::param('gallery')) $this->model->gallery_id          = \Io::param('gallery');
			if(\Io::param('youtube')) $this->model->youtube             = \Io::param('youtube');
			if(\Io::param('media_caption')) $this->model->media_caption = \Io::param('media_caption');
			$this->model->date_created                                  = date('Y-M-d h:i:s');
			if(\Io::param('published')) $this->model->date_publish      = date('Y-M-d',strtotime(\Io::param('published')));
			
			if(\Io::param('unpublished')) $this->model->date_unpublish  = date('Y-M-d',strtotime(\Io::param('unpublished')));
			//else  $this->model->date_unpublish                        = '0000-00-00';
			
			if(\Io::param('featured')) $this->model->featured           = \Io::param('featured');
			if(\Io::param('highlight')) $this->model->highlight         = \Io::param('highlight');
			$this->model->status                                        = 0;
			
			if($this->model->save()){

				$this->addTag(explode(",", \Io::param('tags')));
				$this->addHashTag(\Io::param('hashtag'));

				$menu_id = $this->model->id;

				if(\Io::param('position')){						
					foreach (\Io::param('position') as $key => $value) {
						$rel = new Model\PositionRelation();

	                    $rel->posts_id =$this->model->id;
	                    $rel->posts_position_id = $value;

	                    $rel->save();
					}
				}

				foreach ($this->Language->retrieve() as $key => $value) {
					$data['title'] = \Io::param('title_' . $value->kode);
					$data['content'] = \Io::param('content_' . $value->kode,'html');
					$data['excerpt'] = \Io::param('excerpt_' . $value->kode);

					$this->Detail->create($menu_id, $value->id, $data);
				}
				$this->updated_id = $menu_id;
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


			$posRelationModel = new Model\PositionRelation();
			$posRelationModel::delete_all(array('conditions' => array('posts_id = ?', \Io::param('id'))));

			foreach (\Io::param('position') as $key => $value) {
				$pos_relation = new Model\PositionRelation();

				$pos_relation->posts_id = \Io::param('id');
				$pos_relation->posts_position_id = $value;

				$pos_relation->save();
			}

			// $data->title       = \Io::param('title');
			$data->slug           = \helper::slugify(\Io::param('title_id'));
			$data->category_id    = \Io::param('category');
			// $data->content     = \Io::param('content','html');
			// $data->excerpt     = \Io::param('excerpt');
			$data->hashtag        = str_replace(" ", "", \Io::param('hashtag'));
			$data->tags           = str_replace(" ", "", \Io::param('tags'));
			$data->template       = \Io::param('template');
			$data->featured_image = \Io::param('file');
			$data->video          = \Io::param('video');
			$data->gallery_id     = \Io::param('gallery');
			$data->youtube        = \Io::param('youtube');
			$data->media_caption  = \Io::param('media_caption');
			$data->document       = \Io::param('document');
			$data->date_updated   = date('Y-M-d h:i:s');
			$data->date_publish   = date('Y-M-d',strtotime(\Io::param('published')));

			if(\Io::param('unpublished')) $data->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));
			//else  $data->date_unpublish = '0';
			
			if(\Io::param('highlight'))  $data->highlight = \Io::param('highlight');
			$data->featured = \Io::param('featured');
			$data->status   = \Io::param('status');
			
			if($data->save()){
				$this->addTag(explode(",", \Io::param('tags')));
				$this->addHashTag(\Io::param('hashtag'));

				return true;
			} else {
				return false;
			}
		}
	}

	public function updateOnly(){
		if(\Io::param('title_id')){
			$data = $this->model->find(\Io::param('id'));

			foreach ($this->Language->retrieve() as $key => $value) {
				$arr['title']   = \Io::param('title_' . $value->kode);
				$arr['content'] = \Io::param('content_' . $value->kode,'html');
				$arr['excerpt'] = \Io::param('excerpt_' . $value->kode);
				
				$this->Detail->update(\Io::param('id'), $value->id, $arr);
			}


			$posRelationModel = new Model\PositionRelation();
			$posRelationModel::delete_all(array('conditions' => array('posts_id = ?', \Io::param('id'))));

			foreach (\Io::param('position') as $key => $value) {
				$pos_relation = new Model\PositionRelation();

				$pos_relation->posts_id = \Io::param('id');
				$pos_relation->posts_position_id = $value;

				$pos_relation->save();
			}

			// $data->title       = \Io::param('title');
			$data->slug           = \helper::slugify(\Io::param('title_id'));
			$data->category_id    = \Io::param('category');
			// $data->content     = \Io::param('content','html');
			// $data->excerpt     = \Io::param('excerpt');
			$data->hashtag        = str_replace(" ", "", \Io::param('hashtag'));
			$data->tags           = str_replace(" ", "", \Io::param('tags'));
			$data->template       = \Io::param('template');
			$data->featured_image = \Io::param('file');
			$data->video          = \Io::param('video');
			$data->gallery_id     = \Io::param('gallery');
			$data->youtube        = \Io::param('youtube');
			$data->media_caption  = \Io::param('media_caption');
			$data->date_updated   = date('Y-M-d h:i:s');
			$data->date_publish   = date('Y-M-d',strtotime(\Io::param('published')));

			if(\Io::param('unpublished')) $data->date_unpublish = date('Y-M-d',strtotime(\Io::param('unpublished')));
			//else  $data->date_unpublish = '0';
			
			$data->featured = \Io::param('featured');
			$data->status   = 0;
			
			if($data->save()){
				$this->addTag(explode(",", \Io::param('tags')));
				$this->addHashTag(\Io::param('hashtag'));

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

	public function addTag($arr_tag){
		if(is_array($arr_tag)){
			foreach ($arr_tag as $key => $value) {
				$tags_model = new Model\Tags();

				if(!empty($value) && !$tags_model->find("all", array("conditions" => array("name = ?", $value)))){
					$tags_model->name = str_replace(" ", "", $value);
					$tags_model->save();
				}
			}
		}
	}

	public function addHashTag($hashtag){

		$tags_model = new Model\Hashtag();

		if(!empty($hashtag) && !$tags_model->find("all", array("conditions" => array("name = ?", $hashtag)))){
			$tags_model->name = str_replace(" ", "", $hashtag);
			$tags_model->save();
		}

	}
}