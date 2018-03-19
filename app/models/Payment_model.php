<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends MY_Model {

    protected $table = 'tbl_payments';
    protected $id = 'id';

    function __construct() {
        parent::__construct();
    }

    public function add($data){        
        $this->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updatePayment($id, $data){        
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function currencyFormat($amount){
        if($amount == 0)
            $format_amount = '0.00 '.$this->settings['currency'];
        else
            $format_amount = number_format($amount, 2).' '.$this->settings['currency'];
        
        return $format_amount;
    }

    function getByClientAndDate($clientId, $date)
    {
        $this->db->where('payment_date', $date);
        $this->db->where('client_id', $clientId);
        return $this->db->get($this->table)->result();
    }













    
    public function get_payment($id="")
    {
        $this->db->where("id",$id);
        $this->db->order_by("id","DESC");
        $query = $this->db->get($this->payment_table);

        return $query->row();
    }

    




    public function get_payments($filter_data=array())
    {

        /**
        * Gettings client ids if set dueType or AdvType
        */
        $client_ids = array();

        $this->db->select('sum(amount) total_amount, sum(discount) total_discount, (select name from tbl_users u where u.id=p.added_by) as added_user, m.*');
        $this->db->join('tbl_members m','p.client_id=m.id');

        // $this->db->where("cn.status>",0);

        // Client ID
        if( isset($filter_data['client_id']) && !empty($filter_data['client_id']) )
        {
            $this->db->where("m.id", $filter_data['client_id']);
        }

        // status
        if( isset($filter_data['status']) && !empty($filter_data['status']) )
        {
            $this->db->where("m.status", $filter_data['status']);
        }


        // Name/Mobile
        if( isset($filter_data['txtInput']) && !empty($filter_data['txtInput']) )
        {
            $this->db->like("name", $filter_data['txtInput']);
            $this->db->or_like("mobile", $filter_data['txtInput']);
            $this->db->or_like("summary", $filter_data['txtInput']);
        }

        // From Date/To Date
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            $this->db->where("payment_date>=", $filter_data['from_date']);
        }
        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            $this->db->where("billing_date<=", $filter_data['to_date']);
        }

        // Limit
        if( isset($filter_data['limit']) && !empty($filter_data['limit']) )
        {
            $this->db->limit($filter_data['limit'][1], $filter_data['limit'][0]); // $limit0, $limit1
        }

        $this->db->group_by("m.id");
        $this->db->group_by("added_user");
        // $this->db->order_by('payment_date', 'DESC');
        $query = $this->db->get($this->payment_table.' p');
        //print_r($filter_data);
        // echo $this->db->last_query();exit;

        return $query->result();
    }





    public function get_cur_month_payment($client_id, $cur_year='', $cur_month='', $amount_only=true){
        $cur_year = $cur_year=='' ? date('Y') : $cur_year;
        $cur_month = $cur_month=='' ? date('m') : $cur_month;
        $this->db->select('*');
        $this->db->where('client_id', $client_id);
        $this->db->where('billing_month', $cur_month);
        $this->db->where('billing_year', $cur_year);
        //$this->db->where_in('billing_type', array(2,3,4)); // 2bill, 4advance
        $this->db->order_by('payment_id', 'DESC');
        $query = $this->db->get($this->payment_table);
        
        if($amount_only){
            $cur_month_payment = 0;
            $result = $query->result();
            if(is_array($result) && !empty($result)){
                foreach($result as $payment){
                    $cur_month_payment += $payment->amount + $payment->discount;
                }
            }
            return $cur_month_payment;
        }
        else
            return $query->result();
    }

    public function get_date_range_payment($client_id='', $from_date='', $to_date='', $billing_type=''){
        
        $this->db->select('*, (SELECT DISTINCT name FROM tbl_users WHERE tbl_users.id=bill_collector) as collector');

        if($client_id != '')
        $this->db->where('client_id', $client_id);

        if($from_date != '' && $to_date != ''){
            $this->db->where('billing_date >=', $from_date);
            $this->db->where('billing_date <=', $to_date);
        }

        if( $billing_type != '')
        $this->db->where('billing_type', $billing_type); // type bill 2, 3 as advance

        $this->db->order_by('payment_id', 'DESC');
        $query = $this->db->get($this->payment_table);
        return $query->result();
    }

    public function get_con_recon_payment($client_id, $bill_type = 0){
        $this->db->select('*');
        $this->db->where('client_id', $client_id);
        $this->db->where('billing_type = $bill_type', null, false); // 0 connection payment
        $this->db->order_by('payment_id', 'DESC');
        $query = $this->db->get($this->payment_table);
        return $query->result();
    }

    public function getHoldAmount($filter_data=array())
    {
        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            $from_date = $filter_data['from_date'];
        }else{
            $from_date = $this->settings['default_date'];
        }

        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            $to_date = $filter_data['to_date'];
        }else{
            $to_date = date('Y-m-d');
        }

        $this->db->select("
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and cn.status<>2) then monthly_bill else 0 end) billed_none_active_user_till_todate,
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and cn.status<>2) then amount+discount else 0 end) paid_none_active_user_till_todate,
            sum(case when(billing_date<='$to_date' and cn.status<>2) then monthly_bill else 0 end) total_billed_none_active_user,
            sum(case when(billing_date<='$to_date' and cn.status<>2) then amount+discount else 0 end) total_paid_none_active_user
        ");

        $this->db->join('tbl_clients cn','tbl_payments.client_id=cn.id');
        // $this->db->where('cn.status<>', 2);
        $result = $this->db->get($this->payment_table)->row();
        // echo $this->db->last_query();exit;
        return $result;
    }

    public function get_payments_report($filter_data=array())
    {

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


        if( isset($filter_data['from_date']) && !empty($filter_data['from_date']) )
        {
            $from_date = $filter_data['from_date'];
        }else{
            $from_date = $this->settings['default_date'];
        }

        if( isset($filter_data['to_date']) && !empty($filter_data['to_date']) )
        {
            $to_date = $filter_data['to_date'];
        }else{
            $to_date = date('Y-m-d');
        }


        $this->db->select(" 
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and billing_type = 2) then monthly_bill else 0 end) monthly_bill, 
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and billing_type <> 2) then monthly_bill else 0 end) adj_bill, 
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and billing_type = 2) then amount else 0 end) monthly_paid,
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date') then amount else 0 end) paid,
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and billing_type in (0,1,3,4)) then amount else 0 end) adj_paid,
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date') then discount else 0 end) discount,
            sum(case when(billing_date<='$to_date') then monthly_bill else 0 end) monthly_bill_from_begening,
            sum(case when(billing_date<='$to_date') then amount else 0 end) paid_from_begening,
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and cn.status<>2) then monthly_bill-discount else 0 end) billed_none_active_user_till_todate,
            sum(case when(billing_date>='$from_date' and billing_date<='$to_date' and cn.status<>2) then amount else 0 end) paid_none_active_user_till_todate,
            sum(case when(billing_date<='$to_date' and cn.status<>2) then monthly_bill-discount else 0 end) total_billed_none_active_user,
            sum(case when(billing_date<='$to_date' and cn.status<>2) then amount else 0 end) total_paid_none_active_user,
            sum(case when(billing_date<='$to_date') then discount else 0 end) discount_from_begening, cn.id as client_id, cn.client_id as client_id_alias, cn.full_name as client_name");

        $this->db->join('tbl_clients cn','tbl_payments.client_id=cn.id');

        //$this->db->where("cn.status>", 0);

        $this->db->having('monthly_bill>0 or adj_bill>0 or paid>0 or discount>0');

        // Client ID
        if( isset($filter_data['client_id']) && !empty($filter_data['client_id']) )
        {
            $this->db->where("cn.id", $filter_data['client_id']);
        }

        // Client IDs
        if( isset($filter_data['client_ids']) && !empty($filter_data['client_ids']) )
        {
            $this->db->where_in("cn.id", $filter_data['client_ids']);
        }

        // Client Type
        if( isset($filter_data['client_type']) && !empty($filter_data['client_type']) )
        {
            $this->db->where("client_type", $filter_data['client_type']);
        }
        
        // Payment Type
        if( isset($filter_data['payment_type']) && !empty($filter_data['payment_type']) )
        {
            $this->db->where("payment_type", $filter_data['payment_type']);
        }

        // Billing Type
        if( isset($filter_data['billing_type']) && !empty($filter_data['billing_type']) )
        {

             $this->db->where("billing_type", $filter_data['billing_type']);
        }// connection bill
        elseif ( isset($filter_data['billing_type']) && $filter_data['billing_type']=='0' ){
             $this->db->where("billing_type=0");
        }

        // Package
        if( isset($filter_data['package_id']) && !empty($filter_data['package_id']) )
        {
            $this->db->join('tbl_client_packages pk','pk.client_id=cn.id', 'left');
            $this->db->where("package_id", $filter_data['package_id']);
        }

        // status
        if( isset($filter_data['status']) && !empty($filter_data['status']) )
        {
            $this->db->where("cn.status", $filter_data['status']);
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

        // Book No
        if( isset($filter_data['book_no']) && !empty($filter_data['book_no']) )
        {
            $this->db->where("book_no", $filter_data['book_no']);
        }

        // Name/Mobile
        if( isset($filter_data['txtInput']) && !empty($filter_data['txtInput']) )
        {
            $this->db->like("full_name", $filter_data['txtInput']);
            $this->db->or_like("mobile", $filter_data['txtInput']);
            $this->db->or_like("summary", $filter_data['txtInput']);
        }


        if( isset($filter_data['collector']) && !empty($filter_data['collector']) )
        {
            $this->db->where("bill_collector", $filter_data['collector']);
        }


        if( !empty($client_ids) && $is_due_or_adv ){
            $this->db->where_in('cn.id', $client_ids);
        }
        elseif( empty($client_ids) && $is_due_or_adv ){
            $this->db->where('cn.id<', 1); // to not show any client
        }

        // Group By for Separate billing type or together
        if( 
            ( isset($filter_data['together']) && !empty($filter_data['together']) ) ||
            ( isset($filter_data['all_sum']) && $filter_data['all_sum']==true )
        )
        {
            //nothing $this->db->group_by("tbl_clients.id");
        }else{
            $this->db->group_by("billing_type");
        }

        // Limit
        if( isset($filter_data['limit']) && !empty($filter_data['limit']) )
        {
            $this->db->limit($filter_data['limit'][1], $filter_data['limit'][0]); // $limit0, $limit1
        }

        // Group By with client ID
        if ( isset($filter_data['all_sum']) && $filter_data['all_sum']==true ){
            $this->db->group_by("cn.id"); // all_sum will not work for all calculation like present month adv
        }else{
            $this->db->group_by("cn.id");
        }

        // $this->db->order_by('billing_date', 'DESC');
        $query = $this->db->get($this->payment_table);
        //print_r($filter_data);
        // echo $this->db->last_query();exit;

        return $this->paymentReportCalculation($query->result());
    }

    private function paymentReportCalculation($results){

        //dd($results, false);

        $total_monthly_billed       = 0;
        $total_monthly_other_billed = 0;
        $total_monthly_discount     = 0;
        $total_all_monthly_billed   = 0;
        $total_footer_billed        = 0;
        $total_monthly_paid         = 0;
        $total_adj_paid             = 0;

        $total_all_paid             = 0;
        $total_paid_without_adv     = 0;

        $total_previous_due         = 0;
        $total_previous_advance     = 0;
        $total_cuted_previous_advance       = 0;
        $total_previous_advance_after_cuted = 0;

        $total_present_due          = 0;
        $total_present_advance      = 0;


        $total_present_month_advance_only      = 0;
        $total_present_month_advance           = 0;

        // none active user
        $billed_none_active_user_till_todate = 0;
        $paid_none_active_user_till_todate = 0;
        $total_billed_none_active_user = 0;
        $total_paid_none_active_user   = 0;

        if (!empty($results))
        {
            foreach ($results as $key => &$value) {              

                $previous_due_or_adv    = ($value->monthly_bill_from_begening - $value->monthly_bill - $value->adj_bill) - (($value->paid_from_begening - $value->monthly_paid - $value->adj_paid) + ($value->discount_from_begening - $value->discount)); 
                $previous_due           = $previous_due_or_adv>0 ? $previous_due_or_adv : 0;
                $value->previous_due = $previous_due;
                $previous_advance       = $previous_due_or_adv<0 ? abs($previous_due_or_adv) : 0; 
                $value->previous_advance = $previous_advance;

                $cuted_previous_advance = $value->monthly_bill<=$previous_advance ? $value->monthly_bill : $previous_advance;
                $value->cuted_previous_advance = $cuted_previous_advance;    


                $total_billed           = $value->monthly_bill + $value->adj_bill + $previous_due - $cuted_previous_advance - $value->discount;
                $value->total_billed = $total_billed; 


                $total_paid             = $value->paid;// + $value->discount;
                $value->total_paid = $total_paid; 
                $present_due_or_advance = $value->monthly_bill + $value->adj_bill + $previous_due - $previous_advance - $value->discount - $total_paid;
                $present_due            = $present_due_or_advance>0 ? $present_due_or_advance : 0;
                $value->present_due = $present_due; 
                $present_advance        = $present_due_or_advance<0 ? abs($present_due_or_advance) : 0;
                $value->present_advance = $present_advance; 

                // Footer Value Calculation
                $total_monthly_billed       += $value->monthly_bill;
                $total_footer_billed        += $total_billed;
                $total_monthly_paid         += $value->monthly_paid;
               
                $total_all_paid             += $total_paid;
                $total_monthly_discount     += $value->discount;
                $total_monthly_other_billed += $value->adj_bill;

                $total_adj_paid             += $value->adj_paid;

                $value->paid_without_adv    =  $total_paid>=$value->monthly_bill ? $value->monthly_bill : $total_paid;
                $total_paid_without_adv     += $value->paid_without_adv;

                $total_previous_due         += $previous_due;
                $total_previous_advance     += $previous_advance;
                $total_cuted_previous_advance     += $cuted_previous_advance;

                $previous_advance_after_cuted = $previous_advance - $cuted_previous_advance;
                $total_previous_advance_after_cuted += $previous_advance_after_cuted;
                $value->previous_advance_after_cuted = $previous_advance_after_cuted;


                // present month advance only
                $total_present_due          += $present_due;
                $total_present_advance      += $present_advance;

                // $present_month_advance_only = $present_advance - $previous_advance_after_cuted; 
                $present_month_advance_only = $total_paid-$value->paid_without_adv ;//$total_paid-$present_month_advance_only;
                $value->present_month_advance_only = $present_month_advance_only;
                $total_present_month_advance_only += $value->present_month_advance_only;
                $total_present_month_advance += $value->present_month_advance_only + $value->previous_advance_after_cuted;
                $value->total_present_month_advance = $total_present_month_advance;
                // present month advance only


                $billed_none_active_user_till_todate += $value->billed_none_active_user_till_todate; 
                $paid_none_active_user_till_todate += $value->paid_none_active_user_till_todate; 
                $value->due_adv_none_active_user_till_todate = $value->billed_none_active_user_till_todate - $value->paid_none_active_user_till_todate;

                $total_billed_none_active_user += $value->total_billed_none_active_user; 
                $total_paid_none_active_user += $value->total_paid_none_active_user; 
                $value->total_due_adv_none_active_user = $value->total_billed_none_active_user - $value->total_paid_none_active_user;
            }

            $due_adv_none_active_user_till_todate = $billed_none_active_user_till_todate - $paid_none_active_user_till_todate;
            $total_due_adv_none_active_user = $total_billed_none_active_user - $total_paid_none_active_user;

            $results[] = (object) array(
                'total_monthly_billed'          => $total_monthly_billed,
                'total_monthly_other_billed'    => $total_monthly_other_billed,
                'total_monthly_discount'        => $total_monthly_discount,
                'total_monthly_paid'            => $total_monthly_paid,
                'total_adj_paid'                => $total_adj_paid,
                'total_all_paid'                => $total_all_paid,
                'total_paid_without_adv'        => $total_paid_without_adv,
                'total_previous_due'            => $total_previous_due,
                'total_previous_advance'        => $total_previous_advance,
                'total_present_due'             => $total_present_due,
                'total_present_advance'         => $total_present_advance,
                'total_present_month_advance_only' => $total_present_month_advance_only,
                'total_present_month_advance' => $total_present_month_advance,
                'total_all_monthly_billed'      => $total_footer_billed,
                'total_cuted_previous_advance'      => $total_cuted_previous_advance,
                'total_previous_advance_after_cuted'      => $total_previous_advance_after_cuted,
                'total_billed_none_active_user' => $total_billed_none_active_user,
                'total_paid_none_active_user' => $total_paid_none_active_user,
                'total_due_adv_none_active_user' => $total_due_adv_none_active_user,
                'billed_none_active_user_till_todate' => $billed_none_active_user_till_todate,
                'paid_none_active_user_till_todate' => $paid_none_active_user_till_todate,
                'due_adv_none_active_user_till_todate' => $due_adv_none_active_user_till_todate
            );

        }

        return $results;

        
        
    }

    

    // Due and Paid List
    public function get_paid_or_due_list($year='', $month='', $type='due', array $options=array())
    {
        $dates = $this->master->rangeMonth($year.'-'.$month.'-01');
        // together payment only status 2(active clients)
        $results = $this->get_payments_report(array_merge(['from_date'=>$dates['start'], 'to_date'=>$dates['end'], 'status'=>2, 'together' => 1], $options) );

        //echo $this->db->last_query();        
        // $this->pr($results);exit;
        // 
        

        /**
        * Gettings client ids if set dueType or advType
        */
        $client_ids = $this->client->getDueOrAdvClientIds($options);
        // dd($client_ids);
        //end duetype


        $total_data = end($results);
        array_pop($results); // remove total data

        $outputList = array();
        if (!empty($results))
        {
            foreach($results as $value){

                if( !empty($client_ids) ){
                    if( !in_array($value->client_id, $client_ids) )
                        continue;
                }

                // Due List
                if ($type=='due' && $value->present_due>0){
                    $client = $this->client->get_client($value->client_id);
                    $extra_data = array('client_id'=>$value->client_id, 'previous_due'=>$value->previous_due, 'previous_advance'=>$value->previous_advance);
                    $marge_data = array_merge( (array)$value, (array)$client, $extra_data);
                    $outputList[] = (object)$marge_data;
                }

                // Paid List
                if ($type=='paid' && ($value->paid>0 || $value->previous_advance>0) ){
                    $client = $this->client->get_client($value->client_id);
                    $extra_data = array('client_id'=>$value->client_id, 'previous_due'=>$value->previous_due, 'previous_advance'=>$value->previous_advance, 'present_advance'=>$value->present_advance);
                    $marge_data = array_merge( (array)$value, (array)$client, $extra_data);
                    $outputList[] = (object)$marge_data;
                }

                // Paid List
                if ($type=='paid_from_adv' && $value->previous_advance>0){
                    $client = $this->client->get_client($value->client_id);
                    $extra_data = array('client_id'=>$value->client_id, 'previous_due'=>$value->previous_due, 'previous_advance'=>$value->previous_advance, 'present_advance'=>$value->present_advance);
                    $marge_data = array_merge( (array)$value, (array)$client, $extra_data);
                    $outputList[] = (object)$marge_data;
                }
            }
        }
        $outputList[] = $total_data;
        return $outputList;
        //$this->pr($outputList);exit;
    }

    public function get_due_payments1100000($year='', $month='', $all=true)
    {
        if ($year=='' && $month==''){
            $this->db->select('
                payment_id, 
                SUM(CASE WHEN (billing_year=(SELECT MAX(billing_year) FROM tbl_payments) AND billing_month=(SELECT MAX(billing_month) FROM tbl_payments)) THEN monthly_bill ELSE 0 END) AS monthly_bill, 
                sum(monthly_bill) total_monthly_bill, 
                sum(amount+discount) as total_amount, 
                sum(amount) as amount, 
                sum(discount) as discount,  
                max(billing_date) billing_date, 
                max(billing_year) as billing_year, 
                billing_type, 
                book_no, 
                (select name from tbl_users u where u.id=bill_collector) as collector, 
                '.$this->client_table.'.*, 
                tbl_zones.title zone, 
                tbl_addresss.title address, 
                tbl_apartments.title apartment, 
                tbl_floors.title floor');
        }else{
            $this->db->select('
                payment_id, 
                SUM(CASE WHEN (billing_year='.$year.' AND billing_month='.$month.') THEN monthly_bill ELSE 0 END) AS monthly_bill, 
                sum(monthly_bill) total_monthly_bill, 
                sum(amount+discount) as total_amount, 
                sum(amount) as amount, 
                sum(discount) as discount,  
                max(billing_date) billing_date, 
                max(billing_year) as billing_year, 
                billing_type, 
                book_no, 
                (select name from tbl_users u where u.id=bill_collector) as collector, 
                '.$this->client_table.'.*, 
                tbl_zones.title zone, 
                tbl_addresss.title address, 
                tbl_apartments.title apartment, 
                tbl_floors.title floor');
            $this->db->where('tbl_payments.billing_date<=', $year.'-'.$month.'-31');
        }

        if ($all==false){
            $this->db->where('tbl_payments.billing_year', $year);
            $this->db->where('tbl_payments.billing_month', $month);
        }

        $this->db->join('tbl_clients','tbl_payments.client_id=tbl_clients.id');
        $this->db->join('tbl_addresss','tbl_addresss.id=tbl_clients.address', 'left');
        $this->db->join('tbl_zones','tbl_zones.id=tbl_clients.zone', 'left');
        $this->db->join('tbl_apartments','tbl_apartments.id=tbl_clients.apartment', 'left');
        $this->db->join('tbl_floors','tbl_floors.id=tbl_clients.floor', 'left');

        $this->db->where("tbl_clients.payment_type>",1); // 1 for free client
        $this->db->where("tbl_clients.status",2); // 2 for active clients only

        $this->db->group_by("tbl_clients.id");
        $this->db->order_by('house_no', 'ASC');
        $this->db->order_by('billing_date', 'DESC');
        $query = $this->db->get($this->payment_table);
        //echo $this->db->last_query();exit;

        return $query->result();
    }


    // Due and Paid List
    public function paymentLog($from_date='', $to_date='', $collector='')
    {
        $this->db->select('*, (amount + discount) as amount_discount, billing_year, billing_month, collection_date, (select name from tbl_users u where u.id=tbl_payments.added_by) as added_by, (select name from tbl_users u where u.id=bill_collector) as collector, tbl_clients.full_name, tbl_clients.resident, tbl_payments.created');
        

        if ($from_date != ''){
            $this->db->where("DATE_FORMAT(tbl_payments.created,'%Y-%m-%d') >=", $from_date);
        }

        if ($to_date != ''){
            $this->db->where("DATE_FORMAT(tbl_payments.created,'%Y-%m-%d') <=", $to_date);
        }

        if ($collector != ''){
            $this->db->where("bill_collector", $collector);
        }

        $this->db->join('tbl_clients','tbl_payments.client_id=tbl_clients.id');
        $this->db->order_by('billing_date', 'ASC');
        $this->db->having('amount_discount>0 or billing_type<>2');
        $query = $this->db->get($this->payment_table);
        //echo $this->db->last_query();exit;

        return $query->result();
    }

    public function get_total_payments($client_id='', $from_date='', $to_date='')
    {
        $this->db->select($this->client_table.".id, SUM(".$this->payment_table.".monthly_bill) as monthly_bill, SUM(amount+discount) as amount, max(billing_date) as billing_date, full_name, ".$this->client_table.".client_id");
        $this->db->from($this->payment_table);
        $this->db->join($this->client_table, $this->client_table.'.id='.$this->payment_table.'.client_id', 'inner');

        if($client_id != '')
        $this->db->where($this->payment_table.'.client_id', $client_id);

        if($from_date != '' && $to_date != ''){
            $this->db->where('billing_date >=', $from_date);
            $this->db->where('billing_date <=', $to_date);
        }

        $this->db->group_by($this->payment_table.'.client_id');
        $this->db->order_by('amount', 'desc');
        $query = $this->db->get();
        
        if($client_id != '')
            return $query->row();
        else
            return $query->result();
    }


    public function clientStatement($client_id, $from_date='', $to_date=''){

        $where_part = '';
        if($from_date != '' && $to_date != ''){
            $where_part .= " AND (payment_date >= '$from_date' AND payment_date <= '$to_date') ";
        }
        $sql = "SELECT *,(select name from tbl_users u where u.id=added_by) as added_user  FROM tbl_payments WHERE client_id=$client_id $where_part ORDER BY payment_date DESC";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function getLastGenerateBilling(){
        $this->db->select('*');
        $this->db->from('tbl_billgenerates');
        $this->db->order_by('g_year','DESC');
        $this->db->order_by('g_month','DESC');
        $row = $this->db->get()->row();
        if ($row)
            return $row;
        else
            return (object)array('g_month'=>date('m'), 'g_year'=>date('Y'));
    }

    // helping to debuging
    function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
   
}
