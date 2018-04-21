<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_id")==""){
			redirect($this->admin_path, "refresh");
		}
		$this->load->model('Member_model');
		$this->load->model('media_model');
	}

	public function allMembers()
	{
		$data = $this->init("All Members");
		$data['lists'] = $this->Member_model->all();
		$data['action'] = 'member';
		if(isset($_GET['print']) && $_GET['print']=='true'){
			$data["content"] = $this->load->view($this->theme."member/list_print",$data);
		}
		else{
			$data["content"] = $this->load->view($this->theme."member/list",$data,TRUE);
			$this->load->view($this->theme.'layout',$data);
		}
	}

	public function index()
	{
		
	}

	public function addMember() {        
		$title = "Create New Member";
		$data = $this->init($title);
		$data['action'] = 'member';
		$data["content"] = $this->load->view($this->theme."member/add",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);
	}

	function save_member()
	{
		$data = $this->input->post();

		if(!isset($data["media_id"]) || empty($data["media_id"])){
			if (isset($_FILES['image']) && !empty($_FILES["image"]["name"]) && $_FILES["image"]["size"]>0) {
				$image_name = isset($data["image_name"]) ? $data["image_name"] : "Unknown";
				$data['media_id'] = $this->master->fileUpload($_FILES['image'], 'member', array("action"=>"insert","name"=>$image_name));
			}
		}
		unset($data["image"]);
		unset($data["image_name"]);

		if(!isset($data["media_id2"]) || empty($data["media_id2"])){
			if (isset($_FILES['image2']) && !empty($_FILES["image2"]["name"]) && $_FILES["image2"]["size"]>0) {
				$image_name = isset($data["image_name2"]) ? $data["image_name2"] : "Unknown";
				$data['media_id2'] = $this->master->fileUpload($_FILES['image2'], 'member', array("action"=>"insert","name"=>$image_name));
			}
		}
		unset($data["image2"]);
		unset($data["image_name2"]);

		$attachments = $this->master->fileUpload($_FILES['files'], 'member', ['action'=>'insert']);
		$data['attachments'] = json_encode($attachments);

		if( $data['password'] !== $data['re_password']){
			$this->session->set_flashdata('flashMessage', array('danger', "Sorry, Password Not Match."));      
			redirect('/admin/common/add/member');	
		}
		$password= $data['password'];
		$hash_password  = $this->get_has_password($password);

		$this->db->trans_start();
		if($data['membership_type'] == "1"){
			$data['added_by'] = $this->session->userdata("user_id");
			unset($data['ref_mem_id']);
			unset($data['member_name']);
			unset($data['password']);
			unset($data['re_password']);

			$is_save=$this->Member_model->save_new_member($data);
			$user_data = array(
				'mobile' =>$data['mobile'],
				'password'=>$hash_password,
				'name' =>$data['name'],
				'gender' =>$data['gender'],
				'member_id' => $is_save,
				'client_id' =>$data['client_id'],
				'user_role_id'=> 5,
				'status' => 1,				
			);
			$this->Member_model->save_as_user($user_data);
			if(!empty($is_save)){
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE)
				{
					$this->session->set_flashdata('flashMessage', array('danger', "Sorry, Member Added Failed."));                   
				}
				else
				{
					$this->session->set_flashdata('flashMessage', array('success', "Member Added Successfully."));                   
				}
			}
		}
		else{
			$member_id = $data['ref_mem_id'];
			$collect_info = $this->Member_model->collect_all_info($member_id);
			$collect_info['ref_id'] = $collect_info['id'];
			unset($collect_info['id']);
			$ref_save = $this->Member_model->save_reference_info($collect_info);
			unset($data['ref_mem_id']);
			unset($data['client_id']);
			unset($data['member_name']);

			$data['added_by'] = $this->session->userdata("user_id");
			$is_update = $this->Member_model->update_member_info($member_id,$data);
			if($is_update > 0){
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE)
				{
					$this->session->set_flashdata('flashMessage', array('danger', "Sorry, Referee Member Added Failed."));                   
				}
				else
				{
					$this->session->set_flashdata('flashMessage', array('success', "Referee Member Added Successfully."));                   
				}
			}
		}
		redirect('/admin/common/add/member');	

	}

	function member_details($id)
	{
		$data = $this->init("Bank Account Create");
		$data['data'] = $this->Member_model->get_member_details($id);
		$data['ref_data']= $this->Member_model->get_reference_details($id);
		$data["content"] = $this->load->view($this->theme."member/index",$data,TRUE);
		$this->load->view($this->theme.'layout',$data);
	}

	public function memberDeactive($id='', $status='') {

		if((int)$id>0){

			$status = $status==1?0:1;

			$this->db->trans_start();
			$this->Member_model->_update($id, ['status'=>$status]);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				$this->session->set_flashdata('flashMessage', array('danger', "Sorry, member status updating failed."));
			} else {
				$this->session->set_flashdata('flashMessage', array('success', "Member status updated successfully."));
			}
		}

		redirect('admin/member/allMembers', 'refresh');
	}

	public function get_has_password($password) {
		$options = array(
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		);
		$hashPass = password_hash($password, PASSWORD_BCRYPT, $options);
		return $hashPass;
	}

}

/* End of file Member.php */
/* Location: .//E/xampp alltime setups/XAMPP Latest7/htdocs/bosoti_org/app/controllers/admin/Member.php */