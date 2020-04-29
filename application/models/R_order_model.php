<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class R_order_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }

    public function count_orders(){
        if($_GET){
            $order=$_GET['order'];

            $this->db->like('order_number', $order, 'both');
        }

        $this->db->where('from', $this->session->userdata('id'));
        $this->db->where('retailer_active', 1);
        $all_order = $this->db->get('order');
        
        if($all_order->num_rows() > 0){
            $sn=0;
            foreach($all_order->result() as $order_row){

                // get order content
                if($_GET){
                    $category = $_GET['category'];
        
                    if($category != ''){
                        $this->db->where('status_id', $category);
                    }
                   
                }

                $this->db->where('order_id', $order_row->id);
                $this->db->group_by('order_id');
                $order_content = $this->db->get('order_content');
                
                if($order_content->num_rows() > 0){
                    foreach($order_content->result() as $order_content_row){
                        $sn++;
                        $context[] = $order_content_row;
                    }
                }
            }
            return $sn;
        }else{
            return 0;
        }
    }

    public function get_status(){
        $status = $this->db->get('order_status');
        return $status->result();
    }

    public function get_order($limit, $start){
        if($_GET){
            $order=$_GET['order'];
            
            $this->db->like('order_number', $order, 'both');
        }

        $this->db->where('from', $this->session->userdata('id'));
        $this->db->where('retailer_active', 1);
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'desc');
        $all_order=$this->db->get('order');
            
        if($all_order->num_rows() > 0){
            $context = array();
            foreach($all_order->result() as $order_row){

                // get order content
                if($_GET){
                    $category = $_GET['category'];
        
                    if($category != ''){
                        $this->db->where('status_id', $category);
                    }
                   
                }

                $this->db->where('order_id', $order_row->id);
                $this->db->group_by('order_id');
                $order_content = $this->db->get('order_content');
                
                if($order_content->num_rows() > 0){
                    foreach($order_content->result() as $order_content_row){
                        $context[] = $order_content_row;
                    }
                }
            }
            return $context;
        }else{
            return false;
        }
    }

    public function confirm_invoice($orderid){
        $this->db->where('id', $orderid);
        $this->db->where('from', $this->session->userdata('id'));
        $this->db->where('retailer_active', 1);
        $invoice=$this->db->get('order');
        return $invoice->num_rows();
    }

    public function get_invoice($orderid){
        $this->db->where('id', $orderid);
        $invoice=$this->db->get('order');
        return $invoice->result();
    }

    public function get_invoice_content($orderid){
        $this->db->where('order_id', $orderid);
        $invoice=$this->db->get('order_content');
        return $invoice->result();
    }

}
?>