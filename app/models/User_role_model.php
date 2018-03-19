<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_role_model extends MY_Model{

	public function __construct()
	{
		parent::__construct();
	}

	function get_all(){
		return $this->db->get($this->user_role_table)->result();
	}
	function get_by_id($id){
		$this->db->where('user_role_id', $id);
		return $this->db->get($this->user_role_table)->row();
	}
}
?>