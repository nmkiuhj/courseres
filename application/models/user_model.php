<?php

class User_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('encrypt');
	}
	
	public function get_users($data)
	{
		$query = $this->db->get('users');
		foreach( $query->result_array() as $user ){
			if( $data['name'] === $user['name'] ){
				if( $data['password'] === $this->encrypt->decode($user['password'])) {
					return $user;
				} else {
					return 1;
				}
			}
		}
		return 2;
	}
	
	public function is_exist($data)
	{
		$this->db->select('email');
		$query = $this->db->get('users');
		foreach( $query->result_array() as $user ){
			if( $data !== $user['email']){
				continue;
			} else {
				return 1;
			}
		}
		return 0;
	}
	
	public function register($data)
	{
		$data['password'] = $this->encrypt->encode($data['password']);
		$this->db->insert('users',$data);
		$data['id'] = $this->db->insert_id();
		return $data;
	}
}