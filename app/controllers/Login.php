<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $now;
    public $application;
    public $theme;
    public $admin_path;
    public $app_title;
    public $user_table;

    function __construct()
    {
        parent::__construct();  
        $this->load->model("master");
        date_default_timezone_set("Asia/Dhaka");
        $this->now = date('Y-m-d H:i:s', time());
        $this->application = "app";
        $this->theme = "backend/";
        $this->admin_path = "admin/";
        $this->app_title = $this->master->settings['app_title'];
        $this->user_table = "tbl_users";
    }

    /*
     * method name: index
     * @access    : public
     * @param     : none
     * @return    : mixed template
     */

    public function index() 
    {
        
        if($this->session->userdata("user_id") != ""){
            redirect($this->admin_path."dashboard","refresh");
        }

        $data["title"] = "Login - ".$this->app_title;
        $this->load->view($this->theme."/login/login_form",$data);
    }
    
    public function do_login()
    {       
        $data = array(
            'user_id'   => $this->input->post('email')
        );      

        $password = $this->input->post('password', true);

        $this->db->select('*');
        $this->db->from($this->user_table);
        $this->db->where('email', trim($data['user_id'])); 
        $this->db->or_where('client_id', trim($data['user_id'])); 
        $this->db->where('status', 1); 
        $query = $this->db->get();
        // echo $this->db->last_query();
        // exit();
        if ( $query->num_rows() == 1 )
        {

            if(password_verify($password, $query->row()->password)){
                $data = $query->row_array();
                
                $session_data = array(
                    'user_id'    => $data['id'],
                    'user_email' => $data['email'],
                    'user_role'  => $data['user_role_id'],
                    'user_name'  => $data['name'],
                    'user_full_name'  => $data['name'].' '.$data['surname'],
                    'member_id' => $data['member_id'],
                    'session_id' => session_id(),
                );
                $this->session->set_userdata($session_data); 
                redirect($this->admin_path.'dashboard');
            }else{
             $this->session->set_flashdata('flashMessage', array('danger', "Invalid username or password."));
             redirect($this->admin_path,"refresh");
         }
     }
     else
     {
        $this->session->set_flashdata('flashMessage', array('danger', "Invalid username or password."));
        redirect($this->admin_path,"refresh");
    }

    }//signin;

    public function logout()
    {
    	$session_data = array(
         'user_id'    => "",
         'user_email' => "",
         'user_role'  => "",
         'user_name'  => "",
         'session_id' => "",
     );
    	$this->session->set_userdata($session_data);
    	$this->session->sess_destroy();
    	redirect($this->admin_path,"refresh");
    }

    public function memberLogin()
    {
        $this->load->view('member/login_form');
    }

    public function memberSignup()
    {
        $this->load->view('member/registration_form');
    }

    public function do_member_signup(){
        $status = array();
       // $this->load->library("form_validation");

        $this->form_validation->set_rules('first_name', 'First name', 'trim|required|xss_clean|strip_tags|strip_input');
        $this->form_validation->set_rules('surname', 'Surname', 'trim|required|xss_clean|strip_tags|strip_input');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|strip_tags');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean|strip_tags|strip_input');
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|strip_tags|strip_input');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|xss_clean|strip_tags');
        
        if($this->form_validation->run() === FALSE){
            $error_message = "<p>".form_error('first_name')."</p>";
            $error_message .= "<p>".form_error('surname')."</p>";
            $error_message .= "<p>".form_error('email')."</p>";
            $error_message .= "<p>".form_error('phone')."</p>";
            $error_message .= "<p>".form_error('username')."</p>";
            $error_message .= "<p>".form_error('password')."</p>";
            $status = array("status"=>"error", "msg"=>$error_message);
        }
        else{
            $first_name = $this->input->post("first_name");
            $surname = $this->input->post("surname",true);
            $email = $this->input->post("email",true);
            $phone = $this->input->post("phone",true);
            $username = trim($this->input->post("username",true));
            $password = $this->input->post("password",true);

            if($first_name == "" || $surname == "" || $email == "" || $phone == "" || $username == "" || $password == ""){
                $status = array("status"=>"error", "msg"=>"Sorry, you didn't fill out all the fields!");
            }else{
                if($this->is_uniqe_email($email)===FALSE){
                   $status = array("status"=>"error", "msg"=>"Sorry, email already exists!");  
               }
               elseif($this->is_uniqe_username($username)===FALSE){
                   $status = array("status"=>"error", "msg"=>"Sorry, username already exists!");  
               }else{
                $data = array(
                    "first_name" => $first_name,
                    "surname" => $surname,
                    "email" => $email,
                    "username" => $username,
                    "phone" => $phone,
                    "status" => 1,
                    "created" => $this->now
                );
                $data["password"] = $this->master->get_has_password($password);
                $this->db->trans_start();
                $this->master->insert($this->member_table, $data);
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    $status = array("status"=>"error", "msg"=>"Sorry, something went wrong!");  
                }else{
                        //$status = array("status"=>"ok","msg"=>"Signup successfully. please check your email to active your account, Thanks.");
                    $status = array("status"=>"ok","msg"=>"Signup successfully, Thanks.");
                }
            }
        }
    }

    echo json_encode($status);
}

private function send_email($to_email, $msg){
    $this->load->library('email');

    $this->email->from("info@banglacable.com", "Bangla Cable");
    $this->email->to($to_email);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

    $this->email->subject('Active Account');
    $this->email->message($msg);
    $this->email->set_mailtype("html");
    $this->email->send();
}

public function do_member_login(){
    $data = array(
        'username'   => $this->input->post('username', true)
    );      

    $password = $this->input->post('password', true);

    $this->db->select('*');
    $this->db->from($this->member_table);
    $this->db->where('status', 1); 
    $this->db->where('username', trim($data['username'])); 
    $this->db->or_where('email', trim($data['username'])); 
    $query = $this->db->get();
    if ( $query->num_rows() == 1 )
    {
        if(password_verify($password, $query->row()->password)){
            $data = $query->row_array();
            
            $session_data = array(
                'customer_id'    => $data['id'],
                'customer_email'    => $data['email'],
                'customer_type'  => $data['user_type'],
                'customer_name'  => $data['first_name'],
                'customer_session_id' => session_id(),
            );
            $this->session->set_userdata($session_data);                
            $status = array("status"=>"ok","msg"=>"Login successfully.");
        }else{
         $status = array("status"=>"error","msg"=>"Invalid username or password.");
     }
 }
 else
 {
    $status = array("status"=>"error","msg"=>"Invalid username or password.");
}

echo json_encode($status);
}

public function retrive_member_login(){
    echo json_encode(array("status"=>"ok","msg"=>"Password has been sent to your email. please check your email."));
}

public function customerLogout()
{
    $session_data = array(
        'customer_id'    => "",
        'customer_email' => "",
        'customer_type'  => "",
        'customer_name'  => "",
        'customer_session_id' => "",
    );
    $this->session->set_userdata($session_data);
    $this->session->sess_destroy();
    redirect(base_url(),"refresh");
}


private function is_uniqe_email($email, $id=""){
    $this->db->select("email");
    $this->db->from($this->member_table);
    $this->db->where("email", $email);
    if($id != "")
        $this->db->where("id !=", $id);
    $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        //print_r($query->num_rows());exit;
    if ($query->num_rows() > 0)
    {
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}

private function is_uniqe_username($username){
    $this->db->select("username");
    $this->db->from($this->member_table);
    $this->db->where("username", $username);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    {
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}


}
