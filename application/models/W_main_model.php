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

    public function count_products(){
        if($_GET){
            $product=$_GET['product'];
            $category = $_GET['category'];

            $this->db->group_start();
            $this->db->like('brand_name', $product, 'both');
            $this->db->or_like('generic_name', $product, 'both');
            $this->db->or_like('selling_package', $product, 'both');
            $this->db->or_like('country', $product, 'both');
            $this->db->group_end();
            $this->db->like('category', $category);
        }

        $this->db->where('user', $this->session->userdata('id'));
        $this->db->where('status', 1);
        $all_product = $this->db->get('product');
        return $all_product->num_rows();
    }

    public function get_products($limit, $start){
        if($_GET){
            $product=$_GET['product'];
            $category = $_GET['category'];

            $this->db->group_start();
            $this->db->like('brand_name', $product, 'both');
            $this->db->or_like('generic_name', $product, 'both');
            $this->db->or_like('selling_package', $product, 'both');
            $this->db->or_like('country', $product, 'both');
            $this->db->group_end();
            $this->db->like('category', $category);
        }

        $this->db->where('user', $this->session->userdata('id'));
        $this->db->where('status', 1);
        $this->db->order_by('id', 'desc');

        $this->db->limit($limit, $start);
        $all_products=$this->db->get('product');
        

        if($all_products->num_rows() > 0){
            foreach($all_products->result() as $product_row){
                $context[] = $product_row;
            }

            return $context;
        }else{
            return false;
        }
    }

    public function delete_product($product_id){

        $data = array(
            'status'=>0
        );
        // clean data
        $clean_data = $this->security->xss_clean($data);
        
        $this->db->where('id', $product_id);
        $this->db->where('user', $this->session->userdata('id'));
        $delete = $this->db->update('product', $clean_data);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}
?>