<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends MY_Model {
    
    public $prefix_client;

    function __construct() {
        parent::__construct();
        $this->prefix_client = $this->settings['client_prefix'];
    }

    public function delete_packages_by_client($client_id){
        $this->db->where('client_id', $client_id);
        return $this->db->delete($this->client_package_table);
    }

    public function add($action){        
        $this->load->model('payment_model', 'payment');
        $this->load->model('history_model', 'history');
        $data = array();        
        $packages = $this->input->post('package', true);
        $data['client_id'] = $this->input->post('client_id', true);
        $data['old_client_id'] = $this->input->post('old_client_id', true);
        $data['full_name'] = $this->input->post('full_name', true);
        $data['mobile'] = $this->input->post('mobile', true);
        $data['email'] = $this->input->post('email', true);
        $data['gender'] = $this->input->post('gender', true);
        $data['client_type'] = $this->input->post('client_type', true);
        $data['address'] = $this->input->post('address', true);
        $data['address2'] = $this->input->post('address2', true);
        $data['profession'] = $this->input->post('profession', true);
        $data['resident'] = $this->input->post('resident', true);
        $data['zone'] = $this->input->post('zone', true);
        $data['house_no'] = $this->input->post('house_no', true);
        $data['floor'] = $this->input->post('floor', true);
        $data['apartment'] = $this->input->post('apartment', true);
        $data['payment_type'] = $this->input->post('payment_type', true);
        $data['connection_date'] = $this->input->post('connection_date', true);
        $data['summary'] = $this->input->post('summary', true);   
        $data['status'] = $this->input->post('status', true);    

        // If status is free then the payment type will be free autometically
        if ( $data['status']==5 ){
            $data['payment_type'] = 1;  // status and payment type both are free
        }


        $client_reg = $data;
        $client_reg['collector'] = $this->input->post('collector');
        $this->session->set_userdata(array('client_reg'=>$client_reg));
        
        if($action == 'insert')
        {              
            $this->db->trans_start();            

            // insert data into client table
            $data['created'] = $this->now;
            $data['added_by'] = $this->session->user_id;
            $this->insert($this->client_table, $data);
            $insert_id = $this->db->insert_id();
            
            // insert data in package
            $package_data = array();
            foreach($packages as $package){
                $p_data = array();
                $p_data['client_id'] = $insert_id;
                $p_data['package_id'] = $package;
                $package_data[] = $p_data;
            }
            $this->insert_batch($this->client_package_table, $package_data);

            $client_info = $this->get_client($insert_id);

            // insert data in history
            $history_data = array();
            $history_data['client_id']  = $insert_id;
            $history_data['added_by']   = $this->session->userdata('user_id'); 
            $history_data['meta_key']   = 'status'; 
            $history_data['status_id']  = $this->input->post('status', true); 
            $history_data['comment']    = "Opening"; 
            $history_data['added_time'] = $this->now; 
            $this->history->addHistory($history_data);
            $history_data['meta_key']   = 'ptype'; // payment type
            $history_data['status_id']   = $this->input->post('payment_type', true);
            $this->history->addHistory($history_data);
            $history_data['meta_key']   = 'ctype'; // client type
            $history_data['status_id']   = $this->input->post('client_type', true);
            $this->history->addHistory($history_data);
            foreach($packages as $package){
                $history_data['meta_key']   = 'package'; // Payment Package
                $history_data['status_id']  = $package;
                $this->history->addHistory($history_data);
            }


            // connection fee
            $payment_data['client_id'] = $insert_id;            
            $payment_data['billing_year'] = date('Y', strtotime($data['connection_date']));
            $payment_data['billing_month'] = date('m', strtotime($data['connection_date']));
            $payment_data['billing_date'] = $data['connection_date'];
            $payment_data['billing_type'] = 0; // connection
            $payment_data['bill_collector'] = $this->input->post('collector', true); 
            $payment_data['book_no'] = $this->session->userdata('user_id');//$this->input->post('bill_collector', true); 
            $payment_data['added_by'] = $this->session->userdata('user_id'); 
            $payment_data['created'] = $data['created']; 

            if( isset($this->settings['hide_connection_fee']) && $this->settings['hide_connection_fee'] == '1'){
                //nothing
            }
            else
            {
                if ( isset($_POST['conn_bill']) && $this->input->post('conn_bill') == '1'){
                    $payment_data['monthly_bill'] = $this->input->post('connection_fee', true);
                    $payment_data['amount'] = $this->input->post('connection_fee', true);
                    $this->payment->add($payment_data); // payment as connection fee
                }
            }

            // first bill only for prepaid user
            if( isset($this->settings['hide_first_bill']) && $this->settings['hide_first_bill'] == '1'){
                //nothing
            }
            else
            {
                // insert first bill when client is prepaid and status is active (2)
                if ( isset($_POST['month_bill']) && $this->input->post('month_bill') == '1'){
                    if($client_info->payment_type == 2 && $client_info->status==2){
                        $payment_data['monthly_bill'] = $client_info->total ;
                        $payment_data['amount'] = $this->input->post('first_bill', true);
                        //$payment_data['bill_status'] = 1; 
                        $payment_data['billing_type'] = 2; // first bill
                        $this->payment->add($payment_data); // payment as first bill
                    }
                }
            }
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }
            else{
                return $insert_id;
            }
        }
        else
        {
            $data['updated'] = $this->now;
            $data['added_by'] = $this->session->user_id;
            $id = (int)$this->input->post('id', true);

            if ( empty($id) )
                return false;



            $this->db->trans_start();
            
            // History
            $history_status = $history_package = $history_ctype = $history_ptype = true;
            $pre_info = $this->get_client($id);
            if($data['status']==$pre_info->status)
                $history_status = false;
            if($data['client_type']==$pre_info->client_type)
                $history_ctype = false;
            if($data['payment_type']==$pre_info->payment_type)
                $history_ptype = false;
            
            //if($packages==array_keys($pre_info->packages))
             //   $history_package = false;

            asort($packages);
            $selected_packages = array();
            foreach($packages as $item){
                $selected_packages[] = $item;
            }
            $p_packaages = array_keys($pre_info->packages);
            asort($p_packaages);
            $previous_packages = array();
            foreach($p_packaages as $item){
                $previous_packages[] = $item;
            }

            if( $selected_packages == $previous_packages)
                $history_package = false;

            // echo $history_package;
            // print_r($previous_packages);
            // print_r($selected_packages);exit;

            // insert data in package
            if($history_package) {
                if($this->delete_packages_by_client($id)) {
                    $package_data = array();
                    foreach ($packages as $package) {
                        $p_data = array();
                        $p_data['client_id'] = $id;
                        $p_data['package_id'] = $package;
                        $package_data[] = $p_data;
                    }
                    $this->insert_batch($this->client_package_table, $package_data);
                }
            }

            $history_data = array();
            $history_data['client_id']  = $id;
            $history_data['added_by']   = $this->session->userdata('user_id'); 
            $history_data['comment']    = "Updating"; 
            $history_data['added_time'] = $this->now; 

            if($history_status){
                $history_data['meta_key']   = 'status'; 
                $history_data['status_id']  = $this->input->post('status', true); 
                $this->history->addHistory($history_data);
            }
            if($history_ptype){
                $history_data['meta_key']   = 'ptype'; // payment type
                $history_data['status_id']   = $this->input->post('payment_type', true);
                $this->history->addHistory($history_data);
            }
            if($history_ctype){
                $history_data['meta_key']   = 'ctype'; // client type
                $history_data['status_id']   = $this->input->post('client_type', true);
                $this->history->addHistory($history_data);
            }
            if($history_package){
                foreach($packages as $package){
                    $history_data['meta_key']   = 'package'; // Payment Package
                    $history_data['status_id']  = $package;
                    $this->history->addHistory($history_data);
                }
            }

            $this->update($this->client_table, $id, $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                return false;
            }
            else
                return true;
        }
    }

    public function changeStatus($client_id, $status_id){

        if ( $status_id==5 ){ // if status free then force to payment type free
            $this->update($this->client_table, $client_id, array('status'=>$status_id, 'payment_type'=>1));
        }else{
            $this->update($this->client_table, $client_id, array('status'=>$status_id));
        }
        
        $this->load->model('history_model', 'history');
        $history_data = array();
        $history_data['client_id']  = $client_id;
        $history_data['added_by']   = $this->session->userdata('user_id'); 
        $history_data['comment']    = "Changed Status"; 
        $history_data['added_time'] = $this->now; 
        $history_data['meta_key']   = 'status'; 
        $history_data['status_id']  = $status_id; 
        $this->history->addHistory($history_data);
    }

    public function remove($id){
        $this->update($this->client_table, $id, array('status'=>1));
        
        $this->load->model('history_model', 'history');
        $history_data = array();
        $history_data['client_id']  = $id;
        $history_data['added_by']   = $this->session->userdata('user_id'); 
        $history_data['comment']    = "Disconnected"; 
        $history_data['added_time'] = $this->now; 
        $history_data['meta_key']   = 'status'; 
        $history_data['status_id']  = 1; 
        $this->history->addHistory($history_data);
    }

    public function get_client_types(){
        return array(
            array('text'=>'Analog', 'value'=>'1'),
            array('text'=>'Digital', 'value'=>'2'),
            array('text'=>'D.T.S', 'value'=>'3'),
            array('text'=>'Internet', 'value'=>'4')
            );
    }
    public function get_client_type($index=1){
        return @$this->get_client_types()[$index-1];
    }

    public function get_payment_types(){
        return array(
            array('text'=>'Free', 'value'=>'1'),
            array('text'=>'Prepaid', 'value'=>'2'),
            array('text'=>'Postpaid', 'value'=>'3')
            );
    }
    public function get_payment_type($index=1){
        return $this->get_payment_types()[$index<1?0:$index-1];
    }

    public function get_residents(){
        return array(
            array('text'=>'Present', 'value'=>'1'),
            array('text'=>'Permanent', 'value'=>'2')
            );
    }
    public function get_resident($index=1){
        return $this->get_residents()[$index<1?0:$index-1];
    }

    public function get_statuses(){
        return array(
            array('text'=>'Disconnect', 'value'=>'1'),
            array('text'=>'Active', 'value'=>'2'),
            array('text'=>'Inactive', 'value'=>'3'),
            array('text'=>'Hold', 'value'=>'4'),
            array('text'=>'Free', 'value'=>'5')
            );
    }
    public function get_status($index=1){
        return $this->get_statuses()[$index<1?0:$index-1];
    }

    public function get_due_types(){
        return array(
            array('text'=>'1st Month', 'value'=>'1'),
            array('text'=>'2nd Month', 'value'=>'2'),
            array('text'=>'3rd Month', 'value'=>'3'),
            array('text'=>'4th Month', 'value'=>'4'),
            array('text'=>'5th Month', 'value'=>'5'),
            array('text'=>'6th Month', 'value'=>'6'),
            array('text'=>'All', 'value'=>'all'),
            );
    }

    public function get_adv_types(){
        return array(
            array('text'=>'1st Month', 'value'=>'1'),
            array('text'=>'2nd Month', 'value'=>'2'),
            array('text'=>'3rd Month', 'value'=>'3'),
            array('text'=>'4th Month', 'value'=>'4'),
            array('text'=>'5th Month', 'value'=>'5'),
            array('text'=>'6th Month', 'value'=>'6'),
            array('text'=>'All', 'value'=>'all'),
            );
    }

    

    /**
     * getting packages by client
     * @param $client_id
     * @return array
     */
    public function get_packages_by_client($client_id){
        $this->db->select('id, title, slug, price, vat, total');
        $this->db->where_in($this->package_table.'.id', 'select package_id from '.$this->client_package_table.' where client_id='.$client_id, false);
        $query = $this->db->get($this->package_table);
        return $query->result_array();
    }


    public function get_client($id="")
    {
        $this->db->select($this->client_table.'.*, zn.title zone, zn.id zone_id, ad.title address, ad.id address_id, ap.title apartment, ap.id apartment_id, fl.title floor, fl.id floor_id');
        $this->db->join('tbl_addresss ad','ad.id=tbl_clients.address', 'left');
        $this->db->join('tbl_zones zn','zn.id=tbl_clients.zone', 'left');
        $this->db->join('tbl_apartments ap','ap.id=tbl_clients.apartment', 'left');
        $this->db->join('tbl_floors fl','fl.id=tbl_clients.floor', 'left');


        $this->db->where($this->client_table.".id",$id);
        $query = $this->db->get($this->client_table);
        //echo $this->db->last_query();exit;
        $result = $query->row();
        $packages_arr = $this->get_packages_by_client($id);
        $packages = $package_ids = array();
        $vat = $price = $total = 0;
        foreach($packages_arr as $arr){
            $packages[$arr['id']] = $arr['title'];
            $package_ids[] = $arr['id'];
            $vat = $vat + $arr['vat'];
            $price = $price + $arr['price'];
            $total = $total + $arr['total'];
        }
        $result->price = $price;
        $result->vat = $vat;
        $result->total = $total;
        $result->packages = $packages;
        $result->client_type_text = $this->get_client_type($result->client_type)['text'];
        $result->payment_type_text = $this->get_payment_type($result->payment_type)['text'];
//        $this->pr($result);exit;
        return $result;
    }

    public function get_client_list($filter_data=array())
    {
        if( isset($filter_data['order_by']) && !empty($filter_data['order_by']) )
        {
            $order_type = isset($filter_data['order_type']) ? $filter_data['order_type'] : 'ASC';
            $this->db->order_by($filter_data['order_by'], $order_type);
        }
        $query = $this->db->get($this->client_table);
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    // if set only advance and due type filter
    public function getDueOrAdvClientIds($filter_data)
    {
        $client_ids = array();
        $is_due_or_adv = false;
        // DueType
        if( isset($filter_data['dueType']) && !empty($filter_data['dueType']) )
        {
            
            $dueAbove = isset($filter_data['dueAbove'])?$filter_data['dueAbove']:false;
            $dueBelow = isset($filter_data['dueBelow'])?$filter_data['dueBelow']:false;
            $is_due_or_adv = true;
            $dueTypeClients = $this->payment->getDueClients($filter_data['dueType'], $dueAbove, $dueBelow);
            
            $client_ids = array_merge($client_ids, $dueTypeClients);
        }
        // AdvType
        if( isset($filter_data['advType']) && !empty($filter_data['advType']) )
        {
            $advAbove = isset($filter_data['advAbove'])?$filter_data['advAbove']:false;
            $advBelow = isset($filter_data['advBelow'])?$filter_data['advBelow']:false;
            $is_due_or_adv = true;
            $advTypeClients = $this->payment->getAdvClients($filter_data['advType'], $advAbove, $advBelow);
            $client_ids = array_merge($client_ids, $advTypeClients);
        }

        return $client_ids;
    }

    public function get_clients($filter_data=array())
    {
        $this->load->model('payment_model', 'payment');

        $this->db->select($this->client_table.'.id');
        $this->db->join('tbl_addresss','tbl_addresss.id=tbl_clients.address', 'left');
        $this->db->join('tbl_zones','tbl_zones.id=tbl_clients.zone', 'left');
        $this->db->join('tbl_apartments','tbl_apartments.id=tbl_clients.apartment', 'left');
        $this->db->join('tbl_floors','tbl_floors.id=tbl_clients.floor', 'left');


        // Client Type
        if( isset($filter_data['client_type']) && !empty($filter_data['client_type']) )
        {
            $this->db->where("client_type", $filter_data['client_type']);
        }

        // client ID Alias
        if( isset($filter_data['client_id_alias']) && !empty($filter_data['client_id_alias']) )
        {
            $this->db->where("client_id", $filter_data['client_id_alias']);
        }
        
        // Payment Type
        if( isset($filter_data['payment_type']) && !empty($filter_data['payment_type']) )
        { 
            if ( is_array($filter_data['payment_type']) )
                $this->db->where_in("payment_type", $filter_data['payment_type']);
            else
                $this->db->where("payment_type", $filter_data['payment_type']);
        }

        // Package
        if( isset($filter_data['package_id']) && !empty($filter_data['package_id']) )
        {
            $this->db->join('tbl_client_packages','tbl_client_packages.client_id=tbl_clients.id', 'left');
            $this->db->where("package_id", $filter_data['package_id']);
        }

        // status
        if( isset($filter_data['status']) && !empty($filter_data['status']) )
        {
            if ( is_array($filter_data['status']) )
                $this->db->where_in("tbl_clients.status", $filter_data['status']);
            else
                $this->db->where("tbl_clients.status", $filter_data['status']);
        }

        // Address
        if( isset($filter_data['address']) && !empty($filter_data['address']) )
        {
            $this->db->where("address", $filter_data['address']);
        }

        // Zone
        if( isset($filter_data['zone']) && !empty($filter_data['zone']) )
        {
            $this->db->where("zone", $filter_data['zone']);
        }

        // Floor
        if( isset($filter_data['floor']) && !empty($filter_data['floor']) )
        {
            $this->db->where("floor", $filter_data['floor']);
        }

        // Apartment
        if( isset($filter_data['apartment']) && !empty($filter_data['apartment']) )
        {
            $this->db->where("apartment", $filter_data['apartment']);
        }

        // House
        if( isset($filter_data['house_no']) && !empty($filter_data['house_no']) )
        {
            $this->db->where("house_no", $filter_data['house_no']);
        }

        // Name/Mobile
        if( isset($filter_data['txtInput']) && !empty($filter_data['txtInput']) )
        {
            $this->db->or_where("client_id", $filter_data['txtInput']);
            $this->db->or_like("full_name", $filter_data['txtInput']);
            $this->db->or_like("mobile", $filter_data['txtInput']);
            $this->db->or_like("summary", $filter_data['txtInput']);
        }

        // From Date/To Date
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            $this->db->where("connection_date>=", $filter_data['from_date']);
        }
        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            $this->db->where("connection_date<=", $filter_data['to_date']);
        }

        /**
        * Gettings client ids if set dueType or AdvType
        */
        $client_ids = array();
        $is_due_or_adv = false;
        // DueType
        if( isset($filter_data['dueType']) && !empty($filter_data['dueType']) )
        {
            
            $dueAbove = isset($filter_data['dueAbove'])?$filter_data['dueAbove']:false;
            $dueBelow = isset($filter_data['dueBelow'])?$filter_data['dueBelow']:false;
            $is_due_or_adv = true;
            $dueTypeClients = $this->payment->getDueClients($filter_data['dueType'], $dueAbove, $dueBelow);
            
            $client_ids = array_merge($client_ids, $dueTypeClients);
        }
        // AdvType
        if( isset($filter_data['advType']) && !empty($filter_data['advType']) )
        {
            $advAbove = isset($filter_data['advAbove'])?$filter_data['advAbove']:false;
            $advBelow = isset($filter_data['advBelow'])?$filter_data['advBelow']:false;
            $is_due_or_adv = true;
            $advTypeClients = $this->payment->getAdvClients($filter_data['advType'], $advAbove, $advBelow);
            $client_ids = array_merge($client_ids, $advTypeClients);
        }

        if( !empty($client_ids) && $is_due_or_adv ){
            $this->db->where_in('tbl_clients.id', $client_ids);
        }
        elseif( empty($client_ids) && $is_due_or_adv ){
            $this->db->where('tbl_clients.id<', 1); // to not show any client
        }

        $this->db->order_by('zone', 'ASC');
        $this->db->order_by('house_no', 'ASC');
        $query = $this->db->get($this->client_table);
        // echo $this->db->last_query();exit;
        $result_arr = $query->result();
        $results = array();
        if (!empty($result_arr))
            foreach ($result_arr as $row){
                $results[] = $this->get_client($row->id);
            }
        //$this->pr($results);exit;
        return $results;
    }


    public function get_new_client_id($prefix=''){
        
        if( isset($this->settings['is_client_prefix_by_zone']) && $this->settings['is_client_prefix_by_zone'] == '1' && $prefix == ''){
            $zones = $this->master->get_all($this->zone_table);
            if( !empty($zones) )
            $this->prefix_client = $zones[0]->slug;
        }

        if($prefix != '')
            $this->prefix_client = $prefix;

        $this->db->select("MAX(CAST(REPLACE(client_id, '".ucwords($this->prefix_client)."','') AS UNSIGNED)) as client_id");
        $this->db->like('client_id', $this->prefix_client);
        //$this->db->order_by("id","DESC");
        //$this->db->limit(1);
        $query = $this->db->get($this->client_table);
        //echo $this->db->last_query();exit;
        $row = $query->row();
        if( isset($row) ){
            // $client_id = (int)substr($row->client_id, 1) + 1;
            $client_id = (int)$row->client_id + 1;
            return (empty($this->prefix_client))?'':ucwords($this->prefix_client).$client_id;
        }else
        return (empty($this->prefix_client))?'':ucwords($this->prefix_client).'1';
    }
    
    

    // helping to debuging
    function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
   
}
