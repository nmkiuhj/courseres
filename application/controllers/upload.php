<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('user_info')){
			redirect(base_url(''));
		}
	}
	
	public function index()
	{
		die;
	}
	
	public function browse()
	{
		$user_info = $this->session->userdata('user_info');
		$user_id = $user_info['id'];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$this->load->model('resource_model');
		$start = ($page - 1) * $limit;
		$results = $this->resource_model->show_upload($user_id,$start,$limit);
		echo json_encode($results);
	}
}

