<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class A_main extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='admin'){
            redirect('user');
        }

        $this->load->library("pagination");
        // load model
        $this->load->model('Admin_model', 'adminmodel');
    }
    
    public function index(){
        $context['title']='admin';
        $context['active']='admin_dash';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('admin/Home.php');
        $this->load->view('includes/footer/Footer');
    }

    public function users(){

        $sortby = 20;
        if($_GET){
            $sort = $_GET['sort'];
            $sortby = $sort;
        }

        $config = array();
        $config["base_url"] = base_url() . "a_main/users";
        $config["total_rows"] = $this->adminmodel->user_count();
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
        
        $data['title']='users';
        $data['active']='users';
        $data['category']=$this->adminmodel->index();
        $data["users"] = $this->adminmodel->fetch_users($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagermessage'] = 'Showing '.($page+1) . ' to ' . $to . ' from ' . $count . ' results';

        $this->load->view('includes/header/Header', $data);
        $this->load->view('navbar/Base');
        $this->load->view('admin/Users');
        $this->load->view('includes/footer/Footer');
    }

    public function category(){
        $context['title']='category';
        $context['active']='categories';
        $context['category_data']=$this->adminmodel->get_category();
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('admin/Category');
        $this->load->view('includes/footer/Footer');
    }

    public function add_category(){
        $context['title']='category';
        $context['active']='categories';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('admin/Add_category');
        $this->load->view('includes/footer/Footer');
    }

    public function save_category(){
        // hold data
        $category = array(
            'name'=>$this->input->post('category'),
            'added_by'=>$this->session->userdata('id'),
        );

        // clean data
        $clean_category = $this->security->xss_clean($category);
        
        $save_category = $this->adminmodel->save_category($clean_category);
        if(empty($save_category)){
            
            // category already exist
            $this->session->set_flashdata('feedback', 'exists');
        }else{

            // category saved
            $this->session->set_flashdata('feedback', 'saved');
        }
        redirect('a_main/add_category');
    }

    public function package(){
        $context['title']='selling package';
        $context['active']='package';
        $context['package_data']=$this->adminmodel->get_selling_package();
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('admin/Package');
        $this->load->view('includes/footer/Footer');
    }

    public function add_package(){
        $context['title']='selling package';
        $context['active']='package';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('admin/Add_package');
        $this->load->view('includes/footer/Footer');
    }

    public function save_package(){
        // hold data
        $package = array(
            'name'=>$this->input->post('selling_package'),
            'added_by'=>$this->session->userdata('id'),
        );

        // clean data
        $clean_package = $this->security->xss_clean($package);
        
        $save_package = $this->adminmodel->save_package($clean_package);
        
        if(empty($save_package)){
            
            // category already exist
            $this->session->set_flashdata('feedback', 'exists');
        }else{

            // category saved
            $this->session->set_flashdata('feedback', 'saved');
        }
        redirect('a_main/add_package');
    }

}
?>