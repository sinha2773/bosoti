<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

		$this->load->model('payment_model');
		$this->load->model('dashboard_model', 'dashboard');

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

	// public function index()
	// {	
	// 	redirect($this->admin_path."dashboard","refresh");
	// }	
	

	// Dashboard
	public function index()
	{	
		
		$data = $this->init("Dashboard");
		$member_id = $this->session->userdata("member_id");
		if(!empty($member_id)){
			$data['deposit_by_member']= $this->dashboard->get_member_deposit_amt($member_id);
		}
		$data['total_cashbook']= $this->dashboard->get_cashbook_amt();
		$data['total_bank_acc']= $this->dashboard->get_bank_acc_amt();
		$data['total_expense']= $this->dashboard->get_expense_amt();

		// $client_id = 2;
		// $from_date = '2018-01-01';
		// $to_date = '2018-03-30';
		// $data['dashboard_report'] = $this->dashboard->dashboard_report($client_id, $from_date, $to_date); 
		// dd($data['dashboard_report']);

		$data["content"] = $this->load->view($this->theme."dashboard/index",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);

	}

	public function dashboard_calander(){
		$client_id = $this->input->post('client_id', true);
		$year = $this->input->post('year', true);
		$data['dashboard_report'] = $this->dashboard->dashboard_report($client_id, $year);
		echo $this->load->view($this->theme."dashboard/calander_report",$data, TRUE);
		exit;
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

	// function test()
	// {
	// 	echo "<pre>";
	// 	print_r($_SESSION);
	// }
}