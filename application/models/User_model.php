<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class User_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->db->where('name!=', 'admin');
        $group = $this->db->get('group');
        return $group->result();
    }

    public function user_data_save($clean_user_data){
        // Query to check whether user login already exist in the database or not
        $this->db->from('user');
        $this->db->where('username', $clean_user_data['username']);
        $this->db->limit(1);
        $query_user_info=$this->db->get();
        $count_user = $query_user_info->num_rows();
        
        if($count_user == 0){
            // save
            $this->db->insert('user', $clean_user_data);
            if($this->db->affected_rows() > 0){
                // return saved id
                return $this->db->insert_id();
            }
        }else{
            return FALSE;
        }
    }

    public function save_location($pharmacy_location){
        $this->db->insert('location', $pharmacy_location);
        $id=$this->db->insert_id();
        // return saved id
        return (isset($id)) ? $id : false;
    }

    public function save_pharmacy($clean_pharmacy){
        $this->db->insert('pharmacy', $clean_pharmacy);
    }

    public function login($data){
        $this->db->where('username', $data['usermail']);
        $this->db->where('password', md5($data['user_pass']));
        return $this->db->get('user')->row();
    }

    public function verify_number(){
        $this->db->where('id', $this->session->userdata('id'));
        $get_data=$this->db->get('user');
        return $get_data->result();
    }

}
?>