<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends MY_Model {

    protected $table = 'tbl_members';
    protected $pk = 'id';
    
    function __construct() {
        parent::__construct();
    }

    public function getMemberNewId($prefix='BOSOTI_'){
        
        $this->prefix_client = $prefix;

        $this->db->select("MAX(CAST(REPLACE(client_id, '".ucwords($this->prefix_client)."','') AS UNSIGNED)) as client_id");
        $this->db->like('client_id', $this->prefix_client);
        $query = $this->db->get($this->table);
        $row = $query->row();
        if( isset($row) ){
            $client_id = (int)$row->client_id + 1;
            return (empty($this->prefix_client))?'':ucwords($this->prefix_client).$client_id;
        }else
        return (empty($this->prefix_client))?'':ucwords($this->prefix_client).'1';
    }
   
}
