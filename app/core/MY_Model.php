<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    public $now;
    public $settings;

    public $setting_table;
    public $user_table;
    public $user_role_table;
    public $media_table;
    public $expense_table;
    public $expense_type_table;
    public $income_table;
    public $income_type_table;
    public $address_table;
    public $floor_table;
    public $zone_table;
    public $client_table;
    public $payment_table;
    public $package_table;
    public $client_history_table;
    public $salary_table;
    public $employee_table;
    public $client_package_table;

    /**
     * Table name of model
     * @var [string]
     */
    protected $table;

    /**
     * Primary Key of table
     * @var [string]
     */
    protected $pk = 'id';

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Dhaka");
        $this->now = date('Y-m-d H:i:s', time());        
        
        $this->setting_table = "tbl_settings";
        $this->user_table = "tbl_users";
        $this->user_role_table = "tbl_user_roles";
        $this->media_table = "tbl_medias";
        $this->expense_table = "tbl_expenses";
        $this->expense_type_table = "tbl_expense_types";
        $this->income_table = "tbl_incomes";
        $this->income_type_table = "tbl_income_types";
        $this->address_table = "tbl_addresss";
        $this->floor_table = "tbl_floors";
        $this->zone_table = "tbl_zones";
        $this->client_table = "tbl_members";
        $this->payment_table = "tbl_payments";
        $this->package_table = "tbl_packages";
        $this->client_history_table = "tbl_client_histories";
        $this->salary_table = "tbl_salarys";
        $this->employee_table = "tbl_employees";
        $this->client_package_table = "tbl_client_packages";

        $this->settings = $this->getSettings();
    }


    public function get_has_password($password) {
        $options = array(
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        );
        $hashPass = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hashPass;
    }

    public function getSettings(){
        $result = $this->db->get($this->setting_table)->result();
        $settings = array();

        if(!empty($result))
        foreach($result as $key=>$val){
            $settings[$val->meta_key] = $val->meta_value;
        }

        return $settings;
    }

    // start global methods
    public function insert($tableName, $data) {
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    public function insert_batch($tableName, $data){
        $this->db->insert_batch($tableName, $data);
    }

    public function update($tableName, $id, $data, $field="id") {
        $this->db->where($field, $id);
        return $this->db->update($tableName, $data);
    }

    public function delete($tableName, $id, $field="id") {
        $this->db->where($field, $id);
        return $this->db->delete($tableName);
    }
    // end global methods 

    function _insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function _update($id, $data)
    {
        $this->db->where($this->pk, $id);
        return $this->db->update($this->table, $data);
    }

    function updateIn($ids, $data)
    {
        $this->db->where_in($this->pk, $ids);
        return $this->db->update($this->table, $data);
    }

    function updateWhere($data, $condition, $tableName='') 
    {
        if ($tableName=='')
            $tableName = $this->table;
        
        $this->db->trans_start();
        $this->db->update($tableName, $data, $condition);
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _delete($id)
    {
        $this->db->where($this->pk, $id);
        return $this->db->delete($this->table);
    }

    function deleteIn($where_array)
    {
        $this->db->where_in($this->pk, $where_array);
        return $this->db->delete($this->table);
    }

    function deleteWhere($where_array)
    {
        $this->db->where($where_array);
        return $this->db->delete($this->table);
    }


    function affectedRows()
    {
        return $this->db->affected_rows();
    }


    function all()
    {
        return $this->db->get($this->table)->result();
    }

    function count()
    {
        return $this->db->get($this->table)->num_rows();
    }

    function getWhere($where_array, $isSingle=false)
    {
        $this->db->where($where_array);
        if ($isSingle)
            return $this->db->get($this->table)->row();
        else
            return $this->db->get($this->table)->result();
    }

    function getWhereIn($where_array, $field='')
    {
        if ( $field=='' )
            $this->db->where_in($this->pk, $where_array);
        else
            $this->db->where_in($field, $where_array);

        return $this->db->get($this->table)->result();
    }

    function getById($id)
    {
        $this->db->where($this->pk, $id);
        return $this->db->get($this->table)->row();
    }

    function getByVerificationNo($verification_no)
    {
        $this->db->where('transection_id', $verification_no);
        return $this->db->get($this->table)->row();
    }

    function getByOptions($options = array()) {
        // setting vars
        $fields = isset($options["fields"]) ? $options["fields"] : "*";
        $where = isset($options["where"]) ? $options["where"] : array();
        $like = isset($options["like"]) ? $options["like"] : array();
        $or_like = isset($options["or_like"]) ? $options["or_like"] : array();
        $order_by = isset($options["order_by"]) ? $options["order_by"] : "";

        // setting query
        if(isset($options["fields_raw"]) && $options["fields_raw"]){
            $this->db->select($fields,false);
        }else{
            $this->db->select($fields);
        }
        $this->db->from($this->table);

        if (!empty($where)) {
            if(isset($options["raw_where"]) && $options["raw_where"]){
                $this->db->where($where,null,FALSE);
            }
            else{
                $this->db->where($where);
            }
        }

        if (!empty($like)) {
            $this->db->like($like);
        }
        
        if (!empty($or_like)) {
            $this->db->or_like($or_like);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }
        
        if(isset($options["limit"]) && !empty($options["limit"])){
            $this->db->limit($options["limit"]["limit"],$options["limit"]["start"]);
        }
        
        if(isset($options["return"]) && $options["return"] == "count"){
            return $this->db->get()->num_rows();
        }else{
            return $this->db->get()->result();
        }
    }

    function hasData($attribute)
    {
        $query = $this->db->get_where($this->table, $attribute);
        $no_of_row = 0;
        if (!empty($query)) {
            $no_of_row = $query->num_rows();
        }
        return ($no_of_row > 0) ? TRUE : FALSE;
    }
    // end global methods 

    // menu manage
    function buildTree($flat, $pidKey, $idKey = null) {
        if(empty($flat)) return array();

        $grouped = array();
        foreach ($flat as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }        

        $treeBuilder = function($siblings) use (&$treeBuilder, $grouped, $idKey) {
            foreach ($siblings as $k => $sibling) {
                $id = $sibling[$idKey];
                if (isset($grouped[$id])) {
                    $sibling['children'] = $treeBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }
            return $siblings;
        };
        $tree = $treeBuilder($grouped[0]);
        return $tree;
    }
    
    public function get_assigned_pages($menu_id)
    {
        $options["order_by"] = "order_id ASC";
        $options["output"] = "result_array";
        $all_pages = $this->get_all($this->menu_pages_table,$options); 
        if(empty($all_pages))
            return array();
        else
            return $this->buildTree($all_pages, 'parent_id', 'id');
    }


    public function get_image($id, $type="news", $dir="thumb")
    {
        $this->db->where("id", $id);
        $data = $this->db->get($this->media_table)->row();  
        if(!empty($data)){
            $data->src = base_url()."uploads/".$type."/".$dir."/".$data->image;
        }else{
            $data = new stdClass();
            $data->name = "";
            $data->src = "";
            $data->title = "";
        }  
        return $data;
    }

    public function fileUpload($file, $path_name, $options=array())
    {
        // for multiple
        if ( is_array($file['name']) )
        {
            $insert_ids = [];
            foreach($file['name'] as $key=>$val)
            {
                $file_desc = [
                    'name'=>$file['name'][$key],
                    'type'=>$file['type'][$key],
                    'tmp_name'=>$file['tmp_name'][$key],
                    'error'=>$file['error'][$key],
                    'size'=>$file['size'][$key]
                ];
                $insert_ids[] = $this->image_upload($file_desc, $path_name, $options);
            }
            return $insert_ids;
        }
        else
        {
            return $this->image_upload($file, $path_name, $options);
        }
    }

    public function image_upload($file, $path_name, $options=array()) 
    {
        $this->load->library('upload');
        
        $_FILES['userfile']['name'] = $file['name'];
        $_FILES['userfile']['type'] = $file['type'];
        $_FILES['userfile']['tmp_name'] = $file['tmp_name'];
        $_FILES['userfile']['error'] = $file['error'];
        $_FILES['userfile']['size'] = $file['size'];

        $config['upload_path'] = './uploads/' . $path_name . '/full/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xlsx|xlsm|csv';
        $config['max_size'] = '60000';
        //$config['overwrite'] = false; // image overwite if image name exists

        
        $this->upload->initialize($config);

        if($this->upload->do_upload()){ // uploading original image

            $data1 = array('upload_data' => $this->upload->data());
            $image = $data1['upload_data']['file_name'];
            $file_name_only = basename($image, $data1['upload_data']['file_ext']);
            $rename_file = $file_name_only.'_'.time();
            $rename = $rename_file . $data1['upload_data']['file_ext'];
            rename('./uploads/' . $path_name . '/full/' . $image, './uploads/' . $path_name . '/full/' . $rename);

            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/' . $path_name . '/full/' . $rename;
            $config['new_image'] = './uploads/' . $path_name . '/single/';
            //$config['create_thumb'] = FALSE;
            //$config['maintain_ratio'] = FALSE; // by default true
            $config['master_dim'] = 'width'; // added to make fixed width but height will adjust with width
            $config['width'] = '500';
            $config['height'] = '450';
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            $result = $this->image_lib->resize();
            $this->image_lib->clear();

            $config['new_image'] = './uploads/' . $path_name . '/medium/';
            $config['width'] = '200';
            $config['height'] = '180';
            $this->image_lib->initialize($config);
            $result = $this->image_lib->resize();
            $this->image_lib->clear();

            $config['new_image'] = './uploads/' . $path_name . '/thumb/';
            $config['width'] = '80';
            $config['height'] = '70';
            $this->image_lib->initialize($config);
            $result = $this->image_lib->resize();
            $this->image_lib->clear();

            // data inserted into media table
            $options["name"] = (!isset($options["name"])) ? "Unknown" : $options["name"];
            $options["status"] = (!isset($options["status"])) ? 1 : $options["status"];
            if(isset($options["action"]) && $options["action"] == "insert"){
                $media_data = array(
                    "media_type"    => $path_name,
                    "name"          => $options["name"],
                    "image"         => $rename,
                    "status"        => $options["status"],
                    "created"       => $this->now,
                    "updated"       => $this->now
                );
                $media_id = $this->insert($this->media_table, $media_data);
                return $media_id;
            }
            elseif(isset($options["action"]) && $options["action"] == "update"){
                $media_data = array(
                    "media_type"    => $path_name,
                    "name"          => $options["name"],
                    "image"         => $rename,
                    "status"        => $options["status"],
                    "created"       => $this->now,
                    "updated"       => $this->now
                );
                $media_id = $this->update($this->media_table, $options["id"], $media_data);
                return $media_id;
            }
            else{
                return $rename;
            } 
        }
        else{
            // echo json_encode(array('error' => $this->upload->display_errors('', '')));
            return 0; 
        }  
        
    }

    public function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}