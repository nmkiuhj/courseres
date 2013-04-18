<?php

class Download_model extends CI_Model {
	
	const TBL_DOWNLOAD = 'downloads';
	/**
	 * 构造函数
	 */
	public function __construct()
	{
		parent::__construct();	
	}
	/**
	 * 获得单个下载记录
	 * @param  array $array WHERE条件
	 * @return array
	 */
	public function get_one($array)
	{
		$query = $this->db->get_where(self::TBL_DOWNLOAD,$array);
		return $query->row_array();
	}
	/**
	 * 获得所有下载记录
	 * @param  array $array   WHERE条件
	 * @param  int   $start
	 * @param  int   $num
	 * @param  array $keyword SELECT关键字
	 * @return array
	 */
	public function get_all($array="",$start="",$num="",$keyword="")
	{
		if($array!=""){
			$this->db->where($array);
		}
		if($num!=""){
			$this->db->limit($num,$start);
		}
		$this->db->order_by('create_time','desc');
		$query = $this->db->get(self::TBL_DOWNLOAD);

		return $query->result_array();
	}
	/**
	 * 添加信息
	 * @param  array   $array 添加内容
	 * @return boolean        是否成功
	 */
	public function add($array)
	{ 
		$this->db->insert(self::TBL_DOWNLOAD,$array);
		return ($this->db->affected_rows()==1) ? $this->db->insert_id() : FALSE;
	}
	/**
	 * 删除信息
	 * @param  int $id
	 * @return boolean
	 */
	public function del($id)
	{
		$this->db->delete(self::TBL_DOWNLOAD,array('id' => intval($id)));
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
		$this->db->update(self::TBL_DOWNLOAD,$array);
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}
}