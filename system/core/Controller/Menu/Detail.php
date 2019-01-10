<?php
namespace Ma\Controller\Menu;

use Ma\Model\Menu as Model;

class Detail
{
    function __construct(Model\Detail $model)
    {
        $this->model = $model;
    }

    public function getTitle($menu_id, $language_id = LANG){

        $conditions['menu_id']     = $menu_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->title;
    }


    public function create($menu_id, $language_id, $title){
        if($menu_id){

            $detailModel = new Model\Detail();

            $detailModel->menu_id     = $menu_id;
            $detailModel->language_id = $language_id;
            $detailModel->title       = $title;
            
            if($detailModel->save()){
                unset($detailModel);
                return true;
            }else{
                return false;
            }
        }
    }


    public function update($menu_id, $language_id, $title){
        $conditions['menu_id']     = $menu_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array(
                                            'conditions' => array($conditions)
                                            ));

        if(!$data){
            $this->create($menu_id, $language_id, $title);
        }else{

            $data->title = $title;

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

                return true;
            }
        }
    }
}