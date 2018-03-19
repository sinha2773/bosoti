<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_model extends MY_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function add($data){        
        $this->insert($this->salary_table, $data);
        return $this->db->insert_id();
    }

    public function get_employees()
    {
    	$this->db->select('*, (basic_salary + house_rent + medical_allownce + other_allownce) as total');
        $query = $this->db->get($this->employee_table);
        
        return $query->result();
    }

    public function get_employee($id="")
    {
    	$this->db->select('*, (basic_salary + house_rent + medical_allownce + other_allownce) as total');
        $this->db->where($this->employee_table.".id",$id);
        $query = $this->db->get($this->employee_table);
        
        return $query->row();
    }

    public function get_cur_month_payment($employee_id, $amount_only=true){
        $this->db->select('*');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('MONTH(billing_date) >=', date('m'));
        $this->db->where('MONTH(billing_date) <=', date('m'));
        $this->db->where('YEAR(billing_date) >=', date('Y'));
        $this->db->where('YEAR(billing_date) <=', date('Y'));
        $this->db->where('billing_type', 1); // type salary
        $this->db->order_by('payment_id', 'DESC');
        $query = $this->db->get($this->salary_table);

        if($amount_only){
            $cur_month_payment = 0;
            $result = $query->result();
            if(is_array($result) && !empty($result)){
                foreach($result as $payment){
                    $cur_month_payment += $payment->amount + $payment->adjustment_amount;
                }
            }
            return $cur_month_payment;
        }
        else
            return $query->result();
    }

    public function get_payments($filter_data=array())
    {
        $this->db->select($this->salary_table.'.*, (basic_salary + house_rent + medical_allownce + other_allownce) as total');
        $this->db->join('tbl_salarys','tbl_salarys.employee_id=tbl_employees.id');
        
        // Payment Type
        if( isset($filter_data['payment_type']) && !empty($filter_data['payment_type']) )
        {
            $this->db->where("payment_type", $filter_data['payment_type']);
        }

        // status
        if( isset($filter_data['status']) && !empty($filter_data['status']) )
        {
            $this->db->where("status", $filter_data['status']);
        }

 
        // Name/Mobile
        if( isset($filter_data['txtInput']) && !empty($filter_data['txtInput']) )
        {
            $this->db->like("full_name", $filter_data['txtInput']);
            $this->db->or_like("mobile", $filter_data['txtInput']);
            $this->db->or_like("summary", $filter_data['txtInput']);
        }

        // From Date/To Date
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            $this->db->where("billing_date>=", $filter_data['from_date']);
        }
        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            $this->db->where("billing_date<=", $filter_data['to_date']);
        }

        // Book No
        if( isset($filter_data['book_no']) && !empty($filter_data['book_no']) )
        {
            $this->db->where("book_no", $filter_data['book_no']);
        }


        $query = $this->db->get($this->salary_table);
        //echo $this->db->last_query();exit;

        return $query->result();
    }

    public function salaryStatement($employee_id, $from_date='', $to_date=''){

        $where_part = '';
        if($from_date != '' && $to_date != ''){
            $where_part .= " AND (billing_date >= '$from_date' AND billing_date <= '$to_date') ";
        }
        $sql = "SELECT *,(select name from tbl_users u where u.id=added_by) as added_by  FROM tbl_salarys WHERE employee_id=$employee_id $where_part ORDER BY billing_year, billing_month DESC";
        $query = $this->db->query($sql);
        //echo $this->db->last_query(); exit;
        
        return $query->result();
    }

	function signup(){
		$data = array();
		if (isset($_FILES['image']) && !empty($_FILES["image"]["name"]) && $_FILES["image"]["size"]>0) {
            $image_name = $this->input->post('txtCompanyName');
            $data['media_id'] = $this->image_upload($_FILES['image'], 'employer', array("action"=>"insert","name"=>$image_name));
        }else{
        	return FALSE;
        }
		$company_type = implode(",", $this->input->post('industrys'));
		$data['username'] = $this->input->post('txtUsername');
		$data['password'] = $this->get_has_password($this->input->post('txtPassword'));
		$data['email'] = $this->input->post('txtEmail');
		$data['phone'] = $this->input->post('txtMobile');
		$data['first_name'] = $this->input->post('txtFirstName');
		$data['surname'] = $this->input->post('txtLastName');
		$data['designation'] = $this->input->post('txtDesignation');
		$data['company'] = $this->input->post('txtCompanyName');
		$data['company2'] = $this->input->post('txtAliasName');
		$data['company_description'] = $this->input->post('txtDescription');
		$data['website'] = $this->input->post('txtURL');
		$data['address'] = $this->input->post('txtAddress');
		$data['address2'] = $this->input->post('txtAddress2');
		$data['company_type'] = $company_type;
		$data['country'] = $this->input->post('txtCountry');
		$data['city'] = $this->input->post('txtCity');
		$data['created'] = $this->now;
		$data['status'] = 1;

		$this->insert($this->employer_table, $data);
		return $this->db->insert_id();
	}

	function get_company($id){
		$this->db->where('id',$id);
		return $this->db->get($this->employer_table)->row();
	}

	public function get_payment_types(){
        return array(
            array('text'=>'Salary', 'value'=>'1'),
            array('text'=>'Advance Salary', 'value'=>'2'),
            //array('text'=>'Adjustment/Bonus', 'value'=>'3')
            );
    }

    public function get_payment_type($index=0){
        return $this->get_payment_types()[$index];
    }
}
?>