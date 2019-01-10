<?php
namespace Event;

use Event\Model as Model;

class Detail
{
    function __construct()
    {
        $this->model = new Model\Detail();
    }

    public function getTitle($event_id, $language_id = LANG){

        $conditions['event_id']     = $event_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->title;
    }

    public function getContent($event_id, $language_id = LANG){

        $conditions['event_id']     = $event_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->content;
    }

    public function getExcerpt($event_id, $language_id = LANG){

        $conditions['event_id']     = $event_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array( 
                                        'conditions' => $conditions
                                        ));
        return $data->excerpt;
    }


    public function create($event_id, $language_id, $data){
        if($event_id){

            $detailModel = new Model\Detail();

            $detailModel->event_id     = $event_id;
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


    public function update($event_id, $language_id, $detail){
        $conditions['event_id']     = $event_id;
        $conditions['language_id'] = $language_id;

        $data = $this->model->first(array(
                                            'conditions' => array($conditions)
                                            ));

        if(!$data){
            $this->create($event_id, $language_id, $detail);
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


    public function delete($event_id = false){
        if($event_id){
            if(is_array($id)){
                $this->model->table()->delete(array('event_id' => $id));

                return true;
            }else{

                $conditions['event_id']     = $event_id;

                $this->model->delete_all(array(
                                                'conditions' => array($conditions)
                                                ));
            }
        }
    }
}