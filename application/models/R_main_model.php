<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class R_main_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function count_all_products(){
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

        $this->db->where('status', 1);
        $all_product = $this->db->get('product');
        return $all_product->num_rows();
    }

    public function get_all_products($limit, $start){
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

    public function verify_seller($pharmacy_owner_id){
        $this->db->where('active', 1);
        $this->db->where('verified', 1);
        $this->db->where('id', $pharmacy_owner_id);
        $check_seller = $this->db->get('user');
        return $check_seller->num_rows();
    }

    public function seller_pharmacy($pharmacy_owner_id){
        $this->db->where('user', $pharmacy_owner_id);
        $get_seller_pharmacy = $this->db->get('pharmacy');
        return $get_seller_pharmacy->result();
    }

    public function count_pharmacy_products($pharmacy_owner_id){
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

        $this->db->where('user', $pharmacy_owner_id);
        $this->db->where('status', 1);
        $all_product = $this->db->get('product');
        return $all_product->num_rows();
    }

    public function get_pharmacy_products($limit, $start, $pharmacy_owner_id){
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

        $this->db->where('user', $pharmacy_owner_id);
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

    public function product_details($product_id){
        $this->db->where('id', $product_id);
        $this->db->where('status', 1);
        $product_data=$this->db->get('product');

        $count_product = $product_data->num_rows();

        if($count_product > 0){
            foreach($product_data->result() as $product_row){
                $context[] = $product_row;
            }
            return $context;
        }else{
            return false;
        }
    }

}
?>