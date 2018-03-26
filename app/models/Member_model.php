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


    public function save_new_member($data)
    {
        $this->db->insert('tbl_members', $data);
        return $this->db->affected_rows();
    }

    public function collect_all_info($member_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_members');
        $this->db->where('id', $member_id);
        return $this->db->get()->row_array();
    }

    public function save_reference_info($collect_info)
    {
        $this->db->insert('tbl_reference_history', $collect_info);
        return $this->db->affected_rows();
    }

    public function update_member_info($member_id,$data)
    {
        // $this->db->update('table', $data, $condition);
        $this->db->where('id', $member_id)->update('tbl_members', $data);
        return $this->db->affected_rows();
    }

    function get_member_details($id)
    {
        $this->db->select('*', FALSE);
        $this->db->from('tbl_members');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function get_reference_details($id)
    {
        $this->db->select('*', FALSE);
        $this->db->from('tbl_reference_history');
        $this->db->where('ref_id', $id);
        return $this->db->get()->row();
    }
}
