<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Billing extends CI_Controller{
    
    function __construct(){
        parent:: __construct();
        
        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='retailer' and $this->session->userdata('group')!='ADDO'){
            redirect('user');
        }
        
        $this->load->model('Billing_model', 'billingmodel');
    }
    
    public function index(){
        if($cart_prd=$this->cart->contents()){

            //generate time when retailer place order
            $order_time=date('Y-m-d H:i:s');
            //convert order_time to timestamp
            $order_timestamp=strtotime($order_time);
            
            $cartprd=$this->cart->contents();
            
            //generate unique order_number
            $orderNumber=$this->session->userdata('id').time();

            //update cart before buy
            foreach($cartprd as $cartItems){
                $productid=$cartItems['id'];    
                $prdQty=$cartItems['qty'];
                
                //campare ordered quantity with in-stock products
                $this->db->where('id', $productid);
                $get_in_stock=$this->db->get('product');
                foreach($get_in_stock->result() as $in_stock_row){
                    $in_stock_qty=$in_stock_row->quantity;
                    
                    if($in_stock_qty<$prdQty){    
                        $productQuantity=$in_stock_qty;
                        $prdrowid=$cartItems['rowid'];    
                    }else{
                        $productQuantity=$cartItems['qty'];
                        $prdrowid=$cartItems['rowid'];    
                    }
                    
                    $cartUpdate=array(
                        'rowid'=>$prdrowid,
                        'qty'=>$productQuantity
                    );
                    $this->cart->update($cartUpdate);
                }
            }

            //get transport fee
            $transportCost=str_replace(',','',$this->input->post('transport_fee'));

            // save order
            $order_data = array(
                'order_number'=>$orderNumber,
                'from'=>$this->session->userdata('id'),
                'transport_fee'=>$transportCost,
                'date_ordered'=>$order_time,
            );

            $clean_order_data = $this->security->xss_clean($order_data);
            $saved_order_id = $this->billingmodel->save_order($clean_order_data);
                        
            //retrive all order from cart and save to db
            //..........................................
            //..........................................

            // get order status
            $this->db->where('name', 'pending');
            $order_status = $this->db->get('order_status');
            foreach($order_status->result() as $status_row){
                $current_status_id = $status_row->id; 
            }
            
            $total_order_price=0;
            
            $seller_id=array();
            
            foreach($cart_prd as $items_prd){
                
                //calculate total order price
                $total_order_price=$total_order_price+$items_prd['subtotal'];
                
                $order_detail=array(
                    'order_id'=>$saved_order_id,
                    'to'=>$items_prd['optional']['eachWholesalerId'],
                    'product_id'=>$items_prd['id'],
                    'quantity'=>$items_prd['qty'],
                    'price'=>$items_prd['subtotal'],
                    'status_id'=>$current_status_id,
                );
                
                //clean data
                $clean_order_detail=$this->security->xss_clean($order_detail);
                //pass data to model
                $this->billingmodel->save_order_content($clean_order_detail);
                
                //deduct ordered quantity from available quantity .start        
                //.....................................................
                //.....................................................
                
                //get real available quantity from stocks table
                $prd_id=$items_prd['id'];
                $this->db->where('id', $prd_id);
                $get_available_stock=$this->db->get('product');
                foreach($get_available_stock->result() as $available_stock_row){
                    $available_qty=$available_stock_row->quantity;
                    
                    //deduct ordered product from available stock
                    $remain_prd_stock=array(
                        'quantity'=>$available_qty-$items_prd['qty']
                    );

                    $clean_remain_qty = $this->security->xss_clean($remain_prd_stock);
                    $this->billingmodel->deduct_quantity($prd_id, $clean_remain_qty);
                }
                
                //get sellers id(s)
                $seller_id[]=$items_prd['optional']['eachWholesalerId'];
            } //end cart foreach

            //tuma sms kwa seller
            
            //remove duplicate of seller id from array
            $filtered_seller_id=array_unique($seller_id);
            
            //sort seller id to be in sequence order
            sort($filtered_seller_id);
            
            //count array
            $count_sellers=count($filtered_seller_id);
            
            for($seller_position = 0; $seller_position < $count_sellers; $seller_position++){
                $each_saler_id=$filtered_seller_id[$seller_position];

                //send notification sms to wholesaler who receive orders    
                $sms=array();
                //select data from user details
                $this->db->where('id', $each_saler_id);
                $user_info=$this->db->get('user');
                foreach($user_info->result() as $user_info_row){
                    $userUniqueId=$user_info_row->id;
                    $userMail=$user_info_row->email;
                    $each_wholesaler_no=str_replace(str_split('-+() '),'',$user_info_row->phone_number);
                    
                    //substring all numbers
                    $last_nine_no=substr($each_wholesaler_no, -9);
                    $userPhoneno='255'.$last_nine_no;
                    
                    //find number of products contain in the order and total price of each order
                    $this->db->where('order_id', $saved_order_id);
                    $this->db->where('to', $each_saler_id);
                    $order_products=$this->db->get('order_content');
                    $count_order_products=$order_products->num_rows();
                    $each_order_total_price=0;
                    foreach($order_products->result() as $order_row){
                        $each_prd_price=$order_row->price;
                        $each_order_total_price=$each_order_total_price+$each_prd_price;
                    }

                    //get pharmacy name of retailer
                    $this->db->where('user', $this->session->userdata('id'));
                    $get_retailer_pharmName=$this->db->get('pharmacy');
                    foreach($get_retailer_pharmName->result() as $retailer_pharm_row){
                        $retailer_pharm_name=$retailer_pharm_row->name;
                    }
                    
                    if($count_order_products==1){
                        $different='';
                        $content='contain';
                        $product_containing='product';    
                    }else{
                        $different=' differents ';
                        $content='contains';
                        $product_containing='products';    
                    }
                    
                    //structure notification sms
                    
                    $message_content='Hello '.$userMail.', you have receive a new order consisting of '.$count_order_products.' '.$product_containing.'. Please login to your Pharmlinks Account to check and process it.'.' https://bit.ly/2z8EZuX';
                    
                    // start send sms to seller from here

                    
                }//end foreach loop
            }//end for loop
        }else{
            redirect('cart');
            exit();
        }
        
        $this->cart->destroy();
        redirect("billing/thanks/$saved_order_id");
    }
    
    public function send_mail(){
        //send email to user
        $email_to=$this->session->userdata('user_mail');
        $member_username=$this->session->userdata('user');
        $member_password=$this->session->userdata('pass_word');
        $user_firstname=$this->session->userdata('f_name');
        $user_lastname=$this->session->userdata('l_name');
        $message_content='Dear <strong>'.$user_firstname.' '.$user_lastname.',</strong><br/>
        Thank you for Signing Up and Registering with <strong>PharmLink!</strong>.<br/>
        Use the following credentials to login to your Pharmlink Account:-<br/>
        <p style="margin-left:10px; margin:0; padding: 0;">
        Username: <span style="text-decoration: underline; font-weight: bold;">'.$member_username.'</span><br/>
        Password:<span style="text-decoration: underline; font-weight: bold;">'.$member_password.'</span></p><br>
        If you have trouble please contact us via 0753 841 279 or info@pharmlinktz.com<br/>
        <p style="font-family: Trebuchet MS;">we get straight to work so you can get straight to business. Enjoy our services.</p>';
        
        $this->load->library('email');
        
        $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
        );
        $this->email->initialize($config);
        
        $this->email->from('info@pharmlinktz.com', 'PharmLink');
        $this->email->to($email_to);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');
        
        $this->email->subject('PHARMLINK REGISTRATION');
        $this->email->message($message_content);
        
        $this->email->send();
        
        redirect('Billing/index');
    }
    
    public function buy(){
        //generate time when retailer place order
        $orderTime=date('Y-m-d H:i:s');
        //convert order_time to timestamp
        $orderTimestamp=strtotime($orderTime);
        
        //generate unique order_number
        $order_number=$this->session->userdata('id').time();
        
        //get transport fee
        $transportCost=str_replace(',','',$this->input->post('transport_fee'));
        
        $get_prd_qty=$this->input->post('product_quantity');
        $get_sub_total=$this->input->post('subTotalPrice');
        $get_wholesaler_id=$this->input->post('uniqueWholesalerId');
        $prd_id=$this->input->post('productid');
        

        // save order
        $order_data = array(
            'order_number'=>$order_number,
            'from'=>$this->session->userdata('id'),
            'transport_fee'=>$transportCost,
            'date_ordered'=>$orderTime,
        );

        $clean_order_data = $this->security->xss_clean($order_data);
        $saved_order_id = $this->billingmodel->save_order($clean_order_data);

        // get order status
        $this->db->where('name', 'pending');
        $order_status = $this->db->get('order_status');
        foreach($order_status->result() as $status_row){
            $current_status_id = $status_row->id; 
        }

        $order_detail=array(
            'order_id'=>$saved_order_id,
            'to'=>$get_wholesaler_id,
            'product_id'=>$prd_id,
            'quantity'=>$get_prd_qty,
            'price'=>$get_sub_total,
            'status_id'=>$current_status_id,
        );
        
        //clean data
        $clean_order_detail=$this->security->xss_clean($order_detail);
        //pass data to model
        $this->billingmodel->save_order_content($clean_order_detail);
        
        //get available quantity
        $this->db->where('id', $prd_id);
        $this->db->where('user', $get_wholesaler_id);
        $get_instock=$this->db->get('product');
        foreach($get_instock->result() as $instock_row){
            $available_instock=$instock_row->quantity;
            
            //deduct ordered qty from available quantity
            $remain_prd_stock=array(
                'quantity'=>$available_instock-$get_prd_qty
            );
            $clean_remain_qty = $this->security->xss_clean($remain_prd_stock);
            $this->billingmodel->deduct_quantity($prd_id, $clean_remain_qty);
        }
        
        //tuma sms kwa seller kama buyer ameshalipia
        
        //send notification sms to wholesaler who receive orders    
        $sms=array();
        //select data from user details
        $this->db->where('id', $get_wholesaler_id);
        $user_info=$this->db->get('user');
        foreach($user_info->result() as $user_info_row){
            $userUniqueId=$user_info_row->id;
            $userMail=$user_info_row->email;
            $each_wholesaler_no=str_replace(str_split('-+() '),'',$user_info_row->phone_number);
            
            //substring all numbers
            $last_nine_no=substr($each_wholesaler_no, -9);
            $userPhoneno='255'.$last_nine_no;
            
            //find number of products contain in the order and total price of each order
            $this->db->where('order_id', $saved_order_id);
            $this->db->where('to', $get_wholesaler_id);
            $order_products=$this->db->get('order_content');
            $count_order_products=$order_products->num_rows();
            $each_order_total_price=0;
            foreach($order_products->result() as $order_row){
                $each_prd_price=$order_row->price;
                $each_order_total_price=$each_order_total_price+$each_prd_price;
            }
            
            //get pharmacy name of each retailer
            $this->db->where('user', $this->session->userdata('id'));
            $get_retailer_pharmName=$this->db->get('pharmacy');
            foreach($get_retailer_pharmName->result() as $retailer_pharm_row){
                $retailer_pharm_name=$retailer_pharm_row->name;
            }
            
            if($count_order_products==1){
                $different='';
                $content='contain';
                $product_containing='product';    
            }else{
                $different=' differents ';
                $content='contains';
                $product_containing='products';    
            }
            
            //structure notification sms
            
            $message_content='Hello '.$userMail.', you have receive a new order consisting of '.$count_order_products.' '.$product_containing.'. Please login to your Pharmlinks Account to check and process it.'.' https://bit.ly/2z8EZuX';
            
            // start send sms to seller from here   
            
        }//end of loop

        redirect("billing/thanks/$saved_order_id");
        
    }
    
    public function thanks(){
        $context['title']='thank for ordering';
        $context['active']='thanks';
        $this->load->view('includes/header/Header', $context);
        $this->load->view('navbar/Base');
        $this->load->view('retailer/Thanks_for_ordering.php');
        $this->load->view('includes/footer/Footer');
    }
    
    public function pre_order(){
        //auto cancel order
        $this->billing->auto_cancel_order();
        
        $this->load->view('includes/Pre_order_header');
        $this->load->view('includes/Left_top_right_sidebar');
        $this->load->view('Pre_order_details');
        $this->load->view('includes/Wallet_footer');
    }
    
    public function get_order_payment(){
        $orderdate=$this->input->post('dateOrdered');
        
        //convert timestamp to datetime(equal to database datetime)
        $orderDateTime=date('Y-m-d H:i:s', $orderdate);
        
        $this->db->where('order_from', $this->session->userdata('unique_user_id'));
        $this->db->where('date_ordered', $orderDateTime);
        $this->db->where('retailer_availability!=', 'deleted');
        
        foreach($this->db->get('orders')->result() as $order_row){
            $ordernumber=$order_row->order_number;
        }
        //get order price
        foreach($this->db->where('order_number', $ordernumber)->get('order_payment_tb')->result() as $payment_row){
            $order_price=$payment_row->total_order_price;
            $paid_amount=$payment_row->amount_paid;
        }
        
        //get wallet balance
        $this->db->where('user_reference_number', $this->session->userdata('user_reference_no'));
        $user_wallet_account=$this->db->get('wallet_tb');
        $count_wallet_users=$user_wallet_account->num_rows();
        
        if($count_wallet_users!=0){
            foreach($user_wallet_account->result() as $wallet_balance_row){
                $wallent_balance=$wallet_balance_row->wallet_balance;
            }
        }else{
            $wallent_balance=0;
        }
        
        $dept=$order_price-$paid_amount;
        //hold data
        $hold_order_data=array();
        $hold_order_data['balance']='Tsh '.number_format($wallent_balance).' /=';
        $hold_order_data['orderno']=$ordernumber;
        $hold_order_data['orderprice']='Tsh '.number_format($order_price).' /=';
        $hold_order_data['paid']='Tsh '.number_format($paid_amount).' /=';
        $hold_order_data['dept']='Tsh '.number_format($dept).' /=';
        $hold_order_data['paidamount']=$paid_amount;
        echo json_encode($hold_order_data);
    }
    
    public function pay_order(){
        $get_order_id=$this->input->post('orderid');
        $walletbalance=str_replace(str_split('Tsh , /='), '', $this->input->post('wallet_balance'));
        $orderDept=str_replace(str_split('Tsh , /='),'', $this->input->post('order_dept'));
        $user_ref_no=$this->session->userdata('user_reference_no');
        
        if($walletbalance>=$orderDept){
            $remain_wallet_balance=$walletbalance-$orderDept;
            
            //remain wallet balance
            $new_balance=array(
                'wallet_balance'=>$remain_wallet_balance
            );
            
            //clean data
            $clean_new_balance=$this->security->xss_clean($new_balance);
            $this->db->where('user_reference_number', $user_ref_no);
            $this->db->update('wallet_tb', $clean_new_balance);
            
            //wallet transaction history
            $transaction_data=array(
                'user_reference_no'=>$user_ref_no,
                'amount'=>$orderDept,
                'transaction_status'=>'cash-out'
            );
            
            //clean data
            $clean_transaction_data=$this->security->xss_clean($transaction_data);
            $this->db->insert('wallet_transaction_history_tb', $clean_transaction_data);
            
            //change order details
            $paid_order_details=array(
                'status'=>'pending',
                'date_store_receive'=>date('Y-m-d H:i:s'),
                'wholesaler_availability'=>'available'
            );
            
            //clean data
            $clean_paid_order_details=$this->security->xss_clean($paid_order_details);
            $this->db->where('order_number', $get_order_id);
            $this->db->update('orders', $clean_paid_order_details);
            
            //update order_payment_tb
            $this->db->set("amount_paid", "amount_paid+$orderDept", false);
            $this->db->set("payment_status", "1", false);
            $this->db->where('order_number', $get_order_id);
            $this->db->update('order_payment_tb');
            
            redirect('RT_contents/my_order/pending?paid');
        }else{
            //remain wallet balance
            $new_balance=array(
                'wallet_balance'=>0
            );
            
            //clean data
            $clean_new_balance=$this->security->xss_clean($new_balance);
            $this->db->where('user_reference_number', $user_ref_no);
            $this->db->update('wallet_tb', $clean_new_balance);
            
            //wallet transaction history
            $transaction_data=array(
                'user_reference_no'=>$user_ref_no,
                'amount'=>$walletbalance,
                'transaction_status'=>'cash-out'
            );
            
            //clean data
            $clean_transaction_data=$this->security->xss_clean($transaction_data);
            $this->db->insert('wallet_transaction_history_tb', $clean_transaction_data);
            
            //update order_payment_tb
            $this->db->set("amount_paid", "amount_paid+$walletbalance", false);
            $this->db->where('order_number', $get_order_id);
            $this->db->update('order_payment_tb');
            
            redirect('RT_contents/my_order/init?unfinished');
        }
    }
    
    public function cancel_order(){
        $receive_orderno=$this->input->post('orderno');
        $refe_number=$this->session->userdata('user_reference_no');
        
        //check order payment
        foreach($this->db->where('order_number', $receive_orderno)->get('order_payment_tb')->result() as $order_payment_row){
            $paid_amount=$order_payment_row->amount_paid;
        }
        
        if($paid_amount>0){
            //roll paid amount to buyer wallet
            $this->db->set("wallet_balance", "wallet_balance+$paid_amount", FALSE);
            $this->db->where('user_reference_number', $refe_number);
            $this->db->update('wallet_tb');
            
            //store transaction history
            $amount_deposited=array(
                'user_reference_no'=>$refe_number,
                'amount'=>$paid_amount,
                'transaction_status'=>'cash-in'
            );
            
            //clean data
            $clean_amount_deposited=$this->security->xss_clean($amount_deposited);
            $this->db->insert('wallet_transaction_history_tb', $clean_amount_deposited);
            
            //update order_payment_tb
            $this->db->set("amount_paid", 0, false);
            $this->db->where('order_number', $receive_orderno);
            $this->db->update('order_payment_tb');
        }
        
        //update product quantity as original
        foreach($this->db->where('order_number', $receive_orderno)->get('orders')->result() as $order_data_row){
            $orderto2=$order_data_row->order_to;
            $prdid=$order_data_row->productid;
            $prdquantity=$order_data_row->quantity;
            
            $this->db->set("quantity", "quantity+$prdquantity", false);
            $this->db->where('product_ID', $prdid);
            $this->db->where('user_id', $orderto2);
            $this->db->update('stocks');
        }
        
        //change order details
        $cancel_order_status=array(
            'status'=>'rtl_cancel',
            'rtl_date_cancelled'=>date('Y-m-d H:i:s'),
        );
        
        //clean data
        $clean_cancel_order_status=$this->security->xss_clean($cancel_order_status);
        $this->db->where('order_number', $receive_orderno);
        $this->db->update('orders', $clean_cancel_order_status);
        if(!empty($_GET['results'])){
            $seached_data=$_GET['results'];
            redirect("RT_contents/search_result?results=$seached_data&cancelled");
        }else{
            redirect('RT_contents/my_order/init?cancelled');
        }
    }
    
    public function delete_order(){
        $ordernumber02=$this->input->post('orderno02');
        
        //delete order
        $delete_order_data=array(
            'retailer_availability'=>'deleted',
            'rtl_date_delete'=>date('Y-m-d H:i:s')
        );
        
        //clean data
        $clean_delete_order=$this->security->xss_clean($delete_order_data);
        
        //change order status to delete
        $this->db->where('order_number', $ordernumber02);
        $this->db->update('orders', $clean_delete_order);
        
        //get current url
        $currenturl=$this->uri->segment(3);
        if(empty($currenturl)){
            $seached_data=$_GET['results'];
            redirect("RT_contents/search_result?results=$seached_data&deleted");
        }else{
            redirect("RT_contents/my_order/$currenturl?deleted");
        }
    }
}
?>