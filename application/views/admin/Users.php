<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">All users</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>users</span></a></li>
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
                            <div class="row d-none d-md-block d-lg-block d-xl-block" style="margin: 20px 0;">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-block">
                                            <form action="" method="GET">
                                                <div class="row">
                                                    <div class="col-sm-2">
														<?php
														$sort='';
														$email='';
														$role='';
														if($_GET){
															$sort = $_GET['sort'];
															$email = $_GET['email'];
															$role = $_GET['role'];
														}
														?>
                                                    <select class="form-control" name="sort">
                                                        <option value="20" <?php if($sort==20){echo 'selected';}?>>20</option>
                                                        <option value="30" <?php if($sort==30){echo 'selected';}?>>30</option>
                                                        <option value="40" <?php if($sort==40){echo 'selected';}?>>40</option>
                                                        <option value="50" <?php if($sort==50){echo 'selected';}?>>50</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="email" class="form-control"
                                                            placeholder="search by email" value="<?=$email;?>">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="role">
															<option value="">all categories</option>
															<?php
															foreach($category as $row_group){
															?>
															<option value="<?=$row_group->id;?>" <?php if($role==$row_group->id){echo 'selected';}?>><?=$row_group->name;?></option>
															<?php } ?>
                                                        </select>

                                                    </div>

                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-success btn-outline">
                                                            <i class="icofont icofont-job-search m-r-5"></i> filter
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- filter ./end -->

							<?php
							if($users){
							?>
                            <div class="dataTables_info" id="datable_1_info" role="status" aria-live="polite" style="margin: 10px 0;">Showing 1 to 10 of 57 entries</div>

							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>First name</th>
														<th class="text-center">Last name</th>
														<th class="text-center">Email</th>
														<th class="text-center">Phone number</th>
														<th class="text-center">Reference number</th>
														<th class="text-center">Category</th>
														<th class="text-center">Date registered</th>
														<th class="text-center">Last login</th>
														<th class="text-center">Active</th>
														<th class="text-center">Verified</th>
														<th class="text-right">Action</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>First name</th>
														<th class="text-center">Last name</th>
														<th class="text-center">Email</th>
														<th class="text-center">Phone number</th>
														<th class="text-center">Reference number</th>
														<th class="text-center">Category</th>
														<th class="text-center">Date registered</th>
														<th class="text-center">Last login</th>
														<th class="text-center">Active</th>
														<th class="text-center">Verified</th>
														<th class="text-right">Action</th>
													</tr>
												</tfoot>
												<tbody>
													<?php
													foreach($users as $user_row){
													?>
													<tr>
														<td>
															<?php
															$fname = $user_row->first_name;
															if($fname){
																echo $fname;
															}else{
																echo '---';
															}
															?>
														</td>
														<td class="text-center">
															<?php
															$lname = $user_row->last_name;
															if($fname){
																echo $lname;
															}else{
																echo '---';
															}
															?>
														</td>
														<td class="text-center"><?=$user_row->email;?></td>
														<td class="text-center"><?=$user_row->phone_number;?></td>
														<td class="text-center">
															<?php
															$ref_no = $user_row->reference_number;
															if($ref_no){
																echo $ref_no;
															}else{
																echo '---';
															}
															?>
														</td>
														<td class="text-center">
															<?php
															$this->db->where('id', $user_row->group);
															$category = $this->db->get('group');
															foreach($category->result() as $group_row){
																$group = $group_row->name;
															}
															echo $group;
															?>
														</td>
														<td class="text-center">
															<?php
															echo $user_row->date_registered;
															?>
														</td>
														<td class="text-center">
															<?php
															$last_login = $user_row->last_login;
															if($last_login){
																echo $last_login;
															}else{
																echo '---';
															}
															?>
														</td>
														<td class="text-center"><?=$user_row->active;?></td>
														<td class="text-center"><?=$user_row->verified;?></td>
														<td class="text-right"></td>
													</tr>
													<?php
													}
													?>
													
												</tbody>
                                            </table>
                                            
										</div>
										
										<?=$links;?>                                       
									</div>
								</div>
							</div>

							<?php
							}
							?>
						</div>	
					</div>
				</div>
				<!-- /Row -->
				
				<?php
				if(!$users){
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