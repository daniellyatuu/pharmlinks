<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class User_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->db->where('name!=', 'admin');
        $group = $this->db->get('group');
        return $group->result();
    }

    public function user_data_save($clean_user_data){
        // Query to check whether user login already exist in the database or not
        $this->db->from('user');
        $this->db->where('username', $clean_user_data['username']);
        $this->db->limit(1);
        $query_user_info=$this->db->get();
        $count_user = $query_user_info->num_rows();
        
        if($count_user == 0){
            // save
            $this->db->insert('user', $clean_user_data);
            if($this->db->affected_rows() > 0){
                // return saved id
                return $this->db->insert_id();
            }
        }else{
            return FALSE;
        }
    }

    public function pwd($clean_pwd){
        $this->db->insert('pwd', $clean_pwd);
    }

    public function save_location($pharmacy_location){
        $this->db->insert('location', $pharmacy_location);
        $id=$this->db->insert_id();
        // return saved id
        return (isset($id)) ? $id : false;
    }

    public function save_pharmacy($clean_pharmacy){
        $this->db->insert('pharmacy', $clean_pharmacy);
    }

    public function login($data){
        $this->db->where('username', $data['usermail']);
        $this->db->where('password', md5($data['user_pass']));
        return $this->db->get('user')->row();
    }

    public function verify_number(){
        $this->db->where('id', $this->session->userdata('id'));
        $get_data=$this->db->get('user');
        return $get_data->result();
    }

    public function update_phone_number($clean_update_no){
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $clean_update_no);
    }

    public function save_code($code){
        $this->db->insert('verification_code', $code);
    }

    public function verify(){
        $verify = array(
            'verified'=>1,
        );

        // clean data
        $clean_verify = $this->security->xss_clean($verify);

        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $clean_verify);
    }

    public function save_reference_no(){
        $ref_number_exist = true;
        $new_ref_no = 0;

        while($ref_number_exist){
            //generate the new reference number and check if exists
            $digit=4;
            $base_no=pow(10, $digit-1);
            $power_no=pow(10, $digit)-1;
            $new_ref_no=rand($base_no, $power_no);
            
            $this->db->where('reference_number', $new_ref_no);
            $count_ref_number = $this->db->count_all_results('user');
            if($count_ref_number == 0){
                $ref_number_exist = false;
            }
        }
        
        //update retailer data
        $hold_retailer_info=array(
            'reference_number'=>'pw'.$new_ref_no,
        );
        
        //clean data
        $clean_retailer_info=$this->security->xss_clean($hold_retailer_info);
        
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user', $clean_retailer_info);
    }

    public function get_pwd(){
        $this->db->where('user', $this->session->userdata('id'));
        $pwd_data = $this->db->get('pwd');
        return $pwd_data->result();
    }

    public function check_cart(){
        //check if user have product on cart table
        $this->db->where('user_id', $this->session->userdata('id'));
        $cart_result=$this->db->get('cart');
        //check if there product in cart
        $count_cart=$cart_result->num_rows();
        
        if($count_cart!=0){
            foreach($cart_result->result() as $cartDataRow){
                $cartProductData=array(
                    'id'=>$cartDataRow->product_id,
                    'name'=>$cartDataRow->image,
                    'price'=>$cartDataRow->price,
                    'qty'=>$cartDataRow->quantity,
                    'optional'=>array(
                        'eachWholesalerId'=>$cartDataRow->seller_id
                    )
                );
                $cart_insert=$this->cart->insert($cartProductData);
            }

            // delete data from cart table after get them
            $this->db->where('user_id', $this->session->userdata('id'));
            $this->db->delete('cart');
                
            //update cart
            $cart_content=$this->cart->contents();
            if(!empty($cart_content)){
                foreach($cart_content as $cartitems){
                    $prdID=$cartitems['id'];
                    $prdQTY=$cartitems['qty'];
                    
                    //campare ordered quantity with in-stock products and check if product is available
                    
                    $this->db->where('id', $prdID);
                    $get_stock_info=$this->db->get('product');
                    foreach($get_stock_info->result() as $prd_info_row){
                        $in_stock=$prd_info_row->quantity;
                        $prd_status=$prd_info_row->status;
                        
                        if($prd_status=='deleted'){
                            $productQuantity=0;
                            $prdrowid=$cartitems['rowid'];
                        }else{
                            if($in_stock<$prdQTY){
                                $productQuantity=$in_stock;
                                $prdrowid=$cartitems['rowid'];
                            }else{
                                $productQuantity=$prdQTY;
                                $prdrowid=$cartitems['rowid'];
                            }
                        }
                        
                        $cartUpdate=array(
                            'rowid'=>$prdrowid,
                            'qty'=>$productQuantity
                        );
                        $this->cart->update($cartUpdate);
                    }
                }
            }
        }
    }

}
?>