<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// if($this->session->userdata("user_id")==""){
		// 	redirect($this->admin_path, "refresh");
		// }
		$this->load->model('Member_model');
	}

	public function index()
	{
		
	}

	function save_member()
	{
		$data = $this->input->post();
		$this->db->trans_start();
		if($data['membership_type'] == "1"){
			$data['added_by'] = $this->session->userdata("user_id");
			unset($data['ref_mem_id']);
			unset($data['member_name']);
			$is_save=$this->Member_model->save_new_member($data);
			if($is_save > 0){
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

}

/* End of file Member.php */
/* Location: .//E/xampp alltime setups/XAMPP Latest7/htdocs/bosoti_org/app/controllers/admin/Member.php */