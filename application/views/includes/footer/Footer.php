        <!-- Footer -->
        <footer class="footer container-fluid pl-30 pr-30">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-center"><?=date('Y');?> &copy; PharmLinks.</p>
                </div>
            </div>
        </footer>
        <!-- /Footer -->
			
        </div>
        <!-- /Main Content -->

<!-- ########### Main-content end here -->

</div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Slimscroll JavaScript -->
	<script src="<?=base_url('assets/app');?>/dist/js/jquery.slimscroll.js"></script>
	
	<!-- Init JavaScript -->
    <script src="<?=base_url('assets/app');?>/dist/js/init.js"></script>

    <?php
    if(!empty($active)){
        if($active == 'add_product' || $active == 'categories' || $active == 'package'){
    ?>
    <!-- <script src="<?//=base_url('assets/app/');?>/vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script> -->
    <?php
        }

        if($active == 'view_products'){
    ?>

    <script>
    $(document).ready(function(){
        $('.delete_btn').click(function(){
            var id = $(this).attr('product_id');
            $('.prd_id').val(id);
            
        $.ajax({
            url: "<?=base_url();?>/w_main/product_details",
            method:"POST",
            dataType: "json",
            data:{
               id:id,
            },
            cache: false,
            success: function(result){
                if(result){
                    $('.brand_name').text(result.brand_name);
                    $('.delete_model').modal('show');
                }
            }
        });
        });
        
    });
    </script>

    <?php
        }

        if($active == 'seller_dashboard'){
    ?>
           
    <!-- Progressbar Animation JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

    <?php
        }

        if($active == 'pharmacies' || $active == 'cart_index'){
    ?>

<script src="<?php echo base_url('assets/app');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <!-- add product to cart .start -->
    <script>
        $(document).ready(function(){
            
            $(document).on('click', '.add_to_cart', function(cart_btn){
                cart_btn.preventDefault();

                var prdid=$(this).attr('each_productid');
                var wholesalerids=$(this).attr('each_wholesalerid');
                var each_product_price=$(this).attr('each_prd_price');
                var each_prd_qty=1;
                var product_image=$(this).attr('each_prd_img');

                $.ajax({
                    type: "POST",
                    url: "<?=base_url('cart/add_prd_to_cart');?>",
                    dataType: "json",
                    data: {
                        each_prd_id: prdid,
                        each_wholesalerids: wholesalerids,
                        each_prdprice: each_product_price,
                        each_product_qty: each_prd_qty,
                        each_product_image: product_image
                    },
                    
                    success: function(cart_add_res){
                        // alert(cart_add_res);
                        if(cart_add_res.added=='product_added'){
                            
                            $('.cart_area'+cart_add_res.added_prd_id).html('<a href="<?=base_url('cart/index');?>" class="btn btn-success btn-outline btn-xs" data-toggle="tooltip" data-placement="top" title="click to view cart"><i class="fa fa-check"></i> added</a>');
                            
                            $('#div_cart').load(' #div_cart');
                            $('#div_cart2').load(' #div_cart2');
                            $('#div_cart3').load(' #div_cart3');
                            
                            $.toast({
                                heading: 'Product added to cart',
                                position: 'top-right',
                                loaderBg:'#878787',
                                hideAfter: 1500,
                                stack: 6
                            });
                        }
                    },
                    error: function(){
                        alert('error! please try again.');
                    }
                });
            });
        });
    </script>
    <!-- add product to cart .end -->

    <?php
        }

        if($active == 'cart_index'){
    ?>

    <!--my script-->
    <script>
        $(document).ready(function(){
            $('.delete_prd_btn').click(function(){
                $(this).attr('value', 'please wait..');
                $(this).attr('disabled', true);
            });
            
            $('.checkout_prd_btn').click(function(){
                $(this).html('please wait.. <i class="fa fa-circle-o-notch fa-spin"></i>');
                $('.page-wrapper').addClass('disable_page');
            });
            
            // //validate search field
            // $('#search_form').submit(function(search){
            //     var searched_data=$('#seach_keyword').val();
            //     if(searched_data==''){
            //         search.preventDefault();
            //     }
            // });
            
            //open model to confirm purchase
            $(document).on('click', '.placeOrder', function(){
                var shipping_cost = $('#shipping_fee').val();
                $('.transport_fee').val(shipping_cost);
                $('.payment_method').html('<div class="radio radio-success"><input type="radio" name="payment" id="mpesa" value="m-pesa" checked><label for="mpesa"> M-PESA </label></div><div class="radio radio-success"><input type="radio" name="payment" id="wallet" value="wallet"><label for="wallet"> WALLET </label><p></p></div>');
                $('.checkout_prd_btn').removeAttr('disabled');
                $('#place_order').modal('show');
            });
            
            //load cart data
            $.ajax({
                method: "POST",
                url: "<?=base_url('cart/view_cart');?>",
                cache: false,
                dataType: "text",
                success: function(cart_data){
                    // alert(cart_data);
                    if(cart_data!=''){
                        $('.cart_contents').html(cart_data);
                    }else{
                        $('.cart_contents').html('<div class="panel text-center"><h6 style="text-transform: lowercase;">Your cart is empty!</h6></div><div class="form-actions pull-right pr-15"><a href="<?=base_url('shops')?>" class="btn btn-default btn-anim mr-10 pull-left btn-sm"><i class="fa fa-shopping-cart"></i><span class="btn-text">Continue Shopping</span></a><div class="clearfix"></div></div>');
                    }
                    
                },
                error: function(){
                    alert('error in load cart, please try again!');
                }
            });
            
            //remove one product from cart
            $(document).on('click', '.delete_cart_product', function(remove_item){
                remove_item.preventDefault();
                var product_row_id=$(this).attr('prd_rowid');
                
                $.ajax({
                    method: "POST",
                    url: "<?=base_url('cart/remove_cart_product');?>",
                    cache: false,
                    dataType: "text",
                    data: {
                        productRowId:product_row_id
                    },
                    success: function(remove_prd){
                        //alert(remove_prd);
                        $('#div_cart').load(' #div_cart');
                        $('#div_cart2').load(' #div_cart2');
                        $('#div_cart3').load(' #div_cart3');

                        if(remove_prd!=''){
                            $('.cart_contents').html(remove_prd);
                        }else{
                            $('.cart_contents').html('<div class="panel text-center"><h6 style="text-transform: lowercase;">Your cart is empty!</h6></div><div class="form-actions pull-right pr-15"><a href="<?=base_url('shops')?>" class="btn btn-default btn-anim mr-10 pull-left btn-sm"><i class="fa fa-shopping-cart"></i><span class="btn-text">Continue Shopping</span></a><div class="clearfix"></div></div>');
                        }
                        
                        //update notifation .start
                        $(document).ready(function() {
                            $.toast().reset('all');   
                            $("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
                            $.toast({
                                heading: 'Pharmlink Cart',
                                text: 'one product was removed from cart',
                                position: 'top-center',
                                loaderBg:'#878787',
                                hideAfter: 3000
                            });
                            return false;
                        });
                        //update notification .end
                    },
                    error: function(){
                        alert('error in deleting this product, please try again!');
                    }
                });
            });
            
            //open clear cart modal
            $(document).on('click', '.clear_cart_btn', function(remove_item){
                remove_item.preventDefault();
                $('#clear_cart').modal('show');
            });
            
            //remove all products from cart
            $('.delete_prd_btn').click(function(){
                
                $.ajax({
                    method: "POST",
                    url: "<?=base_url('cart/remove_cart_product');?>",
                    cache: false,
                    dataType: "text",
                    data: {
                        productRowId:'all'
                    },
                    success: function(cart_cleared){
                        //alert(remove_prd);
                        $('#div_cart').load(' #div_cart');
                        $('#div_cart2').load(' #div_cart2');
                        $('#div_cart3').load(' #div_cart3');
                        
                        if(cart_cleared!=''){
                            $('.cart_contents').html(cart_cleared);
                        }else{
                            $('.cart_contents').html('<div class="panel text-center"><h6 style="text-transform: lowercase;">Your cart is empty!</h6></div><div class="form-actions pull-right pr-15"><a href="<?=base_url('shops')?>" class="btn btn-default btn-anim mr-10 pull-left btn-sm"><i class="fa fa-shopping-cart"></i><span class="btn-text">Continue Shopping</span></a><div class="clearfix"></div></div>');
                        }
                        
                        $('.delete_prd_btn').removeAttr('disabled');
                        $('.delete_prd_btn').attr('value', 'cart cleared');
                        $('.delete_prd_btn').removeClass('btn-danger');
                        $('.delete_prd_btn').addClass('btn-success');
                        setTimeout(function(){
                            $('#clear_cart').modal('hide');
                            
                            //update notifation .start
                            $(document).ready(function() {
                                $.toast().reset('all');   
                                $("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
                                $.toast({
                                    heading: 'Pharmlink Cart',
                                    text: 'All product from cart was removed successfully',
                                    position: 'top-center',
                                    loaderBg:'#878787',
                                    hideAfter: 3500
                                });
                                return false;
                            });
                            //update notification .end
                        }, 1000);
                    },
                    error: function(){
                        alert('error in deleting this product, please try again!');
                    }
                });
                
            });
            
            //auto update a cart by change event
            $(document).on('change', '.valSpinner', function(){
                //get product info
                
                var product_rowid = $(this).closest('.wan-spinner-2').prev('span').children('.prdrowid').val();
                var productid = $(this).closest('.wan-spinner-2').prev('span').children('.prdid').val();
                var productprice = $(this).closest('.wan-spinner-2').prev('span').children('.prdprice').val();
                var product_needed_qty = $(this).val();
                
                $.ajax({
                    method: "POST",
                    url: "<?=base_url('cart/updateCart');?>",
                    cache: false,
                    dataType: "text",
                    data: {
                        prd_rowid: product_rowid,
                        prd_id: productid,
                        prd_price: productprice,
                        prd_qty: product_needed_qty
                    },
                    success: function(cartUpdated){
                        if(cartUpdated!=''){
                            $('.cart_contents').html(cartUpdated);
                            
                            //update notifation .start
                            $(document).ready(function() {
                                $.toast().reset('all');   
                                $("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
                                $.toast({
                                    heading: 'Pharmlink Cart',
                                    text: 'Your cart was updated successfully',
                                    position: 'top-center',
                                    loaderBg:'#878787',
                                    hideAfter: 3000
                                });
                                return false;
                            });
                            //update notification .end
                        }
                    },
                    error: function(){
                        alert('error in updating cart, please try again!');
                    }
                });
            });
            
            //auto update a cart by click event
            $(document).on('click', '.plusNo, .minusNo', function(e){
                e.preventDefault();
                //get product info
                
                var product_rowid = $(this).closest('.wan-spinner-2').prev('span').children('.prdrowid').val();
                var productid = $(this).closest('.wan-spinner-2').prev('span').children('.prdid').val();
                var productprice = $(this).closest('.wan-spinner-2').prev('span').children('.prdprice').val();
                var product_needed_qty = $(this).closest('.wan-spinner-2').children('.valSpinner').val();
                
                $.ajax({
                    method: "POST",
                    url: "<?=base_url('cart/updateCart');?>",
                    cache: false,
                    dataType: "text",
                    data: {
                        prd_rowid: product_rowid,
                        prd_id: productid,
                        prd_price: productprice,
                        prd_qty: product_needed_qty
                    },
                    success: function(cartUpdated){
                        if(cartUpdated!=''){
                            $('.cart_contents').html(cartUpdated);
                            
                            //update notifation .start
                            $(document).ready(function() {
                                $.toast().reset('all');   
                                $("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
                                $.toast({
                                    heading: 'Pharmlink Cart',
                                    text: 'Your cart was updated successfully',
                                    position: 'top-center',
                                    loaderBg:'#878787',
                                    hideAfter: 3000
                                });
                                return false;
                            });
                            //update notification .end
                        }
                    },
                    error: function(){
                        alert('error in updating cart, please try again!');
                    }
                });
            });
            
        });
    </script>

    <?php
        }
    }
    ?>

</body>

</html>