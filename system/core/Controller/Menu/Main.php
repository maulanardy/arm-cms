<?php
namespace Ma\Controller\Menu;

use Ma\Model\Menu as Model;

class Main
{ 
  public $html = '';
  public $config = array();

  function __construct(Model\Main $model)
  {
    $this->model = $model;
  }

  public function setLanguageController(\Ma\Controller\Language\Main $lang)
  {
    $this->Language = $lang;
  }

  public function setPostController(\Ma\Controller\Posts\Main $post)
  {
    $this->Posts = $post;
  }

  public function setMediaCategoryController(\Ma\Controller\Media\Category $mediaCat)
  {
    $this->MediaCat = $mediaCat;
  }

  public function setDetailController(Detail $detail)
  {
    $this->Detail = $detail;
  }

  public function init(){
    $this->config = array(
        "class"                               => "",
        "parent_only"                         => false,
        "use_link"                            => true,
        "active_only"                         => true,

        "head_tag_start_top-menu"                => "",
        "head_tag_attr_start_top-menu"           => "",
        "child_tag_start_top-menu"               => '<li>',
        "child_tag_end_top-menu"                 => "</li>",
        "child_tag_start_has_sub_top-menu"       => '<li>',
        "child_tag_end_has_sub_top-menu"         => "</li>", 
        "head_tag_attr_end_top-menu"             => "",
        "head_tag_end_top-menu"                  => "",

        "head_tag_start_top-menu_child"          => "<ul>",
        "child_tag_start_top-menu_child"         => '<li>', 
        "child_tag_end_top-menu_child"           => "</li>",
        "child_tag_start_has_sub_top-menu_child" => '<li>',
        "child_tag_end_has_sub_top-menu_child"   => "</li>",  
        "head_tag_end_top-menu_child"            => "</ul>",

        "head_tag_start_top-menu_child_child"          => "<ul>",
        "child_tag_start_top-menu_child_child"         => '<li>', 
        "child_tag_end_top-menu_child_child"           => "</li>",
        "child_tag_start_has_sub_top-menu_child_child" => '<li>',
        "child_tag_end_has_sub_top-menu_child_child"   => "</li>",  
        "head_tag_end_top-menu_child_child"            => "</ul>",


        "head_tag_start_bottom-menu"                => "",
        "head_tag_attr_start_bottom-menu"           => "",
        "child_tag_start_bottom-menu"               => '<li class="bullet style_5">',
        "child_tag_end_bottom-menu"                 => "</li>",
        "child_tag_start_has_sub_bottom-menu"       => '<li class="bullet style_5">',
        "child_tag_end_has_sub_bottom-menu"         => "</li>", 
        "head_tag_attr_end_bottom-menu"             => "",
        "head_tag_end_bottom-menu"                  => "",

        "head_tag_start_bottom-menu_child"          => "<ol>",
        "child_tag_start_bottom-menu_child"         => '<li>', 
        "child_tag_end_bottom-menu_child"           => "</li>",
        "child_tag_start_has_sub_bottom-menu_child" => '<li>',
        "child_tag_end_has_sub_bottom-menu_child"   => "</li>",  
        "head_tag_end_bottom-menu_child"            => "</ol>",

        "head_tag_start_bottom-menu_child_child"          => "<ul>",
        "child_tag_start_bottom-menu_child_child"         => '<li>', 
        "child_tag_end_bottom-menu_child_child"           => "</li>",
        "child_tag_start_has_sub_bottom-menu_child_child" => '<li>',
        "child_tag_end_has_sub_bottom-menu_child_child"   => "</li>",  
        "head_tag_end_bottom-menu_child_child"            => "</ul>", 

      );

    $this->createMenu();
  }

  public function createMenu(){

    $conditions['parent'] = 0;
    if($this->config["active_only"]) $conditions['status'] = 1;

    $menu = $this->model->find('all', array(
                      'conditions' => array($conditions)
                      ));

    foreach ($menu as $key => $value) {

      $conditions['parent'] = $value->id;
      if($this->config["active_only"]) $conditions['status'] = 1;

      $data = $this->model->find('all', array( 
                        'conditions' => $conditions,
                        'order' => 'sort asc'
                        ));

      $this->config["class"] = $value->slug != "" ? "_" . $value->slug : "";
      $this->generate($data);
      $n = $value->slug;
      $n = str_replace("-", "_", $n);
      $this->$n = $this->html;
      $this->html = "";

      // $this->config["parent_only"] = true;
      // $this->generate($data, "footer");
      // $n = $n."_footer";
      // $this->$n = $this->html;
      // $this->html = "";
    }
  }

  public function generate($data = false){
    if($data){
      $this->html .= $this->config["head_tag_start".$this->config["class"]];

      $this->build($data);

      $this->html .= $this->config["head_tag_end".$this->config["class"]];
    }
  }

  public function build($data)
  {
    foreach ($data as $k => $v) {

      $child_class = $this->config["class"];

      $conditions['parent'] = $v->id;
      if($this->config["active_only"]) $conditions['status'] = 1;

      $child = $this->model->find('all', array( 
                        'conditions' => $conditions,
                        'order' => 'sort asc'
                        ));

      if($child) 
        $this->html .= $this->config["child_tag_start_has_sub".$child_class];
      else 
        $this->html .= $this->config["child_tag_start".$child_class];

      if($this->config["use_link"]) $this->html .= '<a data-slug="'.$this->getSlug($v).'" href="'.$this->getLink($v).'">';

      $this->html .= $this->config["head_tag_attr_start".$this->config["class"]];

      $this->html .= $this->Detail->getTitle($v->id);

      $this->html .= $this->config["head_tag_attr_end".$this->config["class"]];

      if($this->config["use_link"]) $this->html .= '</a>';

      

      if($v->link_to == "category"){

        if($v->child_option == "category"){

          $this->config["class"] .= "_child";

          $this->generateMenuPostCategory($v->category_id);

          $pos = strpos($this->config["class"], "_child");
          if ($pos !== false) {
              $this->config["class"] = substr_replace($this->config["class"], "", $pos, strlen("_child"));
          }
          
        } elseif($v->child_option == "top_post"){

          $this->config["class"] .= "_child";

          $this->generateMenuPost($v->category_id);

          $pos = strpos($this->config["class"], "_child");
          if ($pos !== false) {
              $this->config["class"] = substr_replace($this->config["class"], "", $pos, strlen("_child"));
          }
        }

        
      }else if($v->link_to == "media"){

        $this->config["class"] .= "_child";

        $this->generateMenuMedia($v->media_id);

        $pos = strpos($this->config["class"], "_child");
        if ($pos !== false) {
            $this->config["class"] = substr_replace($this->config["class"], "", $pos, strlen("_child"));
        }
        
      }else if(!$this->config["parent_only"] && $child){

        $this->config["class"] .= "_child";

        $this->generate($child);

        $pos = strpos($this->config["class"], "_child");
        if ($pos !== false) {
            $this->config["class"] = substr_replace($this->config["class"], "", $pos, strlen("_child"));
        }

      }

      if($child) 
        $this->html .= $this->config["child_tag_end_has_sub".$child_class];
      else 
        $this->html .= $this->config["child_tag_end".$child_class];
    }
  }

  public function generateMenuPost($id){
    if($id){
      $this->html .= $this->config["head_tag_start".$this->config["class"]];

      $this->buildMenuPost($id);
      $this->html .= $this->config["head_tag_end".$this->config["class"]];
    }
  }

  public function buildMenuPost($id)
  {
    $child_class = $this->config["class"];
    
    $post = $this->Posts->findHighlight($this->Posts->Category->getSlugById($id), $order = 'id ASC');

    if($post){
      foreach ($post as $k => $v) {

        $conditions['parent'] = $v->id;

        $this->html .= $this->config["child_tag_start".$child_class];

        if($this->config["use_link"]) $this->html .= '<a href="'.BASE.$this->Posts->Category->getCategorySlug($v->category->id)."/".$v->slug.'">';

        $this->html .= $this->Posts->Detail->getTitle($v->id);

        if($this->config["use_link"]) $this->html .= '</a>';
        
        $this->html .= $this->config["child_tag_end".$child_class];
      }
    }
  }

  public function generateMenuPostCategory($parent){
    if($parent){
      $this->html .= $this->config["head_tag_start".$this->config["class"]];

      $this->buildMenuPostCategory($parent);

      $this->html .= $this->config["head_tag_end".$this->config["class"]];
    }
  }

  public function buildMenuPostCategory($parent)
  {
    $child_class = $this->config["class"];

    $cat = \Ma\Model\Posts\Category::find('all', array(
          'conditions' => array('parent = ?', $parent)
        ));

    if($cat){

      foreach ($cat as $k => $v) {

        $conditions['parent'] = $v->id;
        if($this->config["active_only"]) $conditions['status'] = 1;

        $child = \Ma\Model\Posts\Category::find('all', array( 
                          'conditions' => $conditions,
                          'order' => 'id desc'
                          ));

        if($child) 
          $this->html .= $this->config["child_tag_start_has_sub".$child_class];
        else 
          $this->html .= $this->config["child_tag_start".$child_class];

        if($this->config["use_link"]) $this->html .= '<a href="'.BASE.$this->Posts->Category->getCategorySlug($v->id).'">';

        $this->html .= $this->Posts->Category->Detail->getTitle($v->id);

        if($this->config["use_link"]) $this->html .= '</a>';

        if(!$this->config["parent_only"] && $child) $this->generate($child);
        
        if($child) 
          $this->html .= $this->config["child_tag_end_has_sub".$child_class];
        else 
          $this->html .= $this->config["child_tag_end".$child_class];
      }
    }
  }

  public function generateMenuMedia($parent){
    if($parent){
      $this->html .= $this->config["head_tag_start".$this->config["class"]];

      $this->buildMenuMedia($parent);

      $this->html .= $this->config["head_tag_end".$this->config["class"]];
    }
  }

  public function buildMenuMedia($parent)
  {
    $cat = \Ma\Model\Media\Category::find('all', array(
          'conditions' => array('parent = ?', $parent)
        ));

    if($cat){

      foreach ($cat as $k => $v) {

        $conditions['parent'] = $v->id;
        if($this->config["active_only"]) $conditions['status'] = 1;

        $child = \Ma\Model\Media\Category::find('all', array( 
                          'conditions' => $conditions,
                          'order' => 'id desc'
                          ));

        if($child) 
          $this->html .= $this->config["child_tag_start_has_sub"];
        else 
          $this->html .= $this->config["child_tag_start"];

        if($this->config["use_link"]) $this->html .= '<a href="'.BASE.$this->MediaCat->getCategorySlug($v->id).'">';

        $this->html .= $v->title;

        if($this->config["use_link"]) $this->html .= '</a>';

        if(!$this->config["parent_only"] && $child) $this->generate($child);
        
        if($child) 
          $this->html .= $this->config["child_tag_end_has_sub"];
        else 
          $this->html .= $this->config["child_tag_end"];
      }
    }
  }

  public function getSlug($data)
  {
    if($data->link_to == "direct"){
      return $data->link_value;
    }elseif ($data->link_to == "page") {
      return $data->pages->slug;
    }elseif ($data->link_to == "category") {
      return $this->Posts->Category->getCategorySlug($data->category_id);
    }elseif ($data->link_to == "media") {
      return $this->MediaCat->getCategorySlug($data->media_id);
    }
    
  }

  public function getLink($data)
  {
    if($data->link_to == "direct"){
      return BASE.$data->link_value;
    }elseif ($data->link_to == "page") {
      return BASE.$data->pages->slug;
    }elseif ($data->link_to == "category") {
      return BASE.$this->Posts->Category->getCategorySlug($data->category_id);
    }elseif ($data->link_to == "media") {
      return BASE.$this->MediaCat->getCategorySlug($data->media_id);
    }
    
  }

  public function getSlugById($id)
  {
    $res = $this->model->find($id);
    return $res->direct_url;
  }

  public function retrieve($id = false){
    if($id){
      $data = $this->model->find($id);
    }else{
      $data = $this->model->find('all');
    }
    
    return $data;
  }

  public function save(){
    if(\Io::param('title_id')){

      $link_to = \Io::param('link_to');

      // $this->model->title = \Io::param('title');
      $this->model->slug = \helper::slugify(\Io::param('title_id'));
      $this->model->parent = \Io::param('parent');
      $this->model->sort = \Io::param('sort');
      $this->model->link_to = $link_to;

      if($link_to == "direct")
        $this->model->link_value = \Io::param('link_value');
      elseif ($link_to == "page")
        $this->model->pages_id = \Io::param('static_pages');
      elseif ($link_to == "category"){
        $this->model->category_id = \Io::param('category');
        $this->model->child_option = \Io::param('child_option');
      } elseif ($link_to == "media"){
        $this->model->media_id = \Io::param('media_category');
      }

      $this->model->status = \Io::param('status');
      
      if($this->model->save()){

        $menu_id = $this->model->id;

        foreach ($this->Language->retrieve() as $key => $value) {
          $this->Detail->create($menu_id, $value->id, \Io::param('title_' . $value->kode));
        }

        return true;
      } else {
        return false;
      }
    }
  }

  public function update(){
    if(\Io::param('title_id')){
      $data = $this->model->find(\Io::param('id'));

      $link_to = \Io::param('link_to');

      foreach ($this->Language->retrieve() as $key => $value) {
        $this->Detail->update(\Io::param('id'), $value->id, \Io::param('title_' . $value->kode));
      }

      // $data->title = \Io::param('title');
      $data->slug = \helper::slugify(\Io::param('title_id'));
      $data->parent = \Io::param('parent');
      $data->sort = \Io::param('sort');
      $data->link_to = $link_to;

      if($link_to == "direct")
        $data->link_value = \Io::param('link_value');
      elseif ($link_to == "page")
        $data->pages_id = \Io::param('static_pages');
      elseif ($link_to == "category"){
        $data->category_id = \Io::param('category');
        $data->child_option = \Io::param('child_option');
      } elseif ($link_to == "media"){
        $data->media_id = \Io::param('media_category');
      }

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

        $this->deleteChild($id);

        $this->Detail->delete($id);

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