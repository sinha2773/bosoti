<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Income extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

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
        //$this->pr($data['incomes']);exit;
        $data["content"] = $this->load->view($this->theme."income/report",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */