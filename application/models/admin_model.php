<?php

class Admin_model extends CI_Model {

	const TBL_ADMIN = 'admins';
	/**
 	* 构造函数
 	*/
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * 获得一条管理员信息
	 * @param  array $array WHERE条件
	 * @return array
	 */
	public function get_one($array)
	{
		$query = $this->db->get_where(self::TBL_ADMIN,$array);
		return $query->row_array();
	}
	/**
	 * 更新管理员数据
	 * @param  array   $array 更新内容
	 * @param  int     $id    管理员ID号
	 * @return boolean        是否成功
	 */
	public function update($array,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(self::TBL_ADMIN,$array);
		return ($this->db->affected_rows()==1) ? TRUE : FALSE;
	}
}