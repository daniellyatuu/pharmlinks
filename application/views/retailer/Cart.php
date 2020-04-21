<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						  <h5 class="txt-dark">product cart</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						  <ol class="breadcrumb">
							<li><a href="<?=base_url('r_main/');?>">Dashboard</a></li>
							<li class="active"><span>cart</span></li>
						  </ol>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->
                    
					<!-- Row -->
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default card-view">
                                
                                <?php /*{ ?>
                                <div class="alert alert-danger insuffient_wallet_balance alert-dismissable" style="display: ;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="fa fa-warning pr-15 pull-left"></i><p class="pull-left">insufficient money in your wallet account, please deposit money in your wallet and try again</p> 
                                    <div class="clearfix"></div>
                                </div>
                                <?php }*/ ?>
                                
								<div class="panel-wrapper collapse in">
									<div class="panel-body row">
										<form id="example-advanced-form" method="post" action="<?=base_url('cart/update_cart');?>" accept-charset="utf-8">
											<div class="table-wrap cart_contents">
                                                 
											</div>
										</form>
                                        
                    <!-- payment method and confirm order modal .start -->
                    <form method="post" action="<?=base_url('billing');?>">
                        <div class="modal fade" id="place_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h5 class="modal-title" id="exampleModalLabel1">order confirmation</h5>
                                    </div>
                                    <div class="modal-body">
                                        Please confirm the order
                                        <div class="form-group">
                                            <input type="hidden" class="form-control transport_fee" name="transport_fee" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal" >Close</button>
                                        <button type="submit" class="btn btn-primary btn-xs checkout_prd_btn">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- payment method and confirm order modal .end -->
                    
                    <!-- clear cart confirm modal .start-->
                    <div class="modal fade hideModel" id="clear_cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                              Are you sure you want to delete all products from the cart?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">No</button>
                            <input type="submit" class="btn btn-danger btn-xs delete_prd_btn" value="Yes">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- clear cart confirm modal .end-->
                                        
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->
				
				</div>