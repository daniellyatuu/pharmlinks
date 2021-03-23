<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
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
                                                            $this->db->where('status', 1);
                                                            $count_all_products=$this->db->count_all_results('product');
                                                            echo $count_all_products;
                                                            ?>
                                                        </span>+</span>
                                                    <a href="<?=base_url('shops');?>">
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
                    
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
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

                                                            // get group name
                                                            $this->db->where('name', 'wholesaler');
                                                            $group_id = $this->db->get('group');
                                                            foreach($group_id->result() as $group_row){
                                                                $id = $group_row->id;
                                                            }

                                                            $this->db->where('active', 1);
                                                            $this->db->where('verified', 1);
                                                            $this->db->where('group', $id);
                                                            $get_user_details=$this->db->get('user');
                                                            
                                                            $count_seller=0;
                                                            foreach($get_user_details->result() as $user_row){
                                                                $userid=$user_row->id;
                                                                
                                                                //get pharmacy details
                                                                $this->db->where('user', $userid);
                                                                $pharmacy=$this->db->get('pharmacy');
                                                                
                                                                foreach($pharmacy->result() as $pharmacy_row){
                                                                    $count_seller++;
                                                                }
                                                                
                                                            }
                                                            echo $count_seller;
                                                            ?>
                                                        </span></span>
													<span class="weight-500 uppercase-font txt-light block">Shops</span>
                                                    <a href="<?=base_url("shops");?>" class="txt-dark block font-13">visit now</a>
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
                    
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
                                                            // get order status data
                                                            $this->db->where('name', 'pending');
                                                            $order_status = $this->db->get('order_status');
                                                            foreach($order_status->result() as $status_row){
                                                                $status_id = $status_row->id;
                                                            }
                                                            
                                                            $this->db->where('from', $this->session->userdata('id'));
                                                            $this->db->where('retailer_active', 1);
                                                            $all_order = $this->db->get('order');
                                                            
                                                            if($all_order->num_rows() > 0){
                                                                $sn=0;
                                                                foreach($all_order->result() as $order_row){
                                                    
                                                                    $this->db->where('status_id', $status_id);
                                                                    $this->db->where('order_id', $order_row->id);
                                                                    $this->db->group_by('order_id');
                                                                    $order_content = $this->db->get('order_content');
                                                                    
                                                                    if($order_content->num_rows() > 0){
                                                                        foreach($order_content->result() as $order_content_row){
                                                                            $sn++;
                                                                        }
                                                                    }
                                                                }
                                                                echo $sn;
                                                            }else{
                                                                echo 0;
                                                            }
                                                            ?>
                                                        </span>
                                                    </span>
													<span class="weight-500 txt-light block">pending</span>
												</div>
												
												<div class="col-xs-4 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="weight-500 txt-light block" style="visibility: hidden;">processing</span>
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                        <?php
                                                        // get order status data
                                                        $this->db->where('name', 'processing');
                                                        $order_status = $this->db->get('order_status');
                                                        foreach($order_status->result() as $status_row){
                                                            $status_id = $status_row->id;
                                                        }
                                                        
                                                        $this->db->where('from', $this->session->userdata('id'));
                                                        $this->db->where('retailer_active', 1);
                                                        $all_order = $this->db->get('order');
                                                        
                                                        if($all_order->num_rows() > 0){
                                                            $sn=0;
                                                            foreach($all_order->result() as $order_row){
                                                
                                                                $this->db->where('status_id', $status_id);
                                                                $this->db->where('order_id', $order_row->id);
                                                                $this->db->group_by('order_id');
                                                                $order_content = $this->db->get('order_content');
                                                                
                                                                if($order_content->num_rows() > 0){
                                                                    foreach($order_content->result() as $order_content_row){
                                                                        $sn++;
                                                                    }
                                                                }
                                                            }
                                                            echo $sn;
                                                        }else{
                                                            echo 0;
                                                        }
                                                        ?>
                                                        </span>
                                                    </span>
                                                    <span class="weight-500 txt-light block">in-process</span>
												</div>
                                                
                                                <div class="col-xs-4 text-center pl-0 pr-0 data-wrap-left">
                                                    <span class="weight-500 txt-light block" style="visibility: hidden;">orders</span>
													<span class="txt-light block counter">
                                                        <span class="counter-anim">
                                                        <?php
                                                        // get order status data
                                                        $this->db->where('name', 'complete');
                                                        $order_status = $this->db->get('order_status');
                                                        foreach($order_status->result() as $status_row){
                                                            $status_id = $status_row->id;
                                                        }
                                                        
                                                        $this->db->where('from', $this->session->userdata('id'));
                                                        $this->db->where('retailer_active', 1);
                                                        $all_order = $this->db->get('order');
                                                        
                                                        if($all_order->num_rows() > 0){
                                                            $sn=0;
                                                            foreach($all_order->result() as $order_row){
                                                
                                                                $this->db->where('status_id', $status_id);
                                                                $this->db->where('order_id', $order_row->id);
                                                                $this->db->group_by('order_id');
                                                                $order_content = $this->db->get('order_content');
                                                                
                                                                if($order_content->num_rows() > 0){
                                                                    foreach($order_content->result() as $order_content_row){
                                                                        $sn++;
                                                                    }
                                                                }
                                                            }
                                                            echo $sn;
                                                        }else{
                                                            echo 0;
                                                        }
                                                        ?>
                                                        </span>
                                                    </span>
													<span class="weight-500 txt-light block">completed</span>
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
                
                <?php
                /*{
                ?>
                <!-- Row -->
				<div class="row">
                    
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
                <?php
                }*/
                ?>
                <?php
                /*{
                ?>
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
                <?php
                }*/
                ?>
			</div>