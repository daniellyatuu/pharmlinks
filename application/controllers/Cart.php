<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Cart extends CI_Controller{
    
    function __construct()
    {
        parent:: __construct();
        // $this->load->model('Cart_model', 'cartmodel');
        
        if(!$this->session->userdata('logged_in')){
            redirect('user');
        }

        if($this->session->userdata('group')!='retailer' and $this->session->userdata('group')!='ADDO'){
            redirect('user');
        }
    }
    
    public function index(){
        $context['active']='cart_index';
        $context['title']='cart';
        if(!$this->cart->contents()){
            $this->load->view('includes/header/Header', $context);
            $this->load->view('navbar/Base');
            $this->load->view('retailer/Cart');
            $this->load->view('includes/footer/Footer');
        }else{
            $cartUpdate=$this->cart->contents();
            foreach($cartUpdate as $cartItems){
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
                    //print_r(array($cartUpdate));
                    $this->cart->update($cartUpdate);
                }
            }
            
            $this->load->view('includes/header/Header', $context);
            $this->load->view('navbar/Base');
            $this->load->view('retailer/Cart');
            $this->load->view('includes/footer/Footer');
        }
    }
    
    public function view_cart(){
        $cart_content='';
        
        if(!empty($this->cart->contents())){
            $cart_content.='
            <div class="table-responsive">
                <table class="table display product-overview mb-30" id="datable_1">
                ';
            if($cart_data=$this->cart->contents()){
            $cart_content.='
            <thead>
                <tr>
                    <th class="text-center">Image</th>
                    <th>Item</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Seller</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            
            <tbody>
            ';                
            $all_product_price=0;
            $cart_sn=1;
            $seller_id=array();
            
            foreach($cart_data as $cart_item){

            /*echo form_hidden('cart['. $cart_item['id'] .'][id]', $cart_item['id']);
            echo form_hidden('cart['. $cart_item['id'] .'][rowid]', $cart_item['rowid']);
            echo form_hidden('cart['. $cart_item['id'] .'][name]', $cart_item['name']);
            echo form_hidden('cart['. $cart_item['id'] .'][price]', $cart_item['price']);
            echo form_hidden('cart['. $cart_item['id'] .'][qty]', $cart_item['qty']);*/
            $cart_content.='
            <tr>
                <td class="text-center" style="padding: 0 0 0 10px;">
                    <img src="'.base_url('assets/app').'/img/285_files/'.$cart_item['name'].'" alt="product image" width="40" class="zoom_image">
                </td>
                <td class="txt-dark">
                    <a href="'.base_url('r_main/product_info').'/'.$cart_item['id'].'">
            ';
            
            $this->db->where('id', $cart_item['id']);
            $get_prd_name=$this->db->get('product');
            foreach($get_prd_name->result() as $prd_name_row){
                $product_generic_name=$prd_name_row->generic_name;
                if(!empty($product_generic_name)){
                    $product_generic_name='('.$product_generic_name.')';
                }
                $cart_content .= '
                '.$prd_name_row->brand_name.'<br>'.$product_generic_name.'
                ';
            }
            
            $cart_content.='
            </a>
            </td>
            <td class="text-center">
                <span>Tsh '.number_format($cart_item['price']).'</span>
            </td>
            <td class="text-center">
            
            <span>
            <input type="hidden" class="form-control prdrowid" value="'.$cart_item['rowid'].'">
            <input type="hidden" class="form-control prdid" value="'.$cart_item['id'].'">
            <input type="hidden" class="form-control prdprice" value="'.$cart_item['price'].'">
            </span>
            <div class="wan-spinner wan-spinner-2 spinnerValue'.$cart_item['rowid'].'">
                <a href="javascript:void(0)" class="minusNo"><i class="fa fa-minus"></i></a>
            ';
                foreach($get_prd_name->result() as $prd_name_row){
                    $cart_content .= '
                    <input type="text" value="'.$cart_item['qty'].'" class="valSpinner" instock="'.$prd_name_row->quantity.'">
                    ';
                }
            $cart_content.='
                <a href="javascript:void(0)" class="plusNo"><i class="fa fa-plus"></i></a>
            </div>
            <span class="text-danger max_order_val" style="display: none;"></span>
            </td>
            <td class="text-center">
            ';
                                    
            $product_qty=$cart_item['qty'];
            $product_price=$cart_item['price'];
            $total_product_price=$product_qty*$product_price;
            
            $cart_content.='
            <span class="price'.$cart_item['rowid'].'"> Tsh '.number_format($total_product_price).'</span>
            ';
            
            //sum of all produt to this cart
            $all_product_price=$all_product_price+$cart_item['subtotal'];
            
            $cart_content.='
                </td>
                <td class="txt-dark text-center">
            ';
            
            $sellers=$cart_item['optional']['eachWholesalerId'];    
              
            //hold all sellers in array
            $seller_id[]=$sellers;
            
            $this->db->where('user', $sellers);
            $get_pharm_data=$this->db->get('pharmacy');
            foreach($get_pharm_data->result() as $pharm_row){
                $cart_content.='<a href="'.base_url('shops/pharmacy').'/'.$cart_item['optional']['eachWholesalerId'].'">'.$pharm_row->name.'</a>';
            }
            $cart_content.='
            </td>
                <td class="text-right"><a href="#" class="text-inverse delete_cart_product" prd_rowid="'.$cart_item['rowid'].'" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-danger"></i></a></td>
            </tr>
            ';
            }
            $cart_content.='
            </tbody>
            
            <tfoot>
                
                <tr>
                    <th style="border-bottom: none;"></th>
                    <th></th>
                    <th></th>
                    <th class="text-center">Subtotal:</th>
                    <th class="text-center">Tsh '.number_format($all_product_price).'</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border: 2px solid white;"></th>
                    <th style="border: 2px solid white;"></th>
                    <th style="border: 2px solid white;"></th>
                    <th class="text-center">Service fee:</th>
                    <th class="text-center">FREE</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border: 2px solid white;"></th>
                    <th style="border: 2px solid white;"></th>
                    <th style="border: 2px solid white;"></th>
                    <th class="text-center">Transport cost:</th>
                    <th class="text-center">
                    ';
                
                //get active buyer co-ordinates
                $this->db->where('user', $this->session->userdata('id'));
                $active_pharmacy_data=$this->db->get('pharmacy');
                foreach($active_pharmacy_data->result() as $active_pharmacy_row){
                    $pharmacy_loc_id=$active_pharmacy_row->location;
                }
                
                if(!empty($pharmacy_loc_id)){
                    $this->db->where('id', $pharmacy_loc_id);
                    $active_location=$this->db->get('location');
                    foreach($active_location->result() as $active_loc_row){
                        $buyer_lattitude=$active_loc_row->lattitude;
                        $buyer_longitude=$active_loc_row->longitude;
                    }
                }
                
                //remove duplicate of seller id from array
                $filtered_seller_id=array_unique($seller_id);
                
                //sort seller id to be in sequence order
                sort($filtered_seller_id);
                
                //count array
                $count_sellers=count($filtered_seller_id);
                
                $seller_distance=array();
                $sellerids=array();
                for($seller_position = 0; $seller_position < $count_sellers; $seller_position++){
                    $each_saler_id=$filtered_seller_id[$seller_position];
                    
                    //calculate distance from each seller to the buyer direct
                    
                    //get pharmacy information
                    $this->db->where('user', $each_saler_id);
                    $get_pharmacy_details=$this->db->get('pharmacy');
                    foreach($get_pharmacy_details->result() as $pharmacy_row){
                        $pharmacy_location_id=$pharmacy_row->location;
                    }
                    
                    //get each pharmacy location
                    $this->db->where('id', $pharmacy_location_id);
                    $pharmacy_location=$this->db->get('location'); 
                    
                    foreach($pharmacy_location->result() as $location_row){
                        $seller_latitude=$location_row->lattitude;
                        $seller_longitude=$location_row->longitude;
                    }
                    
                    //start calculating distance btn each seller and buyer
                    $latitudeFrom=$buyer_lattitude;
                    $longitudeFrom=$buyer_longitude;
                    
                    $latitudeTo=$seller_latitude;
                    $longitudeTo=$seller_longitude;
                    
                    $earthRadius = 6378.137; //default earch radius
                    
                    // convert from degrees to radians
                    $latFrom = deg2rad($latitudeFrom);                  
                    $lonFrom = deg2rad($longitudeFrom);
                    
                    $latTo = deg2rad($latitudeTo);                  
                    $lonTo = deg2rad($longitudeTo);
                    
                    $lonDelta = $lonTo - $lonFrom;
                    
                    $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
                    
                    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
                    
                    $angle = atan2(sqrt($a), $b);
                    
                    $distance =  $angle * $earthRadius; //default location are in KM
                    
                    //hold distances in array inoder to arrange in descending order
                    $seller_distance[]=$distance;
                    $sellerids[]=$each_saler_id;
                }
                
                //arrange distance with respect to the seller id
                array_multisort($seller_distance, SORT_DESC, $sellerids);
                
                //get last distance btn seller and buyer
                $last_dist_pos=$count_sellers-1;
                $last_distance=$seller_distance[$last_dist_pos];
                
                //calculate distances btn sellers
                
                $i=0;
                $total_distance=0;
                
                if($count_sellers > 1){
                    
                    $lat1 = $long1 = $lat2 = $long2 = "";
                    
                    foreach($sellerids as $id){
                        $i++;
                        
                        //get pharmacy ids
                        foreach($this->db->where('user', $id)->get('pharmacy')->result() as $pharmacy_row){
                            $pharm_loc_id=$pharmacy_row->location;
                            //echo $id.' - '.$pharmacyid.'<br>';
                        }
                        foreach($this->db->where('id',$pharm_loc_id)->get('location')->result() as $latlong){
                            if($i == 1){
                                $lat1 = $latlong->lattitude;
                                $long1 = $latlong->longitude;
                            }else{
                                $lat2 = $latlong->lattitude;
                                $long2 = $latlong->longitude;
                            }
                            
                            if($lat1 != 0 && $lat2 != 0 && $long1 != 0 && $long2 != 0){
                                
                                //start calculating distance btn sellers
                                $latitudeFrom=$lat1;
                                $longitudeFrom=$long1;
                                
                                $latitudeTo=$lat2;
                                $longitudeTo=$long2;
                                
                                $earthRadius = 6378.137; //default earch radius
                                
                                // convert from degrees to radians
                                $latFrom = deg2rad($latitudeFrom);                  
                                $lonFrom = deg2rad($longitudeFrom);
                                
                                $latTo = deg2rad($latitudeTo);                  
                                $lonTo = deg2rad($longitudeTo);
                                
                                $lonDelta = $lonTo - $lonFrom;
                                
                                $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
                                
                                $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
                                
                                $angle = atan2(sqrt($a), $b);
                                
                                $distance =  $angle * $earthRadius;//default distance in KM
                                
                                $total_distance = $total_distance+$distance;
                                
                                ## Update values;
                                $lat1  = $lat2;
                                $long1  = $long2;
                            }
                        }
                    }
                }
                
                //sum total distance btn last seller and buyer
                $combined_total_distance=$total_distance+$last_distance;
                
                //calculate shipping cost according to the distance covered
                foreach($this->db->get('shipping_fee')->result() as $fee_row){
                    $shipping_fee=$fee_row->fee;
                }
                
                //formular to calculate shipping cost
                $shipping_cost=$combined_total_distance*$shipping_fee;
                
                //calculate total product price + shipping cost
                $total_price_and_shipping = $all_product_price+$shipping_cost;
                
                $cart_content.='Tsh '.number_format($shipping_cost).'
                    </th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border: 2px solid white;"></th>
                    <th style="border: 2px solid white;"></th>
                    <th style="border: 2px solid white;"></th>
                    <th class="text-center">Total:</th>
                    <th class="text-center">Tsh '.number_format($total_price_and_shipping).'</th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            ';
            }
            $cart_content.='
            </table>
                
                <div class="form-actions pull-right pr-15">
                    <a href="javascript: void(0);" class="btn btn-danger btn-anim mr-10 pull-left btn-sm clear_cart_btn" style="margin: 2px 0;"><i class="fa fa-trash"></i><span class="btn-text">Clear Cart</span></a>
                    <a href="javascript: void(0);" class="btn btn-primary btn-anim pull-left btn-sm placeOrder" style="margin: 2px 0;"><i class="fa fa-sign-out"></i><span class="btn-text">Checkout</span></a>
                    <div class="clearfix"></div>
                </div>
            </div>
            ';
            $cart_content.='
            <input type="hidden" id="shipping_fee" value="'.number_format($shipping_cost).'" />
            <input type="hidden" id="total_order_price" value="'.number_format($total_price_and_shipping).'" />
            ';
            ?>
            <!-- load js here -->
            <!-- jQuery -->
		    <script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
            <script type="text/javascript" src="<?=base_url('assets/app');?>/number_spinner/wan-spinner.js"></script>
              <script type="text/javascript">
              $(document).ready(function() {
                var options = {
                  maxValue: 10,
                  minValue: -5,
                  step: 0.131,
                  inputWidth: 100,
                  start: -2,
                  plusClick: function(val) {
                    console.log(val);
                  },
                  minusClick: function(val) {
                    console.log(val);
                  },
                  exceptionFun: function(val) {
                    console.log("excep: " + val);
                  },
                  valueChanged: function(val) {
                    console.log('change: ' + val);
                  }
                }
                $(".wan-spinner-1").WanSpinner(options);
                $(".wan-spinner-2").WanSpinner().css("border-color", "#2C3E50");
                  <?php
                  if($cartData=$this->cart->contents()){
                      foreach($cart_data as $cartItemData){
                          $this->db->where('id', $cartItemData['id']);
                          $getPrdName=$this->db->get('product');
                          foreach($getPrdName->result() as $prdNameRow){
                  ?>
                $(".spinnerValue<?=$cartItemData['rowid'];?>").WanSpinner({maxValue: '<?=$prdNameRow->quantity;?>'});
                  <?php
                          }
                      }
                  }
                      
                  ?>
                $(".wan-spinner-3").WanSpinner({inputWidth: 100}).css("border-color", "#C0392B");
              });
              </script>
            
              <script>
                $(document).ready(function(){
                    //prevent jquery conflict
                    $.noConflict(true);
                    
                    // control plus button
                    $('.plusNo').click(function(){
                        var actual_no=$(this).prev('.valSpinner').val();
                        if(actual_no>=999){
                            $(this).closest('.wan-spinner-2').next('.max_order_val').fadeIn().text('max value 999');
                        }else{
                            $(this).closest('.wan-spinner-2').next('.max_order_val').hide();
                            var increment_plus_no=++actual_no;
                            $(this).prev('.valSpinner').val(increment_plus_no);
                        }
                        
                        //disable plus button when reach instock value
                        var prd_instock=$(this).prev('.valSpinner').attr('instock');
                        if(actual_no>=prd_instock){
                            //alert('needed is high');
                            alert('in stock '+prd_instock);
                            $(this).prev('.valSpinner').val(prd_instock);
                            $(this).closest('.wan-spinner-2').next('.max_order_val').fadeIn().text('in stock '+prd_instock);
                        }else{
                            //$(this).hide();
                        }
                    });
                    
                    // control minus button
                    $('.minusNo').click(function(){
                        var actual_no=$(this).next('.valSpinner').val();
                        if(actual_no<=1){
                            $(this).closest('.wan-spinner-2').next('.max_order_val').fadeIn().text('min value 1');
                        }else{
                            $(this).closest('.wan-spinner-2').next('.max_order_val').hide();
                            var decrement_minus_no=--actual_no;
                            $(this).next('.valSpinner').val(decrement_minus_no);
                        }
                    });
                    
                });
            </script>
            <?php
                }
        echo $cart_content;
    }
    
    public function add_product_to_cart(){
        $insert_cart = array(
			'id' => $this->input->post('prd_id'),
			'name' => $this->input->post('product_image'),
			'price' => $this->input->post('product_price'),
			'qty' => $this->input->post('product_quantity'),
            'optional'=>array(
                'eachWholesalerId'=>$this->input->post('unique_wholesaler_id')
            )
		);
        
        //echo json_encode($insert_cart);
		$this->cart->insert($insert_cart);
        echo 'cart_added';
    }
    
    public function add_prd_to_cart(){
        $count_prdid=$this->input->post('each_prd_id');
        $cart_data_insert = array(
			'id' => $count_prdid,
			'name' => $this->input->post('each_product_image'),
			'price' => $this->input->post('each_prdprice'),
			'qty' => $this->input->post('each_product_qty'),
            'optional'=>array(
                'eachWholesalerId' => $this->input->post('each_wholesalerids')
            )
		);
        
        //echo json_encode($cart_data_insert);
        $this->cart->insert($cart_data_insert);
        
        $hold_product_added=array();
        $hold_product_added['added_prd_id']=$count_prdid;
        $hold_product_added['added']='product_added';
        echo json_encode($hold_product_added);
    }
    
    public function updateCart(){
        $product_rowid=$this->input->post('prd_rowid');
        $product_id=$this->input->post('prd_id');
        $product_price=$this->input->post('prd_price');
        $product_quantity=$this->input->post('prd_qty');
        
        //check real in stock
        $this->db->where('id', $product_id);
        $get_prd_quantity=$this->db->get('product');
        foreach($get_prd_quantity->result() as $qty_row){
            $each_prd_qty=$qty_row->quantity;
        }
        if($each_prd_qty<$product_quantity){
            $rowid = $product_rowid;
            $price = $product_price;
            $qty = $each_prd_qty;
            $amount = $price * $qty;
        }else{
            $rowid = $product_rowid;
            $price = $product_price;
            $qty = $product_quantity;
            $amount = $price * $qty;
        }
        
        $data = array(
            'rowid' => $rowid,
            'price' => $price,
            'amount' => $amount,
            'qty' => $qty
        );
        $this->cart->update($data);
        redirect('cart/view_cart');
    }
    
    public function remove_cart_product(){
        $rowid=$this->input->post('productRowId');
        if($rowid=='all'){
            $this->cart->destroy();
        }else{
            $cart_item=array(
                'rowid'=>$rowid,
                'qty'=>0
            );
            
            $this->cart->update($cart_item);
        }
        redirect('cart/view_cart');
    }
}
?>