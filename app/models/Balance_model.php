<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balance_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function getDateRange($start, $end){
        $begin = new DateTime( '2017-01-01' );
        $end = new DateTime( date('Y-m-d') );
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);
        $this->pr($daterange);
        foreach($daterange as $date){
            echo $date->format("Y-m-d") . "<br>";
        }
    }

    function incomeFromMonthlyBill($filter_data=array()){

        if( isset($filter_data['created']) && $filter_data['created']==false ){
            $date_field = 'billing_date';
        }else{
            $date_field = 'created';
        }

        $this->db->select('DATE_FORMAT(tbl_payments.'.$date_field.',"%Y-%m-%d") as billing_date, DATE_FORMAT(tbl_payments.'.$date_field.',"%Y-%m-%d") as created_date, max(payment_month) as payment_month, max(payment_year) as payment_year, collector_id, (select name from tbl_users u where u.id=collector_id) as collector');
        $this->db->select("SUM(IF(payment_type != 4, amount, 0) - IF(payment_type = 4, amount,0)) AS total_amount", FALSE);
        

        // From Date/To Date
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            // $this->db->where("billing_date>=", $filter_data['from_date']);
            $this->db->where("DATE_FORMAT(tbl_payments.".$date_field.",'%Y-%m-%d') >=", $filter_data['from_date']);
        }
        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            // $this->db->where("billing_date<=", $filter_data['to_date']);
            $this->db->where("DATE_FORMAT(tbl_payments.".$date_field.",'%Y-%m-%d') <=", $filter_data['to_date']);
        }

        if( isset($filter_data['collector']) && !empty($filter_data['collector']) )
        {
            $this->db->where("collector_id", $filter_data['collector']);
        }

        if ( isset($filter_data['all_sum']) && $filter_data['all_sum']==true ){
            // all together
        }else{
            $this->db->group_by("collector_id");
            $this->db->group_by("created_date");
        }

        $this->db->order_by('created_date', 'ASC');
        $this->db->having('total_amount>0');
        $query = $this->db->get($this->payment_table);
        //echo $this->db->last_query();exit;

        return $query->result();
    }
    function incomeFromOthers($filter_data=array()){
        $this->db->select('sum(amount) as total_amount, payment_method, payment_from, DATE_FORMAT(created,"%Y-%m-%d") as income_date, DATE_FORMAT(created,"%Y-%m-%d") as created_date, invoice, intype_id, max(remark) remark');
        
        // From Date/To Date
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            // $this->db->where("income_date>=", $filter_data['from_date']);
            $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') >=", $filter_data['from_date']);
        }
        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            // $this->db->where("income_date<=", $filter_data['to_date']);
            $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') <=", $filter_data['to_date']);
        }

        $this->db->where("status", 1);

        if ( isset($filter_data['all_sum']) && $filter_data['all_sum']==true ){
            // all together
        }else
        $this->db->group_by('invoice');

        
        $this->db->group_by('payment_method');
        $this->db->group_by('created_date');
        $this->db->group_by('payment_from');
        $this->db->group_by('income_date');
        $this->db->group_by('intype_id');

        $this->db->order_by('created_date');

        $this->db->having('total_amount>0');
        $query = $this->db->get($this->income_table);
        // echo $this->db->last_query();exit;

        return $query->result();
    }

    // function expenseFromSalary($filter_data=array()){
    //     $this->db->select('sum(amount+adjustment_amount) as total_amount, DATE_FORMAT(created,"%Y-%m-%d") as billing_date, DATE_FORMAT(created,"%Y-%m-%d") as created_date, max(payment_month) as payment_month, max(payment_year) as payment_year, employee_id, (select full_name from tbl_employees e where e.id=employee_id) as employee');
    
    //     // From Date/To Date
    //     if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
    //     {
    //         // $this->db->where("billing_date>=", $filter_data['from_date']);
    //         $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') >=", $filter_data['from_date']);
    //     }
    //     if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
    //     {
    //         // $this->db->where("billing_date<=", $filter_data['to_date']);
    //         $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') <=", $filter_data['to_date']);
    //     }

    //     if( isset($filter_data['employee']) && !empty($filter_data['employee']) )
    //     {
    //         $this->db->where("employee_id", $filter_data['employee']);
    //     }

    //     if ( isset($filter_data['all_sum']) && $filter_data['all_sum']==true ){
    //         // all together
    //     }else{
    //         $this->db->group_by("employee_id");
    //         $this->db->group_by("created_date");
    //     }

    //     $this->db->order_by('created_date', 'ASC');

    //     $this->db->having('total_amount>0');
    //     $query = $this->db->get($this->salary_table);
    //     //echo $this->db->last_query();exit;

    //     return $query->result();
    // }
    function expenseFromOthers($filter_data=array()){
        $this->db->select('sum(amount) as total_amount, payment_method, payment_to, DATE_FORMAT(created,"%Y-%m-%d") as expense_date, DATE_FORMAT(created,"%Y-%m-%d") as created_date, invoice, extype_id, max(remark) remark');
        
        // From Date/To Date
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            // $this->db->where("expense_date>=", $filter_data['from_date']);
            $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') >=", $filter_data['from_date']);
        }
        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            // $this->db->where("expense_date<=", $filter_data['to_date']);
            $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') <=", $filter_data['to_date']);
        }

        $this->db->where("status", 1);

        if ( isset($filter_data['all_sum']) && $filter_data['all_sum']==true ){
            // all together
        }else
        $this->db->group_by('invoice');

        $this->db->group_by('payment_method');
        $this->db->group_by('payment_to');
        $this->db->group_by('expense_date');
        $this->db->group_by('created_date');
        $this->db->group_by('extype_id');

        $this->db->order_by('created_date');

        $this->db->having('total_amount>0');
        $query = $this->db->get($this->expense_table);
        // echo $this->db->last_query();exit;

        return $query->result();
    }

    public function getCashBook($filter_data=array())
    {
        $incomeFromMonthlyBill = $this->incomeFromMonthlyBill($filter_data);
        $incomeFromOthers = $this->incomeFromOthers($filter_data);

        // $expenseFromSalary = $this->expenseFromSalary($filter_data);
        $expenseFromOthers = $this->expenseFromOthers($filter_data);

        $cashBookArray = array(); 
        // marge monthly income from client
        if ( !empty($incomeFromMonthlyBill) ){
            foreach ( $incomeFromMonthlyBill as $income ){
                $cashBookArray[$income->billing_date]['monthly_income'][] = $income;
            }
        }

        // marge other income
        if ( !empty($incomeFromOthers) ){
            foreach ( $incomeFromOthers as $income ){
                $cashBookArray[$income->income_date]['other_income'][] = $income;
            }
        }

        // // marge expense of salary
        // if ( !empty($expenseFromSalary) ){
        //     foreach ( $expenseFromSalary as $expense ){
        //         $cashBookArray[$expense->billing_date]['expense_salary'][] = $expense;
        //     }
        // }

        // // marge expense of others
        if ( !empty($expenseFromOthers) ){
            foreach ( $expenseFromOthers as $expense ){
                $cashBookArray[$expense->expense_date]['expense_other'][] = $expense;
            }
        }
        
        krsort($cashBookArray);

        // $this->pr($cashBookArray); exit;

        return $cashBookArray;

        // $this->pr($incomeFromMonthlyBill);
        // $this->pr($incomeFromOthers);
        // $this->pr($expenseFromSalary);
        // $this->pr($expenseFromOthers);
    }

    private function getPayment(array $filter_data){
        $this->load->model('payment_model', 'payment');
        return $this->payment->get_payments_report($filter_data);
    }

    function balanceSheet($year, array $months){
        // for testing purpose only
        // $data = $this->getPayment( array('from_date'=>'2017-04-01', 'to_date'=>'2017-04-30', 'all_sum'=>true, 'status'=>2) );
        // dd($data);
        // end for testing purpose only

        $output = array();
        foreach($months as $month){
            $startEndDate = $this->master->rangeMonth($year.'-'.$month.'-01');
            $output['billing'][$year.$month] = $this->getPayment( array('from_date'=>$startEndDate['start'], 'to_date'=>$startEndDate['end'], 'all_sum'=>true, 'status'=>2) );
            $output['voucher']['receive_billing'][$year.$month] = $this->incomeFromMonthlyBill( array('from_date'=>$startEndDate['start'], 'to_date'=>$startEndDate['end'], 'created'=>false, 'all_sum'=>false) );
            $output['voucher']['receive_other'][$year.$month] = $this->incomeFromOthers( array('from_date'=>$startEndDate['start'], 'to_date'=>$startEndDate['end'], 'all_sum'=>true) );
            // $output['voucher']['payment_salary'][$year.$month] = $this->expenseFromSalary( array('from_date'=>$startEndDate['start'], 'to_date'=>$startEndDate['end'], 'all_sum'=>true) );
            $output['voucher']['payment_other'][$year.$month] = $this->expenseFromOthers( array('from_date'=>$startEndDate['start'], 'to_date'=>$startEndDate['end'], 'all_sum'=>true) );
        }

        // $this->pr($output);exit;
        return $output;
    }
    
}
