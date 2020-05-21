<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            
            <h5 class="txt-dark"><a href="<?=base_url('w_main/add');?>" class="btn btn-default"><i class="fa fa-plus-square"></i> Add product</a></h5>
            
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                <li><a href="<?=base_url('w_main');?>">Dashboard</a></li>
                <li class="active"><span>products</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <!--notification .start--> 
        <?php
        if($this->session->flashdata()){
        ?>       
        <div class="alert alert-success alert-dismissable">                                
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="zmdi zmdi-check pr-15 pull-left hidden-xs"></i><p class="pull-left"><?=$this->session->flashdata('feedback');?></p>
            <div class="clearfix"></div>                                
        </div>
        <?php } ?>
        
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
                                    <option value="30" <?php if($sort==30){echo 'selected';}?>>30</option>
                                    <option value="42" <?php if($sort==42){echo 'selected';}?>>42</option>
                                    <option value="54" <?php if($sort==54){echo 'selected';}?>>54</option>
                                    <option value="66" <?php if($sort==66){echo 'selected';}?>>66</option>
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
                                    <div class="options">
                                        <a href="<?=base_url('w_product/index');?>/<?=$product->id;?>" class="font-18 mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
                                        
                                        <a href="javascript:void(0);" class="font-18 pull-left btn-xs delete_btn" product_id = '<?=$product->id;?>'>
                                            <i class="zmdi zmdi-close"></i>
                                        </a>
                                        
                                    </div>
                                    
                                    <!--product image .start-->
                                    <?php
                                    if($count_img == 0){
                                    ?>
                                    <a href="javascript:void(0);" style="cursor:default;"> <img src="<?=base_url('assets/app');?>/img/original_files/sample.jpg" class="img-responsive" alt="<?=$product->brand_name;?>" /> </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="javascript:void(0);" style="cursor:default;"> <img src="<?=base_url('assets/app');?>/img/285_files/<?=$prd_image;?>" class="img-responsive" alt="<?=$product->brand_name;?>" /> </a>
                                    <?php
                                    }
                                    ?>
                                    <!--product image .end-->
                                    
                                </div>
                                <div class="info">
                                    <?php
                                    $discount = $product->discount;
                                    ?>
                                    <a href="">
                                        <h6><?=$product->brand_name;?><br><small><?=$product->generic_name;?></small></h6>
                                    </a>
                                    
                                    <div id="pq<?//=$user_available_products->product_ID;?>">
                                    
                                    <div class="row">
                                        <?php
                                        if($discount>0){
                                        ?>
                                        <div class="col-md-12">
                                            <span style="float: left; text-decoration:line-through;">Tsh <?=number_format($product->price);?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="head-font block text-warning font-16">Tsh <?=number_format($discount);?></span>
                                        </div>
                                        <?php
                                        }else{
                                        ?>
                                        <div class="col-md-12">
                                            <span style="float: left; text-decoration:line-through; visibility:hidden;">discount</span>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="head-font block text-warning font-16">Tsh <?=number_format($product->price);?></span>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>

                                    

                                    <p class="long_text">
                                        <span style="<?php if($product->quantity==0){echo 'color: red;';}?>">in-stock: <?=$product->quantity;?></span>
                                    </p>
                                </div>
                                        
                                    <hr style="padding: 0; margin: 0; width: 94%;">
                                    
                                    <span class="head-font block text-default long_text" style="font-size: 12px;">
                                    <?php
                                    $country = $product->country;
                                    $industry = $product->industry;

                                    if($industry){
                                        echo $industry.', '.$country;
                                    }else{
                                        echo $country;
                                    }
                                    ?>
                                    </span>
                                    
                                    <!-- <button type="button" class="btn btn-default btn-xs quickEdit" id="<?//=$user_available_products->product_ID;?>">quick edit</button> -->
                                    
                                </div>
                            </article>
                        </div>
                    </div>	
                </div>	
            </div>
            <?php } ?>

            <!-- product ./end -->

        </div>
        <?=$links;?>
        
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