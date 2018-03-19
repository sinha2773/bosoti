<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation_model extends CI_Model{
	public $bDit_validation;
	public $table;
	public $type;
	public function __construct()
	{
		parent::__construct();
		$this->table = "tbl_users";
		$this->type  = "insert";
		$this->set_validation();
	}


	public function set_validation($options=array())
	{
		$this->bDit_validation = array();
		$this->bDit_validation['username'] = array(
            'field' => 'txtUsername',
            'label' => 'username',
            'rules' => 'trim|xss_clean|strip_tags|required|min_length[5]|max_length[12]|is_unique['.$this->table.'.username]',
            'errors' => array(
                'required' => 'Please provide your %s.',
                'is_unique' => 'Sorry, provided %s already exist.',
            ),
        );
        $this->bDit_validation['password'] = array(
            'field' => 'txtPassword',
            'label' => 'password',
            'rules' => 'trim|xss_clean|strip_tags|required|min_length[5]|max_length[12]',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );
        $this->bDit_validation['re_password'] = array(
            'field' => 'txtRePassword',
            'label' => 'password confirmation',
            'rules' => 'trim|xss_clean|strip_tags|required|matches[txtPassword]',
            'errors' => array(
                'required' => 'Please provide your %s.',
                'matches' => 'Sorry, did not matche %s.',
            ),
        );
        $this->bDit_validation['first_name'] = array(
            'field' => 'txtFirstName',
            'label' => 'first name',
            'rules' => 'trim|xss_clean|strip_tags|required|alpha',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );
        $this->bDit_validation['last_name'] = array(
            'field' => 'txtLastName',
            'label' => 'last name',
            'rules' => 'trim|xss_clean|strip_tags|required|alpha',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );
        $this->bDit_validation['mobile'] = array(
            'field' => 'txtMobile',
            'label' => 'mobile',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );
        $this->bDit_validation['email'] = array(
            'field' => 'txtEmail',
            'label' => 'email',
            'rules' => 'trim|xss_clean|strip_tags|required|valid_email|is_unique['.$this->table.'.email]',
            'errors' => array(
                'required' => 'Please provide your %s.',
                'valid_email' => 'Please provide a valid %s.',
                'is_unique' => 'Sorry, provided %s already exist.',
            ),
        );
        $this->bDit_validation['address'] = array(
            'field' => 'txtAddress',
            'label' => 'address',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );

        $this->bDit_validation['country'] = array(
            'field' => 'txtCountry',
            'label' => 'country',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );

        $this->bDit_validation['city'] = array(
            'field' => 'txtCity',
            'label' => 'city',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );

        $this->bDit_validation['description'] = array(
            'field' => 'txtDescription',
            'label' => 'description',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );

        // for company
        $this->bDit_validation['company_name'] = array(
            'field' => 'txtCompanyName',
            'label' => 'company name',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );
        $this->bDit_validation['industry'] = array(
            'field' => 'industrys[]',
            'label' => 'industry',
            'rules' => 'trim|xss_clean|strip_tags|required',
            'errors' => array(
                'required' => 'Please provide your %s.',
            ),
        );
        
	}
}
?>