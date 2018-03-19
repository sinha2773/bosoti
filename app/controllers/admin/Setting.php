<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        if( !$this->master->isPermission('settings') )
            show_404();

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

    // SETTINGS
    public function index(){
        $data = $this->init("Settings");
        $data["data"] = $this->db->get($this->setting_table)->result();
        $data["content"] = $this->load->view($this->theme."setting/index",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }  
    public function setting_update(){
        
        $this->db->query("delete from $this->setting_table"); // deleting all setting first
        
        $data_array = $this->input->post();
        $data = array();
        foreach ($data_array as $meta_key=>$meta_value) {
            $temp_data = array();
            $temp_data["meta_key"] = $meta_key;
            $temp_data["meta_value"] = $meta_value;
            $data[] = $temp_data;
        }
        
        $this->db->trans_start();
        $this->master->insert_batch($this->setting_table, $data); 
        $this->db->trans_complete();
        if($this->db->trans_status()===TRUE)
            $this->session->set_flashdata('flashMessage', array('success', "Setting updated successfully."));
        else
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, setting updating failed."));
        redirect($this->admin_path."setting", 'refresh'); 
    }
    // END SETTING
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */