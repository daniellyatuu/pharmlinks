<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						  <h5 class="txt-dark">shops</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
							<li><a href="<?=base_url('r_main');?>">Dashboard</a></li>
							<li class="active"><span>shops</span></li>
						  </ol>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->
					
					<!-- Row -->
					<div class="row" style="">
						<div class="col-sm-12">
							<div class="panel panel-default card-view pb-0">
								<div class="panel-wrapper collapse in">
									<div class="panel-body pb-0">
                                        
                                        <div class="row">
                                            <div class="col-md-12 mb-30">
                                                <?php
                                                if(!isset($_REQUEST['pharmacy'])){
                                                ?>
                                                <h6 style="text-transform: lowercase;">Where do you want to shop(order) your products?</h6>
                                                <?php
                                                }else{
                                                ?>
                                                <h5>Available Wholesalers</h5>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <?php
                                            if(!isset($_REQUEST['pharmacy'])){
                                            ?>
                                            <div class="col-md-3 left-contents">
                                                
                                                <div class="row">
                                                    <!-- item -->
                                                    <div class="col-lg-12 col-md-12  col-sm-6 text-center mb-30">
                                                        <div class="panel panel-pricing mb-0">
                                                            <div class="panel-heading">
                                                                
                                                                <a href="<?=base_url('shops/all');?>">
                                                                    <i class="fa fa-random"></i>
                                                                    <h6 class="long_text " style="text-transform: uppercase;">Random shops</h6>
                                                                </a>
                                                            </div>
                                                            <div class="panel-body text-center pl-0 pr-0">
                                                                
                                                                <ul class="list-group mb-0 text-left">
                                                                    <li><hr class="mt-5 mb-5"/></li>
                                                                    <li class="list-group-item long_text "><i class="fa fa-medkit"></i>
                                                                    <?php
                                                                    $this->db->where('status', 1);
                                                                    // $this->db->where('stocks.quantity!=', 0);
                                                                    $count_products=$this->db->count_all_results('product');
                                                                    echo $count_products.' products';
                                                                    ?>
                                                                    </li>
                                                                    <li><hr class="mt-5 mb-5"/></li>
                                                                    <li class="list-group-item" style="text-align: justify;">
                                                                        <i class="ti-info-alt"></i>NOTE: single order from different shops at the sametime will cause <span class="text-danger">HIGHER TRANSPORT FREE</span> compared to the order that come from single shop
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- /item -->
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="<?//php// if(isset($_REQUEST['pharmacy'])){echo 'col-md-12'; }else{echo 'col-md-9'; }?> right-contents">
                                                
                                                <?php
                                                
                                                //get active buyer co-ordinates
                                                $this->db->where('user', $this->session->userdata('id'));
                                                $active_pharmacy_data=$this->db->get('pharmacy');
                                                foreach($active_pharmacy_data->result() as $active_pharmacy_row){
                                                    $active_pharmacy_location_id=$active_pharmacy_row->location;
                                                }

                                                if(!empty($active_pharmacy_location_id)){
                                                    $this->db->where('id', $active_pharmacy_location_id);
                                                    $active_location=$this->db->get('location');
                                                    foreach($active_location->result() as $active_loc_row){
                                                        $buyer_lattitude=$active_loc_row->lattitude;
                                                        $buyer_longitude=$active_loc_row->longitude;
                                                    }
                                                }

                                                //get seller information

                                                // 1
                                                $this->db->where('name', 'wholesaler');
                                                $group_id = $this->db->get('group');
                                                foreach($group_id->result() as $group_row){
                                                    $seller_id = $group_row->id;
                                                }

                                                // 2
                                                $this->db->where('active', 1);
                                                $this->db->where('verified', 1);
                                                $this->db->where('group', $seller_id);
                                                $get_sellers=$this->db->get('user');
                                                //count sellers
                                                $count_seller=$get_sellers->num_rows();
                                                ?>
                                                <div class="row">
                                                    <?php
                                                    foreach($get_sellers->result() as $seller_row){
                                                        $userid=$seller_row->id;
                                                        
                                                        //get pharmacy information
                                                        $this->db->where('user', $userid);
                                                        $get_pharmacy_details=$this->db->get('pharmacy');
                                                        foreach($get_pharmacy_details->result() as $pharmacy_row){
                                                    ?>
                                                    <!-- shop -->
                                                    <div class="<?php if(isset($_REQUEST['pharmacy'])){echo 'col-lg-3 col-md-3 col-sm-3'; }else{echo 'col-lg-4 col-md-4 col-sm-4'; }?> col-xs-6 text-center mb-30">
                                                        <div class="panel panel-pricing mb-0">
                                                            <div class="panel-heading">
                                                                <a href="<?=base_url("shops/pharmacy/$userid");?>">
                                                                    <i class="ti-home"></i>
                                                                    <h6 class="long_text " style="text-transform: uppercase;"><?=$pharmacy_row->name;?></h6>
                                                                </a>
                                                            </div>
                                                            <div class="panel-body text-center pl-0 pr-0">
                                                                
                                                                <ul class="list-group mb-0 text-left">
                                                                    <li class="list-group-item long_text ">
                                                                        
                                                                        <?php
                                                                        //get each pharmacy location
                                                                        $pharmacy_location_id=$pharmacy_row->location;
                                                                        
                                                                        $this->db->where('id', $pharmacy_location_id);
                                                                        $pharmacy_location=$this->db->get('location'); 
                                                                        
                                                                        foreach($pharmacy_location->result() as $location_row){
                                                                            $location_name=$location_row->location_name;
                                                                            $seller_latitude=$location_row->lattitude;
                                                                            $seller_longitude=$location_row->longitude;
                                                                        ?>
                                                                        
                                                                        <i class="ti-location-pin"></i><?=$location_name;?>
                                                                        <br/>
                                                                        <i class="fa fa-motorcycle"></i>
                                                                        <span style="font-weight: bold;">
                                                                            <?php
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
                                                                              
                                                            $distance =  $angle * $earthRadius;           
                                                            
                                                            //default location are in KM
                                                            
                                                            if($distance>1){//if distance is greater than 1KM
                                                                
                                                                //check if number contain decimal
                                                                $formated_distance=$distance;
                                                                if(strpos($distance,'.')!==false){
                                                                    $formated_distance=number_format($distance,2);
                                                                }
                                                                echo $formated_distance.' kilometre far';
                                                                
                                                            }else{
                                                                //1KM = 1000M
                                                                
                                                                $real_distance=$distance*1000;
                                                                
                                                                //check if number contain decimal
                                                                $formated_distance=$real_distance;
                                                                if(strpos($real_distance,'.')!==false){
                                                                    $formated_distance=number_format($real_distance,2);
                                                                }
                                                                echo $formated_distance.' metre far';
                                                            }
                                                                            ?>
                                                                        </span><br/>
                                                                        <i class="fa fa-calculator"></i>
                                                                        <span>
                                                                        <?php
                                                            //get shipping free in one km
                                                            $fee=$this->db->get('shipping_fee');
                                                            foreach($fee->result() as $fee_row){
                                                                $shipping_fee=$fee_row->fee;
                                                            }
                                                            //formular to calculate shipping cost
                                                            $shipping_cost=$distance*$shipping_fee;
                                                            
                                                            echo 'Tsh '.number_format($shipping_cost).' Shipping cost';
                                                                            ?>
                                                                        </span>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <li><hr class="mt-5 mb-5"/></li>
                                                                    <li class="list-group-item long_text "><i class="fa fa-medkit"></i>
                                                                        <?php
                                                                        $this->db->where('user', $userid);
                                                                        $this->db->where('status', 1);
                                                                        // $this->db->where('quantity!=', 0);
                                                                        $count_products=$this->db->count_all_results('product');
                                                                        
                                                                        if($count_products==0){
                                                                            echo 'no products';
                                                                        }else if($count_products==1){
                                                                            echo $count_products.' product';
                                                                        }else if($count_products>1){
                                                                            echo $count_products.' products';
                                                                        }
                                                                        ?>
                                                                    </li>
                                                                    <?php
                                                                    /*{
                                                                    ?>
                                                                    <li><hr class="mt-5 mb-5"/></li>
                                                                    <li class="list-group-item long_text ">
                                                                        <i class="fa fa-phone"></i><span><?//=$seller_row->phone_no;?></span><br/>
                                                                        <i class="fa fa-envelope-o"></i> <?//=$seller_row->email;?>
                                                                    </li>
                                                                    <?php
                                                                    }*/
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- /shop -->
                                                    <?php
                                                        }   
                                                    }
                                                    ?>
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