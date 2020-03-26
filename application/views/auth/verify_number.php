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
											<form data-toggle="validator" method="post" action="<?=base_url('Registration/update_phone_number');?>">
                                                
                                                <h5 class="text-center">Verify your phone number</h5>
                                                <div class="text-center">Pharmlinks will send an SMS message to verify your phone number, click next if your number is correct.</div>
                                                <hr>
                                                
                                                <?php
                                                /*
                                                $this->db->where('user_ID', $this->session->userdata('unique_user_id'));
                                                $get_user_info=$this->db->get('user_details');
                                                foreach($get_user_info->result() as $user_info_row){
                                                    $phone_number=$user_info_row->phone_no;
                                                }
                                                */
                                                ?>
                                                <!-- notification -->
                                                <div class="alert alert-danger incomplete_reg_div alert-dismissable" style="display: none;">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="fa fa-warning pr-15 pull-left"></i><p class="pull-left">Please complete your registration.</p>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label mb-10">Phone Number</label>		
                                                    <input type="text" name="updateUserPhone" value="<?//=$phone_number;?>" placeholder="(+255)999 999-999" data-mask="(+255) 999 999-999" class="form-control verify_no" data-error="This field is required" required>		
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