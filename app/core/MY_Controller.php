<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	public $now;
	public $theme;
	public $app_title;
	public $admin_path;
	public $application;

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
    public $apartment_table;
    public $client_table;
    public $payment_table;
    public $package_table;
    public $client_history_table;
    public $salary_table;
    public $employee_table;
    public $client_package_table;

	public function __construct(){
		parent::__construct();
        // $this->access();
		date_default_timezone_set("Asia/Dhaka");
        $this->now = date('Y-m-d H:i:s', time());

		$this->application = "app";
		$this->theme = "backend/";
		$this->admin_path = "admin/";
        $this->load->helper(array('form', 'file'));
        $this->load->model("master");
		$this->app_title = $this->master->settings['app_title'];
		//$this->load->library('fbpost');

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
        $this->apartment_table = "tbl_apartments";
        $this->client_table = "tbl_members";
        $this->payment_table = "tbl_payments";
        $this->package_table = "tbl_packages";
        $this->client_history_table = "tbl_client_histories";
        $this->salary_table = "tbl_salarys";
        $this->employee_table = "tbl_employees";
        $this->client_package_table = "tbl_client_packages";

        // Session for one hour
        $now = time();
        if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
            // this session has worn out its welcome; kill it and start a brand new one
            session_unset();
            session_destroy();
            session_start();
        }
        // either new or old, it should live at most for another hour
        $_SESSION['discard_after'] = $now + 3600;
		
	}	

	protected function init($title, $data=array())
	{
        $data['title'] = $title . " - " . $this->app_title;
		$data['app_title'] = $this->app_title;
		$data['breadcrumb'] = $title;
        $data['admin_path'] = $this->admin_path;
		$data['settings'] = $this->master->getSettings();
		$data['menu']	= $this->load->view($this->theme."/common/menu",$data,TRUE);
		$data['header']	= $this->load->view($this->theme."/common/header",$data,TRUE);
		$data['footer']	= $this->load->view($this->theme."/common/footer",$data,TRUE);
        
		return $data;
	}

	public function access(){
        //error_reporting(0);
  //       if(is_file(dirname(__FILE__)."/../config/config.xml")){
  //           $xml = simplexml_load_file(dirname(__FILE__)."/../config/config.xml");
  //           $config = $xml->project;
  //           $CODE = $config->key;
  //       }else exit;

  //       defined('SN_CODE') OR exit;
  //       defined('ACCESS_TOKEN') OR exit;
		// if(ACCESS_TOKEN!=$CODE)exit;	
		// if(SN_CODE != $this->decode(ACCESS_TOKEN))exit;
		// if(SN_CODE != $this->decode($CODE))exit;
	}

	// START GLOBAL METHODS FOR INSERT, UPDATE, DELETE AND LIST VIEW

    protected function isExit($dir, $file) {
        $file = FCPATH . $this->application.'/views/'. $this->theme . $dir . '/' . $file . '.php';
        if (file_exists($file)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_all($option = "") {
        if ($this->isExit($option, 'list') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        $title = ucwords($option) . " List";

        $data = $this->init($title);
        $data['lists'] = $this->master->get_all($tableName);
        $data['action'] = $option;
		$data["content"] = $this->load->view($this->theme.$option."/list",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);

    }

    public function add($option = "") {
        if ($this->isExit($option, 'add') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        
        $title = "Create New " . ucwords($option);
        $data = $this->init($title);
        $data['action'] = $option;
		$data["content"] = $this->load->view($this->theme.$option."/add",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);

    }

    public function save($option = "") {
        if ($this->isExit($option, 'add') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        $data = $this->input->post();

        // User id from session
        if(isset($data["user_id"])){            
            $data["user_id"] = (bool)$data["user_id"]==true ? $this->session->userdata('user_id') : $data['user_id'];
        }
        
        if(isset($data["slug"])){
            if($data["slug"] == "")
            $data["slug"] = url_title($data["title"], 'dash', TRUE);
            else
            $data["slug"] = url_title($data["slug"], 'dash', TRUE);
        }
        if(isset($data["content"]))
        $data["content"] = $this->master->remove_specialchars($data["content"]);

        if(!isset($data["media_id"]) || empty($data["media_id"]))
        if (isset($_FILES['image']) && !empty($_FILES["image"]["name"]) && $_FILES["image"]["size"]>0) {
            $image_name = isset($data["image_name"]) ? $data["image_name"] : "Unknown";
            $data['media_id'] = $this->master->fileUpload($_FILES['image'], $option, array("action"=>"insert","name"=>$image_name));
        }
        unset($data["image"]);
        unset($data["image_name"]);

        if(!isset($data["media_id2"]) || empty($data["media_id2"]))
        if (isset($_FILES['image2']) && !empty($_FILES["image2"]["name"]) && $_FILES["image2"]["size"]>0) {
            $image_name = isset($data["image_name2"]) ? $data["image_name2"] : "Unknown";
            $data['media_id2'] = $this->master->fileUpload($_FILES['image2'], $option, array("action"=>"insert","name"=>$image_name));
        }
        unset($data["image2"]);
        unset($data["image_name2"]);

        $data['created'] = $this->now;
        $data['updated'] = $this->now;
        $this->db->trans_start();
        $insert_id = $this->master->insert($tableName, $data);
        // for global update
        // $g_data = array();
        // $g_data["id"] = $insert_id;
        // $g_data["action"] = "save";
        // $this->global_update($option,$g_data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, ".$option." adding failed."));
        } else {
            $this->session->set_flashdata('flashMessage', array('success', ucwords($option)." added successfully."));
        }
        // redirect($this->admin_path."get_all/" . $option, 'refresh');
        redirect($this->admin_path."common/add/" . $option, 'refresh');
    }

    public function edit($option = "", $id='') {
        // $id = $this->uri->segment(4);
        if ($this->isExit($option, 'edit') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        $title = "Edit " . ucwords($option);

        $data = $this->init($title);
        $data['data'] = $this->master->get_all_by_id($tableName, $id)[0];
        $data['action'] = $option;
		$data["content"] = $this->load->view($this->theme.$option."/edit",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);
    }

    public function update($option = "") {
        $id = $this->input->post('id', true);
        if ($this->isExit($option, 'edit') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        $data = $this->input->post();
        unset($data["id"]);

        // User id from session
        if(isset($data["user_id"])){            
            $data["user_id"] = (bool)$data["user_id"]==true ? $this->session->userdata('user_id') : $data['user_id'];
        }

        if(isset($data["slug"]))
        $data["slug"] = url_title($data["slug"], 'dash', TRUE);
        if(isset($data["content"]))
        $data["content"] = $this->master->remove_specialchars($data["content"]);

        if(!isset($data["media_id"]) || empty($data["media_id"]))
        if (isset($_FILES['image']) && !empty($_FILES["image"]["name"]) && $_FILES["image"]["size"]>0) {
            $image_name = isset($data["image_name"]) ? $data["image_name"] : "Unknown";
            $data['media_id'] = $this->master->fileUpload($_FILES['image'], $option, array("action"=>"insert","name"=>$image_name));
        }
        unset($data["image"]);
        unset($data["image_name"]);

        if(!isset($data["media_id2"]) || empty($data["media_id2"]))
        if (isset($_FILES['image2']) && !empty($_FILES["image2"]["name"]) && $_FILES["image2"]["size"]>0) {
            $image_name = isset($data["image_name2"]) ? $data["image_name2"] : "Unknown";
            $data['media_id2'] = $this->master->fileUpload($_FILES['image2'], $option, array("action"=>"insert","name"=>$image_name));
        }
        unset($data["image2"]);
        unset($data["image_name2"]);

        $data['updated'] = $this->now;
        $this->db->trans_start();
        $this->master->update($tableName, $id, $data);
        // for global update
        //$g_data = array();
        //$g_data["id"] = $id;
        //$g_data["action"] = "update";
       // $this->global_update($option,$g_data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, ".$option." updating failed."));
        } else {
            $this->session->set_flashdata('flashMessage', array('success', ucwords($option)." updated successfully."));
        }
        redirect($this->admin_path."common/get_all/" . $option, 'refresh');
    }

    public function detail($option = "", $id='') {
        //$id = $this->uri->segment(4);
        if ($this->isExit($option, 'edit') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        $title = "Details " . ucwords($option);

        $data = $this->init($title);
        $data['data'] = $this->master->get_all_by_id($tableName, $id)[0];
        $data['action'] = $option;
        $data["content"] = $this->load->view($this->theme.$option."/index",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function delete($option = "", $id='') {
        // $id = $this->uri->segment(4);

        $redirect_url = isset($_GET['redirect']) ? $_GET['redirect']:'';

        if ($this->isExit($option, 'edit') === FALSE)
            exit("Sorry, your request is not valid!!");
        $tableName = "tbl_" . $option . 's';
        $this->db->trans_start();
        $this->master->delete($tableName, $id);

        // for global update
        // $g_data = array();
        // $g_data["id"] = $id;
        // $g_data["action"] = "delete";
        // $this->global_update($option,$g_data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, ".$option." deleting failed."));
        } else {
            $this->session->set_flashdata('flashMessage', array('success', ucwords($option)." deleted successfully."));
        }

        if ($redirect_url == '')
            redirect($this->admin_path."common/get_all/" . $option, 'refresh');
        else
            redirect($redirect_url, 'refresh');
    }

    // END GLOBAL PART

    // manage menu
    public function menu($action, $menu_id="", $id="")
    {
        if($action == "save"){
            $data = $this->input->post();
            $this->db->trans_start();
            $this->master->insert($this->menu_pages_table, $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->session->set_flashdata('flashMessage', array('danger', "Sorry, page adding failed."));
            } else {
                $this->session->set_flashdata('flashMessage', array('success', "Page added successfully."));
            }
            redirect($this->admin_path."menu/assign/" .$data["menu_id"], 'refresh');
        }
        elseif($action == "update"){
            $data = $this->input->post();
            $this->db->trans_start();
            $id = $data["id"];
            $menu_id = $data["menu_id"];
            unset($data["id"]);
            unset($data["menu_id"]);
            $this->master->update($this->menu_pages_table, $id, $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->session->set_flashdata('flashMessage', array('danger', "Sorry, page updating failed."));
            } else {
                $this->session->set_flashdata('flashMessage', array('success', "Page updated successfully."));
            }
            redirect($this->admin_path."menu/assign/" .$menu_id, 'refresh');
        }
        elseif($action == "delete" && $id != ""){
            $this->db->trans_start();
            $this->master->delete($this->menu_pages_table, $id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->session->set_flashdata('flashMessage', array('danger', "Sorry, page deleting failed."));
            } else {
                $this->session->set_flashdata('flashMessage', array('success', "Page deleted successfully."));
            }
            redirect($this->admin_path."menu/assign/" .$menu_id, 'refresh');
        }
        elseif($action == "edit" && $id != ""){
            $data = $this->init("Edit Assign Pages to Menu");
            $data["data"] = $this->master->get_all_by_id($this->menu_pages_table,$id)[0];
        }
        else
        {
            $data = $this->init("Assign Pages to Menu");
        }

        if($menu_id=="")
        {
            redirect($this->admin_path."get_all/menu", 'refresh');
        }
        
        $data["menu_id"] = $menu_id;
        $data["pages"] = $this->master->get_all($this->page_table);
        $data["parent_pages"] = $this->master->get_all($this->menu_pages_table);
        $data["assigned_pages"] = $this->master->get_assigned_pages($menu_id);
        $data["content"] = $this->load->view($this->theme."/menu/assign",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function global_redirect($session_path){
        if ( $this->session->has_userdata( $session_path ) ){
            $redirect_url = $this->session->get_userdata()[$session_path];
            $this->session->set_userdata($session_path, '');
            redirect($redirect_url, 'refresh');
            exit;
        }else{
            return;            
        }
    }

    public function pr($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}