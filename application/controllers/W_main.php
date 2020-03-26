<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class W_main extends CI_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function dashboard(){
        //auto cancel order
        // $this->billing->auto_cancel_order();
        
        // $left_rt_dash['leftRtDash']='active';
        // $left_rt_dash['title']='Retailer Dashboard';
        $this->load->view('includes/header/Header');
        $this->load->view('navbar/Base');
        $this->load->view('wholesaler/Home.php');
        $this->load->view('includes/footer/Footer');
    }

}
?>