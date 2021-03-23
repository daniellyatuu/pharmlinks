<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Model_access_db extends CI_Model{
    
    function __construct(){
        parent:: __construct();
    }
    
    public function insert_user_data($clean_data){
        //Query to check whether user login already exist in the database or not
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->where('username', $clean_data['username']);
        $this->db->limit(1);
        $query_user_info=$this->db->get();
        
        if($query_user_info->num_rows() == 0)
        {
            //Query to insert data to database
            $this->db->insert('user_details', $clean_data);
            
            if($this->db->affected_rows() > 0)
            {
                return TRUE;
            }
        }
        
        else
        {
            return FALSE;
        }
    }
    
    public function update_phone_number($clean_phone_no_data){
        $this->db->where('user_ID', $this->session->userdata('unique_user_id'));
        $this->db->update('user_details', $clean_phone_no_data);
    }
    
    public function update_account_status($clean_new_status){
        $this->db->where('user_ID', $this->session->userdata('unique_user_id'));
        $this->db->update('user_details', $clean_new_status);
    }
    
    public function insert_reference_number(){
        $ref_number_exist = true;
        $new_ref_no = 0;
        
        while($ref_number_exist){
            //generate the new reference number and check if exists
            $digit=4;
            $base_no=pow(10, $digit-1);
            $power_no=pow(10, $digit)-1;
            $new_ref_no=rand($base_no, $power_no);
            
            $this->db->where('reference_number', $new_ref_no);
            $count_ref_number = $this->db->count_all_results('user_details');
            if($count_ref_number == 0){
                $ref_number_exist = false;
            }
        }
        
        //update retailer data
        $hold_retailer_info=array(
            'reference_number'=>'pw'.$new_ref_no,
            'status'=>'active'
        );
        
        //clean data
        $clean_retailer_info=$this->security->xss_clean($hold_retailer_info);
        
        $this->db->where('user_ID', $this->session->userdata('unique_user_id'));
        $this->db->update('user_details', $clean_retailer_info);
    }
    
    public function user_details_insert($secure_user_info){
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->where('username', $secure_user_info['username']);
        $this->db->limit(1);
        $user_info_table=$this->db->get();
        
        if($user_info_table->num_rows()==0){
            $this->db->insert('user_details', $secure_user_info);
            
            if($this->db->affected_rows() > 0){
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }
    
    public function check_login_info($data)
    {
        $this->db->select('*');
        $this->db->where('username', $data['user_name']);
        $this->db->where('password', md5($data['user_pass']));
        return $this->db->get('user_details')->row();
    }
    
    public function check_shopping_login_info($user_info){
        $this->db->select('*');
        $this->db->where('username', $user_info['username']);
        $this->db->where('password', $user_info['password']);
        return $this->db->get('user_details')->row();
    }
    
    public function save_products($clean_product_data){
        $this->db->insert('stocks', $clean_product_data);
        
        $id=$this->db->insert_id();
        return (isset($id)) ? $id : false;
    }
    
    public function insert_pharm_details($clean_pharm_details_data){
        $this->db->insert('pharmacies', $clean_pharm_details_data);
        
        $id=$this->db->insert_id();
        return (isset($id)) ? $id : false;
    }
    
    public function insert_pharm_location($clean_pharm_location_data){
        $this->db->insert('location', $clean_pharm_location_data);
    }
    
    public function update_pharmacy_data($pharmacyid, $clean_pharm_detail_data){
        $this->db->where('pharm_ID', $pharmacyid);
        $this->db->update('pharmacies', $clean_pharm_detail_data);
    }
    
    public function update_location($pharmacyid, $clean_pharm_location_data){
        $this->db->where('pharmacy_id', $pharmacyid);
        $this->db->update('location', $clean_pharm_location_data);
    }
    
    public function delete_user_product($deleted_by_id, $hold_delete_info){
        $this->db->where('product_ID', $deleted_by_id);
        $this->db->update('stocks', $hold_delete_info);
    }
    
    public function count_per_click($count_prdid){
        $this->db->set('click_count', 'click_count+1', false);
        $this->db->where('product_ID', $count_prdid);
        $this->db->update('stocks');
    }
    
    public function count_new_order($orderNumber){
        $this->db->set('view_count', 'view_count+1', false);
        $this->db->where('order_number', $orderNumber);
        $this->db->where('order_to', $this->session->userdata('unique_user_id'));
        $this->db->update('orders');
    }
    
    public function accept_order($order_number, $accept_info){
        $this->db->where('order_number', $order_number);
        $this->db->where('order_to', $this->session->userdata('unique_user_id'));
        $this->db->where('status', 'pending');
        $this->db->update('orders', $accept_info);
    }
    
    public function deduct_quantity($prd_id, $remain_prd_stock){
        $this->db->where('product_ID', $prd_id);
        $this->db->update('stocks', $remain_prd_stock);
    }
    
    public function wholesaler_deduct_qty($ordered_prd_id, $remain_stock_data){
        $this->db->where('product_ID', $ordered_prd_id);
        $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        $this->db->update('stocks', $remain_stock_data);
    }
    
    public function count_sold_product($ordered_prd_id){
        $this->db->set('sell_count', 'sell_count+1', false);
        $this->db->where('product_ID', $ordered_prd_id);
        $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        $this->db->update('stocks');
    }
    
    public function update_user_prd($each_prdid, $prd_info_to_update){
        $this->db->where('product_ID', $each_prdid);
        $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        $this->db->update('stocks', $prd_info_to_update);
    }
    
    public function retailer_cancel_order($datetimePrdOrdered, $cancel_status)
    {
        $this->db->where('order_from', $this->session->userdata('unique_user_id'));
        $this->db->where('date_ordered', $datetimePrdOrdered);
        $this->db->update('orders', $cancel_status);
    }
    
    public function cancel_one_prd($prd_id, $prd_ordered_datetime, $hold_cancel_prd_info)
    {
        $this->db->where('order_from', $this->session->userdata('unique_user_id'));
        $this->db->where('productid', $prd_id);
        $this->db->where('date_ordered', $prd_ordered_datetime);
        $this->db->update('orders', $hold_cancel_prd_info);
    }
    
    public function receive_order($date_time_prd_ordered, $receive_status)
    {
        $this->db->where('order_from', $this->session->userdata('unique_user_id'));
        $this->db->where('date_ordered', $date_time_prd_ordered);
        $this->db->update('orders', $receive_status);
    }
    
    public function retailer_delete_order($dateTimePrdOredered, $holdDeletedInfo)
    {
        $this->db->where('order_from', $this->session->userdata('unique_user_id'));
        $this->db->where('date_ordered', $dateTimePrdOredered);
        $this->db->update('orders', $holdDeletedInfo);
    }
    
    public function wholesaler_delete_order($retailer_id, $orderdattime, $cleandeletedata)
    {
        $this->db->where('order_from', $retailer_id);
        $this->db->where('order_to', $this->session->userdata('unique_user_id'));
        $this->db->where('date_ordered', $orderdattime);
        $this->db->update('orders', $cleandeletedata);
    }
    
    public function quick_edit_product($product_to_update, $clean_modified_prd_data)
    {
        $this->db->where('product_ID', $product_to_update);
        $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        $this->db->update('stocks', $clean_modified_prd_data);
    }
    
    public function update_profile($profile_data)
    {
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $profile_data);
    }
    
    public function change_user_pass($clean_user_pass)
    {
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $clean_user_pass);
    }

	public function update_pwd($pwd)
    {
        $this->db->where('user', $this->session->userdata('id'));
        $this->db->update('pwd', $pwd);
    }
    
    public function searched_key($clean_searched_data)
    {
        $this->db->insert('search_history', $clean_searched_data);
    }
    
    public function search_keyword($seach_by_key)
    {
        $this->db->where('status', 'available');
        $this->db->where('quantity>', '0');
        
        $this->db->like('product_name', $seach_by_key, 'both');
        $this->db->or_like('generic_name', $seach_by_key, 'both');
        
        $this->db->limit(100);
        $this->db->where('status', 'available');
        $this->db->where('quantity>', '0');
        
        $query_search_result=$this->db->get('stocks');
        return $query_search_result->result();
    }
    
    public function update_notification($clean_update_notification_click){
        $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        $this->db->update('notification', $clean_update_notification_click);
    }
    
    public function order_notification($order_number, $order_notification){
        $this->db->where('order_number', $order_number);
        $this->db->where('user_id', $this->session->userdata('unique_user_id'));
        $this->db->update('notification', $order_notification);
    }
    
    public function seller_notification($orderNumber){
        $this->db->where('order_number', $orderNumber);
        foreach($this->db->get('notification')->result() as $notif_row){
            $view_status=$notif_row->viewed;
        }
        if($view_status==0){
            $update_notif=array(
                'notification_order'=>'pending order',
                'viewed'=>1
            );
            $this->db->where('order_number', $orderNumber);
            $this->db->update('notification', $update_notif);
        }
    }
}
?>
