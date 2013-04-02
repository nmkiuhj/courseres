<?php

class Admin_model extends CI_Model {

	const DBL_ADMIN = 'admins';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_one($array)
	{
		$query = $this->db->get_where(self::DBL_ADMIN,$array);
		return $query->row_array();
	}

	public function update($array,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(self::DBL_ADMIN,$array);
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}
}