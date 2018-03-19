<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expense extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

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
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */