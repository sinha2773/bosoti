<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Model {

    function __construct() {
        parent::__construct();

    }

    public function permissions(){

        if( $this->session->userdata('permissions') != null && is_array($this->session->userdata('permissions')) ){
            return $this->session->userdata('permissions');
        }

        $this->load->model('user_model', 'user');
        $this->load->model('user_role_model', 'user_role');
        $user_id = $this->session->userdata('user_id');
        if( (int)$user_id > 0){
            $user_info = $this->user->get_user($user_id);
            $role_into = $this->user_role->get_by_id($user_info->user_role_id);
            $permissions = unserialize($role_into->permission);
            $this->session->set_userdata(array('permissions'=>$permissions));
            return $permissions;
        }
        else
            exit('403');
    }

    public function isPermission($permission_name, $access_type='access'){
        if( $this->session->userdata('permissions') != null && is_array($this->session->userdata('permissions')) ){
            $permissions = $this->session->userdata('permissions');
        }else{
            $permissions = $this->permissions();
        }

        if( is_array($permissions) && isset($permissions[$access_type]) ){
            return in_array($permission_name, $permissions[$access_type]);
        }else{
            return false;
        }
    }

    public function get_all($tableName, $options=array()) {
        if(isset($options["select"]) && !empty($options["select"])){
            $this->db->select($options["select"]);
        }
        if(isset($options["where"]) && !empty($options["where"])){
            $this->db->where($options["where"]);
        }
        if(isset($options["like"]) && !empty($options["like"])){
            $this->db->like($options["like"]);
        }
        if(isset($options["limit"]) && !empty($options["limit"])){
            $this->db->limit($options["limit"]);
        }
        
        if(isset($options["cusom_order_by"]) && !empty($options["cusom_order_by"])){
            $this->db->order_by($options["cusom_order_by"], FALSE);
        }else{
            $this->db->order_by("id","DESC");
        }

        if(isset($options["group_by"]) && !empty($options["group_by"])){
            $this->db->group_by($options["group_by"]);
        }else{
            // nothing
        }


        if(isset($options["output"]) && !empty($options["output"])){
            
            if ($options["output"]=='result_array')
                return $this->db->get($tableName)->result_array();
            else
                return $this->db->get($tableName)->result();
                
        }else{
            return $this->db->get($tableName)->result();
        }
    }
    
    public function get_all_by_id($tableName,$id) {
        $this->db->where('id', $id);
        $query_result = $this->db->get($tableName);
        return $query_result->result();
    }

    
    function engtobng($input) 
    {
        $eng = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','am', 'pm');
        $bang = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', ' রোববার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'পূর্বাহ্ন', 'অপরাহ্ন');
        return str_replace($eng, $bang, $input);
    }

    function remove_specialchars($news)
    {
        return strip_tags($news, '<h1><h2><h3><h4><h5><h6><p><a><b><strong><u><span><br/><br><img><table><tr><th><td><iframe><video><audio><i><ol><ul><li>');
    }

    public function value_with_vat($amount, $vat){
        $vat_amount = ($amount * $vat) / 100;
        return $amount + $vat_amount;
    }

    public function genderArray(){
        return array('Male', 'Female', 'Other');
    }

    function lastDateOfBillingMonth(){
        $this->db->select('*');
        $this->db->from('tbl_billgenerates');
        $this->db->order_by('g_year','DESC');
        $this->db->order_by('g_month','DESC');
        $row = $this->db->get()->row();
        if ( empty($row) )
            $row = (object)array('g_month'=>'', 'g_year'=>'', 'g_date'=>date('Y-m-d'));

        $lastGenerateDate = $this->master->rangeMonth($row->g_date);
        return $lastGenerateDate;
    }

    function rangeMonth($datestr) {
        //date_default_timezone_set(date_default_timezone_get());
        $dt = strtotime($datestr);
        $res['start'] = date('Y-m-d', strtotime('first day of this month', $dt));
        $res['end'] = date('Y-m-d', strtotime('last day of this month', $dt));
        return $res;
    }

    function rangeWeek($datestr) {
        //date_default_timezone_set(date_default_timezone_get());
        $dt = strtotime($datestr);
        $res['start'] = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
        $res['end'] = date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
        return $res;
    }

 //print_r(rangeMonth('2011-4-5')); // year-month-day
 //print_r(rangeWeek('2011-4-5'));


    // helping to debuging
    function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    
    
   
}
