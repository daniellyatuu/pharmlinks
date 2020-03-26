<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class User_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        // $this->db->where('name!=', 'admin');
        $group = $this->db->get('group');
        return $group->result();
    }

}
?>