<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expense extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}
        $this->load->model('Expense_model');
        //$this->load->driver("cache", array("adapter"=>"file"));
    }	

    // Expense Report
    public function expenseRepost($exp_type='all', $from_date='', $to_date=''){

        // if( !$this->master->isPermission('see_expense_report') )
        //     show_404();

        $this->load->model('expense_model', 'expense');
        $this->load->model('payment_model', 'payment');
        $data = $this->init("Expense Report");
        $data['search_url'] = base_url('admin/expense/expenseRepost');
        $data['selected_expense'] = $exp_type;

        // default date last generated date
        if ( empty($from_date) && empty($to_date) ){
            $lastGenerateDate = $this->master->rangeMonth(date('Y-m-d')); //$this->master->lastDateOfBillingMonth();
            $from_date = $lastGenerateDate['start'];
            $to_date = date('Y-m-d');//$lastGenerateDate['end'];
        }
        
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $expense_types = $this->master->get_all($this->expense_type_table, array('output'=>'result_array'));
        $data['expense_types'] = $this->master->buildTree($expense_types, 'parent_id', 'id');
        $data['expenses'] = $this->expense->get_expenses($exp_type, $from_date, $to_date);
        // $this->pr($data['expenses']);exit;
        $data["content"] = $this->load->view($this->theme."expense/report",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function save_payment_voucher()
    {

        $data = $this->input->post();
        $data['user_id']=$this->session->userdata("user_id");
        // unset($data['acc_number']);
        $this->db->trans_start();
        if($data['payment_method'] == "cash"){
            $current_cashbook_amt = $this->Expense_model->get_cashbook_amt();
            if($data['amount'] > $current_cashbook_amt['cashbook_amount']){
                $this->db->trans_complete();
                $this->db->trans_status() === FALSE;
                $this->session->set_flashdata('flashMessage', array('danger', "Insufficient Amount In Cashbook."));    
                redirect('/admin/common/add/expense');   
            }
            else{
                $updated_data= array(
                    'cashbook_amount' =>$current_cashbook_amt['cashbook_amount']-$data['amount']  ,
                );
                $this->Expense_model->save_payment_voucher_info($data);
                $this->Expense_model->update_cashbook_balance($updated_data);
            }
        }
        else{
            $bank_acc_id= $data['bank_acc_id'];
            $curr_acc_amt=  $this->Expense_model->get_bank_acc_amt($bank_acc_id);
            if($data['amount'] > $curr_acc_amt['balance']){
                $this->db->trans_complete();
                $this->db->trans_status() === FALSE;
                $this->session->set_flashdata('flashMessage', array('danger', "Insufficient Amount In Bank Account."));    
                redirect('/admin/common/add/expense');   

            }
            $updated_data= array(
                'balance' =>$curr_acc_amt['balance']-$data['amount']  ,
            );
            $this->Expense_model->save_payment_voucher_info($data);
            $this->Expense_model->update_bank_acc_balance($bank_acc_id,$updated_data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Payment Voucher Added Failed."));                   
        }
        else
        {
            $this->session->set_flashdata('flashMessage', array('success', "Payment Voucher Added Successfully."));                   
        }
        redirect('/admin/common/add/expense');   

    }

    public function update_payment_voucher()
    {
     $data= $this->input->post();
     $voucher_id  =$data['id'];
     $get_previous_amt = $this->Expense_model->get_invoice_info($voucher_id);
     $diff_amt  = $get_previous_amt['amount'] - $data['amount'];
     $data['user_id']=$this->session->userdata("user_id");
        // unset($data['acc_number']);
     $this->db->trans_start();
     if($data['payment_method'] == "cash"){
        $current_cashbook_amt = $this->Expense_model->get_cashbook_amt();
        if($diff_amt > $current_cashbook_amt['cashbook_amount']){
            $this->db->trans_complete();
            $this->db->trans_status() === FALSE;
            $this->session->set_flashdata('flashMessage', array('danger', "Insufficient Amount In Cashbook."));    
            redirect('/admin/common/add/expense');   
        }
        else{
            $updated_data= array(
                'cashbook_amount' =>$current_cashbook_amt['cashbook_amount']+$diff_amt,
            );
            $this->Expense_model->update_receipts_voucher_info($voucher_id,$data);
            $this->Expense_model->update_cashbook_balance($updated_data);
        }
    }
    else{
        if($get_previous_amt['bank_acc_id'] == $data['bank_acc_id']){
            $bank_acc_id= $data['bank_acc_id'];
            $curr_acc_amt=  $this->Expense_model->get_bank_acc_amt($bank_acc_id);
            if($diff_amt > $curr_acc_amt['balance']){
                $this->db->trans_complete();
                $this->db->trans_status() === FALSE;
                $this->session->set_flashdata('flashMessage', array('danger', "Insufficient Amount In Bank Account."));    
                redirect('/admin/common/add/expense');   

            }
            else{
                $updated_data= array(
                    'balance' =>$curr_acc_amt['balance']+$diff_amt,
                );
                $this->Expense_model->update_receipts_voucher_info($voucher_id,$data);
                $this->Expense_model->update_bank_acc_balance($bank_acc_id,$updated_data);
            }
        }
        else{
            $bank_acc_id= $data['bank_acc_id'];
            $curr_acc_amt=  $this->Expense_model->get_bank_acc_amt($bank_acc_id);
            if($data['amount'] > $curr_acc_amt['balance']){
                $this->db->trans_complete();
                $this->db->trans_status() === FALSE;
                $this->session->set_flashdata('flashMessage', array('danger', "Insufficient Amount In Bank Account."));    
                redirect('/admin/common/add/expense');  
            }
            else{
                $updated_data= array(
                    'balance' =>$curr_acc_amt['balance']-$data['amount'],
                );
                $this->Expense_model->update_receipts_voucher_info($voucher_id,$data);
                $this->Expense_model->update_bank_acc_balance($bank_acc_id,$updated_data);
            }
            $previous_acc= $get_previous_amt['bank_acc_id'];
            $prev_acc_amt=  $this->Expense_model->get_bank_acc_amt($previous_acc);

            $previou_acc_data = array(
                'balance' =>$prev_acc_amt['balance']+$get_previous_amt['amount'],
            );
            $this->Expense_model->update_prev_bank_acc_balance($previous_acc,$previou_acc_data);
        }

    }
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
        $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Payable Voucher Update Failed."));                   
    }
    else
    {
        $this->session->set_flashdata('flashMessage', array('success', "Payable Voucher Updated Successfully."));                   
    }
    redirect('/admin/common/add/expense');  
}

public function delete_expense($id)
{
    $exp_info = $this->Expense_model->get_income_details($id);
    $this->db->trans_start();

    if($exp_info['payment_method']== "cash"){
        $current_cashbook_amt = $this->Expense_model->get_cashbook_amt();
        $updated_data= array(
            'cashbook_amount' =>$current_cashbook_amt['cashbook_amount']+ $exp_info['amount'],
        );
        $this->Expense_model->update_cashbook_balance($updated_data);
    }
    else{
       $bank_acc_id= $exp_info['bank_acc_id'];
       $curr_acc_amt=  $this->Expense_model->get_bank_acc_amt($bank_acc_id);
       $updated_data= array(
        'balance' =>$curr_acc_amt['balance']+ $exp_info['amount'],
    );
       $this->Expense_model->update_bank_acc_balance($bank_acc_id,$updated_data);
   }
   $this->Expense_model->delete_expense_voucher($id);

   $this->db->trans_complete();
   if ($this->db->trans_status() === FALSE)
   {
    $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Payable Voucher Deleted Failed."));                   
}
else
{
    $this->session->set_flashdata('flashMessage', array('success', "Payable Voucher Deleted Successfully."));                   
}
redirect('/admin/common/get_all/expense');  
}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */