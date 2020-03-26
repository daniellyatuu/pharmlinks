<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Home extends CI_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $context['title']='Pharmlinks';
        $this->load->view('includes/header/home_header.php', $context);
        $this->load->view('home/home.php');
        $this->load->view('includes/footer/home_footer.php');
    }
}
?>