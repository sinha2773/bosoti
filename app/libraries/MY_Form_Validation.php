<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class MY_Form_Validation extends CI_Form_validation {
	function __construct() {
		parent::__construct();
	}

    function edit_unique($value, $params) 
    {
        $CI =& get_instance();
        $CI->load->database();
     
        $CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
     
        list($table, $field, $current_id) = explode(".", $params);

        $query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();
        echo $current_id;
        echo $CI->db->last_query(); exit;
        if ($query->row() && $query->row()->id != $current_id)
        {
            return FALSE;
        }
    }

    function strip_tags_content($text, $tags = '', $invert = FALSE) {
      preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
      $tags = array_unique($tags[1]);
       
      if(is_array($tags) AND count($tags) > 0) {
        if($invert == FALSE) {
          return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
        }
        else {
          return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
        }
      }
      elseif($invert == FALSE) {
        return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
      }
      return $text;
    } 

    function strip_input($input) 
    {
        $CI =& get_instance();
     
        $CI->form_validation->set_message('strip_input', "Sorry, invalid %s data.");
     
        $this->blackInput = array();
        $this->blackInput[] = preg_match('/(\bor\b|\bnull\b)/i', $input); // no sqli boolean keywords
        $this->blackInput[] = preg_match('/(\bunion|\bselect\b|\bfrom\b|\bwhere\b)/i', $input); // no sqli select keywords
        $this->blackInput[] = preg_match('/(\bgroup\b|\border\b|\bhaving\b|\blimit\b)/i', $input); //  no sqli select keywords
        $this->blackInput[] = preg_match('/(\binto\b|\bfile\b|\bcase\b)/i', $input); // no sqli operators
        $this->blackInput[] = preg_match('/(\b--\b|\/\*)/', $input);  // no sqli comments 
        $this->blackInput[] = preg_match('/(=|\|)/', $input); // no boolean operators

        foreach ($this->blackInput as $value) {
            if ($value == 1){
                return FALSE;
                break;                
            }
        }

    }


}