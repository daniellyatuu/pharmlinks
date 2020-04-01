<!--Preloader-->
<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
                
                <div class="sp-logo-wrap pull-left">
					<a href="javascript:void(0);">
						<!--<img class="brand-img mr-10" src="<?//=base_url('assets');?>/dist/img/pl_logo1.png" alt="brand"/>-->
						<span class="brand-text">Pharmlinks</span>
					</a>
				</div>
                
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Don't have an account?</span>
					<a class="inline-block btn btn-info btn-rounded btn-outline" href="<?=base_url('user/register');?>">Sign Up</a>
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
											<h3 class="text-center txt-dark mb-10">Sign in to Pharmlinks</h3>
										</div>
                                        
                                        <div class="alert alert-success logout_div alert-dismissable" style="display: none;">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left">successfully logout.</p> 
											<div class="clearfix"></div>
										</div>
                                        
										<?php
										if($this->session->flashdata()){
										?>
                                        <div class="alert <?php if($this->session->flashdata('wrong_account')){ ?>alert-danger<?php }else if($this->session->flashdata('logout')){ ?>alert-success<?php } ?> show_div3 alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="fa fa-warning pr-15 pull-left"></i><p class="pull-left"><?php if($this->session->flashdata('wrong_account')){echo $this->session->flashdata('wrong_account'); }else if($this->session->flashdata('logout')){echo $this->session->flashdata('logout');}?></p> 
											<div class="clearfix"></div>
										</div>
										<?php } ?>
                                        
										<div class="form-wrap">
											<form method="post" action="<?=base_url('user/login');?>" data-toggle="validator">
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">Username</label>
													<input type="text" name="usermail" value="<?=set_value('usermail');?>" class="form-control" id="exampleInputEmail_2" placeholder="Enter username" required>
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
													<a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="<?=base_url('Registration/forgot_password');?>">forgot password ?</a>
													<div class="clearfix"></div>
													<input type="password" name="user_pass" value="<?=set_value('user_pass');?>" class="form-control" required="" id="exampleInputpwd_2" placeholder="Enter password">
												</div>
												
												<div class="form-group">
													<!-- <div class="checkbox checkbox-primary pr-10 pull-left">
														<input id="checkbox_2" type="checkbox" name="remember_me" checked>
														<label for="checkbox_2"> Keep me logged in</label>
													</div> -->
													<div class="clearfix"></div>
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded">sign in</button>
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