<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
    }

    public function update()
    {
        $data['actives']['users_update'] = ' class="active"';
        $user = $this->session->userdata ( 'user' );
        if ($user) {
            $data['user'] = $user;
        }
        $route = 'admin/users/update';
        $this->_admin_load_view($data,$route);
    }
}