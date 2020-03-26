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
											<form method="post" action="<?=base_url('Registration/finish_registration');?>">
                                                
                                                <?php
                                                // $this->db->where('user_ID', $this->session->userdata('unique_user_id'));
                                                // $get_user_info=$this->db->get('user_details');
                                                // foreach($get_user_info->result() as $user_info_row){
                                                //     $login_username=$user_info_row->username;
                                                //     $login_pass=$user_info_row->viewedPassword;
                                                //     $phone_number=$user_info_row->phone_no;
                                                // }
                                                ?>
                                                                        
                                                <h5 class="text-center">Verify <?//=$phone_number;?></h5>
                                                <div class="text-center">Waiting to automatically detect an SMS sent to <?//=$phone_number;?>. <span class="text-info">Wrong number? <a href="<?=base_url('Registration/verify_number');?>" class="text-info" style="text-decoration: underline;">edit number</a></span></div>
                                                <hr>
                                                
                                                <!-- notification -->
                                                <div class="alert alert-danger code_error_div alert-dismissable" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="fa fa-warning pr-15 pull-left"></i><p class="pull-left">Wrong verification code</p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="user_name" value="<?//=$login_username;?>" class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="user_pass" value="<?//=$login_pass;?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">		
                                                    <!--<label class="control-label mb-10">Phone Number</label>-->	
                                                    <input type="text" name="verify_code" value="<?//=set_value('verify_code');?>" placeholder="__-__" data-mask="99-99"  class="form-control code_field" data-error="This field is required" required>		
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">finish</button>
												</div>
											</form>
										</div>
                                        <div class="text-center">Having trouble? Contact us via <span class="text-success" style="text-decoration: underline;">(+255) 753 841 279</span> or <span class="text-success" style="text-decoration: underline;">info@pharmlinks.com</span></div>
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