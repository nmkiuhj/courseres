<?php

class Resource_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function save($data)
	{
		$this->db->insert('resources',$data);
	}
	
	public function show_upload($user_id,$start,$limit)
	{
		$query1 = $this->db->get_where('resources',array('uploader_id'=>$user_id));
		$arr['total'] = $query1->num_rows();
		if ($arr['total'] == 0){
			return 0;
		}
		$this->db->order_by('upload_date','desc');
		$this->db->limit($limit,$start);
		$query2 = $this->db->get_where('resources',array('uploader_id'=>$user_id));
		foreach($query2->result_array() as $row){
			$arr['list'][] = $row;
		}
		$arr['limit'] = $limit;	
		return $arr;
	}
}