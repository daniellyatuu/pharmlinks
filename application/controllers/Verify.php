<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Verify extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        // load model
        $this->load->model('User_model', 'usermodel');
        
        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }
    }

    public function index(){
        $context['title']='pharmlinks | verify';
        $context['data']=$this->usermodel->verify_number();
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/verify_number');
        $this->load->view('includes/footer/auth_footer');
    }

    public function update(){
        
        $new_phone_no=str_replace(str_split('-+() '),'', $this->input->post('phone_number'));
        
        //update phone number
        $update_no=array(
            'phone_number'=>$new_phone_no
        );

        // clean data
        $clean_update_no = $this->security->xss_clean($update_no);
        $this->usermodel->update_phone_number($clean_update_no);
        
        //prepare number inorder to send sms
        $user_phone_no=str_replace(str_split('-+() '),'',$new_phone_no);
        
        //substring all numbers
        $last_nine_no=substr($user_phone_no, -9);
        $userPhoneno='255'.$last_nine_no;
        
        //generate unique verification code
        $code_exist = true;
        $verification_code = 0;

        while($code_exist){
            //generate the new code and check if exists
            $digit=4;
            $base_no=pow(10, $digit-1);
            $power_no=pow(10, $digit)-1;
            $verification_code=rand($base_no, $power_no);
            
            $this->db->where('user', $this->session->userdata('id'));
            $this->db->where('code', $verification_code);
            $code_no = $this->db->count_all_results('verification_code');
            
            if($code_no == 0){
                $code_exist = false;
            }
        }

        //save verification code
        $code = array(
            'user'=>$this->session->userdata('id'),
            'code'=>$verification_code,
        );
        $this->usermodel->save_code($code);
        
        //generate verification sms
        $verification_sms="Your Pharmlinks code: ".$verification_code.", Don't share this code with others.";
        // echo $verification_sms;

        ########################################
        # start send sms from here #############
        ########################################
        redirect('verify/code');
    }

    public function code(){
        $context['title']='pharmlinks | verify';
        $context['data']=$this->usermodel->verify_number();
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/code');
        $this->load->view('includes/footer/auth_footer');
    }

    public function finalize(){
        $code=str_replace('-','',$this->input->post('verify_code'));
        
        $this->db->from('verification_code');
        $this->db->where('user', $this->session->userdata('id'));
        $this->db->where('code', $code);
        $this->db->limit(1);
        $code_info=$this->db->get();

        // count code info
        $count_code = $code_info->num_rows();
        
        if($count_code > 0){
            
            // check user group
            $this->db->where('id', $this->session->userdata('group'));
            $category_data = $this->db->get('group');

            $category = '';
            foreach($category_data->result() as $category_row){
                $category = $category_row->name;
            }

            // change verification status
            $this->usermodel->verify();

            if($category == 'ADDO' or $category == 'retailer'){
                $this->usermodel->save_reference_no();
            }
            
            $user_data = $this->usermodel->verify_number();
            

            // insert more user data
            foreach($user_data as $user_row){

                $userdata=array(
                    'id' => $user_row->id,
                    'first_name' => $user_row->first_name,
                    'last_name' => $user_row->last_name,
                    'email' => $user_row->email,
                    'username' => $user_row->username,
                    'phone_number' => $user_row->phone_number,
                    'reference_number' => $user_row->reference_number,
                    'group' => $category,
                    'gender' => $user_row->gender,
                    'active' => $user_row->active,
                    'verified' => $user_row->verified,
                );

            }

            $this->session->set_userdata($userdata);

            // send email to user .start
            // $email_to=$this->session->userdata('email');
            // $member_username=$this->session->userdata('username');
            
            // // user pwd
            // $pwd = $this->usermodel->get_pwd();
            // foreach($pwd as $row){
            //     $pwd_data = strrev($row->pwd);
            // }
            
            // $message_content='Dear <strong>customer,</strong><br/>
            // Thank you for Signing Up and Registering with <strong>PharmLinks!</strong>.<br/>
            // Use the following credentials to login to your Pharmlinks Account:-<br/>
            // <p style="margin-left:10px; margin:0; padding: 0;">
            // Username: <span style="text-decoration: underline; font-weight: bold;">'.$member_username.'</span><br/>
            // Password:<span style="text-decoration: underline; font-weight: bold;">'.$pwd_data.'</span></p><br>
            // If you have trouble please contact us via 0753 841 279<br/>
            // <p style="font-family: Trebuchet MS;">we get straight to work so you can get straight to business. Enjoy our services.</p>';
            
            // $this->load->library('email');
            
            // $config=array(
            //     'charset'=>'utf-8',
            //     'wordwrap'=> TRUE,
            //     'mailtype' => 'html'
            // );
            // $this->email->initialize($config);
            
            // $this->email->from('daniellyatuu@gmail.com', 'PharmLinks');
            // $this->email->to($email_to);
            // //$this->email->cc('another@another-example.com');
            // //$this->email->bcc('them@their-example.com');
            
            // $this->email->subject('PHARMLINKS REGISTRATION');
            // $this->email->message($message_content);
            
            // $this->email->send();
            // send email to user ./end

            redirect('verify/thanks');
            
        }else{
            // invalid code flash message
            $this->session->set_flashdata('error','Wrong verification code.');
            redirect('verify/code');
        }
        
    }

    public function thanks(){
        $context['title']='pharmlinks | thanks for register';
        $this->load->view('includes/header/auth_header', $context);
        $this->load->view('auth/thanks_for_register');
        $this->load->view('includes/footer/auth_footer');
    }

}
?>