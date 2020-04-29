<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Billing_model extends CI_Model{
    
    function __construct(){
        parent:: __construct();
    }

    public function save_order($clean_order_data){
        $this->db->insert('order', $clean_order_data);
        // return saved id
        $id=$this->db->insert_id();
        return (isset($id)) ? $id : false;
    }
    
    public function save_order_content($clean_order_detail){
        $this->db->insert('order_content', $clean_order_detail);
    }

    public function deduct_quantity($prd_id, $clean_remain_qty){
        $this->db->where('id', $prd_id);
        $this->db->update('product', $clean_remain_qty);
    }

    // public function order_payment_info($clean_order_payment_data){
    //     $this->db->insert('order_payment_tb', $clean_order_payment_data);
    // }
    
    // public function temp_data_for_sending_message($clean_temp_data_for_send_sms){
    //     $this->db->select('*');
    //     $this->db->from('order_statistics');
    //     $this->db->where('retailer_id', $clean_temp_data_for_send_sms['retailer_id']);
    //     $this->db->where('wholesaler_id', $clean_temp_data_for_send_sms['wholesaler_id']);
    //     $this->db->where('date_product_ordered', $clean_temp_data_for_send_sms['date_product_ordered']);
    //     $this->db->limit(1);
    //     $temp_user_data=$this->db->get();
        
    //     if($temp_user_data->num_rows()==0){
    //         $this->db->insert('order_statistics', $clean_temp_data_for_send_sms);
    //     }
    // }
    
    // public function save_sent_sms($sms_sent)
    // {
    //     $this->db->insert('messages', $sms_sent);
    // }
    
    // public function update_order_price($wholesaler_id, $order_price)
    // {
    //     $this->db->select('*');
    //     $this->db->where('user_ID', $wholesaler_id);
    //     $this->db->update('user_details', $order_price);
    // }
    
    // public function update_wholesaler_order_price($wholesaler_unique_id, $retailer_order_price)
    // {
    //     $this->db->select('*');
    //     $this->db->where('user_ID', $wholesaler_unique_id);
    //     $this->db->update('user_details', $retailer_order_price);
    // }
    
    // /*public function update_instock($unique_prd_id, $prd_wholesaler_id, $clean_remain_instock){
    //     $this->db->where('product_ID', $unique_prd_id);
    //     $this->db->where('user_id', $prd_wholesaler_id);
    //     $this->db->update('stocks', $clean_remain_instock);
    // }*/
    
    // public function auto_cancel_order(){
    //     //get all unpaid orders
        
    //     $this->db->where('retailer_availability!=', 'deleted');
    //     $this->db->where('status!=', 'auto_cancel');
    //     $this->db->where('status', 'init');
        
    //     $this->db->group_by('order_from');
    //     $this->db->group_by('date_ordered');
    //     $this->db->order_by('orderid', 'desc');
    //     $unpaid_order=$this->db->get('orders');
    //     //count order
    //     $count_unpaid_order=$unpaid_order->num_rows();
    //     if($count_unpaid_order>0){
    //         foreach($unpaid_order->result() as $order_row){
    //             $order_no=$order_row->order_number;
    //             $order_from=$order_row->order_from;
    //             $orderto=$order_row->order_to;
    //             $productid=$order_row->productid;
    //             $productqty=$order_row->quantity;
    //             $ordered_date=$order_row->date_ordered;
                
    //             $number_of_hours=24;
                
    //             //today date
    //             $today_date=date('Y-m-d H:i:s');
                
    //             $hourdiff = round((strtotime($today_date) - strtotime($ordered_date))/3600);
    //             $remain_hrs = $number_of_hours-$hourdiff;
                
    //             if($remain_hrs<=0){
    //                 //delete the order
                    
    //                 //check if buyer pay some money on order
    //                 $this->db->where('order_number', $order_no);
    //                 $get_payment_data=$this->db->get('order_payment_tb');
    //                 foreach($get_payment_data->result() as $payment_row){
    //                     $amount_paid=$payment_row->amount_paid;
    //                 }
    //                 if($amount_paid>0){
    //                     //get user reference number
    //                     foreach($this->db->where('user_ID', $order_from)->get('user_details')->result() as $reference_row){
    //                         $user_reference_no=$reference_row->reference_number;
    //                     }
                        
    //                     //move the paid amount from order_payment_tb table to wallet_tb
    //                     $new_paid_amount=array(
    //                         'amount_paid'=>0
    //                     );
    //                     //clean data
    //                     $clean_new_paid_amount=$this->security->xss_clean($new_paid_amount);
    //                     $this->db->where('order_number', $order_no);
    //                     $this->db->update('order_payment_tb', $new_paid_amount);
                        
    //                     $this->db->where('user_reference_number', $user_reference_no);
    //                     $wallet_info=$this->db->get('wallet_tb');
    //                     //count data
    //                     $count_wallet_info=$wallet_info->num_rows();
                        
    //                     if($count_wallet_info==0){
    //                         $order_paid_price=array(
    //                             'user_reference_number'=>$user_reference_no,
    //                             'wallet_balance'=>$amount_paid
    //                         );
    //                         //clean data
    //                         $clean_paid_price=$this->security->xss_clean($order_paid_price);
    //                         $this->db->insert('wallet_tb', $clean_paid_price);
    //                     }else{
                            
    //                         foreach($wallet_info->result() as $wallet_data){
    //                             $current_price=$wallet_data->wallet_balance;
    //                         }
                            
    //                         $paid_price_data=array(
    //                             'wallet_balance'=>$amount_paid+$current_price
    //                         );
    //                         //clean data
    //                         $clean_paid_price_data=$this->security->xss_clean($paid_price_data);
    //                         $this->db->where('user_reference_number', $user_reference_no);
    //                         $this->db->update('wallet_tb', $clean_paid_price_data);
    //                     }
    //                 }
                    
    //                 //update product quantity as original
    //                 $this->db->set("quantity", "quantity+$productqty", false);
    //                 $this->db->where('product_ID', $productid);
    //                 $this->db->where('user_id', $orderto);
    //                 $this->db->update('stocks');
                    
    //                 //change order status to auto_cancel
    //                 $new_order_status=array(
    //                     'status'=>'auto_cancel'
    //                 );
    //                 //clean data
    //                 $clean_new_order_status=$this->security->xss_clean($new_order_status);
    //                 $this->db->where('order_number', $order_no);
    //                 $this->db->update('orders', $clean_new_order_status);
    //             }
    //         }
    //     }
        
    // }
}
?>