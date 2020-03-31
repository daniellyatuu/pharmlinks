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
											<form method="post" action="<?=base_url('verify/finalize');?>">
                                                
                                                <?php
                                                foreach($data as $row){
                                                    $phone_number=$row->phone_number;
                                                }
                                                ?>
                                                                        
                                                <h5 class="text-center">Verify <?=$phone_number;?></h5>
                                                <div class="text-center">Waiting to automatically detect an SMS sent to <?=$phone_number;?>. <span class="text-info">Wrong number? <a href="<?=base_url('verify');?>" class="text-info" style="text-decoration: underline;">edit number</a></span></div>
                                                <hr>
                                                
                                                <div class="form-group">		
                                                    <label class="control-label mb-10">Code</label>	
                                                    <input type="text" name="verify_code" value="<?=set_value('verify_code');?>" placeholder="__-__" data-mask="99-99"  class="form-control code_field" data-error="This field is required" required>		
                                                    <div class="help-block with-errors"></div>
                                                    <div class="text-danger"><?=$this->session->flashdata('error');?></div>
                                                </div>
                                                
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">finish</button>
												</div>
											</form>
										</div>
                                        <div class="text-center">Having trouble? Contact us via <span class="text-success" style="text-decoration: underline;">(+255) 753 841 279</span> <!--or <span class="text-success" style="text-decoration: underline;">info@pharmlinks.com</span>--></div>
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