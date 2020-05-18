<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h5 class="txt-dark">edit-product</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li><a href="<?=base_url('w_main');?>">Dashboard</a></li>
                <li class="active"><span>edit</span></li>
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
                                
                                <?php
                                foreach($product as $product_row){
                                    $product_id = $this->uri->segment(3);
                                    $brand_name = $product_row->brand_name;
                                    $generic_name = $product_row->generic_name;
                                    $categoryid = $product_row->category;
                                    $ogprice = $product_row->price;
                                    $ogdiscount = $product_row->discount;
                                    $sellingpackage = $product_row->selling_package;
                                    $mfcountry = $product_row->country;
                                    $mfindustry = $product_row->industry;
                                    $qty = $product_row->quantity;
                                    $details = $product_row->description;

                                    // get product image(s)
                                    $this->db->where('product', $product_id);
                                    $product_image = $this->db->get('product_image');

                                    $count_img = $product_image->num_rows();
                                }
                                if($ogdiscount == 0){
                                    $ogdiscount = '';
                                }
                                ?>

                                <form method="post" action="<?=base_url('w_product/update');?>" enctype="multipart/form-data" method="post" data-toggle="validator" accept-charset="utf-8" onsubmit="return checkCoords();">
                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>about product</h6>
                                    <hr class="light-grey-hr"/>
                                    <input type="hidden" class="form-control" name="productid" value="<?=$product_id;?>">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group suggestion_area">
                                                <label class="control-label mb-10">Product name / Brand name <abbr style="color: red;" title="required">*</abbr></label>
                                                <input type="text" class="form-control" placeholder="Enter product name" name="product_name" data-error="Please fill out this field." value="<?=$brand_name;?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <label for="genericname" class="control-label mb-10">Generic name <abbr style="color: red;" title="required">*</abbr></label>
                                                <input type="text" class="form-control" placeholder="Enter generic name" name="generic_name" data-error="Please fill out this field." value = "<?=$generic_name;?>" required>
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
                                                    <option value="<?=$category_row->id;?>" <?php if($categoryid == $category_row->id){echo 'selected';}?>><?=$category_row->name;?></option>
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
                                                    <input type="number" class="form-control" data-error="Please fill out this field." name="price" value = "<?=$ogprice;?>" required placeholder="Enter price" min='1'>
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
                                                    <input type="number" class="form-control" name="discount" placeholder="Enter discount" value = "<?=$ogdiscount;?>" min='0'>
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
                                                    <option value="<?=$package_row->id;?>" <?php if($sellingpackage == $package_row->id){echo 'selected';}?>><?=$package_row->name;?></option>
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
                                                <input type="text" id="country" name="country" class="form-control" value = "<?=$mfcountry;?>" required placeholder="enter country" data-error="Please fill out this field.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Manufacturing industry <i class="loader text-success"></i></label>
                                                <input type="text" id="industry" name="industry" class="form-control" value = "<?=$mfindustry;?>" placeholder="enter manufacturing company" data-error="Please fill out this field.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-10">Product Quantity <!--<abbr style="color: red;" title="required">*</abbr>--></label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="">qty</i></div>
                                                <input type="number" class="form-control" data-error="Please fill out this field." name="qty" value="<?=$qty;?>" min='0'>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                    </div>
                                    <!--/row-->
                                    
                                    <label class="control-label mb-10">Product Description <i class="loader text-success"></i></label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="description" rows="4" placeholder="Product description"><?=$details;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    
                                    <hr class="light-grey-hr"/>
                                    
                                    <label class="control-label mb-10">Product image <i class="loader text-success"></i></label>
                                    
                                    <div class="row">
                                        <div class="col-md-12 prod_img"></div>
                                        <div class="col-md-12 upload_div">
                                            <span>browse image</span>
                                            <input type="file" name="files[]" value="" accept="image/*" multiple>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if($count_img > 0){
                                    ?>
                                    <div class="row pl-img-container" style = "margin: 20px 0;">
                                        <?php
                                            foreach($product_image->result() as $image_row){        
                                        ?>
                                        <div class="col-md-3 text-center img<?=$image_row->id;?>">
                                            <img src="<?=base_url('assets/app');?>/img/900_1000_files/<?=$image_row->filename;?>" class="img-thumbnail" alt="">
                                            <a href="javascript:void(0);" class = "btn btn-warning btn-outline btn-xs remove_img_btn" image_id = "<?=$image_row->id;?>" file_name = "<?=$image_row->filename;?>">remove</a>
                                            <!-- <a href="" class = "btn btn-info btn-outline btn-xs">undo</a> -->
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
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

        <!--confirm modal .start-->
        <div class="modal fade hideModel delete_image">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h6 class="modal-title">Delete confirmation</h6>
                    </div>
                    <input type="hidden" class="form-control prd_id" value="" name="prd_id">
                    <div class="modal-body">
                    <img src="" class="img-thumbnail preview_image" alt="">
                    <input type="hidden" class="form-control img_id" value = "">
                        Are you sure you want to delete this image?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger btn-xs delete_img_btn" value="">
                    </div>
                </div>
            </div>
        </div>
        <!--confirm modal .end-->

    </div>