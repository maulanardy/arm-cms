<?php
namespace Ma\Controller\Posts;

use Ma\Model\Posts as Model;

class CategoryDetail
{
    function __construct(Model\CategoryDetail $model)
    {
        $this->model = $model;
    }

    public function getTitle($category_id, $language_id = LANG){

        $conditions['category_id']     = $category_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->title;
    }

    public function getDescription($category_id, $language_id = LANG){

        $conditions['category_id']     = $category_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->description;
    }


    public function create($category_id, $language_id, $data){
        if($category_id){

            $detailModel = new Model\CategoryDetail();

            $detailModel->category_id     = $category_id;
            $detailModel->language_id = $language_id;
            $detailModel->title       = $data['title'];
            $detailModel->description     = $data['description'];
            
            if($detailModel->save()){
                unset($detailModel);
                return true;
            }else{
                return false;
            }
        }
    }


    public function update($category_id, $language_id, $detail){
        $conditions['category_id']     = $category_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array(
                                            'conditions' => array($conditions)
                                            ));

        if(!$data){
            $this->create($category_id, $language_id, $detail);
        }else{

            $data->title   = $detail['title'];
            $data->description = $detail['description'];

            if($data->save())
                return true;
            else
                return false;
        }

    }


    public function delete($category_id = false){
        if($category_id){
            if(is_array($id)){
                $this->model->table()->delete(array('category_id' => $id));

                return true;
            }else{

                $conditions['category_id']     = $category_id;

                $this->model->delete_all(array(
                                                'conditions' => array($conditions)
                                                ));
            }
        }
    }
}