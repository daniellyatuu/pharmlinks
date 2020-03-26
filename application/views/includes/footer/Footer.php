</div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <?php /*{ ?>
	<!-- Data table JavaScript -->
	<script src="<?//=base_url('assets/app');?>/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <?php }*/ ?>

	<!-- Slimscroll JavaScript -->
	<script src="<?=base_url('assets/app');?>/dist/js/jquery.slimscroll.js"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/moment/min/moment.min.js"></script>

    <?php /*{ ?>
	<script src="<?//=base_url('assets/app');?>/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="<?//=base_url('assets/app');?>/dist/js/simpleweather-data.js"></script>
    <?php }*/ ?>
    
	<!-- Progressbar Animation JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/chart.js/Chart.min.js"></script>
	
	<!-- EasyPieChart JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	<!-- Morris Charts JavaScript -->
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="<?=base_url('assets/app');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Bootstrap Select JavaScript -->
	<script src="<?=base_url('assets/app');?>/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="<?=base_url('assets/app');?>/dist/js/init.js"></script>

    <?php
    /*
    ?>
    <script>
        $(document).ready(function(){
            
            /*on change .start*/
            /* here remove
            $('#month, #year').change(function(){
                $('.no_purchases_found').hide('fast');
                $('#chart_1, .cost_price, .orders_number').empty();
                var hold_month=$('#month').val();
                var hold_year=$('#year').val();
                
                if(hold_month!='no month'){
                    $('.select_month_notification').html('');
                    //loader
                    $('.notification_div').html('<i class="fa fa-circle-o-notch fa-spin text-danger" style="font-size: 30px;"></i>');
                    
                    /*get sales history of each day .start*/
                    /* here remove
                    $.ajax({
                        method: "POST",
                        url: "<?=base_url();?>/RT_contents/purchasing_analytics_data",
                        dataType: "json",
                        data:{
                            month: hold_month,
                            yr: hold_year
                        },
                        cache: false,
                        success: function(purchasing_data){
                            setTimeout(function(){
                                $('.notification_div').html('');
                                if(purchasing_data!=''){
                                    $('.orders_number').html(purchasing_data.monthly_order_number);
                                    $('.cost_price').html(purchasing_data.monthly_order_price);
                                    $('.chart_1_data').html(purchasing_data.graph_arrow);
                                }else{
                                    $('.orders_number').html('0');
                                    $('.cost_price').html('Tsh 0');
                                    $('.notification_div').html('<h6 style="font-weight: bold;">No purchases found on this month</h6><p class="text-muted">Select another month to see your daily purchases</p>');
                                }
                            }, 1000);
                            
                        },
                        error: function(){
                            alert('error in loading purchases analytics graph');
                        }
                    });
                    /*get sales history of each day .end*/

                    /*here remove
                    
                }else{
                    alert('select month');
                }
                
            });
            /*on change .end*/
            /*here remove
            
        });
    </script>

    <!-- chart_1 script -->
    <div class="chart_1_data">
        
    </div>

	<script>
        /*Dashboard2 Init*/
        /*here remove
        "use strict"; 
        
        /*****Ready function start*****/
        /*here remove
        $(document).ready(function(){
            <?php
            $this->db->where('order_from', $this->session->userdata('unique_user_id'));
            $this->db->where('status!=', 'init');
            $this->db->where('status!=', 'rtl_cancel');
            $this->db->where('status!=', 'auto_cancel');
            $this->db->select('productid, COUNT(productid) AS countNumber', false);
            $this->db->from('orders');
            $this->db->group_by('orders.productid');
            $this->db->order_by('countNumber','desc');
            $this->db->limit(5);
            $items = $this->db->get();
            ?>
            if( $('#chart_7').length > 0 ){
                var ctx7 = document.getElementById("chart_7").getContext("2d");
                var data7 = {
                     labels: [
                         <?php
                         foreach($items->result() as $ids){
                            $top_sold_prd=$ids->productid;
                            $total_no_sold=$ids->countNumber;

                            //get product info
                            $this->db->where('product_ID', $top_sold_prd);
                            $get_products_info=$this->db->get('stocks');
                            foreach($get_products_info->result() as $stock_row){
                                echo '"'.$stock_row->product_name.'",';
                            }
                        }
                         ?>
                     ],
                datasets: [
                    {
                        data: [
                            <?php
                            foreach($items->result() as $ids){
                                $top_sold_prd=$ids->productid;
                                $total_no_sold=$ids->countNumber;
                                echo $total_no_sold.',';
                            }
                            ?>
                              ],
                        backgroundColor: [
                            "rgba(230,154,42,1)",
                            "rgba(220,70,102,1)",
                            "rgba(23,126,193,1)",
                            "rgba(234,108,65,1)",
                            "rgba(70,148,8,1)"
                            
                        ],
                        hoverBackgroundColor: [
                            "rgba(230,154,42,1)",
                            "rgba(220,70,102,1)",
                            "rgba(23,126,193,1)",
                            "rgba(234,108,65,1)",
                            "rgba(70,148,8,1)"
                            
                        ]
                    }]
                };

                var doughnutChart = new Chart(ctx7, {
                    type: 'doughnut',
                    data: data7,
                    options: {
                        animation: {
                            duration:	3000
                        },
                        elements: {
                            arc: {
                                borderWidth: 0
                            }
                        },
                        responsive: true,
                        maintainAspectRatio:false,
                        percentageInnerCutout: 50,
                        legend: {
                            display:false
                        },
                        tooltips: {
                            backgroundColor:'rgba(33,33,33,1)',
                            cornerRadius:0,
                            footerFontFamily:"'Roboto'"
                        },
                        cutoutPercentage: 70,
                        segmentShowStroke: false
                    }
                });
            }	

            if( $('#chart_8').length > 0 ){
                var ctx7 = document.getElementById("chart_8").getContext("2d");
                var data7 = {
                     labels: [
                    "lab 1",
                    "lab 2",
                    "lab 3",
                    "lab 4"
                ],
                datasets: [
                    {
                        data: [80,40,20, 50],
                        backgroundColor: [
                            "rgba(220,70,102,1)",
                            "rgba(23,126,193,1)",
                            "rgba(234,108,65,1)",
                            "rgba(230,154,42,1)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(220,70,102,1)",
                            "rgba(70,148,8,1)",
                            "rgba(234,108,65,1)",
                            "rgba(230,154,42,1)"
                        ]
                    }]
                };

                var pieChart  = new Chart(ctx7,{
                    type: 'pie',
                    data: data7,
                    options: {
                        animation: {
                            duration:	3000
                        },
                        responsive: true,
                        maintainAspectRatio:false,
                        legend: {
                            display:false
                        },
                        elements: {
                            arc: {
                                borderWidth: 0
                            }
                        },
                        tooltips: {
                            backgroundColor:'rgba(33,33,33,1)',
                            cornerRadius:0,
                            footerFontFamily:"'Roboto'"
                        }
                    }
                });

                }	

            if( $('#pie_chart_4').length > 0 ){
                $('#pie_chart_4').easyPieChart({
                    barColor : '#469408',
                    lineWidth: 20,
                    animate: 3000,
                    size:	165,
                    lineCap: 'square',
                    trackColor: 'rgba(33,33,33,0.1)',
                    scaleColor: false,
                    onStep: function(from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent));
                    }
                });
            }

            if( $('#datable_1').length > 0 )
                $('#datable_1').DataTable({
                    "bFilter": false,
                    "bLengthChange": false,
                    "bPaginate": false,
                    "bInfo": false,

                });
        });
        /*****Ready function end*****/
        /*here remove

        <?php
            if(!empty($this->session->userdata('user')) && isset($_REQUEST['user_login']))
            {

        ?>
        /*****Load function start*****/
        /*here remove
        $(window).load(function(){
            window.setTimeout(function(){
                $.toast({
                    heading: 'Welcome <?php echo $this->session->userdata('f_name'); echo ' '; echo $this->session->userdata('l_name');?>',
                    text: 'Your satisfaction is our priority.',
                    position: 'top-right',
                    loaderBg:'#e69a2a',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            }, 3000);
        });
        /*****Load function* end*****/
        /*here remove
        <?php } ?>

        /*****Sparkline function start*****/
        /*here remove
        var sparklineLogin = function() { 
                if( $('#sparkline_4').length > 0 ){
                    $("#sparkline_4").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
                        type: 'line',
                        width: '100%',
                        height: '45',
                        lineColor: '#e69a2a',
                        fillColor: '#e69a2a',
                        maxSpotColor: '#e69a2a',
                        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
                        highlightSpotColor: '#e69a2a'
                    });
                }	
                if( $('#sparkline_5').length > 0 ){
                    $("#sparkline_5").sparkline([0,2,8,6,8], {
                        type: 'bar',
                        width: '100%',
                        height: '45',
                        barWidth: '10',
                        resize: true,
                        barSpacing: '10',
                        barColor: '#469408',
                        highlightSpotColor: '#469408'
                    });
                }	
                if( $('#sparkline_6').length > 0 ){
                    $("#sparkline_6").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40, 45, 56, 7, 10], {
                        type: 'line',
                        width: '100%',
                        height: '50',
                        lineColor: 'rgb(234,108,65)',
                        fillColor: 'transparent',
                        spotColor: '#fff',
                        minSpotColor: undefined,
                        maxSpotColor: undefined,
                        highlightSpotColor: undefined,
                        highlightLineColor: undefined
                    });
                }
            }
            var sparkResize;
        /*****Sparkline function end*****/
        /*here remove

        $(window).resize(function(e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineLogin, 200);
        });
        sparklineLogin();
    </script>
    <script>
        $(document).ready(function(){
            //validate search field
            $('#search_form').submit(function(search){
                var searched_data=$('#seach_keyword').val();
                if(searched_data==''){
                    search.preventDefault();
                }
            });
        });
    </script>
    <?php
    */
    ?>
</body>

</html>