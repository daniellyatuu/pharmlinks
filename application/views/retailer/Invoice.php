<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					<!-- Title -->
					<div class="row heading-bg hide_on_print">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">invoice</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="javascript:void();">Dashboard</a></li>
								<li class="active"><span>invoice</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->
                    
                    <?php
                    $orderid = $this->uri->segment(3);

                    foreach($invoice as $invoice_row){
                        $order_number = $invoice_row->order_number;
                        $order_date = $invoice_row->date_ordered;
                        $transport_fee = $invoice_row->transport_fee;

                        // convert date to strtime
                        $get_order_timestamp = strtotime($order_date);
                    }
                    ?>

					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h5 class="panel-title txt-dark">Invoice</h5>
                                    </div>
                                    <div class="pull-right">
										<h5 class="panel-title txt-dark">order # 
                                            <?=$order_number;?>
                                        </h5>
                                    </div>
									<div class="clearfix"></div>
								</div>
                                
                                <hr class="light-grey-hr ma-0"/>
                                
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger finish_payment_div alert-dismissable" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="fa fa-warning pr-15 pull-left hidden-xs"></i><p class="pull-left">Dear customer you will not be able to place another order until you finished payment of this order. Thank you for using Pharmlinks</p> 
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
											<div class="col-md-6">
												<span class="txt-dark head-font inline-block capitalize-font mb-5">
                                                    
                                                    SHIPPING ADDRESS:
                                                </span>
												<address class="mb-15">
													<span class="address-head mb-5">
                                                        <?php
                                                        $this->db->where('user', $this->session->userdata('id'));
                                                        $get_pharmacy=$this->db->get('pharmacy');
                                                        foreach($get_pharmacy->result() as $pharmacy_row){
                                                            $pharmacy_loc_id=$pharmacy_row->location;
                                                            $pharmacy_name=$pharmacy_row->name;
                                                            echo $pharmacy_name.',';
                                                        }
                                                        ?>
                                                    </span>
													<?php
                                                    //get buyer pharmacy location
                                                    foreach($this->db->where('id', $pharmacy_loc_id)->get('location')->result() as $loc_row){
                                                        $loc_name=$loc_row->location_name;
                                                        echo str_replace(',',',<br/>',$loc_name);
                                                    } 
                                                    ?>
                                                    <br/>
                                                    
													<abbr title="Phone">P:</abbr>
                                                    <?php
                                                    $this->db->where('id', $this->session->userdata('id'));
                                                    $get_buyer_phone=$this->db->get('user');
                                                    foreach($get_buyer_phone->result() as $buyer_phone_row){
                                                        $buyer_phone_no=$buyer_phone_row->phone_number;
                                                        echo $buyer_phone_no;
                                                    }
                                                    ?>
												</address>
											</div>
											<div class="col-md-6 text-right">
                                                <?php
                                                $this->db->where('order_id', $orderid);
                                                $this->db->group_by('to');
                                                
                                                $getShopNo=$this->db->get('order_content');
                                                //count shops
                                                $countShops=$getShopNo->num_rows();
                                                
                                                if($countShops==1){
                                                    echo '<span class="txt-dark head-font inline-block capitalize-font mb-5">TO ONE SHOP</span><br/>';
                                                }else{
                                                    echo '<span class="txt-dark head-font inline-block capitalize-font mb-5">TO '. $countShops.' DIFFERENT SHOPS</span><br/>';
                                                }
                                                
                                                foreach($getShopNo->result() as $shop_row){
                                                    $wholesalerid=$shop_row->to;
                                                    $order_status_by_shops=$shop_row->status_id;

                                                    // get status name
                                                    $this->db->where('id', $order_status_by_shops);
                                                    $status_data = $this->db->get('order_status');
                                                    foreach($status_data->result() as $status_row){
                                                        $status_name = $status_row->name;
                                                    }
                                                    
                                                    $this->db->where('user', $wholesalerid);
                                                    $getWholesalerPharm=$this->db->get('pharmacy');
                                                    foreach($getWholesalerPharm->result() as $wholesalerPharmRow){
                                                        $pharmacy_loc_id=$wholesalerPharmRow->location;
                                                        $wholesaler_pharmname=$wholesalerPharmRow->name;
                                                        echo '<span class="txt-dark head-font inline-block capitalize-font mb-5">'.$wholesaler_pharmname.'</span>';    
                                                    }
                                                    
                                                ?>
                                                <?php
                                                if($status_name=='pending'){
                                                ?>
                                                <span class="label label-default hide_on_print" data-toggle="tooltip" data-placement="top" title="order not accepted by seller"><i class="fa fa-warning"></i></span><br/>
                                                <?php
                                                }else if($status_name=='processing'){
                                                ?>
                                                <span class="label label-info hide_on_print" data-toggle="tooltip" data-placement="top" title="order already accepted by seller"><i class="ti-check"></i></span><br/>
                                                <?php
                                                }else{
                                                ?>
                                                <br/>
                                                <?php
                                                }
                                                ?>
                                                
                                                <abbr title="Phone">P:</abbr>
                                                <?php
                                                $this->db->where('id', $wholesalerid);
                                                $get_wholesaler_phone=$this->db->get('user');
                                                foreach($get_wholesaler_phone->result() as $saler_phone_row){
                                                    $saler_phone_no=$saler_phone_row->phone_number;
                                                    echo $saler_phone_no.'<br/><br/>';
                                                }    
                                            }
                                                ?>
                                                
											</div>
										</div>
										
										<div class="row">
											<div class="col-xs-6">
												<address>
                                                     <?php
                                                     // get order content
                                                     $this->db->where('order_id', $orderid);
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
                                                         <span class="text-default" style="border: 2px solid #EA6C41; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;"><?=$status_name;?></span>
                                                         <?php
                                                         }else if($status_name=='processing'){
                                                         ?>
                                                         <span class="text-info" style="border: 2px solid #EA6C41; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;"><?=$status_name;?></span>
                                                         <?php
                                                         }else if($status_name=='complete'){
                                                         ?>
                                                         <span class="text-success" style="border: 2px solid #EA6C41; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;"><?=$status_name;?></span>
                                                         <?php
                                                         }else if($status_name=='cancelled'){
                                                         ?>
                                                         <span class="text-danger" style="border: 2px solid #EA6C41; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;"><?=$status_name;?></span>
                                                         <?php
                                                         }
                                                     }
                                                     ?>  
                                                    
												</address>
											</div>
											<div class="col-xs-6 text-right">
												<address>
													<span class="txt-dark head-font capitalize-font mb-5" style="font-weight: bold;">order date:</span><br>
													<?php
                                                    $order_datetime=date('M d, Y H:i', $get_order_timestamp);
                                                    echo $order_datetime;
                                                    ?>
                                                    <br><br>
												</address>
											</div>
										</div>
                                        
										<div class="invoice-bill-table">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th class="text-left">Item</th>
															<th class="text-center">Price</th>
															<th class="text-center">Quantity</th>
															<th class="text-center">Totals</th>
															<th class="hide_on_print text-right">shop</th>
                                                        </tr>
													</thead>
													<tbody>
                                                        <?php
                                                        $total_order_price = 0;
                                                        foreach($invoice_content as $invoce_content_row){
                                                            $orderto = $invoce_content_row->to;
                                                            $product_id = $invoce_content_row->product_id;
                                                            $orderQty = $invoce_content_row->quantity;
                                                            $sub_total_price = $invoce_content_row->price;

                                                            // get product name
                                                            $this->db->where('id', $product_id);
                                                            $product_data = $this->db->get('product');
                                                            foreach($product_data->result() as $product_row){
                                                                $brand_name = $product_row->brand_name;
                                                            }
                                                        ?>
														<tr style="">
                                                            <td class="text-left"><a href="javascript:void();"><?=$brand_name;?></a></td>
															<td class="text-center">
                                                                <?php
                                                                $price_per_one=$sub_total_price/$orderQty;
                                                                echo 'Tsh '.number_format($price_per_one);
                                                                ?>
                                                            </td>
															<td class="text-center"><?=$orderQty;?></td>
                                                            <td class="text-center">
                                                            <?php
                                                            echo 'Tsh '.number_format($sub_total_price);
                                                            $total_order_price += $sub_total_price;
                                                            ?>
                                                            </td>
															<td class="hide_on_print text-right">
                                                                <a href="javascript:void(0);">
                                                                <?php
                                                                foreach($this->db->where('user', $orderto)->get('pharmacy')->result() as $pharmacy_row){
                                                                    echo $pharmacy_row->name;
                                                                }
                                                                ?>
                                                                </a>
                                                            </td>
														</tr>
                                                        <?php
                                                        }
                                                        ?>
														<tr class="txt-dark hidden-table-hover-effect">
															<td class="hide_on_print"></td>
															<td></td>
															<td class="text-center">Subtotal</td>
															<td class="text-center">
                                                                <?='Tsh '.number_format($total_order_price);?>
                                                            </td>
                                                            <td class="hide_on_print"></td>
														</tr>
                                                        
														<tr class="txt-dark hidden-table-hover-effect">
															<td class="hide_on_print" style="border: none;"></td>
															<td style="border: none;"></td>
															<td class="text-center">Shipping</td>
															<td class="text-center">
                                                                <?='Tsh '.number_format($transport_fee);?>
                                                            </td>
                                                            <td style="border: none;" class="hide_on_print"></td>
														</tr>
                                                        
														<tr class="txt-dark hidden-table-hover-effect">
															<td class="hide_on_print" style="border: none;"></td>
															<td style="border: none;"></td>
															<td class="text-center">Total</td>
															<td class="text-center">
                                                                <?php
                                                                $total = $total_order_price+$transport_fee;
                                                                echo 'Tsh '.number_format($total);
                                                                ?>
                                                            </td>
                                                            <td style="border: none;" class="hide_on_print"></td>
														</tr>
													</tbody>
												</table>
											</div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    
                                                    <div class="hide_on_print">
                                                        <h6 style="text-decoration: underline;">Terms &amp; Condition</h6>
                                                        <!-- <p><i class="ti-arrow-right"></i> if order accepted you will not be able to cancel it</p> -->
                                                        <p><i class="ti-arrow-right"></i> if you receive products and you found that the received products is not what you want, please call 0753 841 279 within 48 hours and pharmlinks will return the products to the seller</p>
                                                        <p><i class="ti-arrow-right"></i> if your order delay for 24hrs please call 0753 841 279 pharmlinks will help you to get your order ASAP.</p>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="pull-right">
                                                        <!-- <button type="button" class="btn btn-primary btn-outline btn-xs btn-icon left-icon hide_on_print" onclick="javascript:window.print();"> 
                                                            <i class="fa fa-print"></i><span> Print</span> 
                                                        </button> -->
                                                    </div>
                                                </div>
                                            </div>
											
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->
                    
				</div>