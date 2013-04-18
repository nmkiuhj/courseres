<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function get_list()
    {
        $page = $this->input->get('page');
        $limit = $this->input->get('limit');
        $start = ($page -1)*$limit;

        $count = count($this->user_model->get_all());
        $user_arr = $this->user_model->get_all("",$start,$limit);
        $this->response($user_arr,$count);
    }

    public function get_detail($id)
    {
        $user = $this->user_model->get_one(array('id'=>$id));
        $this->response($user);
    }

    public function del($id)
    {
        $result = $this->user_model->del($id);
        if($result){
            echo json_encode(array('success' => array('message'=> '删除成功！')));
        }else{
            echo json_encode(array('error'=> array('message' => '删除失败！')));
        }
        return;
    }
}