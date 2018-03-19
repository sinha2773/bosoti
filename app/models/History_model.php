<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends MY_Model{

	public function __construct()
	{
		parent::__construct();
	}

	function addHistory($data){
		$this->db->insert($this->client_history_table, $data);
        return $this->db->insert_id();
	}

	function getHistories(){
		$this->db->order_by('history_id', 'DESC');
		return $this->db->get($this->client_history_table)->result();
	}

	function getHistory($id){
		$this->db->where('history_id', $id);
		return $this->db->get($this->client_history_table)->result();
	}

	function getHistoryByClient($id){
		$this->db->where('client_id', $id);
		$this->db->order_by('history_id', 'DESC');
		return $this->db->get($this->client_history_table)->result();
	}

	function getHistoryLog($from_date='', $to_date='', $collector=''){

		$this->db->select('*, (select name from tbl_users u where u.id=tbl_client_histories.added_by) as added_by, tbl_clients.full_name, tbl_clients.client_id');
		$this->db->join($this->client_table, 'tbl_clients.id=tbl_client_histories.client_id', 'LEFT');

		if ($from_date != ''){
            $this->db->where("DATE_FORMAT(tbl_client_histories.added_time,'%Y-%m-%d') >=", $from_date);
        }

        if ($to_date != ''){
            $this->db->where("DATE_FORMAT(tbl_client_histories.added_time,'%Y-%m-%d') <=", $to_date);
        }

        if ($collector != ''){
            $this->db->where("tbl_client_histories.added_by", $collector);
        }

		$this->db->order_by('tbl_client_histories.client_id', 'ASC');
		$this->db->order_by('added_time', 'DESC');
		return $this->db->get($this->client_history_table)->result();
	}

	
}?>