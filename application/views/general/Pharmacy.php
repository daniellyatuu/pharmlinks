<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Pharmacy</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="#">Dashboard</a></li>
								<li class="active"><span>Pharmacy</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->	

                    <div class="alert alert-success edit_div alert-dismissable" style="display: none;">					
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>					
                        <i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left">Pharmacy details updated successfully.</p>			
                        <div class="clearfix"></div>					
                    </div>
                    
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
                                
                            <?php
                            foreach($pharmacy as $row_data){
                                $name = $row_data->name;
                                $FIN = $row_data->FIN;
                                $location_id = $row_data->location;
                            }
                            ?>

								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form class="form-horizontal" role="form">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="ti-home mr-10"></i>Pharmacy Details</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Pharmacy Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?=$name;?></p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">FIN Number:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?=$FIN;?></p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Category:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?=$this->session->userdata('group');?></p>
																		</div>
																	</div>
																</div>
																
															</div>
															
															<div class="seprator-block"></div>
                                                            
                                                            <?php
                                                            $this->db->where('id', $location_id);
                                                            $location = $this->db->get('location');
                                                            foreach($location->result() as $loc_data){
                                                                $country = $loc_data->country;
                                                                $location_name = $loc_data->location_name;
                                                            }
                                                            ?>
															<h6 class="txt-dark capitalize-font"><i class="ti-location-pin mr-10"></i>Pharmacy Location</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Country:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?=$country;?></p>
																		</div>
																	</div>
                                                                </div>
                                                                <div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location Address:</label>
																		<div class="col-md-9">
																			<p class="form-control-static"><?=$location_name;?></p>
																		</div>
																	</div>
																</div>
                                                                
															</div>
															
															<!-- /Row -->
														</div>
                                                        
														<div class="form-actions mt-10">
															<div class="row">
																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-offset-3 col-md-9">
                                                                            <a href="<?=base_url("Main/edit_phamacy_details");?>" class="btn btn-info btn-icon left-icon  mr-10"><i class="zmdi zmdi-edit"></i> <span>Edit</span></a>
																		</div>
																	</div>
																</div>
																<div class="col-md-6"> </div>
															</div>
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
					<!-- /Row -->
                    
                    <!--your pharmacy details-->
                    				
				</div>
				
				<!-- Footer -->
				<footer class="footer container-fluid pl-30 pr-30">
					<div class="row">
						<div class="col-sm-12">
							<p class="text-center"><?=date('Y');?> &copy; PharmLinks.</p>
						</div>
					</div>
				</footer>
				<!-- /Footer -->
			
			</div>
			<!-- /Main Content -->