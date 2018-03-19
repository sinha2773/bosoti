<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class History extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

    public function index(){
        $this->log();
    }


    public function log(){
        if( !$this->master->isPermission('see_history_log') )
            show_404();

        $this->load->model('history_model', 'history');
        $this->load->model('client_model', 'client');

        $title = "History Log";
        $data = $this->init($title);
        $data['from_date'] = isset($_GET['from_date']) ? $_GET['from_date'] : date('Y-m-d');
        $data['to_date'] = isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d');
        $data['from_date_alise'] = date('l, d F Y', strtotime($data['from_date']));
        $data['to_date_alise'] = date('l, d F Y', strtotime($data['to_date']));
        $data['collector'] = $this->input->get('collector', true);
        $data['operators'] = $this->master->get_all($this->user_table);
        $data["lists"] = $this->history->getHistoryLog($data['from_date'], $data['to_date'], $data['collector']);

        // $this->pr($data["lists"]);exit;
        if( isset($_GET['print']) && $_GET['print']=='true' ){
            $data["content"] = $this->load->view($this->theme."history/print_log",$data);  
        }
        else{      
            $data["content"] = $this->load->view($this->theme."history/log",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }
    }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */