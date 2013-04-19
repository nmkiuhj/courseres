<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resources extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		$this->load->model('resource_model');
		$this->load->model('category_model');
		$this->load->model('user_model');
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
			$paths = $this->category_model->get_path($category_id);
			$resource_arr[$i]['category_path'] = implode(' > ',$paths);
		}
		$this->response($resource_arr,$count);
	}

	public function get_detail($id)
	{
		$resource = $this->resource_model->get_one(array('id' => $id));
		$uploader = $this->user_model->get_one(array('id' => $resource['uploader_id']));
		$resource['uploader_name'] = $uploader['name'];
		$resource['upload_date'] = date('Y-m-d H:i:s',$resource['upload_date']);
		$paths = $this->category_model->get_path($resource['category_id']);
		$resource['category_path'] = implode(' > ',$paths);
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

    public function update()
    {
    	$data = $_POST;
    	unset($data['category_path']);
    	if ($data['id']) {
            $this->resource_model->update($data,$data['id']);
        } else {
            $this->resource_model->add($data);
        }
        return;
    }
}