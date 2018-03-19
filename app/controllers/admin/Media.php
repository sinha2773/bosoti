<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Media extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	


    public function media()
	{
        $options = array();
        if(isset($_POST['image_name'])){ // search options
            $options["like"] = array("name"=>$this->input->post('image_name', TRUE));            
        }
		$data["lists"] = $this->master->get_all($this->media_table, $options);
		$this->load->view($this->theme.'media/popup',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */