<!-- Main Content -->
<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Selling-package</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>selling-package</span></a></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
                            
                            <!-- filter .start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <form action="" method="GET">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <select class="form-control" name="sort">
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                            <option value="40">40</option>
                                                            <option value="50">50</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" name="category" class="form-control"
                                                            placeholder="search..." value="">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-success btn-outline">
                                                            <i class="icofont icofont-job-search m-r-5"></i> filter
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="<?=base_url('a_main/add_package');?>" class="btn btn-primary btn-outline" style="float:right;">
                                                <i class="icofont icofont-job-search m-r-5"></i> Add Package
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- filter ./end -->
                            <!-- <div class="dataTables_info" id="datable_1_info" role="status" aria-live="polite" style="margin: 10px 0;">Showing 1 to 10 of 57 entries</div> -->

							
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									
                                    <?php
                                    if($package_data){
                                    ?>
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>Category</th>
														<th class="text-center">Added by</th>
														<th class="text-center">Added at</th>
														<th class="text-right">Action</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
                                                        <th>Category</th>
                                                        <th class="text-center">Added by</th>
                                                        <th class="text-center">Added at</th>
                                                        <th class="text-right">Action</th>
													</tr>
												</tfoot>
												<tbody>
													
                                                    <?php
                                                    foreach($package_data as $package_row){
                                                    ?>
													<tr>
														<td><?=$package_row->name;?></td>
														<td class="text-center">
                                                            <?php
                                                            $this->db->where('id', $package_row->added_by);
                                                            $user_data = $this->db->get('user');
                                                            foreach($user_data->result() as $user_row){
                                                                $user = $user_row->username;
                                                            }
                                                            echo $user;
                                                            ?>
														</td>
														<td class="text-center">
														<?=$package_row->date_added?>
														</td>
														<td class="text-right"></td>
													</tr>
                                                    <?php } ?>
													
												</tbody>
                                            </table>
                                            
										</div>
										                                      
									</div>
                                    <?php } ?>
								</div>
							</div>
							
						</div>	
					</div>
				</div>
				<!-- /Row -->
				
				<?php
				if(!$package_data){
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel text-center no_more_prd hide_on_print" style="padding: 30px 10px;">
							<h6 style="font-weight: bold;">No results found</h6>
							<!-- <p class="text-muted">Try different keywords</p> -->
						</div>
					</div>
				</div>
                <?php } ?>
				
			</div>
			
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p>2017 &copy; Doodle. Pampered by Hencework</p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
		</div>
		<!-- /Main Content -->