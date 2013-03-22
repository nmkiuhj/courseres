<?php

class Resource_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function save($data)
	{
		$this->db->insert('resources', $data);
	}
	
	public function show_upload($user_id, $start, $limit)
	{
		$query1 = $this->db->get_where('resources', array('uploader_id'=>$user_id));
		$arr['total'] = $query1->num_rows();
		if ($arr['total'] == 0){
			return 0;
		}
		$this->db->order_by('upload_date', 'desc');
		$this->db->limit($limit, $start);
		$query2 = $this->db->get_where('resources', array('uploader_id'=>$user_id));
		foreach($query2->result_array() as $row){
			$arr['list'][] = $row;
		}
		$arr['limit'] = $limit;	
		return $arr;
	}

	public function show_brief($option)
	{
		$this->db->select("*");
		$this->db->from('resources');
		$this->db->order_by($option, 'desc');
		$this->db->limit(5,0);
		$query = $this->db->get();
		if ($query->num_rows() == 0){
			return 0;
		}else{
			foreach($query->result_array() as $row){
				if($option == 'upload_date'){
					$row['upload_date'] = date('Y-m-d', $row['upload_date']);
				}
				$arr['list'][] = $row;
			}
			return $arr;
		}
	}

	public function show_detail($id)
	{
		$query = $this->db->get_where('resources', array('id'=>$id));
		$arr = $query->row_array();
		return $arr;
	}

	public function add($data)
	{
		$query = $this->db->insert('resources', $data);
		return $query->insert_id();
	}
}