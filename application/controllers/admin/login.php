<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_login();
    }

    public function index()
    {
        $data = $_POST;
        $error = array();
        if ( ! empty($data['name'])) {
            $this->load->model('admins_model');
            $admin = $this->admins_model->get_one(array('name'=>$data['name']));
            if ( ! empty($admin) && sha1 ( $data['password'] . $admin['nonce'] ) == $admin['password'] ) {
                $user = $admin;
                $this->session->set_userdata ( 'user', $user );
                header('location:'.base_url('admin/articles'));
            }
            $error = array('message' => '用户名或密码错误');
        }
        $this->load->view('admin/signin', $error);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->load->view('admin/signin');
    }
}