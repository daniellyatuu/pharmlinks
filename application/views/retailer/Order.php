<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg hide_on_print">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <?php
                        // $retailer_id=$this->session->userdata('unique_user_id');
                        
                        // //check balance
                        // $this->db->where('user_reference_number', $this->session->userdata('user_reference_no'));
                        // $get_wallet_data=$this->db->get('wallet_tb');
                        // $count_wallet_data=$get_wallet_data->num_rows();
                        
                        // if($count_wallet_data==1){
                        //     foreach($get_wallet_data->result() as $wallet_row_data){
                        //         $customer_balance=$wallet_row_data->wallet_balance;
                        //     }
                        // }else{
                        //     $customer_balance=0;
                        // }
                        
                        // if($view_all_orders=='all'){
                        ?>
                        
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="javascript:void()0;">Dashboard</a></li>
						<li class="active"><span>product-orders</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

                <!-- filter .start -->
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" method="GET">
                                    <?php
                                    $sort='';
                                    $order='';
                                    $catgory='';
                                    if($_GET){
                                        $sort = $_GET['sort'];
                                        $order = $_GET['order'];
                                        $catgory = $_GET['category'];
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-2" style="margin: 5px 0;">
                                            <select class="form-control" name="sort">
                                            <option value="20" <?php if($sort==20){echo 'selected';}?>>20</option>
                                            <option value="30" <?php if($sort==30){echo 'selected';}?>>30</option>
                                            <option value="40" <?php if($sort==40){echo 'selected';}?>>40</option>
                                            <option value="50" <?php if($sort==50){echo 'selected';}?>>50</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="margin: 5px 0;">
                                        
                                        <input type="text" name="order" class="form-control"
                                                placeholder="search..." value="<?=$order;?>">
                                        </div>
                                        <div class="col-md-4" style="margin: 5px 0;">
                                            <select class="form-control" name="category">
                                            <option value="">all categories</option>
                                                <?php
                                                foreach($status as $status_row){
                                                ?>
                                                <option value="<?=$status_row->id;?>" <?php if($catgory==$status_row->id){echo 'selected';}?>><?=$status_row->name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="margin: 5px 0;">
                                            <button type="submit" class="btn btn-success btn-outline" style="float: right;">
                                                <i class="icofont icofont-job-search m-r-5"></i> filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- filter ./end -->
                
                <?php
                if($order_content){
                    echo $pagermessage;
                ?>
				<div class="row">
                    
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body row">
									<div class="table-wrap">
										<div class="table-responsive">
                                           <table class="table display responsive product-overview mb-30" id="myTable">
												<thead>
													<tr>
														<th class="text-left">Order Number</th>
                                                        
                                                        <th class="text-center">Amount</th>
                                                        
														<th class="text-center">Date ordered</th>
                                                        
                                                        <th class="text-center hide_on_print">Status</th>
                                                        
														<th class="text-right hide_on_print">Action</th>
													</tr>
												</thead>
												<tbody class="display_orders"> 
                                                    <?php
                                                    foreach($order_content as $order_content_row){
                                                        $order_id = $order_content_row->order_id;
                                                        
                                                        // get order
                                                        $this->db->where('id', $order_id);
                                                        $order = $this->db->get('order');
                                                        foreach($order->result() as $order_row){
                                                            $order_number = $order_row->order_number;
                                                            $date_ordered = $order_row->date_ordered;
                                                        }
                                                        //convert datetime to timestamp
                                                        $date_order_timestamp=strtotime($date_ordered);
                                                    ?>
                                                    <tr>

                                                        <td class="txt-dark"><?=$order_number;?></td>
                                                        
                                                        <td class="text-center">
                                                        <?php
                                                        // get order content
                                                        $this->db->where('order_id', $order_id);
                                                        $order_content = $this->db->get('order_content');
                                                        $order_price = 0;
                                                        foreach($order_content->result() as $order_content_row){
                                                            $id = $order_content_row->id;
                                                            $price = $order_content_row->price;
                                                            $order_price += $price;
                                                        }
                                                        echo 'Tsh '.number_format($order_price);
                                                        ?>
                                                        </td>
                                                        <td class="text-center">
                                                        <?php
                                                        echo date('M d, Y H:i', $date_order_timestamp);
                                                        ?>
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                        <?php
                                                        // get order content
                                                        $this->db->where('order_id', $order_id);
                                                        $this->db->group_by('status_id');
                                                        $ordercontent = $this->db->get('order_content');
                                                        foreach($ordercontent->result() as $order_content_row){
                                                            $id = $order_content_row->id;
                                                            $status_id = $order_content_row->status_id;
                                                            
                                                            // get status name
                                                            $this->db->where('id', $status_id);
                                                            $get_status = $this->db->get('order_status');
                                                            foreach($get_status->result() as $status_row){
                                                                $status_name = $status_row->name;
                                                            }
                                                            if($status_name=='pending'){
                                                            ?>
                                                            <span class="label label-default" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                            <?php
                                                            }else if($status_name=='processing'){
                                                            ?>
                                                            <span class="label label-info" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                            <?php
                                                            }else if($status_name=='complete'){
                                                            ?>
                                                            <span class="label label-success" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                            <?php
                                                            }else if($status_name=='cancelled'){
                                                            ?>
                                                            <span class="label label-danger" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                        </td>
                                                        
                                                        <td class="text-right">
                                                        <a class="btn btn-xs btn-default btn-outline" href="<?=base_url('r_order/invoice').'/'.$order_id;?>">view</a>
                                                        </td>

                                                    </tr>
                                                    <?php } ?>
												</tbody>
											</table>
										</div>
                                        
									</div>	
								</div>
							</div>
						</div>
                        <?=$links;?>
					</div>
				</div>
				<!-- /Row -->
                
                <?php
                }else{
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel text-center" style="padding: 30px 10px;">
                            <h6 style="font-weight: bold;">No results found</h6>
                            <!-- <p class="text-muted">Try different keywords</p> -->
                        </div>
                    </div>
                </div>
                <?php } ?>

			</div>
            
            <!-- payment method and confirm order modal .start -->
            <form method="post" action="<?=base_url('Billing/pay_order');?>">
                <div class="modal fade" id="checkout_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title" id="exampleModalLabel1">ORDER ID: <strong class="ordernumber"></strong>, PAY YOUR ORDER</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    
                                    <div class="payment_method">
                                        <input type="hidden" class="form-control order_no" name="orderid" value="">
                                        <input type="hidden" class="form-control walletBalance" name="wallet_balance" value="">
                                        <input type="hidden" class="form-control order_dept" name="order_dept" value="">
                                        <div class="">
                                            <i class="pe-7s-wallet top-nav-icon"></i> <label>WALLET BALANCE <strong class="walletbalance"></strong> </label>
                                        </div>
                                        <div class="">
                                            <i class="ti-package"></i> <label>ORDER PRICE <strong class="order_price"></strong> </label>
                                        </div>
                                        <div class="">
                                            <i class="ti-package"></i> <label>AMOUNT PAID <strong class="paid_amount"></strong> </label>
                                        </div>
                                        <div class="text-danger">
                                            <i class="ti-package"></i> <label>DEPT <strong class="dept"></strong> </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal" >Close</button>
                                <button type="submit" class="btn btn-primary btn-xs checkout_prd_btn">Confirm checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- payment method and confirm order modal .end -->
            
            <!-- cancel order .start -->
            <form method="post" action="<?=base_url('Billing/cancel_order');?>">
                <div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title" id="exampleModalLabel1">CANCEL ORDER <strong class="unique_order_no"></strong></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    
                                    <div class="payment_method">
                                        <input type="hidden" class="form-control uniqueOrderNo" name="orderno" value="">
                                        
                                        <div class="text-danger">
                                            Are you sure you want to cancel this order?
                                        </div>
                                        <div class="paid_amount_div">
                                        
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal" >Close</button>
                                <button type="submit" class="btn btn-warning btn-xs checkout_prd_btn">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- cancel order .end -->
            
            <!-- permanent delete order .start -->
            <?php
            $current_url=$this->uri->segment(3);
            ?>
            <form method="post" action="<?=base_url("Billing/delete_order/$current_url");?>">
                <div class="modal fade" id="delete_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title" id="exampleModalLabel1">DELETE ORDER <strong class="unique_order_number"></strong></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    
                                    <div class="payment_method">
                                        <input type="hidden" class="form-control unique_order_number" name="orderno02" value="">
                                        <div class="text-danger">
                                            You will not be able to recover this order
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal" >Close</button>
                                <button type="submit" class="btn btn-danger btn-xs checkout_prd_btn">Confirm delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- permanent delete order .end -->