<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class User extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        // load model
        $this->load->model('User_model', 'usermodel');
    }
    
    public function index(){
        // $login_register_buy['loginandbuy']=$this->uri->segment(3);
        /*echo $login_register_buy;
        exit();*/
        $context['title']='pharmlinks | login';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/login');
        $this->load->view('includes/footer/auth_footer');
        // sdsds
    }

    public function register(){
        $context['title']='pharmlinks | register';
        $context['page']='register';
        $context['group']=$this->usermodel->index();
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/register');
        $this->load->view('includes/footer/auth_footer');
    }

    public function save(){
        echo 'here';
        exit();
        $hold_user_data=array(
            'first_name'=>$this->input->post('firstname'),
            'middle_name'=>$this->input->post('midlename'),
            'last_name'=>$this->input->post('lastname'),
            'email'=>$this->input->post('usermail'),
            'phone_no'=>$this->input->post('user_phone'),
            'username'=>$this->input->post('user_name'),
            'password'=>md5($this->input->post('user_pass')),
            'viewedPassword'=>$this->input->post('user_pass'),
            'category'=>$this->input->post('user_position'),
            'status'=>'pending'
        );
        
        // //secure data
        // $clean_data=$this->security->xss_clean($hold_user_data);
        
        // $pass_userdata_to_model=$this->access_database->insert_user_data($clean_data);
        
        // if($pass_userdata_to_model==TRUE){
            
        //     //hold user login data and insert it to session
        //     if($_POST)
        //     {
        //         $login_result=$this->access_database->check_login_info($_POST);
        //         if(!empty($login_result))
        //         {
        //             foreach($login_result as $login_rows){
        //                 $get_user_login_data=array(
        //                     'unique_user_id' => $login_result->user_ID,
        //                     'user_category' => $login_result->category
        //                 );
        //             }
                    
        //             $this->session->set_userdata($get_user_login_data);
        //             redirect('Registration/verify_number');
        //         }
        //     }
            
        // }else{
        //     $error_send_userdata['repeated_username']='username already exist! Change username.';
        //     $this->load->view('includes/User_registration_header');
        //     $this->load->view('Users_registration', $error_send_userdata);
        //     $this->load->view('includes/User_registration_footer');
        // }
        
    }

    public function verify(){
        // if($this->session->userdata('unique_user_id')!=''){
        //     $this->load->view('includes/User_registration_header');
        //     $this->load->view('Verify_phone_number');
        //     $this->load->view('includes/User_registration_footer');
        // }else{
        //     redirect('Registration/index');
        // }
        $context['title']='pharmlinks | verify';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/verify_number');
        $this->load->view('includes/footer/auth_footer');
    }

    public function code(){
        // if($this->session->userdata('unique_user_id')!=''){
        //     $this->load->view('includes/User_registration_header');
        //     $this->load->view('Verification_code');
        //     $this->load->view('includes/User_registration_footer');
        // }else{
        //     redirect('Registration/index');
        // }
        $context['title']='pharmlinks | verify';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/code');
        $this->load->view('includes/footer/auth_footer');
    }

    public function thanks(){
        $context['title']='pharmlinks | thanks for register';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/thanks_for_register');
        $this->load->view('includes/footer/auth_footer');
    }

}
?>