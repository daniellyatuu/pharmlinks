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
                                
                                <form method="post" action="<?=base_url('Add_products/add_stock');?>" enctype="multipart/form-data" method="post" data-toggle="validator" accept-charset="utf-8" onsubmit="return checkCoords();">
                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>about product</h6>
                                    <hr class="light-grey-hr"/>
                                    
                                    <!--notification-->
                                    <div class="alert alert-success ntf_div01 alert-dismissable product_notify_div" style="display: none;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left">product saved successfully</p> 
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group suggestion_area">
                                                <label for="productname" class="control-label mb-10">Product name / Brand name <abbr style="color: red;" title="required">*</abbr> <i class="spinner"></i></label>
                                                <input type="text" class="form-control" id="productname" list="brand_name" placeholder="Enter product name" name="productName" data-error="Please fill out this field." required autocomplete="off">
                                                <input type="hidden" class="form-control productid" value="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <label for="genericname" class="control-label mb-10">Generic name <abbr style="color: red;" title="required">*</abbr><i class="loader text-success"></i></label>
                                                <input type="text" class="form-control" id="genericname" placeholder="Enter generic name" name="genericName" data-error="Please fill out this field." required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Category <abbr style="color: red;" title="required">*</abbr><i class="loader text-success"></i></label>
                                                <select class="form-control filter_img prd_category" data-placeholder="Choose a Category" name="product_categories" data-error="Please select category of your product."  tabindex="1" required>
                                                    <option value="" style="display: none;" selected>Choose..</option>
                                                    
                                                    <option value="<?//=$category_ids;?>"><?//=$category_names;?></option>
                                                    
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
                                                    <input type="text" class="form-control" data-error="Please fill out this field." name="product_original_price" id="price" required placeholder="eg. 1,000" autocomplete="off">
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
                                                    <input type="text" class="form-control" name="product_discount_price" id="price1" placeholder="eg. 1,000" autocomplete="off">
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
                                                    
                                                    <option value="<?//=$package_row->package_name;?>"><?//=$package_row->package_name;?></option>
                                                    
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
                                                <input type="text" id="country" name="mfg" class="form-control" required placeholder="enter country" data-error="Please fill out this field.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Manufacturing industry <i class="loader text-success"></i></label>
                                                <input type="text" id="industry" name="mfg_industry" class="form-control" placeholder="enter manufacturing company" data-error="Please fill out this field.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">expire date of the product</label>
                                                <input type='text' name="product_expire" class="form-control" id='datetimepicker4' data-error="Please fill out this field." />
                                                <div class="help-block with-errors"><span class="text-muted">dd-mm-yyyy</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->

                                    <!--row-->
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Product Quantity <!--<abbr style="color: red;" title="required">*</abbr>--></label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="">qty</i></div>
                                                    <input type="text" class="form-control" data-error="Please fill out this field." name="product_qty" value="10">
                                                </div>
                                                <div class="help-block with-errors"></div>
                                            </div>
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
                                                <textarea class="form-control product_details" name="product_details" rows="4" placeholder="some text to explain your product"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    
                                    <hr class="light-grey-hr"/>
                                    
                                    <label class="control-label mb-10">Product image <i class="loader text-success"></i></label>
                                    
                                    <input type="text" class="form-control image_check" name="img_status" value=""><!-- 1 = image available filled: 0 = image not filled, so you have to browse for it -->
                                    
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