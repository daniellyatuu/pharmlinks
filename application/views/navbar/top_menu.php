<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
                        <?php
                        // if($this->session->userdata('user_category')=='retailer'){
                        ?>
						<a href="<?=base_url('RT_main/dashboard');?>">
							<img class="brand-img hidden-xs" src="<?php echo base_url('assets/app');?>/dist/img/pl_logo.png" alt="brand"/>
							<span class="brand-text">Pharmlinks</span>
						</a>
                        <!-- <?php
                        // }else if($this->session->userdata('user_category')=='wholesaler'){
                        ?>
                        <a href="<?=base_url('WL_main/index');?>">
							<img class="brand-img hidden-xs" src="<?php echo base_url('assets/app');?>/dist/img/pl_logo.png" alt="brand"/>
							<span class="brand-text">Pharmlinks</span>
						</a>
                        <?php
                        // }
                        ?> -->
					</div>
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
                <?php
                // if($this->session->userdata('user_category')=='retailer'){
                ?>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                <?php //} ?>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
                
                <?php
                    // if($this->session->userdata('user_category')=='retailer'){
                    //     $this->db->where('pharmacies.user_ID', $this->session->userdata('unique_user_id'));
                    //     $get_pharm_table_info=$this->db->get('pharmacies');

                    //     $count_pharm_registered=$get_pharm_table_info->num_rows();
                    //     if($count_pharm_registered!=0){
                ?>
				<form id="search_form" action="<?=base_url('RT_main/search');?>" method="post" role="search" class="top-nav-search collapse pull-left">
					<div class="input-group">
						<input type="text" name="seach_keyword" id="seach_keyword" class="form-control" value="<?php if(!empty($_GET['result'])){echo $_GET['result'];}?>" placeholder="Search for products...">
						<span class="input-group-btn">
						<button type="button" class="btn btn-default hidden-md hidden-lg" data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
						<button type="submit" class="btn btn-default hidden-xs hidden-sm submit_btn"><i class="zmdi zmdi-search"></i></button>
						</span>
					</div>
				</form>
                <?php
                    //     }    
                    // }
                ?>
                
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					<!--<li>
						<a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
					</li>-->
                    
                    <?php
                        // if($this->session->userdata('user_category')=='retailer'){
                    ?>
                    
                    <li class="dropdown alert-drp">
						<a href="<?=base_url('Wallet_controller');?>"><i class="pe-7s-wallet top-nav-icon"></i>
                            <span class="">
                                <span  class="hidden-xs">
                            <?php
                            // $this->db->where('user_reference_number', $this->session->userdata('user_reference_no'));
                            // $get_wallet_data=$this->db->get('wallet_tb');
                            // $count_wallet_data=$get_wallet_data->num_rows();
                            
                            // if($count_wallet_data==1){
                            //     foreach($get_wallet_data->result() as $wallet_row_data){
                            //         echo number_format($wallet_row_data->wallet_balance).' Tsh';
                            //     }
                            // }else{
                            //     echo '0 Tsh';
                            // }
                            ?> 
                                </span>
                            </span>
                        </a>
					</li>
                    
                    <li class="dropdown alert-drp">
						<a href="<?=base_url('Cart/index');?>"><i class="ti-shopping-cart top-nav-icon"></i>
                            <span class="top-nav-icon-badge">
                                <span id="div_cart">
                                    <?php
                                    // if(!empty($this->cart->contents()))
                                    // {
                                    //     $cart_count_row=count($this->cart->contents());
                                    //     echo $cart_count_row;
                                    // }else{
                                    //     echo '0';
                                    // }
                                    ?>
                                </span>
                            </span>
                        </a>
					</li>
                    
                    <?php
                    //     }
                    // if($this->session->userdata('user_category')=='wholesaler'){
                    ?>
                    
                    <li class="dropdown alert-drp seller_notification">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon view_notifiy_icon"></i><span class="top-nav-icon-badge notification_no"></span></a>
						<ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
							<li>
								<div class="notification-box-head-wrap">
									<span class="notification-box-head pull-left inline-block">notifications</span>
									<a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
									<div class="clearfix"></div>
									<hr class="light-grey-hr ma-0"/>
								</div>
							</li>
							<li>
								<div class="streamline message-nicescroll-bar display_notification">
									
								</div>
							</li>
							<li>
								<div class="notification-box-bottom-wrap">
									<hr class="light-grey-hr ma-0"/>
									<a class="block text-center read-all" href="javascript:void(0)"> read all </a>
									<div class="clearfix"></div>
								</div>
							</li>
						</ul>
					</li>
                    
                    <?php
                    // }
                    ?>
                    
                    <li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url('assets/app');?>/images/profile_pic/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li style="pointer-events: none;">
								<a href="javascript:void(0);"><span>Hi, <?=$this->session->userdata('f_name');?></span></a>
							</li>
                            <li class="divider"></li>
                            <li>
								<a href="<?=base_url('Main/my_profile');?>"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
							</li>
                            <?php
                            // if($this->session->userdata('user_category')=='retailer'){
                            ?>
							<li>
                                <a href="<?=base_url('Wallet_controller');?>"><i class="pe-7s-wallet"></i><span>Wallet <span style="text-transform: lowercase;"><?='('.$this->session->userdata('user_reference_no').')';?></span></span></a>
							</li>
                            <?php //} ?>
							<li>
								<a href="<?=base_url('main01/logout');?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
                    
				</ul>
			</div>	
		</nav>