<?php

class Download_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function show_download($user_id,$start,$limit)
	{
		$query1 = $this->db->get_where('downloads',array('downloader_id'=>$user_id));
		$arr['total'] = $query1->num_rows();
		if($arr['total'] == 0){
			return 0;
		}
		$this->db->select('*');
		$this->db->from('downloads');
		$this->db->where('downloader_id',$user_id);
		$this->db->join('resources','resources.id = downloads.resource_id');
		$this->db->limit($limit,$start);
		$this->db->order_by('download_date','desc');
		$query2 = $this->db->get();
		foreach($query2->result_array() as $row){
			$arr['list'][] = $row;
		}
		$arr['limit'] = $limit;
		return $arr;
	}
}