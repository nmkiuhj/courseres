<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->check_login();
	}

	public function index()
	{
		$data['actives']['categories_list'] = ' class="active"';
		$url = 'admin/categories/list';
		$this->_admin_load_view($data,$url);
	}
}