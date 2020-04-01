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
							<div class="ml-auto mr-auto no-float"> <!-- auth-form -->
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="form-wrap">
											<form data-toggle="validator" method="post" action="<?=base_url('Registration/update_phone_number');?>">
                                                
                                                <h5 class="text-center">Thank you for Registering with PharmLinks!</h5>
                                                <div class="text-center"><strong>Please check your email <a href="https://accounts.google.com/signin/v2/identifier?hl=en-GB&continue=https%3A%2F%2Fmail.google.com%2Fmail&service=mail&flowName=GlifWebSignIn&flowEntry=AddSession" target="_blank"><?=$this->session->userdata('email');?></a></strong> to view your login crecidentials.</div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="form-group">
                                                            <?php
                                                            if($this->session->userdata('group')=='wholesaler'){
                                                            ?>
                                                            
                                                            <a href="<?=base_url('w_main');?>" class="btn btn-default btn-xs">Continue to homepage</a>
                                                            
                                                            <?php
                                                            }else if($this->session->userdata('group')=='retailer' or $this->session->userdata('group')=='ADDO'){
                                                            ?>
                                                            
                                                            <a href="<?=base_url('r_main');?>" class="btn btn-default btn-xs">Continue to homepage</a>
                                                            
                                                            <?php
                                                            }
                                                            ;?>
                                                            
                                                        </div>
                                                    </div>
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