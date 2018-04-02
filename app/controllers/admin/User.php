<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();	

		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}

        //$this->load->driver("cache", array("adapter"=>"file"));
	}	

	// user roles
    private function getUserPermissions(){
        return array(
            'super_admin_power',
            'manager_power',
            'dashboard_info',
            'manage_member', 
            'manage_payment',
            'save_deposit',
            'save_profit_distribution',
            'save_credit_adjust',
            'save_debit_adjust',
            'see_payment_report',
            'see_statement',
            'save_income',
            'add_income',
            'add_income_type',
            'see_income_list',
            'see_income_report',
            'save_expense',
            'add_expense',
            'add_expense_type',
            'see_expense_list',
            'see_expense_report',
            'see_payment_log',
            'account_access', 
            'add_user', 
            'update_user',
            'see_user_list', 
            'access_user_role',
            // 'note_menu',
            'send_message',
            'message_history',
            'settings',
        );
    }

    // USER MANAGEMENT
    public function add_user() {

        if( !$this->master->isPermission('add_user') )
            show_404();

        $this->load->model('user_role_model', 'user_role');
        $data = $this->init("Add User");
        $data['user_roles'] = $this->user_role->get_all();
        $data["content"] = $this->load->view($this->theme."user/add",$data,TRUE);
        $this->load->view($this->theme.'layout',$data);
    }
    public function save_user() {
        $this->load->model('user_role_model', 'user_role');

        if( !$this->master->isPermission('add_user') )
            show_404();

        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('surname', 'Surname', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tbl_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('re_password', 'Re-Password', 'required|min_length[6]|matches[password]');
        if ($this->form_validation->run() == FALSE) { //if validation not passed or default view page
         $this->add_user();
     }
     $user_role = $this->input->post('user_role_id', true);
     if($user_role == 5){
        $email = $this->input->post('email', true);
        $mobile = $this->input->post('mobile', true);
        $member_id = $this->user_role->get_member_id($email,$mobile);
        if(empty($member_id['id'])){
         $this->session->set_flashdata('flashMessage', array('danger', "Sorry, No Member Found.Enter Member Email or Mobile Correctly"));
         redirect($this->admin_path."user/add_user", 'refresh'); 
     }
 }
   // else {
            $password = $this->input->post('password', true); // getting the password from the field
            // generating the password cimbining the cost parameter and salt here
            $hashPass = $this->master->get_has_password($password);

            // image upload
            $media_id = "";
            if(isset($_FILES['image']) && $_FILES['image']["size"]>0){
                $media_id = $this->master->image_upload($_FILES['image'],"user", array("action"=>"insert","name"=>$this->input->post('fname',TRUE)));
            }

            // putting all the fields into array for inserting in to DB
            $data = array(
                'name' => $this->input->post('fname', true),
                'surname' => $this->input->post('surname', true),
                'mobile' => $this->input->post('mobile', true),
                'email' => $this->input->post('email', true),
                'username' => $this->input->post('username', true),
                'gender' => $this->input->post('gender', true),
                'user_role_id' => $this->input->post('user_role_id', true),
                'media_id' => $media_id,
                'password' => $hashPass,
                'created' => $this->now,
                'status' => $this->input->post("status"),
                'member_id'=> $member_id['id'],
                'client_id'=> $member_id['client_id'],
            );
            $this->db->trans_start();
            $this->master->insert($this->user_table, $data); 
            $this->db->trans_complete();
            if($this->db->trans_status()===TRUE)
                $this->session->set_flashdata('flashMessage', array('success', "User added successfully."));
            else
                $this->session->set_flashdata('flashMessage', array('danger', "Sorry, user adding failed."));
            redirect($this->admin_path."user/add_user", 'refresh'); 
        // }

        }
        public function edit_user($id=null){

            if( !$this->master->isPermission('update_user') )
                show_404();

            $this->load->model('user_role_model', 'user_role');
            if($id==null || !is_numeric($id))
                redirect($this->admin_path."user/users", 'refresh'); 

            $data = $this->init("Edit User");
            $userdetails = $this->master->get_all_by_id($this->user_table, $id);

            if(empty($userdetails))
                redirect($this->admin_path."user/users", 'refresh'); 

            $data['user_roles'] = $this->user_role->get_all();
            $data["data"] = $userdetails[0];
            $data["content"] = $this->load->view($this->theme."user/edit",$data,TRUE);
            $this->load->view($this->theme.'layout',$data);
        }
        public function update_user() {

            if( !$this->master->isPermission('update_user') )
                show_404();

            $this->load->library("MY_Form_Validation","form_validation");

            $id = $this->input->post("id", TRUE);
            if(empty($id) || !is_numeric($id))
                redirect($this->admin_path."users", 'refresh'); 

            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('surname', 'Surname', 'trim|required');
        //$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_edit_unique_email');
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|edit_unique[tbl_users.email.'. $id .']');

            $password = $this->input->post("password", TRUE);
            if(!empty($password)){
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Re-Password', 'required|min_length[6]|matches[password]');
            }
        if ($this->form_validation->run() == FALSE) { //if validation not passed or default view page
         $this->edit_user($id);
     } else {

            // putting all the fields into array for inserting in to DB
        $data = array(
            'name' => $this->input->post('fname', true),
            'surname' => $this->input->post('surname', true),
            'mobile' => $this->input->post('mobile', true),
            'email' => $this->input->post('email', true),
                //'username' => $this->input->post('username', true),
            'gender' => $this->input->post('gender', true),
            'user_role_id' => $this->input->post('user_role_id', true),                
            'updated' => $this->now,
            'status' => $this->input->post("status")
        );

        if(!empty($password)){
           $hashPass = $this->master->get_has_password($password);
           $data["password"] = $hashPass;
       }

            // image upload
       $media_id = "";
       if(isset($_FILES['image']) && $_FILES['image']["size"]>0){
        $media_id = $this->master->image_upload($_FILES['image'],"user", array("action"=>"insert","name"=>$this->input->post('fname',TRUE)));
        $data["media_id"] = $media_id;
    }

    $this->db->trans_start();
    $this->master->update($this->user_table, $id, $data); 
    $this->db->trans_complete();
    if($this->db->trans_status()===TRUE)
        $this->session->set_flashdata('flashMessage', array('success', "User updated successfully."));
    else
        $this->session->set_flashdata('flashMessage', array('danger', "Sorry, user updating failed."));
    redirect($this->admin_path."user/users", 'refresh'); 
}

}
public function edit_unique_email($email){
    $this->db->where_not_in('email',$this->input->post('email'));
    $this->db->where('email',$email);
    if($this->db->count_all_results('tbl_users') > 0){
        $this->form_validation->set_message('edit_unique_email', "Sorry, that %s is already being used.");
        return false;
    }else{
        return true;
    }
}
public function users(){

    if( !$this->master->isPermission('see_user_list') )
        show_404();

    $this->load->model('user_role_model', 'user_role');
    
    $title = "All Users";
    $data = $this->init($title);
    $data['user_roles'] = $this->user_role->get_all();
    $data["lists"] = $this->master->get_all($this->user_table);
    $data["content"] = $this->load->view($this->theme."user/list",$data,TRUE);
    $this->load->view($this->theme.'layout',$data);
}
public function delete_user($id=null){

    if( !$this->master->isPermission('update_user') )
        show_404();

    if($id!=null)
    {
        $this->db->trans_start();
        $this->master->delete($this->user_table, $id);
        $this->db->trans_complete();
        if($this->db->trans_status()===TRUE)
            $this->session->set_flashdata('flashMessage', array('success', "User deleted successfully."));
        else
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, user deleting failed."));

    }
    redirect($this->admin_path."user/users", 'refresh'); 
}


public function add_user_role() {

    if( !$this->master->isPermission('access_user_role') )
        show_404();

    $this->load->model('user_role_model', 'user_role');
    $data = $this->init("Add User Role");
    $data['permissions'] = $this->getUserPermissions();
    $data["content"] = $this->load->view($this->theme."user_role/add",$data,TRUE);
    $this->load->view($this->theme.'layout',$data);
}
public function save_user_role() {

    if( !$this->master->isPermission('access_user_role') )
        show_404();

    $this->load->model('user_role_model', 'user_role');
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('permission_access[]', 'Permission', 'trim|required');
    if ($this->form_validation->run() == FALSE) { 
     $this->add_user_role();
 } else {          
    $permission = array();
    $permission['access'] = $this->input->post('permission_access', true); 
    $permission['modify'] = $this->input->post('permission_modify', true); 
    $data = array(
        'name' => $this->input->post('name', true),
        'permission' => serialize($permission),
    );
    $this->db->trans_start();
    $this->master->insert($this->user_role_table, $data); 
    $this->db->trans_complete();
    if($this->db->trans_status()===TRUE)
        $this->session->set_flashdata('flashMessage', array('success', "User role added successfully."));
    else
        $this->session->set_flashdata('flashMessage', array('danger', "Sorry, user role adding failed."));
    redirect($this->admin_path."user/add_user_role", 'refresh'); 
}

}
public function edit_user_role($id=null){

    if( !$this->master->isPermission('access_user_role') )
        show_404();

    $this->load->model('user_role_model', 'user_role');
    if($id==null || !is_numeric($id))
        redirect($this->admin_path."user/user_roles", 'refresh'); 

    $data = $this->init("Edit User Role");
    $userdetails = $this->user_role->get_by_id($id);
    
    if(empty($userdetails))
        redirect($this->admin_path."user/user_roles", 'refresh'); 

    $data['permissions'] = $this->getUserPermissions();
    $data["data"] = $userdetails;
    $data["content"] = $this->load->view($this->theme."user_role/edit",$data,TRUE);
    $this->load->view($this->theme.'layout',$data);
}
public function update_user_role() {

    if( !$this->master->isPermission('access_user_role') )
        show_404();

        // empty user roles from session once available
    $this->session->set_userdata(array('permissions'=>''));

    $this->load->model('user_role_model', 'user_role');
    $id = $this->input->post("id", TRUE);
    if(empty($id) || !is_numeric($id))
        redirect($this->admin_path."user/user_roles", 'refresh'); 

    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('permission_access[]', 'Permission', 'trim|required');
    if ($this->form_validation->run() == FALSE) { 
     $this->edit_user_role($id);
 } else {
    $permission = array();
    $permission['access'] = $this->input->post('permission_access', true); 
    $permission['modify'] = $this->input->post('permission_modify', true); 

    $data = array(
        'name' => $this->input->post('name', true),
        'permission' => serialize($permission)
    );

    $this->db->trans_start();
    $this->master->update($this->user_role_table, $id, $data, 'user_role_id'); 
    $this->db->trans_complete();
    if($this->db->trans_status()===TRUE)
        $this->session->set_flashdata('flashMessage', array('success', "User role updated successfully."));
    else
        $this->session->set_flashdata('flashMessage', array('danger', "Sorry, user role updating failed."));
    redirect($this->admin_path."user/user_roles", 'refresh'); 
}

}
public function user_roles(){
    $this->load->model('user_role_model', 'user_role');
    $title = "User Roles";
    $data = $this->init($title);
    $data["lists"] = $this->user_role->get_all();
    $data["content"] = $this->load->view($this->theme."user_role/list",$data,TRUE);
    $this->load->view($this->theme.'layout',$data);
}
public function delete_user_role($id=null){

    if( !$this->master->isPermission('access_user_role') )
        show_404();

    $this->load->model('user_role_model', 'user_role');
    if($id!=null)
    {
        $this->db->trans_start();
        $this->master->delete($this->user_role_table, $id, 'user_role_id');
        $this->db->trans_complete();
        if($this->db->trans_status()===TRUE)
            $this->session->set_flashdata('flashMessage', array('success', "User role deleted successfully."));
        else
            $this->session->set_flashdata('flashMessage', array('danger', "Sorry, user role deleting failed."));

    }
    redirect($this->admin_path."user/user_roles", 'refresh'); 
}
    // END USER SECTION


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */