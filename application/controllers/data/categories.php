<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		$this->load->model('category_model');
	}

	public function get_list()
	{
		$id = $this->input->get('id');
		$count = ($results = $this->category_model->get_all(array('parent_id'=> $id)));
		$this->response($results,$count);
	}

	public function get_category_bread()
	{
		$id = $this->input->get('id');
		$str_count = strlen($id);
		for($i=1;$i<=($str_count/2);$i++){
			$parent_id = substr($id,0,$i*2);
			$parents[] = $this->category_model->get_one(array('id'=>$parent_id));
		}
		$count = count($parents);
		$this->response($parents,$count);
	}

	public function del($id)
	{
        $result = $this->category_model->del($id);
        if($result){
            echo json_encode(array('success' => array('message'=> '删除成功！','parent_id'=> $result['parent_id'])));
        }else{
            echo json_encode(array('error'=> array('message' => '删除失败！')));
        }
        return;
	}
}