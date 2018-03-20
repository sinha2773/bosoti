<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends MY_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function save_bank_acc_info($bank_data)
	{
		$this->db->insert('tbl_bank_account', $bank_data);
		return $this->db->affected_rows();
	}

	public function get_all_bank_accounts()
	{
		$this->db->select('bank_acc_id, CONCAT(bank_name,"->",acc_number) as bank_account', FALSE);
		$this->db->from('tbl_bank_account');
		$this->db->where('status', 1);
		return $this->db->get()->result();
	}

}

/* End of file Bank_model.php */
/* Location: ./application/models/Bank_model.php */