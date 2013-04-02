<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resources extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		$this->load->model('resource_model');
		$this->load->model('category_model');
	}

	public function get_list()
	{
		$page = $this->input->get('page');
		$limit = $this->input->get('limit');
		$start = ($page -1)*$limit;

		$count = count($this->resource_model->get_all());
		$resource_arr = $this->resource_model->get_all("",$start,$limit);
		for($i=0;$i<$count;$i++){
			$category_id = $resource_arr[$i]['category_id'];
			$category_arr = $this->category_model->get_one(array('id'=>$category_id));
			$resource_arr[$i]['category_path'] = $this->get_category_path($category_arr);
		}
		$this->response($resource_arr,$count);
	}

	public function get_detail($id)
	{
		$resource = $this->resource_model->get_one(array('id'=>$id));
		$category_arr = $this->category_model->get_one(array('id'=>$resource['category_id']));
		$resource['category_path'] = $this->get_category_path($category_arr);
		$this->response($resource);
	}

	public function del($id)
	{
        $result = $this->resource_model->del($id);
        if($result){
            echo json_encode(array('success' => array('message'=> '删除成功！')));
        }else{
            echo json_encode(array('error'=> array('message' => '删除失败！')));
        }
        return;
    }

    public function get_category_path($data)
    {

		$child_name = $data['name'];
		$parents = explode('/',$data['category_field']);
    	array_shift($parents);
    	array_pop($parents);
		$data['category_path'] = '';
		foreach($parents as $id){
			$parent = $this->category_model->get_one(array('id'=>$id));
			$data['category_path'] .= $parent['name'].' > ';
		}
		$data['category_path'] .= $child_name;
		return $data['category_path'];
	}
}