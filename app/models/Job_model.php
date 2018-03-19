<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends MY_Model{

	public function __construct()
	{
		parent::__construct();
	}


	function post_job($action='insert'){
		
		$data = array();

		$data['media_id'] = $this->input->post('media_id', TRUE);
		if (isset($_FILES['image']) && !empty($_FILES["image"]["name"]) && $_FILES["image"]["size"]>0) {
            $image_name = $this->input->post('title');
            $data['media_id'] = $this->image_upload($_FILES['image'], 'post', array("action"=>$action,"name"=>$image_name));
        }		

		$data["title"] = $this->input->post('title',TRUE);
		if(isset($_POST['slug']) && !empty($_POST['slug']))
        	$data["slug"] = url_title($this->input->post('slug',TRUE), 'dash', TRUE);
        else
        	$data["slug"] = url_title($this->input->post('title',TRUE), 'dash', TRUE);

		$data["post_type"] = $this->input->post('post_type',TRUE);
		$data["order_id"] = $this->input->post('order_id',TRUE);
        $data["tag"] = $this->input->post('hidden-tags',TRUE);
		//$data["video_id"] = $this->input->post('video_id',TRUE);
		$data["status"] = $this->input->post('status',TRUE);
		
		$data["company_id"] = $this->input->post('company',TRUE);
		$data["category_id"] = $this->input->post('category',TRUE);
		$data["job_type_id"] = $this->input->post('job_type',TRUE);
		$data["job_nature_id"] = $this->input->post('job_nature',TRUE);
		//$data["company_type"] = $this->input->post('company_type',TRUE);
		$data["priority"] = $this->input->post('job_priority',TRUE);
		$data["apply_email"] = $this->input->post('apply_email',TRUE);
		$data["company_benefit"] = $this->input->post('company_benefit',TRUE);
		$data["apply_instruction"] = $this->input->post('apply_instruction',TRUE);

		$data["vacancy_no"] = $this->input->post('vacancy_no',TRUE);
		$data["experience_min"] = $this->input->post('experience_min',TRUE);
		$data["experience_max"] = $this->input->post('experience_max',TRUE);
		$data["age_min"] = $this->input->post('age_min',TRUE);
		$data["age_max"] = $this->input->post('age_max',TRUE);
		$data["salary_min"] = $this->input->post('salary_min',TRUE);
		$data["salary_max"] = $this->input->post('salary_max',TRUE);
		$data["job_source"] = $this->input->post('job_source',TRUE);
		$data["job_location"] = $this->input->post('job_location',TRUE);
		$data["start_date"] = $this->input->post('start_date',TRUE);
		$data["end_date"] = $this->input->post('end_date',TRUE);

		$data["job_description"] = $this->master->remove_specialchars($this->input->post('job_description',TRUE));
		$data["responsibility"] = $this->master->remove_specialchars($this->input->post('responsibility',TRUE));
		$data["experience_requirement"] = $this->master->remove_specialchars($this->input->post('experience_requirement',TRUE));
		$data["education_requirement"] = $this->master->remove_specialchars($this->input->post('education_requirement',TRUE));
		$data["aditional_requirement"] = $this->master->remove_specialchars($this->input->post('aditional_requirement',TRUE));

		


        if($action == "insert"){
            $data["created"] = $this->now;
            
            if(isset($_POST['_post_by'])) // for admin
	        	$data["post_by"] = $this->session->userdata("user_id");
	        else
	        	$data["post_by"] = $this->session->userdata("employe_id");

            $post_id = $this->insert($this->post_table, $data); // inserting job

        }else{
            $post_id = $this->input->post("id",TRUE); // EDITED job ID
            $data["updated"] = $this->now;
            if(isset($_POST['_post_by'])) // for admin
	        	$data["update_by"] = $this->session->userdata("user_id");
	        else
	        	$data["update_by"] = $this->session->userdata("employe_id");

            $this->update($this->post_table, $post_id, $data); // UPDATING job
        }


		return $post_id;
	}


	/**
	* medhod: get_jobs, to get job
	* @params (string) ($priority=normal, hotjob, topjob)
	* @params (number) ($id)
	* return (array of objects)
	*/
	function get_jobs($priority='normal', $id=''){ // 1 normal, 2 hot, 3 top job
		
        $this->db->select("*, 
            (select name from ".$this->user_table." where id=post_by) as post_by, 
            (select name from ".$this->user_table." where id=update_by) as update_by, 
            (select image from ".$this->media_table." where id=(select media_id from ".$this->employer_table." where id=company_id limit 1)) as company_image, 
            (select company from ".$this->employer_table." where id=company_id) as company, 
            (select title from ".$this->category_table." where id=category_id) as category, 
            (select title from ".$this->job_nature_table." where id=job_nature_id) as job_nature, 
            (select title from ".$this->job_type_table." where id=job_type_id) as job_type,
            created, updated, video_id, reader_hit, status");

        if($id != ''){
            $this->db->where("id",$id);
        }

        if($priority == 'hotjob'){
        	$this->db->where("priority",2);
        }
        if($priority == 'topjob'){
        	$this->db->where("priority",3);
        }

        $this->db->order_by("id","DESC");
        $query = $this->db->get($this->post_table);
        // echo $this->db->last_query(); exit;
        return $query->result();
	}

	
}?>