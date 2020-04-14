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
    <script src="<?=base_url('assets/app/');?>/vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <?php
        }
    }
    ?>

</body>

</html>