<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Balance extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}

    public function index(){
        $this->sheet();
    }	

    public function cashbook(){

        if( !$this->master->isPermission('account_access') )
            show_404();

        $this->load->model('balance_model', 'balance');
        $this->load->model('payment_model', 'payment');

        $title = "Cash Book";
        $data = $this->init($title);
        $filter_data = $this->input->get();

        // default date last generated date
        if ( !isset($filter_data['from_date']) || empty($filter_data['from_date']) ){
        	$lastGenerateDate = $this->master->rangeMonth(date('Y-m-d')); //$this->master->lastDateOfBillingMonth();
        	$filter_data['from_date'] = $lastGenerateDate['start'];
        	$filter_data['to_date'] = date('Y-m-d');//$lastGenerateDate['end'];
        }


        $data['data'] = $filter_data;
        $data['cashbook'] = $this->balance->getCashBook($filter_data);
        //$this->pr($data['cashbook']);exit;

        if( isset($_GET['print']) && $_GET['print']=='true' ){ // for print only
            $this->load->view($this->theme."balance/print_cashbook",$data);
        }else{
            $data["content"] = $this->load->view($this->theme."balance/cashbook",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }        
    }

    public function sheet(){

        if( !$this->master->isPermission('account_access') )
            show_404();

        $this->load->model('balance_model', 'balance');
        $this->load->model('payment_model', 'payment');

        $title = "Cash Book";
        $data = $this->init($title);
        $filter_data = $this->input->get();

        if ( !isset($filter_data['year']) || empty($filter_data['year']) ){
            $filter_data['year'] = date('Y');
        }

        $months = range(1, 12);
        array_walk($months, function(&$item) {
            $item = str_pad($item, 2, '0', STR_PAD_LEFT); 
        });

        $filter_data['months'] = $months;
        $data['data'] = $filter_data;
        $data['balancesheet'] = $this->balance->balanceSheet($filter_data['year'], $months);
        // $this->pr($data['balancesheet']);exit;

        if( isset($_GET['print']) && $_GET['print']=='true' ){ // for print only
            $this->load->view($this->theme."balance/print_balancesheet",$data);
        }else{
            $data["content"] = $this->load->view($this->theme."balance/balancesheet",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }  
    }    

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */