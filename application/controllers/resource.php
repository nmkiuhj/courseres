<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		die;
	}

	public function brief()
	{
		$option = $_GET['option'];
		$this->load->model('resource_model');
		$data =  $this->resource_model->show_brief($option);
		echo json_encode($data);
	}

	public function detail($id)
	{
		$this->load->model('resource_model');
		$data['list'] = $this->resource_model->show_detail($id);
		echo json_encode($data);
	}
}
