<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_acc_create extends MY_Controller {

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

		$data = $this->init("Bank Account Create");
		$data["content"] = $this->load->view($this->theme."bank_acc_create/bank_acc_form",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);

	}

	public function create_bank_account()
	{
		if (trim($this->input->post('bank_name'))== "") {
			echo json_encode("no_bank_name");
			exit();
		}
		if (trim($this->input->post('branch_name'))== "") {
			echo json_encode("no_branch_name");
			exit();
		}
		if (trim($this->input->post('acc_name'))== "") {
			echo json_encode("no_acc_name");
			exit();
		}

		if (trim($this->input->post('acc_number'))== "") {
			echo json_encode("no_acc_number");
			exit();
		}

		$bank_data= array(
			'bank_name' => trim($this->input->post('bank_name')),
			'branch_name' => trim($this->input->post('branch_name')),
			'acc_name'=> trim($this->input->post('acc_name')),
			'acc_number'=> trim($this->input->post('acc_number')),
			);
		$is_save = $this->Bank_model->save_bank_acc_info($bank_data);
		if($is_save > 0){
			echo json_encode("success");
		}
		else{
			echo json_encode("db_failed");	
		}
	}

}

/* End of file Bank_acc_create.php */
/* Location: ./application/controllers/Bank_acc_create.php */