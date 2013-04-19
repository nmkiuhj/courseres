<?php

class Resource_model extends CI_Model {
	
	const TBL_RESOURCE = 'resources';
	/**
	 * 构造函数
	 */
	public function __construct()
	{
		parent::__construct();	
	}
	/**
	 * 获得单个资源信息
	 * @param  array $array WHERE条件
	 * @param  int   $start
	 * @param  int   $num
	 * @return array
	 */
	public function get_one($array="",$start="",$num="")
	{
		if($num!=""){
			$this->db->limit($num,$start);
		}
		$query = $this->db->get_where(self::TBL_RESOURCE,$array);
		return $query->row_array();
	}
	/**
	 * 获得所有资源信息
	 * @param  array $array   WHERE条件
	 * @param  int   $start
	 * @param  int   $num
	 * @param  array $keyword SELECT关键字
	 * @return array
	 */
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
		$this->db->order_by('upload_date','desc');
		$query = $this->db->get(self::TBL_RESOURCE);

		return $query->result_array();
	}
	/**
	 * 添加信息
	 * @param  array   $array 添加内容
	 * @return boolean        是否成功
	 */
	public function add($array)
	{ 
		$this->db->insert(self::TBL_RESOURCE,$array);
		return ($this->db->affected_rows()==1) ? $this->db->insert_id() : FALSE;
	}
	/**
	 * 删除信息
	 * @param  int $id
	 * @return boolean
	 */
	public function del($id)
	{
		$this->db->delete(self::TBL_RESOURCE,array('id' => intval($id)));
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}
	/**
	 * 更新信息
	 * @param  array   $array 更新内容
	 * @param  int     $id
	 * @return boolean
	 */
	public function update($array,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(self::TBL_RESOURCE,$array);
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}
}