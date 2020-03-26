<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				
                <?php
                // $this->db->where('pharmacies.user_ID', $this->session->userdata('unique_user_id'));
                // $get_pharm_table_info=$this->db->get('pharmacies');
                
                // $count_pharm_registered=$get_pharm_table_info->num_rows();
                // if($count_pharm_registered==0){
                ?>
                
                <!-- notification to register pharmacy .start -->
                <div class="alert alert-danger alert-dismissable" style="">				
                    <i class="ti-face-sad pr-15 pull-left"></i>
                    <p class="pull-left">Please register your pharmacy, <a href="<?=base_url('Main/pharmacy');?>">click here</a>, without register your pharmacy you will not be able to visit seller's store and also to place order.
                    </p>
                    <div class="clearfix"></div>					
                </div>
                <!-- notification to register pharmacy .end -->
                <?php //} ?>
                
				<!-- Row -->
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-red">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                            <?php
                                                            // $this->db->where('stocks.status', 'available');
                                                            // $this->db->where('stocks.quantity!=', 0);
                                                            // $count_all_products=$this->db->count_all_results('stocks');
                                                            // echo $count_all_products;
                                                            ?>
                                                        </span>+</span>
                                                    <a href="#">
													   <span class="weight-500 uppercase-font txt-light block font-13">Products</span>
                                                    </a>
                                                    <a href="<?=base_url('shops');?>" class="txt-dark block font-13">shop now</a>
												</div>
                                                <a href="#">
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="fa fa-product-hunt txt-light data-right-rep-icon"></i>
												</div>
                                                </a>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-yellow">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                            <?php
                                                            // $this->db->where('status', 'active');
                                                            // $this->db->where('category', 'wholesaler');
                                                            // $get_user_details=$this->db->get('user_details');
                                                            
                                                            // $count_seller=0;
                                                            // foreach($get_user_details->result() as $user_row){
                                                            //     $userid=$user_row->user_ID;
                                                                
                                                            //     //get pharmacy details
                                                            //     $this->db->where('user_ID', $userid);
                                                            //     $pharmacy=$this->db->get('pharmacies');
                                                                
                                                            //     foreach($pharmacy->result() as $pharmacy_row){
                                                            //         $count_seller++;
                                                            //     }
                                                                
                                                            // }
                                                            // echo $count_seller;
                                                            ?>
                                                        </span></span>
													<span class="weight-500 uppercase-font txt-light block">Shops</span>
                                                    <a href="<?=base_url("shops?pharmacy");?>" class="txt-dark block font-13">visit now</a>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="ti-home txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-blue">
										<div class="container-fluid">
											<div class="row">
                                                <div class="col-xs-4 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="weight-500 uppercase-font txt-light block">My Orders</span>
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                            <?php
                                                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                            // $this->db->where('status', 'init');
                                                            // $this->db->group_by('order_from');                        
                                                            // $this->db->group_by('date_ordered');
                                                            // $count_unpaid_order=$this->db->count_all_results('orders');
                                                            // echo $count_unpaid_order;
                                                            ?>
                                                        </span>
                                                    </span>
													<span class="weight-500 txt-light block"><a href="<?=base_url('RT_contents/my_order/init');?>">Unpaid</a></span>
												</div>
												
												<div class="col-xs-4 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="weight-500 txt-light block" style="visibility: hidden;">pending</span>
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                            <?php
                                                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                            // $this->db->where('status', 'pending');
                                                            // $this->db->where('retailer_availability!=', 'deleted');
                                                            // $this->db->group_by('order_from');                        
                                                            // $this->db->group_by('date_ordered');
                                                            // $count_pending_order=$this->db->count_all_results('orders');
                                                            // echo $count_pending_order;
                                                            ?>
                                                        </span>
                                                    </span>
                                                    <span class="weight-500 txt-light block"><a href="<?=base_url('RT_contents/my_order/pending');?>">pending</a></span>
												</div>
                                                
                                                <div class="col-xs-4 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="weight-500 txt-light block" style="visibility: hidden;">orders</span>
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                            <?php
                                                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                            // $this->db->where('status', 'proccessing');
                                                            // $this->db->where('retailer_availability!=', 'deleted');
                                                            // $this->db->group_by('order_from');                        
                                                            // $this->db->group_by('date_ordered');
                                                            // $count_proccessing_order=$this->db->count_all_results('orders');
                                                            // echo $count_proccessing_order;
                                                            ?>
                                                        </span>
                                                    </span>
													<span class="weight-500 txt-light block"><a href="<?=base_url('RT_contents/my_order/proccessing');?>">in process</a></span>
												</div>
												
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<div class="sm-data-box bg-green">
										<div class="container-fluid">
											<div class="row">
												<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
													<span class="txt-light block counter">
                                                        Tsh
                                                        <span class="counter-anim">
                                                              
                                                            <?php   
                                                            //current time
                                                            // $current_date=date('Y-m');
                                                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                            // $this->db->like('date_ordered', $current_date, 'after');
                                                            
                                                            // $this->db->group_start();
                                                            // $this->db->where('status', 'pending');
                                                            // $this->db->or_where('status', 'proccessing');
                                                            // $this->db->or_where('status', 'completed');
                                                            // $this->db->group_end();
                                                            
                                                            // $total_sales=0;
                                                            // $get_monthly_sales=$this->db->get('orders');
                                                            // foreach($get_monthly_sales->result() as $sales_row){
                                                            //     $daily_sales=$sales_row->price;
                                                            //     $total_sales=$total_sales+$daily_sales;
                                                            // }
                                                            // echo number_format($total_sales);    
                                                            ?>                                                          
                                                        </span></span>
													<span class="weight-500 uppercase-font txt-light block"><?=date('M');?> Purchases</span>
												</div>
												<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
													<i class="fa fa-minus-square txt-light data-right-rep-icon"></i>
												</div>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
                
                <!-- Row -->
				<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
                            <?php
                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                            // $this->db->where('status!=', 'init');
                            // $this->db->where('status!=', 'rtl_cancel');
                            // $this->db->where('status!=', 'auto_cancel');
                            // $this->db->select('productid, COUNT(productid) AS countNumber', false);
                            // $this->db->from('orders');
                            // $this->db->group_by('orders.productid');
                            // $this->db->order_by('countNumber','desc');
                            // $this->db->limit(5);
                            // $items = $this->db->get();
                            // //count
                            // $count_items=$items->num_rows();
                            ?>
							<div class="panel-heading">
								<div class="pull-left">
                                    <?php
                                    // if($count_items!=0){
                                    // ?>
									// <h6 class="panel-title txt-dark">top purchased products</h6>
                                    // <?php
                                    // }else{
                                    // ?>
                                    // <h6 class="panel-title txt-dark" style="text-transform:lowercase;">top purchased products will display here</h6>
                                    // <?php
                                    // }
                                    ?>
								</div>
								<div class="clearfix"></div>
							</div>
                            <?php
                            // if($count_items!=0){
                            ?>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row">
									<div class="col-sm-6 pa-0">
										<canvas id="chart_7" height="164"></canvas>
									</div>
									<div class="col-sm-6 pr-0 pt-25">
										<div class="label-chatrs">
                                            <?php
                                            // $s_n=1;
                                            // foreach($items->result() as $ids){
                                            //     $top_sold_prd=$ids->productid;
                                            //     $total_no_sold=$ids->countNumber;
                                                
                                            //     //get product info
                                            //     $this->db->where('product_ID', $top_sold_prd);
                                            //     $get_products_info=$this->db->get('stocks');
                                            //     foreach($get_products_info->result() as $stock_row){
                                            ?>
											<div class="mb-5">
												<span class="clabels inline-block <?php //if($s_n=='1'){echo 'bg-yellow';}else if($s_n=='2'){echo 'bg-pink';}else if($s_n=='3'){echo 'bg-blue';}else if($s_n=='4'){echo 'bg-red';}else if($s_n=='5'){echo 'bg-green';}*/?> mr-5"></span>
                                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font"><?//=$stock_row->product_name;?><?php //$s_n++;?></span>
											</div>
                                            <?php
                                            //     } //end stock foreach
                                            // } //end items foreach 
                                            ?>
											<?php /*{ ?>
                                            <div class="mb-5">
												<span class="clabels inline-block bg-pink mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Bow Ties</span>
											</div>
											<div class="mb-5">
												<span class="clabels inline-block bg-blue mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Pocket Squares</span>
											</div>
											<div class="mb-5">
												<span class="clabels inline-block bg-red mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Wood Sunglasses</span>
											</div>	
											<div class="">
												<span class="clabels inline-block bg-green mr-5"></span>
                                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Leggings</span>
											</div>
                                            <?php }*/ ?>
										</div>
									</div>										
								</div>	
							</div>
                            <?php //} ?>
						</div>
                        
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view">
								<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Order History</h6>
								</div>
								<div class="clearfix"></div>
							</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body row">
										<div class="">
                                            
											<div class="pl-15 pr-15 mb-15">
												<div class="pull-left">
													<i class="ti-package inline-block mr-10 font-16"></i>
                                                    <span class="inline-block txt-dark"><a href="<?=base_url('RT_contents/my_order/all');?>">All orders</a></span>
												</div>	
												<span class="inline-block txt-default pull-right weight-500">
                                                    <?php
                                                    // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                    // $this->db->where('retailer_availability!=', 'deleted');
                                                    // $this->db->where('status!=', 'auto_cancel');
                                                    // $this->db->group_by('order_from');                        
                                                    // $this->db->group_by('date_ordered');
                                                    // $get_all_order_to_count=$this->db->get('orders');
                                                    // $count_all_order=$get_all_order_to_count->num_rows();
                                                    // echo $count_all_order;
                                                    ?>
                                                </span>
												<div class="clearfix"></div>
											</div>
                                            
											<hr class="light-grey-hr mt-0 mb-15"/>
											<div class="pl-15 pr-15 mb-15">
												<div class="pull-left">
													<i class="ti-check-box inline-block mr-10 font-16"></i>
                                                    <span class="inline-block txt-dark"><a href="<?=base_url('RT_contents/my_order/completed');?>">Complete orders</a></span>
												</div>	
												<span class="inline-block txt-success pull-right weight-500">
                                                    <?php
                                                    // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                    // $this->db->where('status', 'completed');
                                                    // $this->db->where('retailer_availability!=', 'deleted');
                                                    // $this->db->where('status!=', 'auto_cancel');
                                                    // $this->db->group_by('order_from');                      
                                                    // $this->db->group_by('date_ordered');
                                                    // $count_completed_order=$this->db->count_all_results('orders');
                                                    // echo $count_completed_order;
                                                    ?>
                                                </span>
												<div class="clearfix"></div>
											</div>
											<hr class="light-grey-hr mt-0 mb-15"/>
											<div class="pl-15 pr-15 mb-15">
												<div class="pull-left">
													<i class=" ti-close inline-block mr-10 font-16"></i>
                                                    <span class="inline-block txt-dark"><a href="<?=base_url('RT_contents/my_order/cancelled');?>">Cancelled orders</a></span>
												</div>	
												<span class="inline-block txt-danger pull-right weight-500">
                                                    <?php
                                                    // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                                    // $this->db->where('status', 'rtl_cancel');
                                                    // $this->db->where('retailer_availability!=', 'deleted');
                                                    // $this->db->where('status!=', 'auto_cancel');
                                                    // $this->db->group_by('order_from');                        
                                                    // $this->db->group_by('date_ordered');
                                                    // $count_cancelled_order=$this->db->count_all_results('orders');
                                                    // echo $count_cancelled_order;
                                                    ?>
                                                </span>
												<div class="clearfix"></div>
											</div>
                                            
										</div>
									</div>
								</div>
							</div>
						
					</div>
				</div>
				<!-- /Row -->
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">purchases analytics</h6>
								</div>
								<div class="pull-right">
									<div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
										<select class="selectpicker" id="month" data-style="form-control">
                                            <?php
                                            // //get date order of each wholesaler
                                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                            // $this->db->where('status!=', 'init');
                                            // $this->db->where('status!=', 'rtl_cancel');
                                            // $this->db->where('status!=', 'auto_cancel');
                                            // $order_month=$this->db->get('orders');
                                            // $count_order_month=$order_month->num_rows();
                                            // if($count_order_month!=0){
                                            ?>
                                            <option selected value="no month" style="display: none;">select month..</option>
											<option value='01'>January</option>
											<option value='02'>February</option>
											<option value='03'>March</option>
											<option value='04'>April</option>
											<option value='05'>May</option>
											<option value='06'>June</option>
											<option value='07'>July</option>
											<option value='08'>August</option>
											<option value='09'>September</option>
											<option value='10'>October</option>
											<option value='11'>November</option>
											<option value='12'>December</option>
                                            <?php
                                            // }else{
                                            ?>
                                            <option selected value="no month" style="display: ;">month</option>
                                            <?php
                                            // }
                                            ?>
										</select>
									</div>
                                    
                                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
										<select class="selectpicker" id="year" data-style="form-control">
                                            <?php
                                            // //get date order of each retailer
                                            // $this->db->where('order_from', $this->session->userdata('unique_user_id'));
                                            // $this->db->where('status!=', 'init');
                                            // $this->db->where('status!=', 'rtl_cancel');
                                            // $this->db->where('status!=', 'auto_cancel');
                                            // $this->db->group_by('YEAR(date_ordered)');
                                            // $this->db->order_by('date_ordered', 'desc');
                                            // $order_date=$this->db->get('orders');
                                            // $count_order_date=$order_date->num_rows();

                                            // if($count_order_date!=0){
                                            //     foreach($order_date->result() as $date_row){
                                            //         $orderDate=$date_row->date_ordered;
                                            //         //convert time to timestamp
                                            //         $orderDate_timestamp=strtotime($orderDate);
                                            //         //convert timestamp to year format
                                            //         $order_year=date('Y', $orderDate_timestamp);
                                            ?>
                                            <option value='<?//=$order_year;?>'><?//=$order_year;?></option>
                                            <?php
                                            //     }
                                            // }else{
                                                //$current_yr=date('Y');
                                            ?>
                                            <option value='<?//=$current_yr;?>'>year</option>
                                            <?php
                                            // }
                                            ?>
										</select>
									</div>	
									<a href="#" class="pull-left inline-block full-screen">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
                                <div class="panel-body">
									<ul class="flex-stat mb-10 ml-15">
										<!--<li class="text-left auto-width mr-60">
											<span class="block">Traffic</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+15%</span>
											</span>
											<div class="clearfix"></div>
										</li>-->
										<li class="text-left auto-width mr-60">
											<span class="block">Orders</span>
											<span class="block txt-dark weight-500 font-18"><span class="orders_number">0</span></span>
											<!--<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+4%</span>
											</span>-->
											<div class="clearfix"></div>
										</li>
										<li class="text-left auto-width">
											<span class="block">cost</span>
											<span class="block txt-dark weight-500 font-18"><span class="cost_price">Tsh 0</span></span>
											<!--<span class="block txt-danger mt-5">
												<i class="zmdi zmdi-caret-down pr-5 font-20"></i><span class="weight-500">-5%</span>
											</span>-->
											<div class="clearfix"></div>
										</li>
									</ul>
                                    
                                    <div class="text-center notification_div" style="display: ;"></div>
                                    
									<div id="chart_1" class="morris-chart" style="max-height:345px;">
                                        <div class="text-center select_month_notification" style="padding: 10px; display: ;">
                                            <h6 style="font-weight: bold;">purchases analytics graph</h6>
                                            <p class="text-muted">select month to view your daily purchases</p>
                                        </div>
                                    </div>
								</div>
							</div>
                        </div>
                    </div>
                    
                </div>
				
			</div>
			
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p class="text-center"><?=date('Y');?> &copy; Pharmlinks.</p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->