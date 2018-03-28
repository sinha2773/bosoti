<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

    public function index(){

        if( !$this->master->isPermission('send_message') )
            show_404();

        $this->load->model('member_model');
        $this->load->model('user_model');
        $title = "Send Message";
        $data = $this->init($title);

        $data["clients"] = $this->member_model->all();

        $data["content"] = $this->load->view($this->theme."message/send",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

    public function history(){

        if( !$this->master->isPermission('message_history') )
            show_404();
        
        $this->load->model('member_model');
        $this->load->model('message_model');

        $title = "Message History";
        
        $data = $this->init($title);

        $data['histories'] = $this->message_model->getMessages();

        $data["content"] = $this->load->view($this->theme."message/history",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */