<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

    public function salaryStatement(){

        if( !$this->master->isPermission('see_salary_statement') )
            show_404();

        $employee_info = array();
        $payment_info = array();
        $employee_id = 0;

        $this->load->model('employe_model','employee');
        $this->load->model('payment_model','payment');


        if(isset($_GET)){
            $employee_id = $this->input->get('employee_id');
            $from_date = $this->input->get('from_date');
            $to_date = $this->input->get('to_date');
            if(is_numeric($employee_id)){
                $employee_info = $this->employee->get_employee($employee_id);
                $payment_info = $this->employee->salaryStatement($employee_id,$from_date,$to_date);
            }
        }

        //$this->pr($payment_info);exit;

        $title = "Salary Statement";
        $data = $this->init($title);
        $data['employees'] = $this->employee->get_employees();
        $data['employee_id'] = $employee_id;
        $data['employee_info'] = $employee_info;
        $data['payment_info'] = $payment_info;
        $data["content"] = $this->load->view($this->theme."salary/statement",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    // Salary details of current month
    public function employeeSalaryDetails(){
    	$employee_id = $this->input->post('employee_id');
    	if( !empty($employee_id) ){
            $this->load->model('employe_model', 'employee');
    		$this->load->model('payment_model', 'payment');
    		$employee_info = $this->employee->get_employee($employee_id);
    		$total_monthly_bill = $employee_info->total;
    		
            //Salary paid for current month
            $cur_month_payment = $this->employee->get_cur_month_payment($employee_id);            
            $total_due = $total_monthly_bill - $cur_month_payment;

            $information = array(
                'paid_cur_month' => $this->payment->currencyFormat($cur_month_payment),
                'due_amount' => $this->payment->currencyFormat($total_due),
                '_monthly_bill' => $total_monthly_bill,
                'monthly_bill' => $this->payment->currencyFormat($total_monthly_bill),
                'name' => $employee_info->full_name,
                'address' => $employee_info->address,
                'qualification' => $employee_info->qualification,
                'job_title' => $employee_info->job_title,
                'joining_date' => $employee_info->joining_date,
                'basic_salary' => $this->payment->currencyFormat($employee_info->basic_salary),
                'house_rent' => $this->payment->currencyFormat($employee_info->house_rent),
                'medical_allownce' => $this->payment->currencyFormat($employee_info->medical_allownce),
                'other_allownce' => $this->payment->currencyFormat($employee_info->other_allownce),
                'total' => $this->payment->currencyFormat($employee_info->basic_salary + $employee_info->house_rent + $employee_info->medical_allownce + $employee_info->other_allownce)
                );

    		$response = array('employee_info'=>$information);
    		echo json_encode($response);exit;
    	}else{
    		die('Unauthorized');
    	}
    }
    
    public function salary($action="list", $id="", $from_date='', $to_date=''){

        $this->load->model('employe_model', 'employee');
        $re_call = false;
    	if( $action == "pay" )
    	{
            if( !$this->master->isPermission('pay_salary') )
                show_404();

    		$template = "add";
    		$title = "Payment Salary";
            $data = $this->init($title);
            $data['employees'] = $this->master->get_all($this->employee_table);
            $data['payment_types'] = $this->employee->get_payment_types();
            //$this->pr($data['employees']);exit;
    	}
    	elseif( $action == "insert" )
    	{
            if( !$this->master->isPermission('pay_salary') )
                show_404();
            
    		if($this->input->post('payment_type') == 1){ // Salary
    			$this->form_validation->set_rules('employee_id', 'Client', 'trim|required|callback_check_amount');
    		}else{
    			$this->form_validation->set_rules('employee_id', 'Client', 'trim|required');
    		}
    		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
    		$this->form_validation->set_rules('payment_type', 'Salary Type', 'trim|required');
        	if ($this->form_validation->run() == TRUE) 
            {

            	$p_data['employee_id'] = $this->input->post('employee_id');
                $p_data['billing_date'] = $this->input->post('billing_date');
                $p_data['billing_year'] = date('Y', strtotime($p_data['billing_date']));
                $p_data['billing_month'] = date('m', strtotime($p_data['billing_date']));
            	$p_data['billing_type'] = $this->input->post('payment_type');

            	$employee_info = $this->employee->get_employee($p_data['employee_id']);
            	$total_monthly_bill = $employee_info->total;

                $p_data['monthly_bill'] = $total_monthly_bill;
                $p_data['amount'] = $this->input->post('amount');

            	//$this->pr($employee_info);exit;
            	
            	if($p_data['billing_type'] == 1){ // Salary            		
                    $p_data['adjustment_amount'] = $this->input->post('adjustment');
            	}            	
            	elseif($p_data['billing_type'] == 2){ // Advance
            		$p_data['is_advance'] = 1;
            	}
                // elseif($p_data['billing_type'] == 3){ // Adjustment/Bonus
                //     $p_data['adjustment_amount'] = $this->input->post('adjustment_amount');
                //     $p_data['monthly_bill'] = $this->input->post('amount');
                //     // $p_data['monthly_bill'] = $this->input->post('credited');
                // }
                else{
                    exit;
                }

            	$p_data['summary'] = $this->input->post('summary');
            	$p_data['added_by'] = $this->session->userdata('user_id');
                $p_data['created'] = $this->now;

                $this->db->trans_start();                
                $this->employee->add($p_data);                
                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE)
                {
                    $this->session->set_flashdata('flashMessage', array('danger', "Sorry, salary adding failed."));                   
                }
                else
                {
                   $this->session->set_flashdata('flashMessage', array('success', "Salary added successfully."));                   
                }
	    		
    		  redirect($this->admin_path."employee/salary/pay", 'refresh');		
            } 
            else 
            {
                $re_call = true;
                $this->salary('pay');
                //$this->session->set_flashdata('flashMessage', array('danger', "Sorry, you didnt fill up required fields."));
            }

    	}            
    	else
    	{
            exit;
    		$template = "list";
    		$title = "Payment Reports";
            $data = $this->init($title);

            $filter_data = $this->input->get();
            $data['data'] = $filter_data;

            $data["lists"] = $this->employee->get_payments($filter_data);
            //$this->pr($data["lists"] ); exit;
    	} 
        if( $re_call == false ){            
    		$data["content"] = $this->load->view($this->theme."salary/".$template,$data,TRUE);
    		$this->load->view($this->theme.'layout',$data);
        }
    }

    public function check_amount($employee_id){
        $this->load->model('employee_model', 'employee');
        $employee_info = $this->employee->get_employee($employee_id);
        $cur_month_payment = $this->employee->get_cur_month_payment($employee_id);

        if( $employee_info->total > $cur_month_payment){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_amount', 'Sorry, salary already paid. If you want you can paid as advance.');
            return FALSE;
        }
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */