<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model{

	public $today;
	public $this_week;
	public $this_month;
	public $three_month;
	public $six_month;
	public $this_year;

	public function __construct()
	{
		parent::__construct();
		$this->today = date('Y-m-d');
		$this->this_week = date('Y-m-d', strtotime($this->today . " -1 week"));
		$this->this_month = date('Y-m-d', strtotime($this->today . " -1 month"));
		$this->three_month = date('Y-m-d', strtotime($this->today . " -3 month"));
		$this->six_month = date('Y-m-d', strtotime($this->today . " -6 month"));
		$this->this_year = date('Y');
	}


	function client_summary(){
		$data = array();

		//DATE_FORMAT(created, '%Y\-%m\-%e')
		// Today
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE connection_date = '" . $this->today."'";
		$row = $this->db->query($query)->row();
		$data['today_total'] = $row->total;

		// Week
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE connection_date > '" . $this->this_week."'";
		$row = $this->db->query($query)->row();
		$data['week_total'] = $row->total;

		// Month
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE connection_date > '" . $this->this_month."'";
		$row = $this->db->query($query)->row();
		$data['month_one'] = $row->total;

		// Three Month
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE connection_date > '" . $this->three_month."'";
		$row = $this->db->query($query)->row();
		$data['month_three'] = $row->total;

		// Six Month
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE connection_date > '" . $this->six_month."'";
		$row = $this->db->query($query)->row();
		$data['month_six'] = $row->total;

		// One Year
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE DATE_FORMAT(connection_date, '%Y') = " . $this->this_year;
		$row = $this->db->query($query)->row();
		$data['year_total'] = $row->total;

		// Total
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table;
		$row = $this->db->query($query)->row();
		$data['total'] = $row->total;

		return $data;
	}

	private function client_total_by_status($status){
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE status = " . $status;
		$row = $this->db->query($query)->row();
		return $row->total;
	}

	private function client_total_by_ptype($ptype){
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE payment_type = " . $ptype;
		$row = $this->db->query($query)->row();
		return $row->total;
	}

	private function client_total_by_ctype($ctype){
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table . " WHERE client_type = " . $ctype;
		$row = $this->db->query($query)->row();
		return $row->total;
	}

	private function client_total(){
		$query = "SELECT COUNT(*) AS total FROM " . $this->client_table;
		$row = $this->db->query($query)->row();
		return $row->total;
	}

	function total_client_summary(){
		
		$data = array();

		// Disconnect
		$data['total_disconnect'] = $this->client_total_by_status(1);

		// active
		$data['total_active'] = $this->client_total_by_status(2);

		// Inactive
		$data['total_inactive'] = $this->client_total_by_status(3);

		// Hold
		$data['total_hold'] = $this->client_total_by_status(4);

		// Free
		$data['total_free'] = $this->client_total_by_ptype(1);

		// Prepaid
		$data['total_prepaid'] = $this->client_total_by_ptype(2);

		// Postpaid
		$data['total_postpaid'] = $this->client_total_by_ptype(3);

		// Postpaid
		$data['total_client'] = $this->client_total();

		return $data;
	}

	function get_total_client_payment(){
		$this->db->select('sum(amount+discount) as total_paid, sum(monthly_bill) as total_billed from '.$this->payment_table);
		return $this->db->get()->row();
	}	

	function get_total_other_payment(){
		$this->db->select('sum(amount) as total_paid from '.$this->income_table);
		return $this->db->get()->row();
	}

	function get_total_salary_paid(){
		$this->db->select('sum(amount+adjustment_amount) as total_paid, sum(monthly_bill) as total_billed from '.$this->salary_table);
		return $this->db->get()->row();
	}

	function get_total_other_paid(){
		$this->db->select('sum(amount) as total_paid from '.$this->expense_table);
		return $this->db->get()->row();
	}

	function client_payment_summary(){
		$this->load->model('balance_model', 'balance');
		$incomeFromMonthlyBill = $this->get_total_client_payment();
		$incomeFromOthers = $this->get_total_other_payment();

		$expenseFromSalary = $this->get_total_salary_paid();
		$expenseFromOthers = $this->get_total_other_paid();

        // $this->pr($incomeFromMonthlyBill);
        // $this->pr($incomeFromOthers);
        // $this->pr($expenseFromSalary);
        // $this->pr($expenseFromOthers);exit;

		$result = array(
			'incomeFromMonthlyBill'	=>$incomeFromMonthlyBill,
			'incomeFromOthers'		=>$incomeFromOthers,
			'expenseFromSalary'		=>$expenseFromSalary,
			'expenseFromOthers'		=>$expenseFromOthers,
		);

		return $result;
	}

	function monthly_payment_summary($month='', $year='', $all=false){
		$this->db->select("sum(amount) as paid, sum(discount) as discount, sum(monthly_bill) as billed, max(billing_year) as billing_year, max(billing_month) as billing_month, billing_type");
		$this->db->from('tbl_payments p');
		$this->db->join('tbl_clients c', 'c.id=p.client_id', 'inner');
		$this->db->where('c.status', 2); // active client bill

		if ( $all==false )
		{
			if ( !empty($month) )
				$this->db->where('billing_month='.$month);
			if ( !empty($year) )
				$this->db->where('billing_year='.$year);

			$this->db->group_by('billing_year, billing_month, billing_type');
		}
		else 
			$this->db->group_by('billing_type');

		$result = $this->db->get()->result();
		// echo $this->db->last_query();exit;
		$summary = array();	


		if ( !empty($result) ){
			foreach($result as $data){
				@$summary[$data->billing_year.'_'.$data->billing_month][$data->billing_type]['paid'] += $data->paid;
				@$summary[$data->billing_year.'_'.$data->billing_month]['total_paid'] += $data->paid + $data->discount;
				@$summary[$data->billing_year.'_'.$data->billing_month][$data->billing_type]['discount'] += $data->discount;
				@$summary[$data->billing_year.'_'.$data->billing_month]['total_discount'] += $data->discount;
				@$summary[$data->billing_year.'_'.$data->billing_month][$data->billing_type]['billed'] += $data->billed;
				@$summary[$data->billing_year.'_'.$data->billing_month]['total_billed'] += $data->billed;
			}
		}


		if ( !empty($summary) ){
			foreach ($summary as $key => $value) {
				$summary[$key]['monthly_billed'] = isset($value['2']) ? $value['2']['billed'] : 0;
				$summary[$key]['monthly_paid'] = isset($value['2']) ? $value['2']['paid'] : 0;
				$summary[$key]['monthly_discount'] = isset($value['2']) ? $value['2']['discount'] : 0;
				$summary[$key]['monthly_paid_with_discount'] = $summary[$key]['monthly_paid'] + $summary[$key]['monthly_discount'];
				$summary[$key]['monthly_paid_with_discount_alias'] = $summary[$key]['monthly_paid'] .'('. $summary[$key]['monthly_discount'] .')';


				// connection
				$summary[$key]['con_billed'] = isset($value['0']) ? $value['0']['billed'] : 0;
				$summary[$key]['con_paid'] = isset($value['0']) ? $value['0']['paid'] : 0;

				// re-connection
				$summary[$key]['recon_billed'] = isset($value['1']) ? $value['1']['billed'] : 0;
				$summary[$key]['recon_paid'] = isset($value['1']) ? $value['1']['paid'] : 0;

				// Adjustment
				$summary[$key]['adj_billed'] = isset($value['3']) ? $value['3']['billed'] : 0;
				$summary[$key]['adj_paid'] = isset($value['3']) ? $value['3']['paid'] : 0;


				// con/recon and adj sum as adjustment bill and paid
				$summary[$key]['adj_billed'] += $summary[$key]['con_billed'] + $summary[$key]['recon_billed'];
				$summary[$key]['adj_paid']   += $summary[$key]['con_paid'] + $summary[$key]['recon_paid'];


				//$summary[$key]['adv_billed'] = isset($value['4']) ? $value['4']['billed'] : 0;
				$summary[$key]['adv_paid'] = isset($value['4']) ? $value['4']['paid'] : 0;
				$summary[$key]['adj_adv_paid'] = $summary[$key]['adj_paid'] + $summary[$key]['adv_paid'];
				$summary[$key]['adj_adv_paid_alias'] = $summary[$key]['adj_paid'] .'('. $summary[$key]['adv_paid'] .')';

				$summary[$key]['monthly_adv_due'] = $summary[$key]['monthly_billed'] - $summary[$key]['monthly_paid_with_discount'];
				$summary[$key]['adj_adv_due'] = $summary[$key]['adj_billed'] - $summary[$key]['adj_adv_paid'];
				$summary[$key]['total_adv_due'] = $summary[$key]['total_billed'] - $summary[$key]['total_paid'];

				// Unset for makeing sum
				unset($summary[$key][0]); // connect
				unset($summary[$key][1]); // reconnection fee
				unset($summary[$key][2]); // bill pay
				unset($summary[$key][3]); // adjusment
				unset($summary[$key][4]); // advance
			}
		}
		

		if ($all == true && !empty($summary)){
			$sumArray = array();
			foreach ($summary as $k=>$subArray) {
				$details_monthly = $subArray;
				unset($details_monthly['monthly_paid_with_discount_alias']);
				unset($details_monthly['adj_adv_paid_alias']);
				foreach ($details_monthly as $id=>$value) {
					if ( !is_array($id) )
						@$sumArray[$id]+=$value;
				}
			}
			$sumArray['monthly_paid_with_discount_alias'] = $sumArray['monthly_paid'] .'('. $sumArray['monthly_discount'] .')';
			$sumArray['adj_adv_paid_alias'] = $sumArray['adj_paid'] .'('. $sumArray['adv_paid'] .')';

			return $sumArray;
		}

		//$this->pr($summary);
		//$this->pr($sumArray);
		//$this->pr($result);exit;

		return $summary;
	}


	function mini_monthly_payment_summary($year, $month){

		$dates = $this->master->rangeMonth($year.'-'.$month.'-01');
        // together payment only status 2(active clients)
		$results = $this->payment->get_payments_report(['from_date'=>$dates['start'], 'to_date'=>$dates['end'], 'status'=>2, 'together' => 1]);
        // $this->pr($results);exit;
		return (array)end($results);

        // return $this->payment->footer_payment_calculation($results);

	}

	function get_cashbook_amt()
	{
		$this->db->select('cashbook_amount');
		$this->db->from('tbl_final_amount');
		return $this->db->get()->row();
	}

	function get_bank_acc_amt()
	{
		$this->db->select('sum(balance) as balance');
		$this->db->from('tbl_bank_account');
		return $this->db->get()->row();
	}

	function get_expense_amt()
	{
		$this->db->select('sum(amount) as amount');
		$this->db->from('tbl_expenses');
		$this->db->where('status', 1);
		return $this->db->get()->row();
	}
	
	
}?>