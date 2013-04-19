<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
    }

    public function index()
    {
        $this->update();
    }

    public function update()
    {
        $data['actives']['admin_update'] = ' class="active"';
        $admin = $this->session->userdata ('user');
        if ($admin) {
            $data['admin'] = $admin;
        }
        $route = 'admin/admins/update';
        $this->_admin_load_view($data,$route);
    }
}