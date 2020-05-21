<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg hide_on_print">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                <li><a href="javascript:void()0;">Dashboard</a></li>
                <li class="active"><span>product-orders</span></li>
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
                            $order='';
                            $catgory='';
                            if($_GET){
                                $sort = $_GET['sort'];
                                $order = $_GET['order'];
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
                                
                                <input type="text" name="order" class="form-control"
                                        placeholder="search..." value="<?=$order;?>">
                                </div>
                                <div class="col-md-4" style="margin: 5px 0;">
                                    <select class="form-control" name="category">
                                    <option value="">all categories</option>
                                        <?php
                                        foreach($status as $status_row){
                                        ?>
                                        <option value="<?=$status_row->id;?>" <?php if($catgory==$status_row->id){echo 'selected';}?>><?=$status_row->name;?></option>
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
                </div>
            </div>
        </div>
        <!-- filter ./end -->
        
        <?php
        if($order_no>0){
            echo $pagermessage;
        ?>
        <div class="row">
            
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table display responsive product-overview mb-30" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Order id</th>
                                                
                                                <th class="text-center">From</th>

                                                <th class="text-center">Price</th>
                                                
                                                <th class="text-center">Date ordered</th>
                                                
                                                <th class="text-center hide_on_print">Status</th>
                                                
                                                <th class="text-right hide_on_print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="display_orders">
                                            <?php
                                            foreach($orderdata as $order_row){
                                                $order_id = $order_row->id;
                                                $order_number = $order_row->order_number;
                                                $from = $order_row->from;
                                                $date_ordered = $order_row->date_ordered;

                                                //convert datetime to timestamp
                                                $date_order_timestamp=strtotime($date_ordered);
                                            ?>
                                            <tr>
                                                <td class="txt-dark"><?=$order_number;?></td>
                                                
                                                <td class="text-center">
                                                <?php
                                                // order from data
                                                $this->db->where('user', $from);
                                                $pharmacy_data = $this->db->get('pharmacy');
                                                foreach($pharmacy_data->result() as $pharmacy_row){
                                                    $pharmacy_name = $pharmacy_row->name;
                                                }
                                                echo $pharmacy_name;
                                                ?>
                                                </td>

                                                <td class="text-center">
                                                <?php
                                                // get order content
                                                $this->db->where('order_id', $order_id);
                                                $order_content = $this->db->get('order_content');
                                                $order_price = 0;
                                                foreach($order_content->result() as $order_content_row){
                                                    $price = $order_content_row->price;
                                                    $status_id = $order_content_row->status_id;
                                                    $order_price += $price;
                                                }
                                                echo 'Tsh '.number_format($order_price);
                                                ?>
                                                </td>
                                                <td class="text-center">
                                                <?php
                                                echo date('M d, Y H:i', $date_order_timestamp);
                                                ?>
                                                
                                                </td>
                                                
                                                <td class="text-center">
                                                <?php
                                                    // get status name
                                                    $this->db->where('id', $status_id);
                                                    $get_status = $this->db->get('order_status');
                                                    foreach($get_status->result() as $status_row){
                                                        $status_name = $status_row->name;
                                                    }
                                                    if($status_name=='pending'){
                                                    ?>
                                                    <span class="label label-default" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                    <?php
                                                    }else if($status_name=='processing'){
                                                    ?>
                                                    <span class="label label-info" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                    <?php
                                                    }else if($status_name=='complete'){
                                                    ?>
                                                    <span class="label label-success" style="cursor: default; margin: 0 3px;"><?=$status_name;?> </span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                
                                                <td class="text-right">
                                                <a class="btn btn-xs btn-default btn-outline" href="<?=base_url('w_order/invoice').'/'.$order_id;?>">view</a>
                                                <?php
                                                if($status_name=='pending'){
                                                ?>
                                                <a class="btn btn-xs btn-success btn-outline" href="<?=base_url('w_order/accept').'/'.$order_id;?>">Accept</a>
                                                <?php } ?>
                                                </td>

                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?=$links;?>
            </div>
        </div>
        <!-- /Row -->
        
        <?php
        }else{
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel text-center" style="padding: 30px 10px;">
                    <h6 style="font-weight: bold;">No results found</h6>
                    <!-- <p class="text-muted">Try different keywords</p> -->
                </div>
            </div>
        </div>
        <?php } ?>

    </div>