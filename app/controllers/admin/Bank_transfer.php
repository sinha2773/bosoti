<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_transfer extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}
		$this->load->model('Bank_model');
	}

	public function index()
	{
		$data['bank_accounts'] = $this->Bank_model->get_all_bank_accounts();
		$data = $this->init("Transfer To Bank Account");
		$data["content"] = $this->load->view($this->theme."bank_transfer/bank_transfer_form",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);
	}

}

/* End of file Bank_transfer.php */
/* Location: ./application/controllers/Bank_transfer.php */