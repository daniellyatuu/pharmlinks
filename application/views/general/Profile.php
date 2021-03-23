<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
                
                <?php
                $this->db->where('id', $this->session->userdata('id'));
                $user_info=$this->db->get('user');
                
                foreach($user_info->result() as $user_profile){
                    // $user_pass=$user_profile->viewedPassword;
                    $user_fname=$user_profile->first_name;
                    $user_lname=$user_profile->last_name;
					$user_mname = $user_profile -> username;
                    $user_mail=$user_profile->email;
                    $user_phone_number=$user_profile->phone_number;
                    $user_gender=$user_profile->gender;
                    
                    $this->db->where('user', $this->session->userdata('id'));
                    $pharmacy_info=$this->db->get('pharmacy');
                    
                    $count_pharm=$pharmacy_info->num_rows();
                    foreach($pharmacy_info->result() as $pharmacy_row){
                        $pharmacy_name=$pharmacy_row->name;
                    }
                }
                ?>
				<!-- Row -->   
				<div class="row">  
					<div class="col-lg-3 col-xs-12">
						<div class="panel panel-default card-view  pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body  pa-0">
									<div class="profile-box">
										
										    
										<div class="social-info">
											
										    <?php
                                             if($count_pharm!=0){
                                            ?>
											<h6 class="block capitalize-font text-center"><?=$pharmacy_name;?></h6>
                                            <?php } ?>
											<button class="btn btn-default btn-block btn-outline btn-anim mt-30" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i><span class="btn-text">Change password</span></button>
											<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												

											<div class="modal-dialog">
                                                    <form action="<?=base_url('Main/change_password');?>" method="post" data-toggle="validator">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h5 class="modal-title" id="myModalLabel">Change password</h5>
														</div>
														<div class="modal-body">
															<!-- Row -->
															<div class="row">
																<div class="col-lg-12">
																	<div class="">
																		<div class="panel-wrapper collapse in">
																			<div class="panel-body pa-0">
																				<div class="col-sm-12 col-xs-12">
																					<div class="form-wrap">
																						
																							<div class="form-body overflow-hide">
																								
																								<div class="form-group">
																									<label class="control-label mb-10" for="user_password">New password</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-lock"></i></div>
																										<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter pwd" value="" data-minlength="6" required>
																									</div>
                                                                                                    <div class="help-block">Minimum of 6 characters</div>
																								</div>
                                                                                                
                                                                                                <div class="form-group">
																									<label class="control-label mb-10" for="exampleInputpwd_1">Confirm password</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-lock"></i></div>
																										<input type="password" class="form-control" id="exampleInputpwd_1" placeholder="Enter pwd" value="" data-match="#user_password" data-match-error="password don't match" required>
																									</div>
                                                                                                    <div class="help-block with-errors"></div>
																								</div>
																							</div>
																										
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success waves-effect btn-xs">Save</button>
															<button type="button" class="btn btn-default waves-effect btn-xs" data-dismiss="modal">Cancel</button>
														</div>
													</div>
													<!-- /.modal-content -->
                                                        </form>
												</div>
												<!-- /.modal-dialog -->

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											
											<li role="presentation" class="active"><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>settings</span></a></li>
										</ul>
										<div class="tab-content" id="myTabContent_8">
                                            
                                            <div  id="settings_8" class="tab-pane fade active in" role="tabpanel">
												<!-- Row -->
												<div class="row">
													<div class="col-lg-12">
														<div class="">
															<div class="panel-wrapper collapse in">
																<div class="panel-body pa-0">
																	<div class="col-sm-12 col-xs-12">
																		<div class="form-wrap">
																			<form action="<?=base_url('Main/edit_profile');?>" method="post" data-toggle="validator">
																				<div class="form-body overflow-hide">
																					<div class="form-group">
																						<label class="control-label mb-10" for="fname">First name</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" id="fname" name="edit_fname" placeholder="enter firstname" required value="<?=$user_fname;?>">
																						</div>
																					</div>
                                                                                    
                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="middlename">Middle name</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" id="middlename" name="edit_mname" placeholder="Enter middlename" value="<?=$user_mname;?>">
																						</div>
																					</div>
                                                                                    
                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="lastname">Last name</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" id="lastname" name="edit_lname" placeholder="Enter lastname" required value="<?=$user_lname;?>">
																						</div>
																					</div>
                                                                                    
																					<div class="form-group">
																						<label class="control-label mb-10" for="mail">Email address</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																							<input type="email" class="form-control" id="mail" name="edit_mail" placeholder="enter your email" required value="<?=$user_mail;?>">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-phone"></i></div>
																							<input type="text" class="form-control" id="exampleInputContact_01" placeholder="(+255) XXX XXX-XXX" data-mask="(+255) 999 999-999" name="edit_contact" value="<?=$user_phone_number;?>" required>
																						</div>
																					</div>
																					
																					<div class="form-group">
																						<label class="control-label mb-10">Gender</label>
																						<div>
																							<div class="radio">
																								<input type="radio" name="sex" id="radio_01" value="Male" <?php if($user_gender=='Male'){echo 'checked';}?> required>
																								<label for="radio_01">
																								Male
																								</label>
																							</div>
																							<div class="radio">
																								<input type="radio" name="sex" id="radio_02" value="Female" <?php if($user_gender=='Female'){echo 'checked';}?> required>
																								<label for="radio_02">
																								Female
																								</label>
																							</div>
																						</div>
																					</div>
																					
																				</div>
																				<div class="form-actions mt-10">			
																					<button type="submit" class="btn btn-success btn-xs mr-10 mb-30">Update profile</button>
																				</div>				
																			</form>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
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
				
			</div>
