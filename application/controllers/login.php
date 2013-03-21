<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function search()
	{
		$data = $_POST;
		$result = $this->user_model->get_users($data);
		if ($result == '1') {
			echo 1;
		}elseif ($result =='2') {
			echo 2;
		}else {
			$this->session->set_userdata('user_info',$result);
			$user_info = $this->session->userdata('user_info');
			echo $user_info['name'];
		}
	}
	
	public function register()
	{
		$data = $_POST;
		$data['create_date'] = time();
		$user = $this->user_model->register($data);
		$this->session->set_userdata('user_info',$user);
		$user_info = $this->session->userdata('user_info');
		echo $user_info['name'];
	}

	public function is_exist()
	{
		$data = $_POST;
		$result = $this->user_model->is_exist($data['email']);
		if ($result == '0') {
			echo 0;
		} else {
			echo 1;
		}
	}
	
	public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(''));
    }
}











/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
