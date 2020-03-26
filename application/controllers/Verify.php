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
        
        $new_phone_no=$this->input->post('phone_number');
        echo $new_phone_no;
        exit();
        
        // ###########################################
        // //check if user data already exist in the verification_code table and delete them before continue
        
        // $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        // $select_code=$this->db->get('verification_code');
        
        // $count_code_selected=$select_code->num_rows();
        // if($count_code_selected==1){
        //     $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        //     $this->db->delete('verification_code');
        // }
        // ###########################################
        
        // //prepare number inorder to send sms
        // $user_phoneNo=str_replace(str_split('-+() '),'',$get_updated_phone_no);
        
        // //substring all numbers
        // $last_nine_no=substr($user_phoneNo, -9);
        // $userPhoneno='255'.$last_nine_no;
        
        // //hold update number data
        // $hold_update_phone_no=array(
        //     'phone_no'=>$get_updated_phone_no
        // );
        
        // //clean data
        // $clean_phone_no_data=$this->security->xss_clean($hold_update_phone_no);
        // $this->access_database->update_phone_number($clean_phone_no_data);
        
        // //generate unique verification code
        // ##################################
        // ##################################
        
        // $digit=4;
        // $base_no=pow(10, $digit-1);
        // $power_no=pow(10, $digit)-1;
        // $verification_code=rand($base_no, $power_no);
        
        // //insert verification code
        // $this->db->from('verification_code');
        // $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        // $this->db->where('phone_number', $get_updated_phone_no);
        // $this->db->limit(1);
        // $code_number=$this->db->get();
        
        // //check if user already insert this number
        // if($code_number->num_rows() == 0){
        //     //insert this code to verification table
        //     $hold_code=array(
        //         'user_id'=>$this->session->userdata('unique_user_id'),
        //         'code'=>$verification_code,
        //         'phone_number'=>$get_updated_phone_no
        //     );
        //     //clean data
        //     $clean_hold_code=$this->security->xss_clean($hold_code);
        //     $this->db->insert('verification_code', $clean_hold_code);
            
        //     //get code from db and send to user who register
        //     $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        //     $get_code_number=$this->db->get('verification_code');
        //     foreach($get_code_number->result() as $code_number_row){
        //         $real_code_no=$code_number_row->code;
        //     }
        //     //generate verification sms
        //     $verification_sms="Your Pharmlinks code: ".$real_code_no.", Don't share this code with others.";
            
        //     ###	NEW API TO SEND SMS
        //     $arrContextOptions=array(
        //         "ssl"=>array(
        //             "verify_peer"=>false,
        //             "verify_peer_name"=>false,
        //         ),
        //     );
            
        //     //send sms to getway 
        //     $to = $userPhoneno;
        //     $sms = urlencode($verification_sms);
        //     $header='PHARMLINKS';
            
        //     $verification_code_sent = file_get_contents("https://www.sms.co.tz/api.php?do=sms&username=afeltechnologies&password=AFELSMS123&senderid=$header&dest=$to&msg=$sms", false, stream_context_create($arrContextOptions));
        //     //if msg sent to getway...insert data.
            
        //     if($verification_code_sent){
        //         //save sent sms to db
        //         $hold_sent_sms=array(
        //             'user_id'=>$this->session->userdata('unique_user_id'),
        //             'sms'=>$verification_sms,
        //             'sms_number'=>ceil(strlen($verification_sms)/160)
        //         );
        //         //clean data
        //         $clean_sent_sms=$this->security->xss_clean($hold_sent_sms);
        //         $this->db->insert('verification_sms', $clean_sent_sms);
        //     }
        // }
        
        // ##################################
        // ##################################
        
        // redirect('Registration/code_number');
    }

    public function code(){
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