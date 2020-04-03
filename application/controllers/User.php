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

    public function login(){
        if($_POST){
            
            $user_login=$this->usermodel->login($_POST);
            
            if(!empty($user_login)){
                foreach($user_login as $user_row){
                    
                    $user_active=$user_login->active;
                    $user_verified = $user_login->verified;
                    
                    if($user_verified == 0){
                        $user_data=array(
                            'id' => $user_login->id,
                            'group' => $user_login->group,
                            'logged_in' => true,
                        );
                        $this->session->set_userdata($user_data);
                        $this->session->set_flashdata('verify','Please complete your registration.');
                        redirect('verify');
                        exit();
                    }
                    
                    if($user_active == 1){
                        
                        // check user group
                        $group_id = $user_login->group;
                        $this->db->where('id', $group_id);
                        $category_data = $this->db->get('group');

                        $category = '';
                        foreach($category_data->result() as $category_row){
                            $category = $category_row->name;
                        }
                        
                        $userdata=array(
                            'id' => $user_login->id,
                            'first_name'=> $user_login->first_name,
                            'last_name'=>$user_login->last_name,
                            'email'=>$user_login->email,
                            'username'=>$user_login->username,
                            'phone_number'=>$user_login->phone_number,
                            'reference_number'=>$user_login->reference_number,
                            'group'=>$category,
                            'gender'=>$user_login->gender,
                            'active'=>$user_login->active,
                            'verified'=>$user_login->verified,
                            'logged_in' => true,
                        );
                        
                    }else{
                        redirect('user/error_404');
                        exit();
                    }
                }

                $this->session->set_userdata($userdata);
                    
                $this->session->set_flashdata('loggedin','true');

                if($this->session->userdata('group')=='retailer' or $this->session->userdata('group')=='ADDO'){
                    redirect('r_main');
                }else if($this->session->userdata('group')=='wholesaler'){
                    redirect('w_main');
                }else if($this->session->userdata('group')=='admin'){
                    redirect('a_main');
                }
                
            }else{
                $this->session->set_flashdata('wrong_account','wrong password or username, try again!');
                redirect('user');
            }
        }
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

    public function error_404(){
        $context['title']='error 404';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/error_404');
        $this->load->view('includes/footer/auth_footer');
    }

    public function logout(){
        // if($this->session->userdata('user_category')=='retailer'){
        //     //insert cart data to temp_cart
        //     $cartData=$this->cart->contents();
        //     if(!empty($cartData)){
        //         foreach($cartData as $cartDataRow){
        //             $cart_data=array(
        //                 'userid'=>$this->session->userdata('unique_user_id'),
        //                 'productid'=>$cartDataRow['id'],
        //                 'productPrice'=>$cartDataRow['price'],
        //                 'quantity'=>$cartDataRow['qty'],
        //                 'productImage'=>$cartDataRow['name'],
        //                 'wholesalerid'=>$cartDataRow['optional']['eachWholesalerId']
        //             );
        //             $this->db->insert('temp_cart', $cart_data);
        //         }
        //     }
        // }
        
        //remove session
        $this->session->sess_destroy();
        
        redirect('user/logout_msg');
    }

    public function logout_msg(){
        $this->session->set_flashdata('logout','email already exist! Change email.');
        redirect('user');
    }
}
?>