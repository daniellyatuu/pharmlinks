<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class General_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->db->where('user', $this->session->userdata('id'));
        $pharmacy_query = $this->db->get('pharmacy');
        return $pharmacy_query->result();
    }
}
?>