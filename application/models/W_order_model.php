<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_order_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function count_orders(){
        // get order content
        if($_GET){
            $category = $_GET['category'];

            if($category != ''){
                $this->db->where('status_id', $category);
            }
           
        }

        $this->db->where('to', $this->session->userdata('id'));
        
        $this->db->group_by('order_id');
        $this->db->group_by('to');
        $this->db->order_by('order_id', 'desc');
        $get_order_from_retailer=$this->db->get('order_content');

        // count received order
        $count_order = $get_order_from_retailer->num_rows();

        if($count_order > 0){
            $count_orderdata=0;
            foreach($get_order_from_retailer->result() as $get_order_row){
                $order_id = $get_order_row->order_id;
                
                if($_GET){
                    $order=$_GET['order'];
        
                    $this->db->like('order_number', $order, 'both');
                }
                // get order data
                $this->db->where('id', $order_id);
                $orderdata = $this->db->get('order');

                foreach($orderdata->result() as $orderdaat_row){
                    $count_orderdata++;
                }

            }
            return $count_orderdata;
        }else{
            return $count_order;
        }
        
    }

    public function get_status(){
        $this->db->where('name !=', 'cancelled');
        $status = $this->db->get('order_status');
        return $status->result();
    }

    public function get_order($limit, $start){
        // get order content
        if($_GET){
            $category = $_GET['category'];

            if($category != ''){
                $this->db->where('status_id', $category);
            }
        }

        $this->db->where('to', $this->session->userdata('id'));
        
        $this->db->group_by('order_id');
        $this->db->group_by('to');
        $this->db->order_by('order_id', 'desc');
        $get_order_from_retailer=$this->db->get('order_content');

        // count received order
        $count_order = $get_order_from_retailer->num_rows();

        if($count_order > 0){
            $context = array();
            foreach($get_order_from_retailer->result() as $get_order_row){
                $order_id = $get_order_row->order_id;
                
                if($_GET){
                    $order=$_GET['order'];
        
                    $this->db->like('order_number', $order, 'both');
                }

                // get order data
                $this->db->where('id', $order_id);
                $orderdata = $this->db->get('order');

                foreach($orderdata->result() as $orderdaat_row){
                    $context[] = $orderdaat_row;
                }
            }
            return $context;
        }else{
            return false;
        }
        // return $get_order_from_retailer->result();
    }

}
?>