<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class General extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        // load model
        $this->load->model('General_model', 'generalmodel');
    }
    
    public function index(){
        $context['active']='pharmacy_detail';
        $context['title']='pharmacy details';
        $context['pharmacy'] = $this->generalmodel->index();
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('general/Pharmacy.php');
        $this->load->view('includes/footer/Footer');
    }

}
?>
