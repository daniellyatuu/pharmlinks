<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Main extends CI_Controller{
    
    function __construct(){
        parent:: __construct();
        $this->load->model('Model_access_db', 'access_database');
        
        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }
    }
    
    // public function pharmacy(){
    //     //check if user register pharmacy
    //     $this->db->where('user_ID', $this->session->userdata('unique_user_id'));
    //     $count_pharmacy=$this->db->count_all_results('pharmacies');
        
    //     $content_data['pharm_detail_highlight']="active";
    //     $content_data['title']="Pharmacy Details";
    //     $this->load->view('includes/Pharmacy_details_header', $content_data);
    //     $this->load->view('includes/Left_top_right_sidebar');
    //     if($count_pharmacy==0){
    //         $this->load->view('Pharmacy_details');
    //     }else{
    //         $this->load->view('View_pharm_details');
    //     }
    //     $this->load->view('includes/Pharmacy_details_footer');
    // }
    
    // public function insert_pharmacy_details(){
    //     //506=is code which i set if user is not register his pharmacy
    //     $phamacy_code=$this->input->post('pharm_code');
        
    //     //insert pharmacy details .start
    //     $hold_pharm_details_infos=array(
    //         'user_ID'=>$this->session->userdata('unique_user_id'),
    //         'name'=>$this->input->post('pharmacy_name'),
    //         'business_TIN_no'=>$this->input->post('tin_number')
    //     );
        
    //     //clean data
    //     $clean_pharm_details_data=$this->security->xss_clean($hold_pharm_details_infos);
        
    //     $returned_pharmacy_id=$this->access_database->insert_pharm_details($clean_pharm_details_data);
        
    //     //insert pharmacy location .start
    //     $hold_pharm_location_infos=array(
    //         'pharmacy_id'=>$returned_pharmacy_id,
    //         'country'=>$this->input->post('country_operated'),
    //         'city_id'=>$this->input->post('selected_city'),
    //         'location_name'=>$this->input->post('location_name'),
    //         'lattitude'=>$this->input->post('lati'),
    //         'longitude'=>$this->input->post('longi')
    //     );
        
    //     //clean data
    //     $clean_pharm_location_data=$this->security->xss_clean($hold_pharm_location_infos);
        
    //     $pass_pharm_location_to_model=$this->access_database->insert_pharm_location($clean_pharm_location_data);
        
    //     //check if user register to buy or to return to dashboard
    //     /*if($phamacy_code=='506'){
    //         redirect('Billing/save_order');
    //     }else{
    //         redirect('Main/view_pharmacy_details?pharmacy_registered');
    //     }*/
        
    //     redirect('Main/pharmacy?pharmacy_registered');
    // }
    
    // public function edit_phamacy_details(){
    //     //pass data to view
    //     $pharm_detail_clicked['title']='Edit Pharmacy Details';
    //     $pharm_detail_clicked['pharm_detail_highlight']='active';
    //     $this->load->view('includes/Pharmacy_details_header', $pharm_detail_clicked);
    //     $this->load->view('includes/Left_top_right_sidebar');
    //     $this->load->view('Edit_pharm_details');
    //     $this->load->view('includes/Pharmacy_details_footer');
    // }
    
    // public function update_pharm_location(){
    //     $pharmacyid=$this->input->post('pharmacyid');
        
    //     //collect pharmacy details
    //     $hold_pharm_details_to_update=array(
    //         'name'=>$this->input->post('edit_pharmacy_name'),
    //         'business_TIN_no'=>$this->input->post('edit_tin_number')
    //     );
    //     //clean data
    //     $clean_pharm_detail_data=$this->security->xss_clean($hold_pharm_details_to_update);
        
    //     $this->access_database->update_pharmacy_data($pharmacyid, $clean_pharm_detail_data);
        
    //     //collect pharmacy location data from page
        
    //     $hold_pharm_direction_to_update=array(
    //         'country'=>$this->input->post('country_operated'),
    //         'city_id'=>$this->input->post('selected_city'),
    //         'location_name'=>$this->input->post('location_name'),
    //         'lattitude'=>$this->input->post('lati'),
    //         'longitude'=>$this->input->post('longi')
    //     );
        
    //     //clean data
    //     $clean_pharm_location_data=$this->security->xss_clean($hold_pharm_direction_to_update);
        
    //     $this->access_database->update_location($pharmacyid, $clean_pharm_location_data);
        
    //     redirect('Main/pharmacy?edited');
    // }
    
    // public function thanks(){
    //     $this->load->view('includes/User_registration_header');
    //     $this->load->view('Thank_you');
    //     $this->load->view('includes/User_registration_footer');
    // }
    
    public function my_profile(){
		$context['active']='profile';
        $context['title']='Profile';

		$this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('general/Profile');
        $this->load->view('includes/footer/Footer');
    }
    
    public function edit_profile(){
        $profile_data=array(
            'first_name'=>$this->input->post('edit_fname'),
            'last_name'=>$this->input->post('edit_lname'),
            'email'=>$this->input->post('edit_mail'),
            'phone_number'=>$this->input->post('edit_contact'),
            'gender'=>$this->input->post('sex'),
            'update_at'=>date('Y-m-d H:i:s')
        );
        
        //clean data
        $clean_profile_data=$this->security->xss_clean($profile_data);
        $this->access_database->update_profile($profile_data);
        redirect('Main/my_profile?profile_updated');
    }
    
    public function change_password(){
        $user_pass=array(
            'password'=>md5($this->input->post('user_password')),
            'update_at'=>date('Y-m-d H:i:s')
        );

		// save viewed pwd
		$pwd = array(
			'pwd'=>strrev($this->input->post('user_password')),
		);

		// clean data
		$clean_pwd = $this->security->xss_clean($pwd);
		$this->access_database->update_pwd($clean_pwd);
        
        //clean data
        $clean_user_pass=$this->security->xss_clean($user_pass);
        $this->access_database->change_user_pass($clean_user_pass);
        redirect('Main/my_profile?password_updated');
    }
    
    /*public function error404(){
        $this->load->view('includes/Error_404_header');
        $this->load->view('Error_404');
        $this->load->view('includes/Error_404_footer');
    }*/
}
?>
