<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function update()
    {
   		$admin = $this->admin_model->get_one(array('name'=>$_POST['name']));

        if(sha1( $_POST['oldpassword'] . $admin['nonce'] ) == $admin['password']){
            $data['nonce'] = rand(10001,99999);
            $data['password'] = sha1($_POST['newpassword'].$data['nonce']);
            $data['create_time'] = time();
            $this->admin_model->update($data,$admin['id']);
            echo 1;
        }else {
            echo 0;
        }
    }
}