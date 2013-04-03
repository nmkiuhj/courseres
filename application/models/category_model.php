<?php

class Category_model extends CI_Model {
	
	const DBL_CATEGORY = 'categories';

	public function __construct()
	{
		parent::__construct();	
	}
	
	public function get_one($array,$start="",$num="")
	{
		if($start!=""){
			$this->db->limit($num,$start);
		}
		$query = $this->db->get_where(self::DBL_CATEGORY,$array);
		return $query->row_array();
	}

	public function get_all($array="",$start="",$num="",$keyword="")
	{
		if($keyword!=""){
			$this->db->select($keyword);
		}
		if($array!=""){
			$this->db->where($array);
		}
		if($num!=""){
			$this->db->limit($num,$start);
		}
		$this->db->order_by('id','asc');
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
		$target = $this->db->get_where(self::DBL_CATEGORY,array('id' => $id));
		if($target!=NULL){
			$result = $target->row_array();
			$this->db->like('id',$id,'after');
			$this->db->delete(self::DBL_CATEGORY);
			return $result;
		}else{
			return FALSE;
		}
	}

	public function update($array,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(self::DBL_CATEGORY,$array);
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}

	public function get_path($id)
    {	$paths = [];
    	$child = $this->get_one(array('id'=>$id));
		$length = strlen($id);
		for($i=1; $i < ($length/2); $i++){
			$parent_id = substr($id, 0, $i*2);
			$parent = $this->category_model->get_one(array('id' => $parent_id));
			$paths[] = $parent['name'];
		}
		$paths[] = $child['name'];
		return $paths;
	}
}