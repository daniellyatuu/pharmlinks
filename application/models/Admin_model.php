<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Admin_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function index(){
        $group = $this->db->get('group');
        return $group->result();
    }

    public function user_count(){
        return $this->db->count_all('user');
    }

    public function fetch_users($limit, $start){

        if($_GET){
            $email=$_GET['email'];
            $category = $_GET['role'];

            $this->db->like('email', $email, 'both');
            $this->db->like('group', $category);
        }

        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('user');

        if($query->num_rows() > 0){
            foreach($query->result() as $user_row){
                $data[] = $user_row;
            }

            return $data;
        }else{
            return false;
        }
    }

    public function dan(){
        $x = $_GET['sort'];
        echo $x;
    }

}
?>