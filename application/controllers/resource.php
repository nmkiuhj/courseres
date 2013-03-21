<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource extends CI_Controller{
	
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
	
	public function upload()
	{
		$data['actives']['resource_upload'] = ' class="active"';
		$this->load->view('header',$data);
		$this->load->view('sidebar');
		$this->load->view('resource/upload');
		$this->load->view('footer');
	}
}
