<?php
namespace Ma\Controller\Posts;

use Ma\Model\Posts as Model;

class Detail
{
    function __construct(Model\Detail $model)
    {
        $this->model = $model;
    }

    public function getTitle($post_id, $language_id = LANG){

        $conditions['menu_id']     = $post_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->title;
    }

    public function getContent($menu_id, $language_id = LANG){

        $conditions['menu_id']     = $menu_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->content;
    }

    public function getExcerpt($menu_id, $language_id = LANG){

        $conditions['menu_id']     = $menu_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->excerpt;
    }


    public function create($menu_id, $language_id, $data){
        if($menu_id){

            $detailModel = new Model\Detail();

            $detailModel->menu_id     = $menu_id;
            $detailModel->language_id = $language_id;
            $detailModel->title       = $data['title'];
            $detailModel->content     = $data['content'];
            $detailModel->excerpt     = $data['excerpt'];
            
            if($detailModel->save()){
                unset($detailModel);
                return true;
            }else{
                return false;
            }
        }
    }


    public function update($menu_id, $language_id, $detail){
        $conditions['menu_id']     = $menu_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array(
                                            'conditions' => array($conditions)
                                            ));

        if(!$data){
            $this->create($menu_id, $language_id, $detail);
        }else{

            $data->title   = $detail['title'];
            $data->content = $detail['content'];
            $data->excerpt = $detail['excerpt'];

            if($data->save())
                return true;
            else
                return false;
        }

    }


    public function delete($menu_id = false){
        if($menu_id){
            if(is_array($id)){
                $this->model->table()->delete(array('menu_id' => $id));

                return true;
            }else{

                $conditions['menu_id']     = $menu_id;

                $this->model->delete_all(array(
                                                'conditions' => array($conditions)
                                                ));
            }
        }
    }
}