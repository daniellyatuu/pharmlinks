<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
                
                <?php
                
                    // if($this->session->userdata('user_category')=='retailer'){
                ?>
				<li>
					<a class="<?php if(!empty($leftRtDash)){echo $leftRtDash;}?>" href="<?=base_url('RT_main/dashboard');?>" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
				</li>
                
                <li>
					<a class="<?php if(!empty($leftRtProducts)){echo $leftRtProducts;}?>" href="<?=base_url('shops');?>" data-toggle="collapse" data-target="#products"><div class="pull-left"><i class="fa fa-medkit mr-20"></i><span class="right-nav-text">Shop Now</span></div><div class="clearfix"></div></a>
				</li>
                
                <li>
					<a class="<?php if(!empty($leftRtCart)){echo $leftRtCart;}?>" href="<?=base_url('Cart/index');?>"><div class="pull-left"><i class="ti-shopping-cart mr-20"></i><span class="right-nav-text">My cart</span></div>
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
                
                <li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Suport</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
                
                <?php
                    // }else if($this->session->userdata('user_category')=='wholesaler'){
                    ?>
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
                
                <?php //} ?>
                
				<!--<li><hr class="light-grey-hr mb-10"/></li>-->
				<!--<li class="navigation-header">
					<span>Sales</span> 
					<i class="zmdi zmdi-more"></i>
				</li>-->
                <?php
                    // if($this->session->userdata('user_category')=='retailer'){
                ?>
                <li>
					<a href="javascript:void(0);" class="<?php if(!empty($leftRtOrders)){echo $leftRtOrders;}?>" data-toggle="collapse" data-target="#app_dr"><div class="pull-left"><i class="ti-package mr-20"></i><span class="right-nav-text">My orders</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="app_dr" class="collapse collapse-level-1">
						<li>
							<a href="<?=base_url('RT_contents/my_order/all');?>">All
                                <div class="pull-right">
                                    <?php /*{ ?>
                                    <span class="label label-default">
                                        <?php
                                        $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                        $this->db->where('retailer_availability!=', 'deleted');
                                        $this->db->where('status!=', 'auto_cancel');
                                        $this->db->group_by('order_from');                        
                                        $this->db->group_by('date_ordered');
                                        $count_all_orders=$this->db->count_all_results('orders');
                                        echo $count_all_orders;
                                        ?>
                                    </span>
                                    <?php }*/ ?>
                                </div>
                            </a>
						</li>
                        <li>
							<a href="<?=base_url('RT_contents/my_order/init');?>">Unpaid</a>
						</li>
                        <li>
							<a href="<?=base_url('RT_contents/my_order/pending');?>">Pending</a>
						</li>
                        <li>
							<a href="<?=base_url('RT_contents/my_order/proccessing');?>">In Process</a>
						</li>
                        <li>
							<a href="<?=base_url('RT_contents/my_order/completed');?>">Complete</a>
						</li>
                        <li>
							<a href="<?=base_url('RT_contents/my_order/cancelled');?>">Cancelled</a>
						</li>
					</ul>
				</li>
                
                <!--<li>
					<a href="#" data-toggle="collapse" data-target="#pages_dr">
                        <div class="pull-left"><i class="ti-truck mr-20"></i><span class="right-nav-text">In transit</span></div>
                        <div class="pull-right">        
                            <span class="label label-info">        
                                0    
                            </span>
                        </div>
                        <div class="clearfix"></div></a>
				</li>-->
                
                <!--<li>
					<a href="#" data-toggle="collapse" data-target="#pages_dr">
                        <div class="pull-left"><i class="ti-trash mr-20"></i><span class="right-nav-text">Trash</span></div>
                        <div class="pull-right">        
                            <span class="label label-danger">        
                                0    
                            </span>
                        </div>
                        <div class="clearfix"></div></a>
				</li>-->
                
                <?php //}
                    // if($this->session->userdata('user_category')=='wholesaler')
                    // { 
                ?>
                <li>
					<a href="<?=base_url('WL_main/received_order');?>" class="<?php if(!empty($viewReceivedOrders)){echo 'active';}?>" data-toggle="collapse" data-target="#pages_dr"><div class="pull-left"><i class="ti-package mr-20"></i><span class="right-nav-text">received orders</span></div><div class="clearfix"></div></a>
				</li>
                
                <li>
					<a href="javascript:void(0);" class="<?php if(!empty($viewDailySales)){echo 'active';}?>" data-toggle="collapse" data-target="#wholesaler_sales"><div class="pull-left"><i class="fa fa-plus-square mr-20"></i><span class="right-nav-text">sales</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="wholesaler_sales" class="collapse collapse-level-1">
						<li>
							<a href="<?=base_url('Main_filter/sales');?>">Daily</a>
						</li>
                        <!--<li>
							<a href="#">Weekly</a>
						</li>-->
                        <li>
							<a href="<?=base_url('Main_filter/monthly_sales');?>">Monthly</a>
						</li>
                        <li>
							<a href="<?=base_url('Main_filter/anually_sales');?>">Anually</a>
						</li>
					</ul>
				</li>
                
                <li>
					<a class="<?php if(!empty($trash_highlight)){echo $trash_highlight;}?>" href="<?=base_url('Main_rw/trash');?>" data-toggle="collapse" data-target="#pages_dr">
                        <div class="pull-left"><i class="ti-trash mr-20"></i><span class="right-nav-text">Trash</span></div>
                        <div class="pull-right">        
                            <span class="label <?php if(!empty($trash_highlight)){echo 'label-info';}else{echo 'label-danger';}?>">        
                                <?php        
                                    // $this->db->where('user_id', $this->session->userdata('unique_user_id'));                    
                                    // $this->db->where('status', 'deleted');
                                    // $get_product_to_count=$this->db->get('stocks');
                                    
                                    // $count_product_added=$get_product_to_count->num_rows();                    
                                    // echo $count_product_added;        
                                ?>      
                            </span>
                        </div>
                        <div class="clearfix"></div></a>
				</li>
                
                <?php //} ?>
                
                <!--account .start-->
                <li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Bussiness info</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
                
                <li>
                    <a class="<?php if(!empty($pharm_detail_highlight)){echo $pharm_detail_highlight;}?>" href="javascript:void(0);" data-toggle="collapse" data-target="#maps_dr"><div class="pull-left"><i class="zmdi zmdi-info-outline mr-20"></i><span class="right-nav-text">Pharmacy details</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
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
                            </a>
						</li>
                        
					</ul>
				</li>
                
                <!--<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Support</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
                
                <li>
                    <?php
                    /*if($this->session->userdata('user_category')=='retailer'){
                    ?>
                    <a href="#" data-toggle="collapse" data-target="#pages_dr">
                        <div class="pull-left"><i class="fa fa-question-circle-o mr-20"></i><span class="right-nav-text">Help</span></div>
                        <div class="clearfix"></div></a>
                    <?php
                    }else if($this->session->userdata('user_category')=='wholesaler'){
                    ?>
                    <a href="#" data-toggle="collapse" data-target="#pages_dr">
                        <div class="pull-left"><i class="fa fa-question-circle-o mr-20"></i><span class="right-nav-text">Help</span></div>
                        <div class="clearfix"></div></a>
                    <?php
                    }*/
                    ?>
				</li>-->
				
			</ul>
		</div>