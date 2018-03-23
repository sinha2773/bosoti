<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipts_voucher extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}
		$this->load->model('Income_model');
	}

	public function index()
	{
		
	}



}

/* End of file Receipts_voucher.php */
/* Location: ./application/controllers/Receipts_voucher.php */