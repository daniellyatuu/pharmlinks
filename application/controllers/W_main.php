<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_main extends CI_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        //auto cancel order
        // $this->billing->auto_cancel_order();
        
        // $left_rt_dash['leftRtDash']='active';
        // $left_rt_dash['title']='Retailer Dashboard';
        $context['active']='seller_detail';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Home.php');
        $this->load->view('includes/footer/Footer');
    }

    public function add(){
        $context['active']='add_product';
        $context['title']='add product';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Add_product.php');
        $this->load->view('includes/footer/Footer');
    }

}
?>