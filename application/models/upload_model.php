<?php

class Upload_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function show_upload($user_id)
	{
		
	}

	public function add($data)
	{
		$query = $this->db->insert('uploads', $data);
	}
}
