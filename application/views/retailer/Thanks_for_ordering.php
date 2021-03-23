<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">order sent</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li class="active"><span>order - sent</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default text-center">
                            <h4>Your desired products have successfully been ordered</h4>
                            <p style="margin: 10px 0;">  
                                Having trouble? <a href="" id="sa-basic">Contact us</a>
                            </p>
                            <div class="row" style="margin: 20px 0 5px 0;">
                                <div class="col-md-6">
                                    <a href="<?=base_url('shops');?>" class="btn btn-default btn-block">continue shopping</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?=base_url('r_order/invoice');?>/<?=$this->uri->segment(3);?>" class="btn btn-default btn-block">check my order</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
               
			</div>