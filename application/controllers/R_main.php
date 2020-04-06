<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class R_main extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='retailer' and $this->session->userdata('group')!='ADDO'){
            redirect('user');
        }
    }
    
    public function index(){
        //auto cancel order
        // $this->billing->auto_cancel_order();
        
        // $left_rt_dash['leftRtDash']='active';
        // $left_rt_dash['title']='Retailer Dashboard';
        $context['active']='retailer_dash';
        $context['title']='retailer';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Home.php');
        $this->load->view('includes/footer/Footer');
    }

}
?>