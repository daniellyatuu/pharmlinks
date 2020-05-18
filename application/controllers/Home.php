<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Home extends CI_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $context['title']='Pharmlinks';
        $this->load->view('includes/header/Home_header.php', $context);
        $this->load->view('home/home.php');
        $this->load->view('includes/footer/Home_footer.php');
    }
}
?>