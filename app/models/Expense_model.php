<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_expense_types(){
        $query = $this->db->get($this->expense_type_table);
        return $query->result();
    }

    public function get_expense_type($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->expense_type_table);
        return $query->row();
    }

    public function get_siblings_expense_type($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->expense_type_table);
        $result1 = $query->result();

        $this->db->where('parent_id', $id);
        $query = $this->db->get($this->expense_type_table);
        $result = $query->result();
        
        if ( !empty($result) ){
            array_unshift($result, $result1[0]);
            return $result;
        }else{
            return $result1;
        }
    }


    public function get_expenses($exp_type='all', $from_date='', $to_date='')
    {
        $expense_list = array();
        $expense_types = array();

        if($exp_type == "all"){
            $expenses = $this->get_expense_types();
        }else{
            $expenses = $this->get_siblings_expense_type($exp_type);
        }
        if(!empty($expenses))
        foreach($expenses as $expense){
            $expense_types[] = array('id'=>$expense->id, 'name'=>$expense->title);
        }


        if( !empty($expense_types) ){
            foreach($expense_types as $expense){
                $this->db->select('*');
                $this->db->from($this->expense_table);
                $this->db->where('status', 1);

                if($from_date != '' && $to_date != ''){
                    // $this->db->where('expense_date >=', $from_date);
                    // $this->db->where('expense_date <=', $to_date);
                    $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') >=", $from_date);
                    $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') <=", $to_date);
                }

                $this->db->where('extype_id', $expense['id']);
                $query = $this->db->get();
                $expense_list[] = array('id'=>$expense['id'], 'name'=>$expense['name'], 'list'=>$query->result());
            }
        }
        return $expense_list;
    }

    

    // helping to debuging
    function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
   
}
