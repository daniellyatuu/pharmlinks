<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        
        <div class="row heading-bg">
            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
            <?php
            // seller information
            foreach($pharmacy_data as $pharmacy_row){
                $pharmacy_name = $pharmacy_row->name;
                $pharmacy_loc_id = $pharmacy_row->location;
            }

            // get pharmacy location
            $this->db->where('id', $pharmacy_loc_id);
            $location_data = $this->db->get('location');
            foreach($location_data->result() as $location_row){
                $location_name = $location_row->location_name;
            }
            
            ?>
            <h5 class="txt-dark"><span class="bg-dark" style="color: white; padding: 5px; text-transform: uppercase;"><?=$pharmacy_name;?></span><br/><small><?=$location_name;?></small></h5>
             
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-6 col-sm-7 col-md-7 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url('r_main');?>">Dashboard</a></li>
                    <li class="active"><span>all product</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        
        <!-- filter .start -->
        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <?php
                            $sort='';
                            $prd='';
                            $catgory='';
                            if($_GET){
                                $sort = $_GET['sort'];
                                $prd = $_GET['product'];
                                $catgory = $_GET['category'];
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-2" style="margin: 5px 0;">
                                    <select class="form-control" name="sort">
                                    <option value="20" <?php if($sort==20){echo 'selected';}?>>20</option>
                                    <option value="30" <?php if($sort==30){echo 'selected';}?>>30</option>
                                    <option value="40" <?php if($sort==40){echo 'selected';}?>>40</option>
                                    <option value="50" <?php if($sort==50){echo 'selected';}?>>50</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="margin: 5px 0;">
                                
                                <input type="text" name="product" class="form-control"
                                        placeholder="search..." value="<?=$prd;?>">
                                </div>
                                <div class="col-md-4" style="margin: 5px 0;">
                                    <select class="form-control" name="category">
                                    <option value="">all categories</option>
                                        <?php
                                        foreach($categories as $category){
                                        ?>
                                        <option value="<?=$category->id;?>" <?php if($catgory==$category->id){echo 'selected';}?>><?=$category->name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2" style="margin: 5px 0;">
                                    <button type="submit" class="btn btn-success btn-outline" style="float: right;">
                                        <i class="icofont icofont-job-search m-r-5"></i> filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="col-md-4">
                        <a href="<?=base_url('a_main/add_category');?>" class="btn btn-primary btn-outline" style="float:right;">
                            <i class="icofont icofont-job-search m-r-5"></i> Add Category
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- filter ./end -->
        <?php
        if($products){
        ?>
        <div style="margin-bottom:10px;"><?=$pagermessage;?></div>
        <div class="row display_available_prd">
            
            <!-- product .start -->
            <?php
            foreach($products as $product){

                $seller_id = $product->user;
                $eachProductId = $product->id;
                $qty = $product->quantity;

                // check product image
                $this->db->where('product', $product->id);
                $this->db->limit(1); // display only one product image
                $image = $this->db->get('product_image');
                // count product image
                $count_img = $image->num_rows();
                foreach($image->result() as $img_row){
                    $prd_image = $img_row->filename;
                }
            ?>
            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <article class="col-item">
                                <div class="photo">

                                    <!--product image .start-->
                                    <?php
                                    if($count_img == 0){
                                    ?>
                                    <a href="javascript:void(0);" style="cursor:default;"> <img src="<?=base_url('assets/app');?>/img/original_files/sample.jpg" class="img-responsive" alt="<?$product->brand_name;?>" /> </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="javascript:void(0);" style="cursor:default;"> <img src="<?=base_url('assets/app');?>/img/285_files/<?=$prd_image;?>" class="img-responsive" alt="Product Image" /> </a>
                                    <?php
                                    }
                                    ?>
                                    <!--product image .end-->

                                </div>
                                
                                <div class="info">
                                    <h6><a href=""><?=$product->brand_name;?><br><small><?=$product->generic_name;?></small></a></h6>
                                    
                                    <div class="row">
                                        <div class="col-md-12 long_text">
                                            <?php
                                            $og_price=$product->price;
                                            $discount_price=$product->discount;
                                            
                                            if($discount_price>0){
                                            ?>
                                            <span style="color: black;"><?='Tsh '.number_format($discount_price);?></span>
                                            <span style="margin-left: 5px;"><strike><?='Tsh '.number_format($og_price);?></strike></span>
                                            <?php
                                            }else{
                                            ?>
                                            <span style="color: black;"><?='Tsh '.number_format($og_price);?></span>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    
                                    <?php
                                    $manufacturingIndustry=$product->industry;
                                    $manufacturingCountry=$product->country;
                                    
                                    if(!empty($manufacturingIndustry) && !empty($manufacturingCountry)){
                                    ?>
                                    
                                    <span class="head-font block text-default long_text" style="font-size: 12px;"><?=$manufacturingIndustry;?>, <?=$manufacturingCountry;?></span>
                                    
                                    <?php
                                    }else{
                                    ?>
                                    
                                    <span class="head-font block text-default long_text" style="font-size: 12px;"><?=$manufacturingCountry;?></span>
                                    
                                    <?php } ?>
                                    
                                    <span class="head-font block text-default long_text" style="font-size: 12px;">In-stock: <?=$qty;?></span>
                                    <hr style="padding: 0; margin: 0; width: 94%;" />
                                    
                                    <div style="padding: 0; margin: 5px 0 0 0;" class="cart_area<?=$eachProductId;?>">
                                        
                                        <?php
                                        //check if product already exist in the cart
                                        $cart_contents=$this->cart->contents();
                                        
                                        $product_existance=0; //by default product not exist
                                        foreach($cart_contents as $cart_item){
                                            $each_prd_id=$cart_item['id'];
                                            //echo $each_prd_id.', ';
                                            if($each_prd_id==$eachProductId){
                                                $product_existance=1; //product exist in the cart
                                            }
                                        }
                                        
                                        if($product_existance==0){
                                        ?>
                                        <!-- cart button .start -->
                                        <button class="btn <?php if($qty == 0){echo 'btn-default';}else{echo 'btn-info';}?> btn-outline btn-xs add_to_cart" each_productid="<?=$eachProductId;?>" each_wholesalerid="<?=$seller_id;?>" each_prd_price="<?php if($discount_price>0){echo $discount_price; }else{echo $og_price;}?>" each_prd_img="<?php if($count_img == 0){ echo 'sample.jpg';}else{ echo $prd_image; } ?>" data-toggle="tooltip" data-placement="top" title="add product to cart" <?php if($qty == 0){echo 'disabled';}?>><i class="fa fa-shopping-cart"></i></button>
                                        <!-- cart button .end-->
                                        <?php
                                            }else{
                                        ?>
                                        <a href="<?=base_url('Cart/index');?>" class="btn btn-success btn-outline btn-xs" data-toggle="tooltip" data-placement="top" title="click to view cart"><i class="fa fa-check"></i> added</a>
                                        <?php
                                            }
                                        ?>
                                        
                                    </div>
                                    
                                </div>
                            </article>
                        </div>
                        
                    </div>	
                </div>	
            </div>
            <?php }?>
            <!-- product ./end -->

        </div>
        <?//=$links;?>
        
        <!--confirm modal .start-->
        <form method="post" action="<?=base_url('w_main/delete_product');?>">
            <div class="modal fade hideModel delete_model">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h6 class="modal-title">Delete confirmation</h6>
                        </div>
                        <input type="hidden" class="form-control prd_id" value="" name="prd_id">
                        <div class="modal-body">
                            Are you sure you want to delete <strong class="brand_name"></strong>?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger btn-xs move_to_trash_btn" value="Confirm">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--confirm modal .end-->
        <?php
        }else{
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel text-center no_more_prd hide_on_print" style="padding: 30px 10px;">
                    <h6 style="font-weight: bold;">No results found</h6>
                    <!-- <p class="text-muted">Try different keywords</p> -->
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        
    </div>