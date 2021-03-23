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

        $this->load->model('R_main_model', 'r_mainmodel');
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

    public function info(){
        //count each product clicks
        $product_id=$this->uri->segment(3);
        $data = $this->r_mainmodel->product_details($product_id);
        if(empty($data)){
            redirect('shops');
        }

        foreach($data as $product_row){
            $product_name = $product_row->brand_name;
        }
        
        $context['active']='product_details';
        $context['title']=$product_name;
        $context['product']=$data;
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Product_detail');
        $this->load->view('includes/footer/Footer');
    }

}
?>
