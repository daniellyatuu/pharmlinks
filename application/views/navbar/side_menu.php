<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>

                <?php
                if($this->session->userdata('group')=='retailer' or $this->session->userdata('group')=='ADDO'){
                ?>
                
                    <!-- side menu for retailer or ADDO .start -->
                  
                    <li>
                        <a class="" href="<?=base_url('r_main');?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
                    </li>
                
                    <li>
                        <a class="" href="<?//=base_url('shops');?>" data-toggle="collapse" data-target="#products"><div class="pull-left"><i class="fa fa-medkit mr-20"></i><span class="right-nav-text">Shop Now</span></div><div class="clearfix"></div></a>
                    </li>
                
                    <li>
                        <a class="" href="<?=base_url('Cart/index');?>"><div class="pull-left"><i class="ti-shopping-cart mr-20"></i><span class="right-nav-text">My cart</span></div>
                            <div class="pull-right">
                                <span class="label label-info">
                                    <span id="div_cart2">
                                    <?php
                                        if(!empty($this->cart->contents())){
                                            $cart_count_row=count($this->cart->contents());
                                            echo $cart_count_row;
                                        }else{
                                            echo '0';
                                        }
                                    ?>
                                    </span>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="" class="<?php if(!empty($leftRtOrders)){echo $leftRtOrders;}?>" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="ti-package mr-20"></i><span class="right-nav-text">My orders</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
                    </li>
                
                    <!-- <li><hr class="light-grey-hr mb-10"/></li>
                    <li class="navigation-header">
                        <span>Suport</span> 
                        <i class="zmdi zmdi-more"></i>
                    </li> -->
                
                <?php
                }else if($this->session->userdata('group')=='wholesaler'){
                ?>

                    <!-- side menu for wholesaler only .start -->
                    
                    <li>
                        <a class="<?php if(!empty($highlightWholesalerDash)){echo 'active';}?>" href="<?=base_url('WL_main/index');?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
                    </li>
                    
                    <li>
                        <a class="<?php if(!empty($highlight)){echo 'active';}?>" href="javascript:void(0);" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="fa fa-medkit mr-20"></i><span class="right-nav-text">products </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="app_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?=base_url('WL_main/add_my_product');?>">Add product</a>
                            </li>
                            <li>
                                <a href="<?=base_url('WL_main/available_stock');?>">products list
                                    <div class="pull-right">
                                        <span class="label label-info">
                                            <?php
                                                // $this->db->where('user_id', $this->session->userdata('unique_user_id'));
                                                // $this->db->where('status', 'available');
                                                // $get_product_to_count=$this->db->get('stocks');
                            
                                                // $count_product_added=$get_product_to_count->num_rows();
                                                // echo $count_product_added;
                                            ?>
                                        </span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
            
                    <li>
                        <a href="<?//=base_url('WL_main/received_order');?>" class="" data-toggle="collapse" data-target="#pages_dr"><div class="pull-left"><i class="ti-package mr-20"></i><span class="right-nav-text">received orders</span></div><div class="clearfix"></div></a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="<?php if(!empty($viewDailySales)){echo 'active';}?>" data-toggle="collapse" data-target="#wholesaler_sales"><div class="pull-left"><i class="fa fa-plus-square mr-20"></i><span class="right-nav-text">sales</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
                    </li>

                    <!-- side menu for wholesaler only ./end -->

                <?php
                }else if($this->session->userdata('group')=='admin'){
                ?>

                    <!-- side menu for admin .start -->

                    <li>
                        <a href="<?=base_url('a_main');?>" class="<?php if($active=='admin_dash'){echo 'active';}?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
                    </li>
                    
                    <li>
                        <a href="<?=base_url('a_main/users');?>" class="<?php if($active=='users'){echo 'active';}?>" data-toggle="collapse" data-target="#pages_dr"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">users</span></div><div class="clearfix"></div></a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="" data-toggle="collapse" data-target="#wholesaler_sales"><div class="pull-left"><i class="ti-package mr-20"></i><span class="right-nav-text">orders</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
                    </li>

                    <li><hr class="light-grey-hr mb-10"/></li>
                    <li class="navigation-header">
                        <span>Master data</span> 
                        <i class="zmdi zmdi-more"></i>
                    </li>
                
                    <li>
                        <a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#maps_dr"><div class="pull-left"><i class="zmdi zmdi-info-outline mr-20"></i><span class="right-nav-text">Category</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        
                    </li>


                    <!-- side menu for admin ./end -->

                <?php
                }
                ?>

                <?php
                if($this->session->userdata('group')!='admin'){
                ?>
                
                <li><hr class="light-grey-hr mb-10"/></li>
                    <li class="navigation-header">
                        <span>Bussiness info</span> 
                        <i class="zmdi zmdi-more"></i>
                    </li>
                
                    <li>
                        <a class="" href="javascript:void(0);" data-toggle="collapse" data-target="#maps_dr"><div class="pull-left"><i class="zmdi zmdi-info-outline mr-20"></i><span class="right-nav-text">Pharmacy details</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="maps_dr" class="collapse collapse-level-1">
                            
                            <li>
                                <a href="<?=base_url('Main/pharmacy');?>">
                                    <?php
                                        // $this->db->where('pharmacies.user_ID', $this->session->userdata('unique_user_id'));
                                        // $get_pharm_table_info=$this->db->get('pharmacies');
                                        
                                        // $count_pharm_registered=$get_pharm_table_info->num_rows();
                                        
                                        // if($count_pharm_registered==0){
                                        //     echo "Add Pharmacy Details";
                                        // }else{
                                        //     echo "View Pharmacy Details";
                                        // }
                                        ?>
                                        here
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                <?php
                }
                ?>
                
			</ul>
		</div>