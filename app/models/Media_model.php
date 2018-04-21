<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends MY_Model {

    public $table = 'tbl_medias';
    public $pk = 'id';


    function __construct() {
        parent::__construct();

    } 
   
}
