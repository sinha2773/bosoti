<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

    public function search()
    {
        redirect($this->admin_path."dashboard","refresh");
    } 

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */