<?php

class Category_model extends CI_Model {
	
	const DBL_CATEGORY = 'categories';

	public function __construct()
	{
		parent::__construct();	
	}
	
	public function get_one($array)
	{
		$query = $this->db->get_where(self::DBL_CATEGORY,$array);
		return $query->row_array();
	}

	public function get_all($array="",$start="",$num="",$keyword="")
	{
		if($array!=""){
			$this->db->where($array);
		}
		if($num!=""){
			$this->db->limit($num,$start);
		}
		$this->db->order_by('create_time','desc');
		$query = $this->db->get(self::DBL_CATEGORY);

		return $query->result_array();
	}

	public function add($array)
	{ 
		$this->db->insert(self::DBL_CATEGORY,$array);
		return ($this->db->affected_rows()==1) ? $this->db->insert_id() : FALSE;
	}

	public function del($id)
	{
		$this->db->delete(self::DBL_CATEGORY,array('id' => intval($id)));
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}

	public function update($array,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(self::DBL_CATEGORY,$array);
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}
}