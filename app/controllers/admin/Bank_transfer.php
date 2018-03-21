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
		$data = $this->init("Transfer To Bank Account");
		$data["content"] = $this->load->view($this->theme."bank_transfer/bank_transfer_form",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);
	}

	public function search_bank_acc_by_name()
	{
		$text = $this->input->post('q');
		if($text == null || $text=="") {
			echo "input field empty";
		}
		else{
			echo json_encode($this->Bank_model->search_bank_acc_info($text));
		}
	}

	public function save_bank_transaction_info()
	{
		$check_cashbook_amount = $this->Bank_model->get_current_cashbook_amt();

		if (trim($this->input->post('bank_acc_id'))== "") {
			echo json_encode("no_bank_acc_id");
			exit();
		}
		if (trim($this->input->post('amount'))== "") {
			echo json_encode("no_amount");
			exit();
		}
		if (trim($this->input->post('payment_date'))== "") {
			echo json_encode("no_payment_date");
			exit();
		}

		if(trim($this->input->post('amount')) > $check_cashbook_amount['cashbook_amount']){
			echo json_encode("insufficient_amount_in_cashbook");
			exit();
		}

		$transfer_data= array(
			'bank_acc_id' => trim($this->input->post('bank_acc_id')),
			'amount' => trim($this->input->post('amount')),
			'payment_date'=> trim($this->input->post('payment_date')),
			'note'=> trim($this->input->post('summary')),
			'added_by' => $this->session->userdata("user_id"),
			'transection_type' =>'Transferred',
			'transaction_through' =>'Bankbook'
		);

		$bank_acc_id= trim($this->input->post('bank_acc_id'));
		$currnet_acc_balance = $this->Bank_model->get_current_amount($bank_acc_id);
		$this->db->trans_start();
		$updated_balance = array(
			'balance' => $currnet_acc_balance['balance'] + $transfer_data['amount'],
		);
		$updated_cashbook =array(
			'cashbook_amount' => $check_cashbook_amount['cashbook_amount'] - $transfer_data['amount'],
		);
		$cashbook_update = $this->Bank_model->update_cashbook_amount($updated_cashbook);
		if($cashbook_update > 0)
		{
			$is_update = $this->Bank_model->update_acc_balance_info($bank_acc_id,$updated_balance);

			if( $is_update >0 ){
				$is_save = $this->Bank_model->save_transfer_info($transfer_data);
				if($is_save == 0){
					echo json_encode("db_insert_failed");	
				}
			}
			else{
				echo json_encode("db_update_failed");	
			}
		}
		else{
			echo json_encode("cashbook_update_failed");	
		}
		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			echo json_encode("error transection");
		}
		else
		{
			$this->db->trans_commit();
			echo json_encode("success");
		}
	}

}

/* End of file Bank_transfer.php */
/* Location: ./application/controllers/Bank_transfer.php */