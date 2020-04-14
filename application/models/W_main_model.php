<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_main_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function save_product($clean_product_data){
        $this->db->insert('product', $clean_product_data);
        $id=$this->db->insert_id();
        // return saved id
        return (isset($id)) ? $id : false;
    }

}
?>