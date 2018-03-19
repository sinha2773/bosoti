<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function getMessages($filter_data=array())
    {
        $query = $this->db->get('tbl_messages');
        //echo $this->db->last_query();exit;

        return $query->result();
    }

    public function oooget_total_payments($client_id='', $from_date='', $to_date='')
    {
        $this->db->select($this->client_table.".id, SUM(".$this->payment_table.".monthly_bill) as monthly_bill, SUM(amount) as amount, max(billing_date) as billing_date, full_name, ".$this->client_table.".client_id, address, zone, floor, house_no");
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
        
        return $query->result();
    }

    private function make_dates($from_date, $to_date){
        $data = array();
        
    }

    public function clientStatement($client_id, $from_date='', $to_date=''){

        $where_part = '';
        if($from_date != '' && $to_date != ''){
            $where_part .= " AND (billing_date >= '$from_date' AND billing_date <= '$to_date') ";
        }
        $sql = "SELECT *,(select name from tbl_users u where u.id=bill_collector) as collector  FROM tbl_payments WHERE client_id=$client_id $where_part ORDER BY billing_year, billing_month DESC";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    // helping to debuging
    function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
   
}
