<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('user_info')){
			redirect(base_url(''));
		}
	}

	public function index()
	{
		$this->information();
	}

	public function information()
	{
		$data['actives']['user_information'] = ' class="active"';
		$this->load->view('header',$data);
		$this->load->view('sidebar');
		$this->load->view('user/information');
		$this->load->view('footer');
	}

	public function upload()
	{
		$data['actives']['user_upload'] = ' class="active"';
		$this->load->view('header',$data);
		$this->load->view('sidebar');
		$this->load->view('user/upload');
		$this->load->view('footer');
	}

	public function download()
	{
		$data['actives']['user_download'] = ' class="active"';
		$this->load->view('header',$data);
		$this->load->view('sidebar');
		$this->load->view('user/download');
		$this->load->view('footer');
	}

	public function share()
	{
		$data['actives']['user_share'] = ' class="active"';
		$this->load->view('header',$data);
		$this->load->view('sidebar');
		$this->load->view('user/share');
		$this->load->view('footer');
	}
}
