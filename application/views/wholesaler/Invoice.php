<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg hide_on_print">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">invoice</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="javascript:void();">Dashboard</a></li>
                    <li class="active"><span>invoice</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        
        <?php
        $invoice_id=$this->uri->segment(3);
        
        $this->db->where('id', $invoice_id);
        $get_invoice=$this->db->get('order');
        
        // count order
        $count_invoice=$get_invoice->num_rows();
        if($count_invoice==0){
            redirect('w_order/all_invoice');
        }

        // get order content
        $this->db->where('order_id', $invoice_id);
        $this->db->where('to', $this->session->userdata('id'));

        // $this->db->group_by('order_id');
        // $this->db->group_by('to');
        
        $order_content = $this->db->get('order_content');
        foreach($order_content->result() as $content_data){
            $order_status = $content_data->status_id;
        }

        // status name
        $this->db->where('id', $order_status);
        $status_data = $this->db->get('order_status');
        foreach($status_data->result() as $statur_row){
            $status_name = $statur_row->name;
        }
        ?>

        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h5 class="panel-title txt-dark">Invoice</h5>
                        </div>
                        <div class="pull-right">
                            <h5 class="panel-title txt-dark">order # 
                                <?php
                                foreach($get_invoice->result() as $orderNumber){
                                    $order_No=$orderNumber->order_number;
                                    $buyer_id = $orderNumber->from;
                                    $date_ordered = $orderNumber->date_ordered;

                                    // convert datetime to timestamp
                                    $timestamp_date_ordered = strtotime($date_ordered);
                                }
                                echo $order_No;
                                ?>
                            </h5>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <hr class="light-grey-hr ma-0"/>
                    
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="txt-dark head-font inline-block capitalize-font mb-5">
                                        
                                        BILLING ADDRESS:
                                    </span>
                                    <address class="mb-15">
                                        <span class="address-head mb-5">
                                            <?php
                                            $this->db->where('user', $this->session->userdata('id'));
                                            $getWholesalerPharm=$this->db->get('pharmacy');
                                            foreach($getWholesalerPharm->result() as $buyerPharmRow){
                                                $wholesaler_pharmname=$buyerPharmRow->name;
                                                $location_id = $buyerPharmRow->location;
                                                echo $wholesaler_pharmname.',';
                                            }
                                            ?>
                                        </span>
                                        <?php
                                        //get seller pharmacy location
                                        foreach($this->db->where('id', $location_id)->get('location')->result() as $loc_row){
                                            $loc_name=$loc_row->location_name;
                                            echo str_replace(',',',<br/>',$loc_name);
                                        }
                                        ?>
                                        <br/>
                                        <abbr title="Phone">P:</abbr>
                                        <?php
                                        $this->db->where('id', $this->session->userdata('id'));
                                        $get_seller_phone=$this->db->get('user');
                                        foreach($get_seller_phone->result() as $seller_phone_row){
                                            $seller_phone_no=$seller_phone_row->phone_number;
                                            echo $seller_phone_no;
                                        }
                                        ?>
                                    </address>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="txt-dark head-font inline-block capitalize-font mb-5">SHIPPING ADDRESS</span><br/>
                                    <address class="mb-15">
                                        <span class="address-head mb-5">
                                        <?php
                                        $this->db->where('user', $buyer_id);
                                        $get_pharmacy_details=$this->db->get('pharmacy');
                                        foreach($get_pharmacy_details->result() as $pharm_row){
                                            $buyer_pharmacy_name=$pharm_row->name;
                                        }
                                        echo '<span style="font-weight: bold;">'.$buyer_pharmacy_name.'</span>';
                                        ?>
                                        </span>
                                        
                                    </address>
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-6">
                                    <address>
                                        <?php
                                        if($status_name=='pending'){
                                        ?>
                                        <span class="text-warning" style="border: 2px solid #E69A2A; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;">PENDING</span>
                                        <?php    
                                        }else if($status_name=='processing'){
                                        ?>
                                        <span class="text-info" style="border: 2px solid #DC4666; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;">proccessing</span>
                                        <?php
                                        }else if($order_status=='complete'){
                                        ?>
                                        <span class="text-success" style="border: 2px solid #469408; border-style: dashed; font-weight: bold; padding: 5px 10px; font-size: 18px;">complete</span>
                                        <?php } ?>
                                    </address>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <address>
                                        <span class="txt-dark head-font capitalize-font mb-5" style="font-weight: bold;">order date:</span><br>
                                        <?php
                                        $orderdate=date('M d, Y H:i', $timestamp_date_ordered);
                                        echo $orderdate;
                                        ?>
                                        <br>
                                    </address>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-xs-6 text-danger" style="padding-top: 5px; padding-bottom: 5px;">
                                    <?php
                                    if($status_name=='pending'){
                                    ?>
                                    <span>Dear customer please accept the order inorder to help our driver to pickup this order to your pharmacy location and deliver to buyer</span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            
                            <?php
                            if($status_name!='completed'){
                            ?>
                            <div class="row hide_on_print">
                                <div class="col-md-12">
                                    <div class="panel-group accordion-struct pay_procedure">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a role="button" action="view"> <span>CLICK TO VIEW PAYMENT METHOD</span> <i class="ti-angle-down"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 main_procedure" style="display: none;">
                                    
                                <div class="row hide_on_print">
                                    <div class="col-md-12">
                                        <p>Dear customer, your money will be paid to you by cash when our driver is come to pickup the order</p>
                                    </div>
                                    
                                </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <!--<div class="seprator-block"></div>-->
                            
                            <div class="invoice-bill-table">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center hide_on_print">image</th>
                                                <th class="text-center">Item</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_order_price=0;
                                            foreach($order_content->result() as $content_data){
                                                $each_product_price = $content_data->price;
                                                $product_id = $content_data->product_id;
                                                $product_qty = $content_data->quantity;

                                                //calculate subtotal price
                                                $total_order_price+=$each_product_price;

                                                // get product name
                                                $this->db->where('id', $product_id);
                                                $product_data = $this->db->get('product');
                                                foreach($product_data->result() as $product_row){
                                                    $product_name = $product_row->brand_name;
                                                }
                                            ?>
                                            <tr>
                                                <td style="padding: 0; margin: 0;" class="text-center hide_on_print">
                                                    <?php
                                                    // check product image
                                                    $this->db->where('product', $product_id);
                                                    $this->db->limit(1); // display only one product image
                                                    $image = $this->db->get('product_image');
                                                    // count product image
                                                    $count_img = $image->num_rows();
                                                    foreach($image->result() as $img_row){
                                                        $prd_image = $img_row->filename;
                                                    }
                                                    ?>
                                                    <!--product image .start-->
                                                    <?php
                                                    if($count_img == 0){
                                                    ?>
                                                    <img src="<?=base_url('assets/app');?>/img/original_files/sample.jpg" width="40" class="zoom_image" alt="<?=$product_name;?>" />
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <img src="<?=base_url('assets/app');?>/img/285_files/<?=$prd_image;?>" width="40" class="zoom_image" alt="<?=$product_name;?>" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <!--product image .end-->
                                                </td>
                                                <td class="text-center"><a href="javascript:void();"><?=$product_name;?></a></td>
                                                <td class="text-center">
                                                    <?php
                                                    $price_per_one=$each_product_price/$product_qty;
                                                    echo 'Tsh '.number_format($price_per_one);
                                                    ?>
                                                </td>
                                                <td class="text-center"><?=$product_qty;?></td>
                                                <td class="text-right"><?='Tsh '.number_format($each_product_price);?></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                            
                                            <tr class="txt-dark hidden-table-hover-effect">
                                                <td class="hide_on_print" style="border: none;"></td>
                                                <td style="border: none;"></td>
                                                <td style="border: none;"></td>
                                                <td class="text-center">Total</td>
                                                <td class="text-right">
                                                    <?='Tsh '.number_format($total_order_price);?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        
                                    </div>
                                    <div class="col-md-5">
                                        <div class="pull-right">
                                            <!-- <button type="button" class="btn btn-primary btn-outline btn-xs btn-icon left-icon hide_on_print" onclick="javascript:window.print();"> 
                                                <i class="fa fa-print"></i><span> Print</span> 
                                            </button> -->
                                            <?php
                                            if($status_name=='pending'){
                                            ?>
                                            <a href="<?=base_url('w_order/accept');?>/<?=$invoice_id;?>" class="btn btn-info btn-outline btn-xs btn-icon left-icon"> 
                                                <span> accept</span> 
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

    </div>
