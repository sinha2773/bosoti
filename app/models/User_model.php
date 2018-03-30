<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model{

	public function __construct()
	{
		parent::__construct();
	}

	function getUsers(){
		return $this->db->get($this->user_table)->result();
	}

	// return array
	function getUser($id){
		$this->db->where('id', $id);
		return $this->db->get($this->user_table)->result();
	}

	// return obj
	function get_user($id){
		$this->db->where('id', $id);
		return $this->db->get($this->user_table)->row();
	}

	function getOperators(){
		return $this->db->get($this->user_table)->result();
	}


	
}?>