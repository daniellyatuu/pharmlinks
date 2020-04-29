        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Details for <?php if(!empty($title)){echo $title;}?></h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="<?=base_url('main/index');?>">Dashboard</a></li>
						<li class="active"><span>product detail</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

                <?php
                foreach($product as $product_row){
                    $seller_id=$product_row->user;
                    $brand_name=$product_row->brand_name;
                    $generic_name=$product_row->generic_name;
                    $category_id=$product_row->category;
                    $selling_package_id=$product_row->selling_package;
                    $price=$product_row->price;
                    $discount=$product_row->discount;
                    $country=$product_row->country;
                    $industry=$product_row->industry;
                    $quantity=$product_row->quantity;
                    $description=$product_row->description;
                }

                // get category name
                $this->db->where('id', $category_id);
                $category_data=$this->db->get('category');
                foreach($category_data->result() as $category_row){
                    $product_category=$category_row->name;
                }

                // get selling package
                $this->db->where('id', $selling_package_id);
                $selling_package_data=$this->db->get('selling_package');
                foreach($selling_package_data->result() as $package_row){
                    $product_selling_package=$package_row->name;
                }

                // get product image(s)
                $product_id = $this->uri->segment(3);
                $this->db->where('product', $product_id);
                $images = $this->db->get('product_image');

                $count_image = $images->num_rows();
                ?>				
				<!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="item-big">
                                                <!-- START carousel-->
                                                <div id="carousel-example-captions-1" data-ride="carousel" class="carousel slide">
                                                    <ol class="carousel-indicators">
                                                        <?php
                                                        if($count_image!=0){
                                                            $s_n = -1;
                                                            foreach($images->result() as $image_row){
                                                                $s_n++;
                                                        ?>
                                                        <li data-target="#carousel-example-captions-1" data-slide-to="<?=$s_n;?>" class="<?php if($s_n==1){echo 'active';}?>">
                                                        
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </ol>
                                                    <div role="listbox" class="carousel-inner">

                                                        <!--find product image-->
                                                        <?php
                                                        if($count_image!=0){
                                                            $s_n = 0;
                                                            foreach($images->result() as $image_row){
                                                                $s_n++;
                                                                $image_filename = $image_row->filename;
                                                        ?>
                                                        <div class="item <?php if($s_n==1){echo 'active';}?>"> <img src="<?php echo base_url('assets/app');?>/img/900_1000_files/<?=$image_filename;?>" alt="image for <?=$image_filename;?>"> </div>
                      
                                                        <?php
                                                            } // endforeach
                                                        }else{
                                                        ?>
                                                        <div class="item active"> <img src="<?=base_url('assets/app');?>/img/900_1000_files/sample.jpg" alt="product image"> </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                                <!-- END carousel-->
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="product-detail-wrap">
                                                
                                                <h5 class="mb-10 weight-500"><?=$brand_name;?><br/><small><?=$generic_name;?></small></h5>
                                                        
                                                <?php
                                                    if($discount > 0){
                                                ?>

                                                <div class="product-price head-font mb-10">
                                                    <span><?='Tsh '.number_format($discount);?>
                                                    </span>
                                                    <span style="margin-left: 5px; color: black; text-decoration:line-through">
                                                        <?='Tsh '.number_format($price);?>
                                                    </span>
                                                </div>

                                                <?php
                                                    }else{
                                                ?>
                                                <div class="product-price head-font mb-10">
                                                    <span><?='Tsh '.number_format($price);?></span>
                                                </div>
                                                <?php
                                                    }
                                                ?>

                                                <p class="mb-50"><strong style="color: black;">Selling packaging:</strong> <span style="font-weight: bold;"><?=$product_selling_package;?></span><br/>
                                                    <!--get manufacturing company of a product-->
                                                    <?php
                                                    if(!empty($industry) && !empty($country)){
                                                    ?>

                                                <span class="head-font block manufacturing_industry_class"><strong style="color: black;">Manufaturing industry:</strong> <?=$industry;?>, <?=$country;?></span>
                                                <?php
                                                    }else{
                                                ?>
                                                <span class="head-font block text-default manufacturing_industry_class"><strong style="color: black;">Manufaturing industry:</strong> <?=$country;?></span>
                                                <?php } ?>
                                                    
                                                <!--get pharmacy details-->
                                                <?php
                                                foreach($this->db->where('user', $seller_id)->get('pharmacy')->result() as $phamacy_row){
                                                    $pharmacy_locaton_id=$phamacy_row->location;
                                                    $pharmacy_name=$phamacy_row->name;
                                                    //get pharmacy location
                                                    foreach($this->db->where('id', $pharmacy_locaton_id)->get('location')->result() as $location_row){
                                                        $seller_lattitude=$location_row->lattitude;
                                                        $seller_longitude=$location_row->longitude;
                                                ?>
                                                    <span class="head-font block text-default"><strong style="color: black;">Seller:</strong> <a href="<?=base_url("shops/pharmacy/$seller_id");?>" style="text-transform: uppercase;"><?=$pharmacy_name;?></a><br/><span style="padding-left: 45px;"><?=$location_row->location_name;?></span></span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </p>

                                                <?php
                                                //check if product already exist in the cart
                                                $cart_contents=$this->cart->contents();

                                                $product_existance=0; //by default product not exist
                                                foreach($cart_contents as $cart_item){
                                                    $each_prd_id=$cart_item['id'];
                                                    //echo $each_prd_id.', ';
                                                    if($each_prd_id==$product_id){
                                                        $product_existance=1; //product exist in the cart
                                                    }
                                                }
                                                ?>
                                                <input class="vertical-spin" type="text" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" id="prd_qty" value="1" name="vertical-spin" max="5">

                                                <?php
                                                if($product_existance!=1){
                                                ?>
                                                <div class="btn-group mr-10 cart_area">
                                                    <button class="btn btn-info btn-anim add_to_cart_btn" each_productid="<?=$product_id;?>" each_wholesalerid="<?=$seller_id;?>" each_prd_price="<?php if($discount > 0){echo $discount;}else{echo $price;}?>" each_prd_img="<?php $this->db->where('product', $product_id);$this->db->limit(1);$images = $this->db->get('product_image');$count_image = $images->num_rows();if($count_image!=0){foreach($images->result() as $image_row){$image_filename = $image_row->filename;}echo $image_filename;}else{echo 'sample.jpg';}?>"><i class="fa fa-shopping-cart"></i><span class="btn-text">add to Cart</span></button>
                                                </div>
                                                <?php
                                                }else{
                                                ?>
                                                <a href="<?=base_url('cart');?>" class="btn btn-success btn-anim"><i class="ti-shopping-cart">view</i><span class="btn-text">added</span></a>
                                                <?php
                                                }
                                                ?>
                                                <div class="btn-group wishlist">
                                                    <a href="javascript:void(0);" class="btn btn-warning btn-anim place_order_btn"><i class="fa fa-shopping-cart"></i><span class="btn-text">Buy it now</span></a>
                                                </div>
                                                <p class="">In-stock <span style="font-weight: bold;"><?=$quantity;?></span></p><br/>
                                                <p>
                                                    <?php
                                                    // get active buyer co-ordinates
                                                    $this->db->where('user', $this->session->userdata('id'));
                                                    $active_pharmacy_data=$this->db->get('pharmacy');
                                                    foreach($active_pharmacy_data->result() as $active_pharmacy_row){
                                                        $pharmacy_location_id=$active_pharmacy_row->location;
                                                    }

                                                    if(!empty($pharmacy_location_id)){
                                                        $this->db->where('id', $pharmacy_location_id);
                                                        $active_location=$this->db->get('location');
                                                        foreach($active_location->result() as $active_loc_row){
                                                            $buyer_lattitude=$active_loc_row->lattitude;
                                                            $buyer_longitude=$active_loc_row->longitude;
                                                        }
                                                    }

                                                    //calculate distance btn seller and buyer
                                                    $latitudeFrom=$buyer_lattitude;
                                                    $longitudeFrom=$buyer_longitude;

                                                    $latitudeTo=$seller_lattitude;
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

                                                    //calculate shipping cost
                                                    //get shipping free in one km
                                                    $fee=$this->db->get('shipping_fee');
                                                    foreach($fee->result() as $fee_row){
                                                        $shipping_fee=$fee_row->fee;
                                                    }

                                                    //formular to calculate shipping cost
                                                    $shipping_cost=$distance*$shipping_fee;
                                                    echo 'estimated shipping cost from this seller to your store location is <strong style="color: black;">Tsh '.number_format($shipping_cost).'</strong>';
                                                    ?>
                                                </p>
                                                <input type="hidden" id="prd_price" value="<?php if($discount > 0){echo $discount;}else{echo $price;}?>">
                                                <input type="hidden" id="shipping_fee" value="<?=number_format($shipping_cost);?>">
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

                <!-- payment method and confirm order modal .start -->
                <form method="post" action="<?=base_url('billing/buy');?>">
                    <div class="modal fade" id="place_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h5 class="modal-title" id="exampleModalLabel1">Payment method and confirm order</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4 col-md-4" style="text-transform: uppercase;">Price<hr class="light-grey-hr mb-5"/></div>
                                            <div class="col-xs-4 col-md-4" style="text-transform: uppercase;">Quantity<hr class="light-grey-hr mb-5"/></div>
                                            <div class="col-xs-4 col-md-4" style="text-transform: uppercase;">Total<hr class="light-grey-hr mb-5"/></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-4 col-md-4 single_prd_price"></div>
                                            <div class="col-xs-4 col-md-4 prd_qty"></div>
                                            <div class="col-xs-4 col-md-4 sub_total_price"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row" style="color: black;">
                                            <div class="col-md-12">SUBTOTAL: <span class="sub_total_price"></span></div>
                                            <div class="col-md-12">SERVICE FEE: <span style="font-weight: bold;">free</span></div>
                                            <div class="col-md-12">TRANSPORT COST: <span class="transport_cost"></span></div>
                                            <div class="col-md-12" style="background: black; padding-top: 5px; padding-bottom: 5px; font-weight: bold; color: white;">TOTAL: <span class="total_order_price"></span></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="hidden" class="form-control transport_fee" name="transport_fee" value="">
                                        <input type="hidden" class="form-control product_qty" name="product_quantity" value="">
                                        <input type="hidden" class="form-control sub_total_order_price" name="subTotalPrice" value="">
                                        <input type="hidden" class="form-control" name="uniqueWholesalerId" value="<?=$seller_id;?>">
                                        <input type="hidden" class="form-control" name="productid" value="<?=$product_id;?>">
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal" >Close</button>
                                    <button type="submit" class="btn btn-primary btn-xs checkout_prd_btn">Confirm order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- payment method and confirm order modal .end -->
                
                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div  class="tab-struct custom-tab-1 product-desc-tab">
                                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_7">
                                            <li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="descri_tab" href="#descri_tab_detail"><span>Description</span></a></li>
                                            <li role="presentation" class="next"><a  data-toggle="tab" id="adi_info_tab" role="tab" href="#adi_info_tab_detail" aria-expanded="false"><span>Aditional information</span></a></li>
                                            <li role="presentation" class=""><a  data-toggle="tab" id="review_tab" role="tab" href="#review_tab_detail" aria-expanded="false"><span>Review<span class="inline-block">(<span class="review-count">0</span>)</span></span></a></li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent_7">
                                            <div  id="descri_tab_detail" class="tab-pane fade active in pt-0" role="tabpanel">
                                                <?php //if($productDetails!=''){ ?>

                                                <p class="pt-15">
                                                  <?//=$productDetails;?>  
                                                </p>
                                                <?php //}else{ ?>
                                                <p class="muted review-tag pt-15">No description yet.</p>
                                                <?php //} ?>

                                            </div>
                                            <div  id="adi_info_tab_detail" class="tab-pane pt-0 fade" role="tabpanel">
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                      <table class="table  mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td>EXPIRE DATE</td>
                                                                <td>
                                                                    not specified
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="review_tab_detail" class="tab-pane pt-0 fade" role="tabpanel">
                                                <p class="muted review-tag pt-15">No reviews yet.</p>
                                                
                                                </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
			</div>