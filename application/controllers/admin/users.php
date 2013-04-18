<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
    }

    public function index()
    {
        $data['actives']['users_list'] = ' class="active"';
        $url = 'admin/users/list';
        $this->_admin_load_view($data,$url);
    }
}