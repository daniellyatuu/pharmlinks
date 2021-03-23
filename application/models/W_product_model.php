<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_product_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function index($id){
        $this->db->where('id', $id);
        $this->db->where('user', $this->session->userdata('id'));
        $this->db->where('status', 1);
        $get_product = $this->db->get('product');
        return $get_product->result();
    }

    public function update_product($id, $clean_product_data){
        $this->db->where('id', $id);
        $this->db->update('product', $clean_product_data);
    }

}
?>