<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends MY_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function save_bank_acc_info($bank_data)
	{
		$this->db->insert_batch('tbl_bank_account', $bank_data);
		return $this->db->affected_rows();
	}

}

/* End of file Bank_model.php */
/* Location: ./application/models/Bank_model.php */