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

    <script src="<?php echo base_url('assets/app');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

    <?php
    if(!empty($active)){
        if($active == 'add_product' || $active == 'categories' || $active == 'package'){
    ?>
    <!-- <script src="<?//=base_url('assets/app/');?>/vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script> -->
    <?php
        }

        if($active == 'add_product'){
    ?>
    <script>
    $(document).ready(function(){
        $('.remove_img_btn').click(function(){
            $imageid = $(this).attr('image_id');
            $image_file = $(this).attr('file_name');
            $image_url = '<?=base_url('assets/app');?>/img/900_1000_files/'+$image_file;
            $('.preview_image').attr('src', $image_url);
            $('.img_id').val($imageid);
            $('.delete_img_btn').attr('value', 'Confirm');
            $('.delete_img_btn').attr('disabled', false);
            $('.delete_image').modal('show');
        });

        $('.delete_img_btn').click(function(){
            var id_to_rm = $('.img_id').val();

            $(this).attr('value', 'please wait..');
            $(this).attr('disabled', true);
            
            $.ajax({
                method: "POST",
                url: "<?=base_url();?>/w_product/remove_product_image",
                cache: false,
                dataType: "json",
                data: {
                    id: id_to_rm,
                },
                success: function(result){
                    $('.img'+result.id).hide();
                    $('.delete_image').modal('hide');
                },
                error: function(){
                    alert('error in deleting image');
                }
            });
        });
        
    });
    </script>
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

        if($active == 'seller_dashboard' || $active == 'retailer_dash'){
    ?>
           
    <!-- Progressbar Animation JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

    <?php
        }

        if($active == 'seller_dashboard'){
    ?>
    
    <!-- check new order -->
    <script>
        $(document).ready(function(){
            
            //notication check
            function check_new_order(){
                
                //new order check .start
                $.ajax({
                    method: "POST",
                    url: "<?=base_url();?>/w_order/index",
                    cache: false,
                    dataType: "json",
                    success: function(newOrder){
                        // alert(newOrder);
                        // alert(newOrder.new_order);
                        $('.notification_no').html(newOrder.notification_no);
                        // $('.check_order').html(newOrder.order_number);
                        if(newOrder.order_number!=0){
                            $('.display_new_orders').html(newOrder.new_order);
                        }else{
                            $('.display_new_orders').html('<div class="panel panel-default card-view"><div class="panel-heading"><div class="pull-left"><h6 class="panel-title txt-dark">No new order</h6></div><div class="clearfix"></div></div></div>');
                        }
                        
                        if(newOrder.notification_data!=''){
                            $('.display_notification').html(newOrder.notification_data);
                        }else{
                            $('.display_notification').html('<div class="sl-content"><h6 class="text-center" style="text-transform: lowercase;">no new notification</h6></div>');
                        }
                        
                    },
                    error: function(){
                        alert('error in loading new order');
                    }
                });
                //new order check .end
            }
            check_new_order();
            
            // setInterval(function(){
            //     check_new_order();
            // }, 1000);
            // 30000
            
            /*
            //check if notification viewed
            $('.notification_no, .view_notifiy_icon').click(function(){
                
                $.ajax({
                    method: "POST",
                    url: "<?=base_url();?>/Main_filter/notification_icon_clicked",
                    cache: false,
                    success: function(update){
                        $('.notification_no').html('0');
                    }
                });
                
            });*/
        });
    </script>

    <?php
        }

        if($active == 'pharmacies' || $active == 'cart_index'){
    ?>

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

        if($active == 'product_details'){
    ?>
    
    <!-- Bootstrap Touchspin JavaScript .start-->
	<script type="text/javascript">
        <?php
        $product_id = $this->uri->segment(3);
        $this->db->where('id', $product_id);            
        $getProductTable=$this->db->get('product');
        foreach($getProductTable->result() as $prdInfoRow){
            $productQuantity=$prdInfoRow->quantity;
        }
        ?>
        !function(a){"use strict";function b(a,b){return a+".touchspin_"+b}function c(c,d){return a.map(c,function(a){return b(a,d)})}var d=0;a.fn.TouchSpin=function(b){if("destroy"===b)return void this.each(function(){var b=a(this),d=b.data();a(document).off(c(["mouseup","touchend","touchcancel","mousemove","touchmove","scroll","scrollstart"],d.spinnerid).join(" "))});var e={min:0,max:<?=$productQuantity;?>,initval:"",replacementval:"",step:1,decimals:0,stepinterval:100,forcestepdivisibility:"round",stepintervaldelay:500,verticalbuttons:!1,verticalupclass:"glyphicon glyphicon-chevron-up",verticaldownclass:"glyphicon glyphicon-chevron-down",prefix:"",postfix:"",prefix_extraclass:"",postfix_extraclass:"",booster:!0,boostat:10,maxboostedstep:!1,mousewheel:!0,buttondown_class:"btn btn-default",buttonup_class:"btn btn-default",buttondown_txt:"-",buttonup_txt:"+"},f={min:"min",max:"max",initval:"init-val",replacementval:"replacement-val",step:"step",decimals:"decimals",stepinterval:"step-interval",verticalbuttons:"vertical-buttons",verticalupclass:"vertical-up-class",verticaldownclass:"vertical-down-class",forcestepdivisibility:"force-step-divisibility",stepintervaldelay:"step-interval-delay",prefix:"prefix",postfix:"postfix",prefix_extraclass:"prefix-extra-class",postfix_extraclass:"postfix-extra-class",booster:"booster",boostat:"boostat",maxboostedstep:"max-boosted-step",mousewheel:"mouse-wheel",buttondown_class:"button-down-class",buttonup_class:"button-up-class",buttondown_txt:"button-down-txt",buttonup_txt:"button-up-txt"};return this.each(function(){function g(){if(!J.data("alreadyinitialized")){if(J.data("alreadyinitialized",!0),d+=1,J.data("spinnerid",d),!J.is("input"))return void console.log("Must be an input.");j(),h(),u(),m(),p(),q(),r(),s(),D.input.css("display","block")}}function h(){""!==B.initval&&""===J.val()&&J.val(B.initval)}function i(a){l(a),u();var b=D.input.val();""!==b&&(b=Number(D.input.val()),D.input.val(b.toFixed(B.decimals)))}function j(){B=a.extend({},e,K,k(),b)}function k(){var b={};return a.each(f,function(a,c){var d="bts-"+c;J.is("[data-"+d+"]")&&(b[a]=J.data(d))}),b}function l(b){B=a.extend({},B,b),b.postfix&&J.parent().find(".bootstrap-touchspin-postfix").text(b.postfix),b.prefix&&J.parent().find(".bootstrap-touchspin-prefix").text(b.prefix)}function m(){var a=J.val(),b=J.parent();""!==a&&(a=Number(a).toFixed(B.decimals)),J.data("initvalue",a).val(a),J.addClass("form-control"),b.hasClass("input-group")?n(b):o()}function n(b){b.addClass("bootstrap-touchspin");var c,d,e=J.prev(),f=J.next(),g='<span class="input-group-addon bootstrap-touchspin-prefix">'+B.prefix+"</span>",h='<span class="input-group-addon bootstrap-touchspin-postfix">'+B.postfix+"</span>";e.hasClass("input-group-btn")?(c='<button class="'+B.buttondown_class+' bootstrap-touchspin-down" type="button">'+B.buttondown_txt+"</button>",e.append(c)):(c='<span class="input-group-btn"><button class="'+B.buttondown_class+' bootstrap-touchspin-down" type="button">'+B.buttondown_txt+"</button></span>",a(c).insertBefore(J)),f.hasClass("input-group-btn")?(d='<button class="'+B.buttonup_class+' bootstrap-touchspin-up" type="button">'+B.buttonup_txt+"</button>",f.prepend(d)):(d='<span class="input-group-btn"><button class="'+B.buttonup_class+' bootstrap-touchspin-up" type="button">'+B.buttonup_txt+"</button></span>",a(d).insertAfter(J)),a(g).insertBefore(J),a(h).insertAfter(J),C=b}function o(){var b;b=B.verticalbuttons?'<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">'+B.prefix+'</span><span class="input-group-addon bootstrap-touchspin-postfix">'+B.postfix+'</span><span class="input-group-btn-vertical"><button class="'+B.buttondown_class+' bootstrap-touchspin-up" type="button"><i class="'+B.verticalupclass+'"></i></button><button class="'+B.buttonup_class+' bootstrap-touchspin-down" type="button"><i class="'+B.verticaldownclass+'"></i></button></span></div>':'<div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="'+B.buttondown_class+' bootstrap-touchspin-down" type="button">'+B.buttondown_txt+'</button></span><span class="input-group-addon bootstrap-touchspin-prefix">'+B.prefix+'</span><span class="input-group-addon bootstrap-touchspin-postfix">'+B.postfix+'</span><span class="input-group-btn"><button class="'+B.buttonup_class+' bootstrap-touchspin-up" type="button">'+B.buttonup_txt+"</button></span></div>",C=a(b).insertBefore(J),a(".bootstrap-touchspin-prefix",C).after(J),J.hasClass("input-sm")?C.addClass("input-group-sm"):J.hasClass("input-lg")&&C.addClass("input-group-lg")}function p(){D={down:a(".bootstrap-touchspin-down",C),up:a(".bootstrap-touchspin-up",C),input:a("input",C),prefix:a(".bootstrap-touchspin-prefix",C).addClass(B.prefix_extraclass),postfix:a(".bootstrap-touchspin-postfix",C).addClass(B.postfix_extraclass)}}function q(){""===B.prefix&&D.prefix.hide(),""===B.postfix&&D.postfix.hide()}function r(){J.on("keydown",function(a){var b=a.keyCode||a.which;38===b?("up"!==M&&(w(),z()),a.preventDefault()):40===b&&("down"!==M&&(x(),y()),a.preventDefault())}),J.on("keyup",function(a){var b=a.keyCode||a.which;38===b?A():40===b&&A()}),J.on("blur",function(){u()}),D.down.on("keydown",function(a){var b=a.keyCode||a.which;(32===b||13===b)&&("down"!==M&&(x(),y()),a.preventDefault())}),D.down.on("keyup",function(a){var b=a.keyCode||a.which;(32===b||13===b)&&A()}),D.up.on("keydown",function(a){var b=a.keyCode||a.which;(32===b||13===b)&&("up"!==M&&(w(),z()),a.preventDefault())}),D.up.on("keyup",function(a){var b=a.keyCode||a.which;(32===b||13===b)&&A()}),D.down.on("mousedown.touchspin",function(a){D.down.off("touchstart.touchspin"),J.is(":disabled")||(x(),y(),a.preventDefault(),a.stopPropagation())}),D.down.on("touchstart.touchspin",function(a){D.down.off("mousedown.touchspin"),J.is(":disabled")||(x(),y(),a.preventDefault(),a.stopPropagation())}),D.up.on("mousedown.touchspin",function(a){D.up.off("touchstart.touchspin"),J.is(":disabled")||(w(),z(),a.preventDefault(),a.stopPropagation())}),D.up.on("touchstart.touchspin",function(a){D.up.off("mousedown.touchspin"),J.is(":disabled")||(w(),z(),a.preventDefault(),a.stopPropagation())}),D.up.on("mouseout touchleave touchend touchcancel",function(a){M&&(a.stopPropagation(),A())}),D.down.on("mouseout touchleave touchend touchcancel",function(a){M&&(a.stopPropagation(),A())}),D.down.on("mousemove touchmove",function(a){M&&(a.stopPropagation(),a.preventDefault())}),D.up.on("mousemove touchmove",function(a){M&&(a.stopPropagation(),a.preventDefault())}),a(document).on(c(["mouseup","touchend","touchcancel"],d).join(" "),function(a){M&&(a.preventDefault(),A())}),a(document).on(c(["mousemove","touchmove","scroll","scrollstart"],d).join(" "),function(a){M&&(a.preventDefault(),A())}),J.on("mousewheel DOMMouseScroll",function(a){if(B.mousewheel&&J.is(":focus")){var b=a.originalEvent.wheelDelta||-a.originalEvent.deltaY||-a.originalEvent.detail;a.stopPropagation(),a.preventDefault(),0>b?x():w()}})}function s(){J.on("touchspin.uponce",function(){A(),w()}),J.on("touchspin.downonce",function(){A(),x()}),J.on("touchspin.startupspin",function(){z()}),J.on("touchspin.startdownspin",function(){y()}),J.on("touchspin.stopspin",function(){A()}),J.on("touchspin.updatesettings",function(a,b){i(b)})}function t(a){switch(B.forcestepdivisibility){case"round":return(Math.round(a/B.step)*B.step).toFixed(B.decimals);case"floor":return(Math.floor(a/B.step)*B.step).toFixed(B.decimals);case"ceil":return(Math.ceil(a/B.step)*B.step).toFixed(B.decimals);default:return a}}function u(){var a,b,c;return a=J.val(),""===a?void(""!==B.replacementval&&(J.val(B.replacementval),J.trigger("change"))):void(B.decimals>0&&"."===a||(b=parseFloat(a),isNaN(b)&&(b=""!==B.replacementval?B.replacementval:0),c=b,b.toString()!==a&&(c=b),b<B.min&&(c=B.min),b>B.max&&(c=B.max),c=t(c),Number(a).toString()!==c.toString()&&(J.val(c),J.trigger("change"))))}function v(){if(B.booster){var a=Math.pow(2,Math.floor(L/B.boostat))*B.step;return B.maxboostedstep&&a>B.maxboostedstep&&(a=B.maxboostedstep,E=Math.round(E/a)*a),Math.max(B.step,a)}return B.step}function w(){u(),E=parseFloat(D.input.val()),isNaN(E)&&(E=0);var a=E,b=v();E+=b,E>B.max&&(E=B.max,J.trigger("touchspin.on.max"),A()),D.input.val(Number(E).toFixed(B.decimals)),a!==E&&J.trigger("change")}function x(){u(),E=parseFloat(D.input.val()),isNaN(E)&&(E=0);var a=E,b=v();E-=b,E<B.min&&(E=B.min,J.trigger("touchspin.on.min"),A()),D.input.val(E.toFixed(B.decimals)),a!==E&&J.trigger("change")}function y(){A(),L=0,M="down",J.trigger("touchspin.on.startspin"),J.trigger("touchspin.on.startdownspin"),H=setTimeout(function(){F=setInterval(function(){L++,x()},B.stepinterval)},B.stepintervaldelay)}function z(){A(),L=0,M="up",J.trigger("touchspin.on.startspin"),J.trigger("touchspin.on.startupspin"),I=setTimeout(function(){G=setInterval(function(){L++,w()},B.stepinterval)},B.stepintervaldelay)}function A(){switch(clearTimeout(H),clearTimeout(I),clearInterval(F),clearInterval(G),M){case"up":J.trigger("touchspin.on.stopupspin"),J.trigger("touchspin.on.stopspin");break;case"down":J.trigger("touchspin.on.stopdownspin"),J.trigger("touchspin.on.stopspin")}L=0,M=!1}var B,C,D,E,F,G,H,I,J=a(this),K=J.data(),L=0,M=!1;g()})}}(jQuery);
    </script>
    <!-- Product Detail Data JavaScript -->
	<script src="<?=base_url('assets/app');?>/dist/js/product-detail-data.js"></script>
    <!-- Bootstrap Touchspin JavaScript .end-->
    
    <!--add product to cart .start-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add_to_cart_btn').click(function(add_cart){
                add_cart.preventDefault();
                var prdid=$(this).attr('each_productid');
                var wholesalerids=$(this).attr('each_wholesalerid');
                var each_product_price=$(this).attr('each_prd_price');
                var each_prd_qty=$('.vertical-spin').val();
                var product_image=$(this).attr('each_prd_img');
                
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('cart/add_prd_to_cart');?>",
                    dataType: "json",
                    data:{
                        each_prd_id: prdid,
                        each_wholesalerids: wholesalerids,
                        each_prdprice: each_product_price,
                        each_product_qty: each_prd_qty,
                        each_product_image: product_image
                    },
                    success: function(cart_add_result){
                        // alert(cart_add_result.added);
                        if(cart_add_result.added=='product_added'){
                            $('.cart_area').html('<a href="<?=base_url('cart');?>" class="btn btn-success btn-anim"><i class="ti-shopping-cart">view</i><span class="btn-text">added</span></a>');
                                       
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
    <!--add product to cart .end-->

    <!-- place order .start -->
    <script>
        $(document).ready(function(){
            //place order
            $('.place_order_btn').click(function(){
                var shipping_fee=$('#shipping_fee').val();
                var filter_shipping_fee=shipping_fee.replace(',', '');
                var get_order_qty=$('.vertical-spin').val();
                var product_price=$('#prd_price').val();
                
                //calculate order total order price
                var sub_total=get_order_qty*product_price;
                var total_order_price=parseInt(filter_shipping_fee) + parseInt(sub_total);
                
                $('.single_prd_price').html('Tsh '+product_price);
                $('.prd_qty').html(get_order_qty);
                $('.sub_total_price').html('Tsh '+sub_total);
                $('.transport_cost').html('Tsh '+filter_shipping_fee);
                $('.sub_total_order_price').val(sub_total);
                $('.transport_fee').val(filter_shipping_fee);
                $('.product_qty').val(get_order_qty);
                $('.total_order_price').html('Tsh '+total_order_price);
                
                $('.payment_method').html('<div class="radio radio-success"><input type="radio" name="payment" id="mpesa" value="m-pesa" checked><label for="mpesa"> M-PESA </label></div><div class="radio radio-success"><input type="radio" name="payment" id="wallet" value="wallet"><label for="wallet"> WALLET </label><p></p></div>');
                
                $('.checkout_prd_btn').removeAttr('disabled');
                $('#place_order').modal('show');
            });
            
        });
    </script>
    <!-- place order ./end -->

    <?php
        }

        if($active == 'w_invoice'){
    ?>
    <script>
        $(document).ready(function(){
            $('.pay_procedure').click(function(){
                var ctrl_text = $(this).find('a').attr('action');
                
                if(ctrl_text=='view'){
                    $(this).find('a').attr('action', 'hide');
                    $(this).find('a').children('span').html('CLICK TO HIDE PAYMENT METHOD');
                    $(this).find('a').children('i').removeClass('ti-angle-down').addClass('ti-angle-up');
                    $('.main_procedure').slideDown('fast');
                }else{
                    $(this).find('a').attr('action', 'view');
                    $(this).find('a').children('span').html('CLICK TO VIEW PAYMENT METHOD');
                    $(this).find('a').children('i').removeClass('ti-angle-up').addClass('ti-angle-down');
                    $('.main_procedure').slideUp('fast');
                }
            });

            <?php
            if($this->session->flashdata()){
            ?>
            $(document).ready(function(){
                $(this).delay(1200).queue(function(){
                    $.toast({
                        heading: '<?=$this->session->userdata('feedback');?>',
                        text: 'start packing the drugs',
                        position: 'top-left',
                        loaderBg:'#878787',
                        hideAfter: 4000,
                        stack: 6
                    });
                });
            });
            <?php
            }
            ?>

        });
    </script>

    <?php
        }
    }
    ?>

</body>

</html>