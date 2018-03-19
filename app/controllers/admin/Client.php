<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Client extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

    public function index(){

        if( !$this->master->isPermission('see_client_list') )
            show_404();

        $this->load->model('client_model','client');
        $this->load->model('user_model','user');
        $title = "All Clients";
        $data = $this->init($title);

        $filter_data = $this->input->get();
        //$this->pr($filter_data);exit;

        $data['payment_types'] = $this->client->get_payment_types();
        $data['client_types'] = $this->client->get_client_types();
        $data["statuses"] = $this->client->get_statuses();
        $data["address"] = $this->master->get_all($this->address_table);
        $data["floors"] = $this->master->get_all($this->floor_table);
        $data["zones"] = $this->master->get_all($this->zone_table);
        $data["apartments"] = $this->master->get_all($this->apartment_table);
        $data["packages"] = $this->master->get_all($this->package_table);
        $data["operators"] = $this->user->getOperators();
        $data["dueTypes"] = $this->client->get_due_types();
        $data["advanceTypes"] = $this->client->get_adv_types();
        $data['data'] = $filter_data;

        $data["lists"] = $this->client->get_clients($filter_data);

        if( isset($_GET['print']) && $_GET['print']=='true' ){ // for print only
            $this->load->view($this->theme."client/print_list",$data);
        }else{
            $data["content"] = $this->load->view($this->theme."client/list",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }
    }

    /**
    * To get only the client prefix
    * Return (json) client prefix
    */
    public function getClientPrefix(){
        if( isset($_POST) ){
            $prefix = $this->input->post('prefix'); 
            $this->load->model('client_model', 'client');  
            $prefix_data = $this->client->get_new_client_id($prefix);
            echo json_encode(array('status'=>'success', 'prefix'=>$prefix_data));exit;
        }
    }

    public function registration(){

        if( !$this->master->isPermission('client_registration') )
            show_404();

        $this->load->model('client_model','client');
        $this->load->model('user_model','user');
        
        $title = "Add Client";
        $data = $this->init($title);
        $data['client_id'] = $this->client->get_new_client_id();
        $data['payment_types'] = $this->client->get_payment_types();
        $data['client_types'] = $this->client->get_client_types();
        $data["statuses"] = $this->client->get_statuses();
        $data["address"] = $this->master->get_all($this->address_table);
        $data["floors"] = $this->master->get_all($this->floor_table);
        $data["zones"] = $this->master->get_all($this->zone_table);
        $data["apartments"] = $this->master->get_all($this->apartment_table);
        $data["packages"] = $this->master->get_all($this->package_table);
        $data["operators"] = $this->user->getOperators();
        $data["content"] = $this->load->view($this->theme."client/add",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function editClient($id=''){

        if( !$this->master->isPermission('update_client') )
            show_404();

        $this->load->model('client_model','client');
        $this->load->model('user_model','user');

        $title = "Edit Client";
        if($id=="" || !is_numeric($id))
            redirect($this->admin_path."client", 'refresh'); 
        
        $data = $this->init($title);
        $edit_items = $this->client->get_client($id);
        if( !empty($edit_items))
        $data["data"] = $edit_items;
        else
        redirect($this->admin_path."client", 'refresh'); 

        $data['payment_types'] = $this->client->get_payment_types();
        $data['client_types'] = $this->client->get_client_types();
        $data["statuses"] = $this->client->get_statuses();
        $data["address"] = $this->master->get_all($this->address_table);
        $data["floors"] = $this->master->get_all($this->floor_table);
        $data["zones"] = $this->master->get_all($this->zone_table);
        $data["apartments"] = $this->master->get_all($this->apartment_table);
        $data["packages"] = $this->master->get_all($this->package_table);
        $data["operators"] = $this->user->getOperators();

        $data["content"] = $this->load->view($this->theme."client/edit",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function deleteClient($id=''){

        if( !$this->master->isPermission('update_client') )
            show_404();

        if($id=="" || !is_numeric($id))
            redirect($this->admin_path."client", 'refresh'); 

        $this->load->model('client_model','client');
        $this->db->trans_start();
        $this->client->remove($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, client deleting failed."));
        } else {
            $this->session->set_flashdata('flashMessage', array('success', "Client deleted successfully."));
        }
        redirect($this->admin_path."client", 'refresh');
    }

    public function saveClient($action='insert'){
        //$this->pr($this->input->post());exit;
        $this->load->model('client_model','client');
        $this->form_validation->set_rules('full_name', 'Name', 'trim|required');
        
        if(isset($this->master->settings['is_mobile_required']) && $this->master->settings['is_mobile_required'] == 1)
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[11]');
        
        if($action == 'insert'){
            $this->form_validation->set_rules('client_id', 'Client ID', 'trim|required|is_unique[tbl_clients.client_id]');
        }
        else{
            $this->form_validation->set_rules('client_id', 'Client ID', 'trim|required|callback_edit_client_unique');
        }

        if ($this->form_validation->run() == TRUE) 
        {
            
            if($this->client->add($action))
            {
                if($action=="insert"){
                    $this->session->set_flashdata('flashMessage', array('success', "Client created successfully."));
                }else{
                    $this->session->set_flashdata('flashMessage', array('success', "Client updated successfully."));
                }
            }
            else
            {
                if($action=="insert"){
                    $this->session->set_flashdata('flashMessage', array('danger', "Sorry, client creating failed."));
                }else{
                    $this->session->set_flashdata('flashMessage', array('danger', "Sorry, client updating failed."));
                }
            }

            if($action=="insert")
            redirect($this->admin_path."client/registration", 'refresh');
            else   
            redirect($this->admin_path."client", 'refresh'); 
            
        } 
        else 
        {
            //$this->session->set_flashdata('flashMessage', array('danger', "Sorry, you didnt fill up required fields."));
            $this->registration();
        }
              
    }

    public function edit_client_unique($client_id){
        $this->db->where_not_in('id',$this->input->post('id'));
        $this->db->where('client_id',$client_id);
        if($this->db->count_all_results('tbl_clients') > 0){
            $this->form_validation->set_message('edit_client_unique', "Sorry, that %s is already being used.");
            return false;
        }else{
            return true;
        }
    }

    public function changeStatus(){
        if( !$this->master->isPermission('update_client_status') )
            show_404();

        $this->load->model('client_model','client');
        $this->load->model('user_model','user');
        $title = "Update Client Status";
        $data = $this->init($title);

        $data['client_id_alias'] = '';

        // when finding client
        if ( isset($_POST['get_client']) ){
            $client_id_alias = $this->input->post('client_id_alias', true);
            $data['client_id_alias'] = $client_id_alias;
        }

        // when update process
        if ( isset($_POST['update_status']) ){
            $client_id          = $this->input->post('client_id', true);
            $client_id_alias    = $this->input->post('client_id_alias', true);
            $status_id          = $this->input->post('status', true);
            $data['client_id_alias'] = $client_id_alias;
            $this->client->changeStatus($client_id, $status_id);
        }

        if ( $data['client_id_alias'] !='' )
            $data["lists"] = $this->client->get_clients(array('client_id_alias'=>$data['client_id_alias']));
        else
            $data['lists'] = array();


        $data["content"] = $this->load->view($this->theme."client/change_status",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function history($id=''){

        if( !$this->master->isPermission('client_history') )
            show_404();

        $this->load->model('client_model','client');
        $this->load->model('user_model','user');
        $this->load->model('history_model','history');
        $this->load->model('payment_model','payment');

        $title = "Client History";
        if($id=="" || !is_numeric($id))
            redirect($this->admin_path."client", 'refresh'); 
        
        $data = $this->init($title);
        $edit_items = $this->client->get_client($id);
        if( !empty($edit_items))
        $data["client_info"] = $edit_items;
        else
        redirect($this->admin_path."client", 'refresh'); 

        $data['histories'] = $this->history->getHistoryByClient($id);
        $data['billing_info'] = $this->payment->getLastPayment($id);
        //$this->pr($data['billing_info']);exit;

        $data["content"] = $this->load->view($this->theme."client/history",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function statement(){

        if( !$this->master->isPermission('see_client_statement') )
            show_404();

    	$client_info = array();
    	$payment_info = array();
    	$billing_info = array();
    	$client_id = 0;

    	$this->load->model('client_model','client');
        //$this->load->model('user_model','user');
        //$this->load->model('history_model','history');
        $this->load->model('payment_model','payment');


        if(isset($_GET)){
	        $client_id = $this->input->get('client_id');
	        $from_date = $this->input->get('from_date');
	        $to_date = $this->input->get('to_date');
	        if(is_numeric($client_id)){
	        	$client_info = $this->client->get_client($client_id);
	        	$payment_info = $this->payment->clientStatement($client_id,$from_date,$to_date);
	        	$billing_info = $this->payment->getLastPayment($client_id);
	        }
	    }

	    //$this->pr($payment_info);exit;

    	$title = "Client Statement";
        $data = $this->init($title);
        $data['clients'] = $this->client->get_client_list(array('order_by'=>'client_id'));
        $data['client_id'] = $client_id;
        $data['client_info'] = $client_info;
        $data['payment_info'] = $payment_info;
        $data['billing_info'] = $billing_info;

        if( isset($_GET['print']) && $_GET['print']=='true' ){
            $data["content"] = $this->load->view($this->theme."client/print_statement",$data);
        }else{
        	$data["content"] = $this->load->view($this->theme."client/statement",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }
    }

    public function clientSummary(){

         if( !$this->master->isPermission('see_client_summary') )
            show_404();

        $this->load->model('client_model','client');

        $title = "Full Client Summary";
        $data = $this->init($title);

        $data['lists'] = $this->master->get_all('tbl_billgenerates', array('cusom_order_by'=>'g_year desc, g_month desc', 'output'=>'result_array', 'group_by'=>'g_year, g_month'));

        if( isset($_GET['print']) && $_GET['print']=='true' ){
            $data["content"] = $this->load->view($this->theme."client/client_summary_print",$data);
        }else{
            $data["content"] = $this->load->view($this->theme."client/client_summary",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }

    }   

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */