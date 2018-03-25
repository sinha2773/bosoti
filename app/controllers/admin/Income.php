<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Income extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        $this->load->model('Income_model');

        //$this->load->driver("cache", array("adapter"=>"file"));
    }	

    // Income Report
    public function incomeRepost($inc_type='all', $from_date='', $to_date=''){

        if( !$this->master->isPermission('see_income_report') )
            show_404();

        $this->load->model('income_model', 'income');
        $this->load->model('payment_model', 'payment');
        $data = $this->init("Income Report");
        $data['search_url'] = base_url('admin/income/incomeRepost');
        $data['selected_income'] = $inc_type;

        // default date last generated date
        if ( empty($from_date) && empty($to_date) ){
            $lastGenerateDate = $this->master->rangeMonth(date('Y-m-d')); //$this->master->lastDateOfBillingMonth();
            $from_date = $lastGenerateDate['start'];
            $to_date = date('Y-m-d');//$lastGenerateDate['end'];
        }

        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $income_types = $this->master->get_all($this->income_type_table, array('output'=>'result_array'));
        $data['income_types'] = $this->master->buildTree($income_types, 'parent_id', 'id');
        $data['incomes'] = $this->income->get_incomes($inc_type, $from_date, $to_date);
        // $this->pr($data['incomes']);exit;
        $data["content"] = $this->load->view($this->theme."income/report",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }


    function save_receipts_voucher()
    {

        $data = $this->input->post();
        $data['user_id']=$this->session->userdata("user_id");
        // unset($data['acc_number']);
        $this->db->trans_start();
        $this->Income_model->save_receipts_voucher_info($data);
        if($data['payment_method'] == "cash"){
            $current_cashbook_amt = $this->Income_model->get_cashbook_amt();
            $updated_data= array(
                'cashbook_amount' =>$current_cashbook_amt['cashbook_amount']+$data['amount']  ,
                );
            $this->Income_model->update_cashbook_balance($updated_data);
        }
        else{
            $bank_acc_id= $data['bank_acc_id'];
            $curr_acc_amt=  $this->Income_model->get_bank_acc_amt($bank_acc_id);
            $updated_data= array(
                'balance' =>$curr_acc_amt['balance']+$data['amount']  ,
                );

            $this->Income_model->update_bank_acc_balance($bank_acc_id,$updated_data);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Receipts Voucher Added Failed."));                   
        }
        else
        {
            $this->session->set_flashdata('flashMessage', array('success', "Receipts Voucher Added Successfully."));                   
        }
        redirect('/admin/common/add/income');   

    }

    public function update_receipts_voucher()
    {
        $data= $this->input->post();
        $voucher_id  =$data['id'];
        $get_previous_amt = $this->Income_model->get_invoice_info($voucher_id);
        $diff_amt  = $data['amount']- $get_previous_amt['amount'];
        $data['user_id']=$this->session->userdata("user_id");
        // unset($data['acc_number']);
        $this->db->trans_start();
        $this->Income_model->update_receipts_voucher_info($voucher_id,$data);
        if($data['payment_method'] == "cash"){
            $current_cashbook_amt = $this->Income_model->get_cashbook_amt();
            $updated_data= array(
                'cashbook_amount' =>$current_cashbook_amt['cashbook_amount']+$diff_amt,
                );
            $this->Income_model->update_cashbook_balance($updated_data);
        }
        else{
            if($get_previous_amt['bank_acc_id'] == $data['bank_acc_id']){
                $bank_acc_id= $data['bank_acc_id'];
                $curr_acc_amt=  $this->Income_model->get_bank_acc_amt($bank_acc_id);
                $updated_data= array(
                    'balance' =>$curr_acc_amt['balance']+$diff_amt,
                    );
                $this->Income_model->update_bank_acc_balance($bank_acc_id,$updated_data);
            }
            else{
                $bank_acc_id= $data['bank_acc_id'];
                $curr_acc_amt=  $this->Income_model->get_bank_acc_amt($bank_acc_id);
                $updated_data= array(
                    'balance' =>$curr_acc_amt['balance']+$data['amount'],
                    );
                $this->Income_model->update_bank_acc_balance($bank_acc_id,$updated_data);
                $previous_acc= $get_previous_amt['bank_acc_id'];
                $prev_acc_amt=  $this->Income_model->get_bank_acc_amt($previous_acc);

                $previou_acc_data = array(
                    'balance' =>$prev_acc_amt['balance']-$get_previous_amt['amount'],
                    );
                $this->Income_model->update_prev_bank_acc_balance($previous_acc,$previou_acc_data);
            }

        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Receipts Voucher Update Failed."));                   
        }
        else
        {
            $this->session->set_flashdata('flashMessage', array('success', "Receipts Voucher Updated Successfully."));                   
        }
        redirect('/admin/common/add/income');  
    }

    public function delete_income($id)
    {
        $income_info = $this->Income_model->get_income_details($id);
        $this->db->trans_start();

        if($income_info['payment_method']== "cash"){
            $current_cashbook_amt = $this->Income_model->get_cashbook_amt();
            $updated_data= array(
                'cashbook_amount' =>$current_cashbook_amt['cashbook_amount']- $income_info['amount'],
                );
            $this->Income_model->update_cashbook_balance($updated_data);
        }
        else{
           $bank_acc_id= $income_info['bank_acc_id'];
           $curr_acc_amt=  $this->Income_model->get_bank_acc_amt($bank_acc_id);
           $updated_data= array(
            'balance' =>$curr_acc_amt['balance']- $income_info['amount'],
            );
           $this->Income_model->update_bank_acc_balance($bank_acc_id,$updated_data);
       }
       $this->Income_model->delete_income_voucher($id);

       $this->db->trans_complete();
       if ($this->db->trans_status() === FALSE)
       {
        $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Receipts Voucher Deleted Failed."));                   
    }
    else
    {
        $this->session->set_flashdata('flashMessage', array('success', "Receipts Voucher Deleted Successfully."));                   
    }
    redirect('/admin/common/get_all/income');  
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */