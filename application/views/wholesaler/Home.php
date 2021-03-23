<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid pt-25">
        
        <!-- Row -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-red">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter">
                                                <span class="counter-anim">
                                                    <?php
                                                    $this->db->where('user', $this->session->userdata('id'));
                                                    $this->db->where('status', 1);
                                                    $count_products=$this->db->count_all_results('product');
                                                    echo $count_products;
                                                    ?>
                                                </span>
                                            </span>
                                            <span class="weight-500 uppercase-font txt-light block font-13">my products</span>
                                            <a href="<?=base_url('w_main/products');?>" class="txt-dark block font-13">View all</a>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="fa fa-medkit txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-green">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter">
                                                <span class="counter-anim">
                                                    <?php
                                                    $this->db->where('user', $this->session->userdata('id'));    
                                                    $this->db->where('status', 1);
                                                    $this->db->where('quantity', 0);

                                                    $count_out_of_stock=$this->db->count_all_results('product');
                                                    echo $count_out_of_stock;
                                                    ?>
                                                </span>
                                            </span>
                                            <span class="weight-500 uppercase-font txt-light block font-13">Out of stock</span>
                                            <!-- <a href="<?//=base_url('WL_main/available_stock');?>/stock_ended" class="txt-dark block font-13">View all</a> -->
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="ti-stats-down txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-yellow">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter">
                                                <span class="counter-anim"><!--  -->
                                                    <?php
                                                    $this->db->where('to', $this->session->userdata('id'));
        
                                                    $this->db->group_by('order_id');
                                                    $this->db->group_by('to');
                                                    $this->db->order_by('order_id', 'desc');
                                                    $get_order_from_retailer=$this->db->get('order_content');
                                            
                                                    // count received order
                                                    $count_order = $get_order_from_retailer->num_rows();
                                                    echo $count_order;
                                                    ?>
                                                </span>
                                            </span>
                                            <span class="weight-500 uppercase-font txt-light block">Orders</span>
                                            <!--<a href="<?//=base_url('Main_filter/deleted');?>" class="txt-dark block font-13">View all</a>-->
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="ti-package txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            /*{
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-blue">
                                <div class="container-fluid">
                                    <div class="row">
                                        
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter">Tsh <span class=""><!-- counter-anim -->
                                                <?php
                                                // $today_sales_date=date('Y-m-d');
                                                
                                                // $this->db->where('order_to', $this->session->userdata('unique_user_id'));
                                                // $this->db->where('status!=', 'init');
                                                // $this->db->where('status!=', 'rtl_cancel');
                                                // $this->db->where('status!=', 'auto_cancel');
                                                // $this->db->where('wholesaler_availability!=', 'deleted');
                                                
                                                // $this->db->group_start();
                                                // $this->db->where('status', 'proccessing');
                                                // $this->db->or_where('status', 'completed');
                                                // $this->db->group_end();
                                                
                                                // $this->db->like('date_ordered',$today_sales_date,'after');
                                                
                                                // $this->db->group_by('order_number');
                                                // $this->db->group_by('order_to');
                                                
                                                // $order_no=$this->db->get('orders');
                                                
                                                // $total_today_sales=0;
                                                // foreach($order_no->result() as $order_no_row){
                                                //     $get_order_no=$order_no_row->order_number;
                                                    
                                                //     //get single order price
                                                //     $this->db->where('order_to', $this->session->userdata('unique_user_id'));
                                                //     $this->db->where('order_number', $get_order_no);
                                                    
                                                //     $total_order_price=0;
                                                //     foreach($this->db->get('orders')->result() as $price_row){
                                                //         $get_today_sale=$price_row->price;
                                                //         $total_order_price=$total_order_price+$get_today_sale;
                                                //     }
                                                    
                                                //     //deduct service charges cost from order
                                                //     foreach($this->db->get('order_charges_tb')->result() as $charge_row){
                                                //         $percentage_deducted=$charge_row->percentage_deducted;
                                                //     }
                                                //     $percentage_charged=$percentage_deducted/100;
                                                //     $money_deducted=$percentage_charged*$total_order_price;
                                                //     $final_order_price=$total_order_price-$money_deducted;
                                                    
                                                //     $total_today_sales=$total_today_sales+$final_order_price;
                                                // }
                                                // echo $total_today_sales;
                                                
                                                /*
                                                $total_today_sales=0;
                                                foreach($wholesaler_today_sales->result() as $sale_info_row){
                                                    $get_today_sale=$sale_info_row->price;
                                                    $total_today_sales=$total_today_sales+$get_today_sale;
                                                    
                                                    echo $get_today_sale.', ';
                                                }*//*
                                                //echo number_format($total_today_sales);
                                                ?>
                                                </span></span>
                                            <span class="weight-500 uppercase-font txt-light block">today sales</span>
                                        </div>

                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="fa fa-plus-square txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }*/
            ?>
        </div>
        <!-- /Row -->

        
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 display_new_orders">
                
            </div>
            
            <?php
            /*{
            ?>
            <!--top 5 sold product .start-->
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view panel-refresh">
                    <div class="refresh-container">
                        <div class="la-anim-1"></div>
                    </div>
                            
                    <?php
                    // $this->db->where('user_id', $this->session->userdata('unique_user_id'));
                    // $this->db->where('stocks.status', 'available');
                    // $this->db->limit(5);
                    // $this->db->where('sell_count>', '0');
                    // $this->db->order_by('sell_count', 'desc');
                    
                    // $prd_info=$this->db->get('stocks');
                    // $count_prd=$prd_info->num_rows();
                    
                    // if($count_prd==0){
                    ?>
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">No product sold</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                    // }else{
                    ?>
                    
                    <div class="panel-heading">
                        <div class="pull-left">
                            <?php
                            // if($count_prd==1){
                            // ?>
                            // <h6 class="panel-title txt-dark">top sold products</h6>
                            // <?php
                            // }else{
                            // ?>
                            // <h6 class="panel-title txt-dark">top <?//=$count_prd;?> sold products</h6>
                            // <?php
                            // }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row">
                            <div class="col-sm-6 pa-0">
                                <canvas id="chart_7" height="164"></canvas>
                            </div>
                            <div class="col-sm-6 pr-0 pt-25">
                                <div class="label-chatrs">
                                    
                                    <?php
                                    // $s_n=1;
                                    // foreach($prd_info->result() as $most_sold_prd_row){
                                    ?>
                                    <div class="mb-5">
                                        <span class="clabels inline-block <?php //if($s_n==1){echo 'bg-yellow';}else if($s_n==2){echo 'bg-pink';}else if($s_n==3){echo 'bg-blue';}else if($s_n==4){echo 'bg-red';}else if($s_n==5){echo 'bg-green';}?> mr-5"></span>
                                        <span class="clabels-text font-12 inline-block txt-dark capitalize-font"><?//=$most_sold_prd_row->product_name;?><?php// $s_n++;?></span>
                                    </div>
                                    <?php
                                    // }
                                    ?>

                                </div>
                            </div>
                            <?php
                            /*if($count_prd=5){
                            ?>
                            <div class="col-xs-12 text-center"><a href="javascript:void(0);" class="prd_statistic_link">view all product statistics <i class="ti-angle-double-down"></i></a></div>
                            <?php }*//* ?>
                        </div>	
                    </div>
                    
                    <?php
                    // }
                    ?>
                    
                </div>
                
            </div>
            <!--top 5 sold product .end-->
            <?php
            }*/
            ?>
        </div>	
        <!-- Row -->
        
        <?php
        /*{
        ?>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">sales analytics</h6>
                        </div>
                        <div class="pull-right">
                            <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                                <select class="selectpicker" id="month" data-style="form-control">
                                    <?php
                                    // //get date order of each wholesaler
                                    // $this->db->where('order_to', $this->session->userdata('unique_user_id'));
                                    
                                    // $this->db->group_start();
                                    // $this->db->where('status', 'proccessing');
                                    // $this->db->or_where('status', 'completed');
                                    // $this->db->group_end();
                                    
                                    // $order_month=$this->db->get('orders');
                                    // $count_order_month=$order_month->num_rows();
                                    // if($count_order_month!=0){
                                    ?>
                                    <option selected value="no month" style="display: none;">select month..</option>
                                    <option value='01'>January</option>
                                    <option value='02'>February</option>
                                    <option value='03'>March</option>
                                    <option value='04'>April</option>
                                    <option value='05'>May</option>
                                    <option value='06'>June</option>
                                    <option value='07'>July</option>
                                    <option value='08'>August</option>
                                    <option value='09'>September</option>
                                    <option value='10'>October</option>
                                    <option value='11'>November</option>
                                    <option value='12'>December</option>
                                    <?php
                                    // }else{
                                    ?>
                                    <option selected value="no month" style="display: ;">month</option>
                                    <?php
                                    // }
                                    ?>
                                </select>
                            </div>	
                            
                            <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                                <select class="selectpicker" id="year" data-style="form-control">
                                    <?php
                                    //get date order of each wholesaler
                                    // $this->db->where('order_to', $this->session->userdata('unique_user_id'));
                                    
                                    // $this->db->group_start();
                                    // $this->db->where('status', 'proccessing');
                                    // $this->db->or_where('status', 'completed');
                                    // $this->db->group_end();
                                    
                                    // $this->db->group_by('YEAR(date_ordered)');
                                    // $this->db->order_by('date_ordered', 'desc');
                                    // $order_date=$this->db->get('orders');
                                    // $count_order_date=$order_date->num_rows();
                                    
                                    // if($count_order_date!=0){
                                    //     foreach($order_date->result() as $date_row){
                                    //         $orderDate=$date_row->date_ordered;
                                    //         //convert time to timestamp
                                    //         $orderDate_timestamp=strtotime($orderDate);
                                    //         //convert timestamp to year format
                                    //         $order_year=date('Y', $orderDate_timestamp);
                                    ?>
                                    <option value='<?//=$order_year;?>'><?//=$order_year;?></option>
                                    <?php
                                    //     }
                                    // }else{
                                    //     $current_yr=date('Y');
                                    ?>
                                    <option value=''>year</option>
                                    <?php
                                    // }
                                    ?>
                                </select>
                            </div>
                            <a href="#" class="pull-left inline-block full-screen">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <ul class="flex-stat mb-10 ml-15">
                                <!--<li class="text-left auto-width mr-60">
                                    <span class="block">Traffic</span>
                                    <span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
                                    <span class="block txt-success mt-5">
                                        <i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+15%</span>
                                    </span>
                                    <div class="clearfix"></div>
                                </li>-->
                                <li class="text-left auto-width mr-30">
                                    <span class="block">Orders</span>
                                    <span class="block txt-dark weight-500 font-18"><span class="orders_number">0</span></span>
                                    <span class="block txt-success mt-5">
                                        <!--<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+4%</span>-->
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                
                                <li class="text-left auto-width mr-30">
                                    <span class="block">Service fee</span>
                                    <span class="block txt-dark weight-500 font-18"><span class="service_fee">Tsh 0</span></span>
                                    <span class="block txt-success mt-5">
                                        <!--<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+4%</span>-->
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                
                                <li class="text-left auto-width">
                                    <span class="block">Revenue</span>
                                    <span class="block txt-dark weight-500 font-18"><span class="revenue_number">Tsh 0</span></span>
                                    <span class="block txt-danger mt-5">
                                        <!--<i class="zmdi zmdi-caret-down pr-5 font-20"></i><span class="weight-500">-5%</span>-->
                                    </span>
                                    <div class="clearfix"></div>
                                </li>
                                
                            </ul>
                            
                            <div class="text-center notification_div" style="display: ;"></div>
                            
                            <div id="chart_1" class="morris-chart" style="max-height:345px;">
                                <div class="text-center select_month_notification" style="padding: 10px; display: ;">
                                    <h6 style="font-weight: bold;">sales analytics graph</h6>
                                    <p class="text-muted">select month to view your daily sales</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /Row -->
        <?php
        }*/
        ?>

    </div>