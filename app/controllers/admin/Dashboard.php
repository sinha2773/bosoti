<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

		$this->load->model('payment_model');

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

	// public function index()
	// {	
	// 	redirect($this->admin_path."dashboard","refresh");
	// }	
	

	// Dashboard
	public function index()
	{	
		$this->load->model('dashboard_model', 'dashboard');
		$data = $this->init("Dashboard");
		$data['total_cashbook']= $this->dashboard->get_cashbook_amt();
		$data['total_bank_acc']= $this->dashboard->get_bank_acc_amt();
		$data['total_expense']= $this->dashboard->get_expense_amt();

		// $data['members'] = 

		$data["content"] = $this->load->view($this->theme."dashboard/index",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);

	}

	public function miniMonthlySummary(){
		if ( isset($_POST['month']) && isset($_POST['year']) )
		{
			$this->load->model('dashboard_model', 'dashboard');
			$this->load->model('payment_model', 'payment');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$payment_summary = $this->dashboard->mini_monthly_payment_summary($year, $month);
			echo json_encode(array('status'=>1, 'data'=>$payment_summary));
			exit;
		}
		else
			exit('404');
	}

	public function monthlySummary(){
		if ( isset($_POST['month']) && isset($_POST['year']) )
		{
			$this->load->model('dashboard_model', 'dashboard');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$payment_summary = $this->dashboard->monthly_payment_summary($month, $year);
			echo json_encode(array('status'=>1, 'data'=>$payment_summary));
			exit;
		}
		else
			exit('404');
	}
}