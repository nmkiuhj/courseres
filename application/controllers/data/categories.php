<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		$this->load->model('category_model');
	}

	public function get_category_recursion($data, $id)
	{
		$count = count($this->category_model->get_all(array('category_id'=>$id)));
		$data[$id] = $this->category_model->get_all(array('category_id'=>$id));
		for($i=0;$i<$count;$i++){
			$this->get_category_list($data[$id],$i);
		}
	}

	public function get_category_list()
	{
		$data=[];
		$this->get_category_recursion($data, 0);
	}
}