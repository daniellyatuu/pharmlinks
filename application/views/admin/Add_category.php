<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h5 class="txt-dark">add-category</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li><a href="<?=base_url('main/index');?>">Dashboard</a></li>
                <li class="active"><span>add</span></li>
              </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-wrap">
                                
                                <form method="post" action="<?=base_url('a_main/save_category');?>" enctype="multipart/form-data" method="post" data-toggle="validator" accept-charset="utf-8" onsubmit="return checkCoords();">
                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>about category</h6>
                                    <hr class="light-grey-hr"/>
                                    
                                    <!--notification-->
                                    <?php
                                    if($this->session->flashdata()){
                                    ?>
                                    <div class="alert <?php if($this->session->userdata('feedback')=='exists'){echo 'alert-danger';}else if($this->session->userdata('feedback')=='saved'){echo 'alert-success';}?> alert-dismissable product_notify_div">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="zmdi zmdi-check pr-15 pull-left"></i>
                                        <p class="pull-left">
                                            <?php
                                            if($this->session->userdata('feedback') == 'exists'){
                                                echo 'this category already exists.';
                                            }else if($this->session->userdata('feedback') == 'saved'){
                                                echo 'category was saved successfully';
                                            }
                                            ?>
                                        </p> 
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group suggestion_area">
                                                <label for="productname" class="control-label mb-10">Category name <abbr style="color: red;" title="required">*</abbr></label>
                                                <input type="text" class="form-control" placeholder="Enter category name" name="category" data-error="Please fill out this field." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-actions">
                                        <button type="reset" class="btn btn-warning left-icon mr-10 pull-left cancel_btn">Cancel</button>
                                        <button type="submit" class="btn btn-success pull-left">save</button>
                                        <div class="clearfix"></div>
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

    <!-- Footer -->
    <footer class="footer container-fluid pl-30 pr-30">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center"><?=date('Y');?> &copy; PharmLink.</p>
            </div>
        </div>
    </footer>
    <!-- /Footer -->

</div>
<!-- /Main Content -->