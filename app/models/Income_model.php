<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Income_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_income_types(){
        $query = $this->db->get($this->income_type_table);
        return $query->result();
    }

    public function get_income_type($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->income_type_table);
        return $query->row();
    }

    public function get_siblings_income_type($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->income_type_table);
        $result1 = $query->result();

        $this->db->where('parent_id', $id);
        $query = $this->db->get($this->income_type_table);
        $result = $query->result();
        
        if ( !empty($result) ){
            array_unshift($result, $result1[0]);
            return $result;
        }else{
            return $result1;
        }
    }


    public function get_incomes($exp_type='all', $from_date='', $to_date='')
    {
        $income_list = array();
        $income_types = array();

        if($exp_type == "all"){
            $incomes = $this->get_income_types();
            
        }else{
            $incomes = $this->get_siblings_income_type($exp_type);
        }
        
        if(!empty($incomes))
        foreach($incomes as $income){
            $income_types[] = array('id'=>$income->id, 'name'=>$income->title);
        }


        if( !empty($income_types) ){
            foreach($income_types as $income){
                $this->db->select('*');
                $this->db->from($this->income_table);
                $this->db->where('status', 1);
                
                if($from_date != '' && $to_date != ''){
                    // $this->db->where('income_date >=', $from_date);
                    // $this->db->where('income_date <=', $to_date);
                    $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') >=", $from_date);
                    $this->db->where("DATE_FORMAT(created,'%Y-%m-%d') <=", $to_date);
                }

                $this->db->where('intype_id', $income['id']);
                $query = $this->db->get();
                $income_list[] = array('id'=>$income['id'], 'name'=>$income['name'], 'list'=>$query->result());
            }
        }
        return $income_list;
    }

    

    // helping to debuging
    function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
   
}
