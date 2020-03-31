<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class User extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        // load model
        $this->load->model('User_model', 'usermodel');
    }
    
    public function index(){
        $context['title']='pharmlinks | login';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/login');
        $this->load->view('includes/footer/auth_footer');
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
        $user_data=array(
            'email'=>$this->input->post('usermail'),
            'phone_number'=>str_replace(str_split('()-+ '),'', $this->input->post('user_phone')),
            'username'=>$this->input->post('usermail'),
            'password'=>md5($this->input->post('user_pass')),
            'group'=>$this->input->post('group'),
        );
        
        $clean_user_data = $this->security->xss_clean($user_data);
        $saved_object = $this->usermodel->user_data_save($clean_user_data);
        
        if(!empty($saved_object)){

            // save viewed pwd
            $pwd = array(
                'user'=>$saved_object,
                'pwd'=>strrev($this->input->post('user_pass')),
            );

            // clean data
            $clean_pwd = $this->security->xss_clean($pwd);
            $this->usermodel->pwd($clean_pwd);
            
            $pharmacy_location = array(
                'country'=>$this->input->post('country'),
                'location_name'=>$this->input->post('location_name'),
                'lattitude'=>$this->input->post('lati'),
                'longitude'=>$this->input->post('longi'),
            );

            $clean_pharmacy_location = $this->security->xss_clean($pharmacy_location);
            $saved_loc_obj = $this->usermodel->save_location($pharmacy_location);

            if(!empty($saved_loc_obj)){
                $pharmacy = array(
                    'user'=>$saved_object,
                    'location'=>$saved_loc_obj,
                    'name'=>$this->input->post('pharmacy_name'),
                    'FIN'=>$this->input->post('fin'),
                );

                $clean_pharmacy = $this->security->xss_clean($pharmacy);
                $this->usermodel->save_pharmacy($clean_pharmacy);
            }
            
            // auto-logn
            if($_POST){
                
                $user_login=$this->usermodel->login($_POST);

                if(!empty($user_login)){
                    foreach($user_login as $data){
                        $user_data=array(
                            'id' => $user_login->id,
                            'group' => $user_login->group,
                            'logged_in' => true,
                        );
                    }
                    $this->session->set_userdata($user_data);
                }
            }
            redirect('verify');

        }else{
            // wrong account flash message
            $this->session->set_flashdata('error','email already exist! Change email.');
            redirect('user/register');
        }   
    }
}
?>