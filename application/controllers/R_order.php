<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class R_order extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='retailer' and $this->session->userdata('group')!='ADDO'){
            redirect('user');
        }

        $this->load->library("pagination");
        $this->load->model('R_order_model', 'rordermodel');
    }
    
    public function index(){

        $sortby = 20;
        if($_GET){
            $sort = $_GET['sort'];
            $sortby = $sort;
        }

        $config = array();
        $config["base_url"] = base_url() . "r_order/index";
        $config["total_rows"] = $this->rordermodel->count_orders();
        $config["per_page"] = $sortby;
        $config["uri_segment"] = 3;

        // CodeIgniter pagination customization
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = "<ul class='pagination' style='float:right;'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="javascript:void(0);" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_link'] = '';
        $config['last_link'] = '';
        $config['next_link'] = '<span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $to = $page + $this->pagination->per_page;
        $count = $config['total_rows'];
        
        if ($to > $count) {
            $to = $count;
        }
        
        $context['active']='retailer_order';
        $context['title']='orders';
        $context['status']=$this->rordermodel->get_status();
        $context["order_content"] = $this->rordermodel->get_order($config["per_page"], $page);
        $context["links"] = $this->pagination->create_links();
        $context['pagermessage'] = 'Showing '.($page+1) . ' to ' . $to . ' from ' . $count . ' results';

        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Order');
        $this->load->view('includes/footer/Footer');
    }

    public function invoice(){
        // confirm retailer invoice
        $orderid = $this->uri->segment(3);
        $invoice = $this->rordermodel->confirm_invoice($orderid);
        if($invoice == 0){
            redirect('r_order');
            exit();
        }
        
        $context['active']='retailer_order';
        $context['title']='invoice';
        $context['invoice']='invoice';
        $context['invoice']=$this->rordermodel->get_invoice($orderid);
        $context['invoice_content']=$this->rordermodel->get_invoice_content($orderid);
        
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Invoice');
        $this->load->view('includes/footer/Footer');
    }

}
?>