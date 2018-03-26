<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        $this->load->model('payment_model');
        $this->load->model('member_model');
        $this->load->model('user_model','user');

    }	

    public function statement(){

        // if( !$this->master->isPermission('see_client_statement') )
        //     show_404();
        $client_info = array();
        $payment_info = array();
        $client_id = 0;

        if(isset($_GET)){
            $client_id = $this->input->get('client_id');
            $from_date = $this->input->get('from_date');
            $to_date = $this->input->get('to_date');
            if(is_numeric($client_id)){
                $client_info = $this->member_model->getById($client_id);
                $payment_info = $this->payment_model->clientStatement($client_id,$from_date,$to_date);
            }
        }

        //$this->pr($payment_info);exit;

        $title = "Client Statement";
        $data = $this->init($title);
        $data['clients'] = $this->member_model->all();
        $data['client_id'] = $client_id;
        $data['client_info'] = $client_info;
        $data['payment_info'] = $payment_info;

        if( isset($_GET['print']) && $_GET['print']=='true' ){
            $data["content"] = $this->load->view($this->theme."payment/print_statement",$data);
        }else{
            $data["content"] = $this->load->view($this->theme."payment/statement",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }
    }

    // to check any bill paid in this month when adding pay bill
    public function isPaidAnyBillThisMonth(){

        $status = 0;
        if( isset($_POST) ){
            $client_id = $this->input->post('client_id');
            $payment_date = $this->input->post('payment_date');
            $result = $this->payment_model->getByClientAndDate($client_id, $payment_date);
            if( !empty($result) )
                $status = 1;
            else
                $status = 0;
        }
        else
            $status = 0;

        echo json_encode(array('status'=>$status));
        exit;
    }

    // Payment
    public function userPaymentDetails(){
        $client_id = $this->input->post('client_id');
        $payment_date = $this->input->post('payment_date');

        if( !empty($client_id) ){

            $member = $this->member_model->getById($client_id);
            $html = "";

            if( !empty($member) )
            {
                $html = "<table class='table'>";
                $html .="<tr>";
                $html .="<td>";
                $html .= "Name";
                $html .="</td>";
                $html .="<td>";
                $html .= $member->name;
                $html .="</td>";
                $html .="</tr>";

                $html .="<tr>";
                $html .="<td>";
                $html .= "Father name";
                $html .="</td>";
                $html .="<td>";
                $html .= $member->fathername;
                $html .="</td>";
                $html .="</tr>";

                $html .="<tr>";
                $html .="<td>";
                $html .= "Mother name";
                $html .="</td>";
                $html .="<td>";
                $html .= $member->mothername;
                $html .="</td>";
                $html .="</tr>";
                $html .= "</table>";
            }
            echo $html;
            exit;
        }else{
            die('Unauthorized');
        }
    }
    public function search_member_by_name()
    {
        $text = $this->input->post('q');
        if($text == null || $text=="") {
            echo "input field empty";
        }
        else{
            echo json_encode($this->payment_model->search_member_info($text));
        }
    }

    public function search_collector_by_name()
    {
        $text = $this->input->post('q');
        if($text == null || $text=="") {
            echo "input field empty";
        }
        else{
            echo json_encode($this->payment_model->search_collector_info($text));
        }
    }
    
    
    public function bill($action="list", $id="", $from_date='', $to_date=''){        
        $this->load->model('payment_model','payment');
        
        $re_call = false;
        if( $action == "add" )
        {
          $template = "add";
          $title = "Add Payment";
          $data = $this->init($title);          
         // $data['clients'] = $this->member_model->all();
      }
      elseif( $action == "insert" )
      {  
            // if( !$this->master->isPermission('add_bill') )
            // show_404();

        $redirect_path = '?payment_date='.$this->input->post('payment_date');


        $this->form_validation->set_rules('client_id', 'Client ID', 'trim|required');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        $this->form_validation->set_rules('payment_date', 'Payment date', 'trim|required');

        if ($this->form_validation->run() == TRUE) 
        {

            if($this->input->post('collector_id') != ""){
                $collector_data= array(
                    'collector_name' => $this->input->post('collector_name'),
                    'collector_id' =>$this->input->post('collector_id'),
                );
                $this->session->set_userdata($collector_data);
            }
            if($this->session->userdata("user_role")== 4){
             $p_data['collector_id'] = $this->session->userdata("user_role");
         }
         else{
            $p_data['collector_id'] = $this->input->post('collector_id');
        }
        $this->db->trans_start();

        if( $p_data['collector_id'] == ""){
            $this->db->trans_complete();
            $this->db->trans_status() === FALSE;
            $this->session->set_flashdata('flashMessage', array('danger', "Select Colletor Properly."));          
            redirect($this->admin_path."payment/bill/add".$redirect_path, 'refresh');           
        }
        $p_data['client_id'] = $this->input->post('client_id');
        $p_data['amount'] = $this->input->post('amount');
           // $p_data['collector_id'] = $this->input->post('collector_id');
        $p_data['payment_type'] = $this->input->post('payment_type');
        $p_data['payment_date'] = date('Y-m-d', strtotime( $this->input->post('payment_date') ));
        $p_data['payment_year'] = date('Y', strtotime($p_data['payment_date']));
        $p_data['payment_month'] = date('m', strtotime($p_data['payment_date']));
        $p_data['payment_day'] = date('d', strtotime($p_data['payment_date']));
        $p_data['summary'] = $this->input->post('summary');
        $p_data['added_by'] = $this->session->userdata('user_id');
        $p_data['created'] = $this->now;

        $this->payment_model->add($p_data);
        $current_cashbook_amt = $this->payment_model->get_cashbook_amount();
        if($p_data['payment_type'] == "Deposit" || $p_data['payment_type'] == "Profit Distribution" || $p_data['payment_type'] == "Credit Adjust")
        {
           $updated_amt = array(
            'cashbook_amount' => $current_cashbook_amt['cashbook_amount'] + $p_data['amount'],
        );
       }
       if($p_data['payment_type'] == "Debit Adjust"){
        $updated_amt = array(
            'cashbook_amount' => $current_cashbook_amt['cashbook_amount'] - $p_data['amount'],
        );
    }
    $this->payment_model->update_cashbook_amt($updated_amt);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
        $this->session->set_flashdata('flashMessage', array('danger', "Sorry, payment adding failed."));                   
    }
    else
    {
     $this->session->set_flashdata('flashMessage', array('success', "Payment added successfully."));                   
 }

 redirect($this->admin_path."payment/bill/add".$redirect_path, 'refresh');		
} 
else 
{
    $re_call = true;
                //$this->bill('add');
    $this->session->set_flashdata('flashMessage', array('danger', "Sorry, Something went wrong"));
    redirect($this->admin_path."payment/bill/add".$redirect_path, 'refresh'); 
}

}
elseif( $action == "delete" )
{
    if($id=="" || !is_numeric($id))
        redirect($this->admin_path."payment/bill", 'refresh');


    $result = $this->master->delete($this->payment_table, $id, 'payment_id');
    if ( $result )
    {
     $this->session->set_flashdata('flashMessage', array('success', "Payment deleted successfully."));                   
 }
 else
 {
    $this->session->set_flashdata('flashMessage', array('danger', "Sorry, payment deleting failed."));                   
}     

$this->global_redirect('redirect_path'); 

redirect($this->admin_path."payment/bill", 'refresh');     

}
elseif( $action == "details" )
{
    if($id=="" || !is_numeric($id))
        redirect($this->admin_path."payment/bill", 'refresh'); 

    $template = "index";
    $title = "Payment Details";
    $data = $this->init($title);
    $data['search_url'] = base_url('admin/payment/bill/details').'/'.$id;
    $this->session->set_userdata('redirect_path', $data['search_url']);
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['lists'] = $this->payment_model->clientStatement($id, $from_date, $to_date);
    $data['client_info'] = $this->member_model->getById($id);

}      
else
{
            // if( !$this->master->isPermission('see_bill_report') )
            // show_404();

  $template = "list";
  $title = "Payment Reports";
  $data = $this->init($title);

  $filter_data = $this->input->get();
            // $filter_data['status'] = 1; // only active client;
  $month = $this->master->rangeMonth(date('Y-m-d'));
  $filter_data['from_date'] = isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : $month['start'];
  $filter_data['to_date'] = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : $month['end'];
  $data['data'] = $filter_data;

  $data["lists"] = $this->payment_model->get_payments($filter_data);
            //$this->pr($data["lists"] ); exit;
} 
if( $re_call == false ){    

    if( isset($_GET['print']) && $_GET['print']=='true' ){
        $data["content"] = $this->load->view($this->theme."payment/print_list",$data);  
    }
    else{      
      $data["content"] = $this->load->view($this->theme."payment/".$template,$data,TRUE);
      $this->load->view($this->theme.'layout',$data);
  }
}
}



public function check_amount($client_id){
    return TRUE;
        // $this->load->model('client_model', 'client');
        // $this->load->model('payment_model', 'payment');
        // $client_info = $this->client->get_client($client_id);
        // $cur_month_payment = $this->payment->get_cur_month_payment($client_id);

        // if( $client_info->total > $cur_month_payment){
        //     return TRUE;
        // }else{
        //     $this->form_validation->set_message('check_amount', 'Sorry, you already paid. If you want you can paid as advance.');
        //     return FALSE;
        // }
}



public function log(){
    if( !$this->master->isPermission('see_log') )
        show_404();

    $this->load->model('payment_model', 'payment');
    $this->load->model('client_model', 'client');

    $title = "LOG";
    $data = $this->init($title);
    $data['from_date'] = isset($_GET['from_date']) ? $_GET['from_date'] : date('Y-m-d');
    $data['to_date'] = isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d');
    $data['from_date_alise'] = date('l, d F Y', strtotime($data['from_date']));
    $data['to_date_alise'] = date('l, d F Y', strtotime($data['to_date']));
    $data['collector'] = $this->input->get('collector', true);
    $data['operators'] = $this->master->get_all($this->user_table);
    $data["lists"] = $this->payment->paymentLog($data['from_date'], $data['to_date'], $data['collector']);

        //$this->pr($data["lists"]);exit;
    if( isset($_GET['print']) && $_GET['print']=='true' ){
        $data["content"] = $this->load->view($this->theme."payment/print_log",$data);  
    }
    else{      
        $data["content"] = $this->load->view($this->theme."payment/log",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }
}


    // print payment slip
public function paymentSlip(){
    if( !$this->master->isPermission('access_payment_slip') )
        show_404();

    $this->load->model('payment_model', 'payment');
    $this->load->model('client_model', 'client');

    $filter_data = [];
    if ( isset($_GET['zone']) && !empty($_GET['zone']))
        $filter_data['zone'] = (int)$_GET['zone'];

    if ( isset($_GET['chkIds']) && !empty($_GET['chkIds'])){
        $filter_data['client_ids'] = explode(',', $_GET['chkIds']);
    }

        // due selection
    if ( isset($_GET['dueType']) && !empty($_GET['dueType'])){
        $filter_data['dueType'] = $_GET['dueType'];
    }
    if ( isset($_GET['dueAbove']) && !empty($_GET['dueAbove'])){
        $filter_data['dueAbove'] = $_GET['dueAbove'];
    }
    if ( isset($_GET['dueBelow']) && !empty($_GET['dueBelow'])){
        $filter_data['dueBelow'] = $_GET['dueBelow'];
    }
        // end due selection

    $title = "Payment Slip for Due Clients";
    $data = $this->init($title);
    $data["dueTypes"] = $this->client->get_due_types();
    $data["zones"] = $this->master->get_all($this->zone_table);
    $data['due_month'] = $this->get_billing_month();
    $explode_date = explode('-', $data['due_month']['date']);
    $data['year'] = $explode_date[0];
    $data['month'] = $explode_date[1];
    $data['last_billing'] = $this->payment->getLastGenerateBilling();
    $data["lists"] = $this->payment->get_paid_or_due_list($data['year'],$data['month'], 'due', $filter_data);
    $data['list_total'] = end($data['lists']);
        array_pop($data['lists']); // remove total item
        // $this->pr($data["lists"]);exit;
        $data['data'] = $filter_data;
        if( isset($_GET['print']) && $_GET['print']=='true' ){
            $data["content"] = $this->load->view($this->theme."payment/paymentslip_print",$data);  
        }
        else{      
            $data["content"] = $this->load->view($this->theme."payment/paymentslip",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }
    }

    function get_member_info()
    {
        date_default_timezone_set("Asia/Dhaka");
        $today_date = date("Y-m-d");
        $text = $this->input->post('id');
        $return_data = array(
            'member_info' =>$this->payment_model->get_member_info($text),
            'payment_info' =>$this->payment_model->todays_payment_info($text,$today_date),
        );
        echo json_encode($return_data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */