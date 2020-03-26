<!--Preloader-->
<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="<?=base_url('main/index');?>">
						<!-- <img class="brand-img mr-10" src="<?=base_url('assets');?>/dist/img/pl_logo1.png" alt="pharmlinks logo"/> -->
						<span class="brand-text">PharmLinks</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Already have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="<?=base_url('user');?>">Sign In</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
                                
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign up to PharmLinks</h3>
											<!-- <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6> -->
										</div>
                                        
                                        <!--notification-->
                                        <div class="alert alert-danger user_name_repeat_div alert-dismissable" style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-warning pr-15 pull-left"></i><p class="pull-left">username already exist! Change username.</p>
                                            <div class="clearfix"></div>
                                        </div>
                                        
										<div class="form-wrap">
											<form data-toggle="validator" method="post" action="<?=base_url('user/save');?>">
                                                
                                                <div class="mb-30" style="border-bottom: 1px solid gray;">
                                                <h5 class="text-left txt-dark mb-10">Personal details</h5>
                                                </div>
                                                
                                                <div class="form-group">		
                                                    <label for="inputEmail" class="control-label mb-10">Email</label>		
                                                    <input type="email" name="usermail" value="<?=set_value('usermail');?>" class="form-control" placeholder="Email" data-error="That email address is invalid" required>		
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                
                                                <div class="form-group">		
                                                    <label class="control-label mb-10">Phone Number</label>		
                                                    <input type="text" name="user_phone" value="<?=set_value('user_phone');?>" placeholder="(+255)999 999-999" data-mask="(+255) 999 999-999" class="form-control" data-error="This field is required" required>		
                                                    <div class="help-block with-errors"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="inputPassword">Password</label>
                                                            <input type="password" name="user_pass" value="<?=set_value('user_pass');?>" data-minlength="6" class="form-control" id="inputPassword" placeholder="enter password" required>		
                                                            <div class="help-block">Minimum of 6 characters</div>		
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10" for="inputPasswordConfirm">Confirm password</label>
                                                            <input type="password" name="confirm_pass" value="<?=set_value('confirm_pass');?>" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="password don't match" placeholder="Confirm password" required>
                                                            <div class="help-block with-errors"></div>		
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-30" style="border-bottom: 1px solid gray;">
                                                    <h5 class="text-left txt-dark mb-10">Bussiness details</h5>
                                                </div>

                                                <div class="form-group">
													<label class="control-label mb-10" for="firstname_1">Pharmacy name</label>
													<input type="text" name="firstname" value="<?=set_value('firstname');?>" class="form-control" id="firstname_1" placeholder="Enter firstname" data-error="This field is required" required>
                                                    <div class="help-block with-errors"></div>
												</div>

                                                <div class="form-group">
													<label class="control-label mb-10" for="firstname_1">FIN number</label>
													<input type="text" name="firstname" value="<?=set_value('firstname');?>" class="form-control" id="firstname_1" placeholder="Enter firstname" data-error="This field is required" required>
                                                    <div class="help-block with-errors"></div>
												</div>

                                                <div class="form-group">
													<label class="control-label mb-10" for="country">Country</label>
													<input type="text" name="country" value="Tanzania" class="form-control" id="country" style="pointer-events: none;">
												</div>

                                                <!-- map .start -->
                                                            
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Pharmacy Location</label>
                                                            <input type="text" id="pac-input" name="bussiness_loc" class="form-control searchBussinessLocation" placeholder="search your bussiness location here" data-error="Please fill out this field" required>
                                                            <div class="help-block with-errors error_div"></div> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div id="map" style="height: 350px;"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p class="coupon-input form-row-last">
                                                            <input type="text" placeholder="location name" name="location_name" class="location_name" value="">
                                                            <input type="text" placeholder="location name" class="dir" value="">
                                                            <input type="text" placeholder="latitude" name="lati" class="lati" value="">
                                                            <input type="text" placeholder="longitude" name="longi" class="longi" value="">
                                                        </p>
                                                        
                                                        <div class="row locationInfoShow">
                                                            <div class="col-md-12 locationName"></div>
                                                            <div class="col-md-12 lattitude_no"></div>
                                                            <div class="col-md-12 longitude_no"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- map .end -->
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        foreach($group as $group_row){
                                                        ?>
                                                        <div class="radio radio-info">
                                                            <input type="radio" name="user_position" id="retailer" value="retailer" checked />
                                                            <label for="retailer"> Retailer </label>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">sign Up</button>
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