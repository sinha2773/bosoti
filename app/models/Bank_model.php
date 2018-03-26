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

	public function search_bank_acc_info($text)
	{
		$this->db->select('bank_acc_id, CONCAT(bank_name," -- ",acc_number) as bank_account', FALSE);
		$this->db->from('tbl_bank_account');
		$this->db->like('acc_number', $text, 'both');
		$this->db->or_like('bank_name', $text, 'both');
		$this->db->where('status', 1);
		return $this->db->get()->result();
	}

	public function save_transfer_info($transfer_data)
	{
		$this->db->insert('tbl_transaction_history', $transfer_data);
		return $this->db->affected_rows();
	}

	public function get_current_amount($bank_acc_id)
	{
		$this->db->select('balance');
		$this->db->from('tbl_bank_account');
		$this->db->where('bank_acc_id', $bank_acc_id);
		return $this->db->get()->row_array();
	}

	public function get_current_cashbook_amt()
	{
		$this->db->select('cashbook_amount');
		$this->db->from('tbl_final_amount');
		return $this->db->get()->row_array();
	}

	public function update_cashbook_amount($updated_cashbook)
	{
		$this->db->update('tbl_final_amount', $updated_cashbook);
		return $this->db->affected_rows();
	}

	public function update_acc_balance_info($bank_acc_id,$updated_balance)
	{
		$this->db->where('bank_acc_id', $bank_acc_id)->update('tbl_bank_account', $updated_balance);
		return $this->db->affected_rows();
	}

	function get_all_bank_acc_info()
	{
		$this->db->select('*', FALSE);
		$this->db->from('tbl_bank_account');
		$this->db->where('status', 1);
		return $this->db->get()->result();
	}

}

/* End of file Bank_model.php */
/* Location: ./application/models/Bank_model.php */