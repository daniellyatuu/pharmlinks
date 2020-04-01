<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
                                
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										
										<div class="form-wrap">
											<form data-toggle="validator" method="post" action="<?=base_url('verify/update');?>">
                                                
                                                <h5 class="text-center">Verify your phone number</h5>
                                                <div class="text-center">Pharmlinks will send an SMS message to verify your phone number, click next if your number is correct.</div>
                                                <hr>
                                                
                                                <?php
                                                foreach($data as $row){
													$phone_number=$row->phone_number;
												}
                                                ?>

												<?php
												if($this->session->flashdata('verify')){
												?>
												<div class="alert alert-danger incomplete_reg_div alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="fa fa-warning pr-15 pull-left"></i><p class="pull-left"><?=$this->session->flashdata('verify');?></p>
                                                    <div class="clearfix"></div>
                                                </div>
												<?php } ?>
                                                
                                                <div class="form-group">
                                                    <label class="control-label mb-10">Phone Number</label>		
                                                    <input type="number" name="phone_number" value="<?=$phone_number;?>" placeholder="enter phone number" class="form-control verify_no" data-error="This field is required" required>		
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">next</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->