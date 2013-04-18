<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
    public function index()
    {
        $data = $_POST;
        $error = array();
        if ( ! empty($data['name'])) {
            $this->load->model('admin_model');
            $admin = $this->admin_model->get_one(array('name'=>$data['name']));
            if ( $admin && sha1 ( $data['password'] . $admin['nonce'] ) == $admin['password'] ) {
                $user = $admin;
                $this->session->set_userdata ( 'user', $user );
                header('location:'.base_url('admin/resources'));
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



/* End of file login.php */
/* Location: ./application/controllers/login.php */