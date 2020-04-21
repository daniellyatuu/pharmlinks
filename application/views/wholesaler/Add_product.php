<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h5 class="txt-dark">add-products</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li><a href="<?=base_url('main/index');?>">Dashboard</a></li>
                <li class="active"><span>add-products</span></li>
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
                                
                                <form method="post" action="<?=base_url('w_main/save_product');?>" enctype="multipart/form-data" method="post" data-toggle="validator" accept-charset="utf-8" onsubmit="return checkCoords();">
                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>about product</h6>
                                    <hr class="light-grey-hr"/>
                                    
                                    <?php
                                    if($this->session->flashdata()){

                                        $savedimg = 0;
                                        if(isset($_REQUEST['img'])){
                                            $savedimg = $_REQUEST['img'];
                                        }
                                        
                                        $all_img="";
                                        if(isset($_REQUEST['all'])){
                                            $all_img=$_REQUEST['all'];
                                        }
                                        
                                        $pass_img="";
                                        if(isset($_REQUEST['pass'])){
                                            $pass_img=$_REQUEST['pass'];
                                        }
                                        
                                        $ext_error_img="";
                                        if(isset($_REQUEST['ext_error'])){
                                            $ext_error_img=$_REQUEST['ext_error'];
                                        }
                                        
                                        $size_error_img="";
                                        if(isset($_REQUEST['size_error'])){
                                            $size_error_img=$_REQUEST['size_error'];
                                        }
                                    ?>
                                    <div class="alert alert-dismissable" style="border: 1px solid white;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: black;">&times;</button>
                                        <dl>
                                            <dt class="text-success"><span style="font-weight: bold;">&#8811;</span> <?=$this->session->userdata('feedback');?> with <?=$pass_img;?> image<?php if($pass_img>1){echo 's';}?> out of <?=$all_img;?></dt>
                                            <?php
                                            if($ext_error_img!=0){
                                            ?>
                                            <hr class="light-grey-hr ma-0"/>
                                            <dd class="text-danger" style="margin-left: 35px;"><?=$ext_error_img;?> image<?php if($ext_error_img>1){echo "s";}?> fail because file extension is not allowed. Allowed ext(jpeg, jpg and png)</dd>
                                            <?php
                                            }
                                            if($size_error_img!=0){
                                            ?>
                                            <dd class="text-danger" style="margin-left: 35px;"><?=$size_error_img;?> image<?php if($size_error_img>1){echo "s";}?> fail because file size is greater than 5MB.</dd>
                                            <?php } ?>
                                        </dl>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php } ?>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group suggestion_area">
                                                <label class="control-label mb-10">Product name / Brand name <abbr style="color: red;" title="required">*</abbr></label>
                                                <input type="text" class="form-control" placeholder="Enter product name" name="product_name" data-error="Please fill out this field." required>
                                                <input type="hidden" class="form-control productid" value="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <label for="genericname" class="control-label mb-10">Generic name <abbr style="color: red;" title="required">*</abbr></label>
                                                <input type="text" class="form-control" placeholder="Enter generic name" name="generic_name" data-error="Please fill out this field." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Category <abbr style="color: red;" title="required">*</abbr></label>
                                                <select class="form-control" data-placeholder="Choose a Category" name="category" data-error="Please select category of your product."  tabindex="1" required>
                                                    <option value="" style="display: none;" selected>Choose..</option>
                                                    <?php
                                                    foreach($category as $category_row){
                                                    ?>
                                                    <option value="<?=$category_row->id;?>"><?=$category_row->name;?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Price <abbr style="color: red;" title="required">*</abbr></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="">Tsh</i></div>
                                                    <input type="number" class="form-control" data-error="Please fill out this field." name="price" required placeholder="Enter price" min='1'>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Discount Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="">Discount</i></div>
                                                    <input type="number" class="form-control" name="discount" placeholder="Enter discount" min='0'>
                                                </div>
                                                <span id="display_percentage" class="text-success"></span>
                                                <div></div>
                                            </div>
                                            
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Selling package <abbr style="color: red;" title="required">*</abbr></label>
                                                <select class="form-control" name="selling_package" data-error="Please select a selling package of your product."  tabindex="1" required>
                                                    <option value="" style="display: none;" selected>Choose..</option>
                                                    <?php
                                                    foreach($selling_package as $package_row){
                                                    ?>
                                                    <option value="<?=$package_row->id;?>"><?=$package_row->name;?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group autocomplete">
                                                <label class="control-label mb-10">country manufactured <abbr style="color: red;" title="required">*</abbr><i class="loader text-success"></i></label>
                                                <input type="text" id="country" name="country" class="form-control" required placeholder="enter country" data-error="Please fill out this field.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Manufacturing industry <i class="loader text-success"></i></label>
                                                <input type="text" id="industry" name="industry" class="form-control" placeholder="enter manufacturing company" data-error="Please fill out this field.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-10">Product Quantity <!--<abbr style="color: red;" title="required">*</abbr>--></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="">qty</i></div>
                                                <input type="number" class="form-control" data-error="Please fill out this field." name="qty" value="10" min='0'>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                    </div>
                                    <!--/row-->
                                    
                                    <?php /*{ ?>
                                    <div class="seprator-block"></div>
                                    <?php }*/ ?>
                                    
                                    <label class="control-label mb-10">Product Description <i class="loader text-success"></i></label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="description" rows="4" placeholder="Product description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    
                                    <hr class="light-grey-hr"/>
                                    
                                    <label class="control-label mb-10">Product image <i class="loader text-success"></i></label>
                                    
                                    <!-- <input type="text" class="form-control image_check" name="img_status" value=""> -->
                                    <!-- 1 = image available filled: 0 = image not filled, so you have to browse for it -->
                                    
                                    <div class="row">
                                        <div class="col-md-12 prod_img"></div>
                                        <div class="col-md-12 upload_div">
                                            <span>browse image</span>
                                            <input type="file" name="files[]" value="" accept="image/*" multiple>
                                        </div>
                                    </div>
                                    
                                    <div class="row pl-img-container show_filted_img" style="display: none;">
                                        
                                        <!--load medicine image from database-->
                                        
                                    </div>
                                    <div class="seprator-block"></div>
                                    <hr class="light-grey-hr"/>
                                    
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