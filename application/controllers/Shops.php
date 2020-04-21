<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Shops extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='retailer' and $this->session->userdata('group')!='ADDO'){
            redirect('user');
        }

        $this->load->library("pagination");
        
        // load model
        $this->load->model('Admin_model', 'adminmodel');
        $this->load->model('R_main_model', 'r_mainmodel');
    }
    
    public function index(){
        $context['active']='pharmacies';
        $context['title']='select shop';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Shops.php');
        $this->load->view('includes/footer/Footer');
    }

    public function all(){

        $sortby = 20;
        if($_GET){
            $sort = $_GET['sort'];
            $sortby = $sort;
        }

        $config = array();
        $config["base_url"] = base_url() . "shops/all";
        $config["total_rows"] = $this->r_mainmodel->count_all_products();
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
        
        $context['active']='pharmacies';
        $context['title']='products';
        $context["products"] = $this->r_mainmodel->get_all_products($config["per_page"], $page);
        $context["links"] = $this->pagination->create_links();
        $context["categories"] = $this->adminmodel->get_category();
        $context['pagermessage'] = 'Showing '.($page+1) . ' to ' . $to . ' from ' . $count . ' results';

        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/All_product.php');
        $this->load->view('includes/footer/Footer');
    }

    public function pharmacy(){

        $pharmacy_owner_id = $this->uri->segment(3);

        // check if user not blocked also
        // check if user already verified
        $check_seller = $this->r_mainmodel->verify_seller($pharmacy_owner_id);
        if($check_seller==0){
            redirect('shops');
        }
        
        $sortby = 20;
        if($_GET){
            $sort = $_GET['sort'];
            $sortby = $sort;
        }

        $config = array();
        $config["base_url"] = base_url() . "shops/pharmacy/".$pharmacy_owner_id;
        $config["total_rows"] = $this->r_mainmodel->count_pharmacy_products($pharmacy_owner_id);
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $to = $page + $this->pagination->per_page;
        $count = $config['total_rows'];
        
        if ($to > $count) {
            $to = $count;
        }
        
        $context['active']='pharmacies';
        $context['title']='pharmacy products';
        $context['pharmacy_data']=$this->r_mainmodel->seller_pharmacy($pharmacy_owner_id);
        $context["products"] = $this->r_mainmodel->get_pharmacy_products($config["per_page"], $page, $pharmacy_owner_id);
        $context["links"] = $this->pagination->create_links();
        $context["categories"] = $this->adminmodel->get_category();
        $context['pagermessage'] = 'Showing '.($page+1) . ' to ' . $to . ' from ' . $count . ' results';

        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Pharmacy_product.php');
        $this->load->view('includes/footer/Footer');
    }
    
    // public function pharmacy(){
    //     $user_id=$this->uri->segment(3);
        
    //     //get seller information
    //     $this->db->where('user_ID', $user_id);
    //     $this->db->where('status', 'active');
    //     $this->db->where('category', 'wholesaler');
    //     $count_seller=$this->db->count_all_results('user_details');
        
    //     if($count_seller==0){
    //         redirect('shops');
    //     }
        
    //     //get pharmacy information
    //     $this->db->where('user_ID', $user_id);
    //     $get_pharmacy_details=$this->db->get('pharmacies');
    //     foreach($get_pharmacy_details->result() as $pharmacy_row){
    //         $pharmacy_name=$pharmacy_row->name;
    //     }
    //     $data['leftRtProducts']='active';
    //     $data['title']=$pharmacy_name;
    //     $this->load->view('includes/Pharmacy_header', $data);
    //     $this->load->view('includes/Left_top_right_sidebar');
    //     $this->load->view('Pharmacy');
    //     $this->load->view('includes/Pharmacy_footer');
    // }
}
?>