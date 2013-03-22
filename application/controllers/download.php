<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		die;
	}
	
	public function browse()
	{
		$user = $this->session->userdata('user_info');
		$user_id = $user['id'];
		$page = $_GET['page'];
		$limit = $_GET['limit'];
		$this->load->model('download_model');
		$start = ($page - 1) * $limit;
		$results = $this->download_model->show_download($user_id,$start,$limit);
		echo json_encode($results);
	}

	public function do_download()
	{
		
	}
}