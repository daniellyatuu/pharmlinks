<nav class="navbar navbar-inverse navbar-fixed-top">

<div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                
                <a href="javascript:void(0);" style = "cursor: default;">
                    <img class="brand-img hidden-xs" src="<?php echo base_url('assets/app');?>/dist/img/pl_logo.png" alt="brand"/>
                    <span class="brand-text">Pharmlinks</span>
                </a>
            </div>
        </div>

        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        
        <?php
        /*{
        ?>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        
        <form id="search_form" action="<?=base_url('RT_main/search');?>" method="post" role="search" class="top-nav-search collapse pull-left">
            <div class="input-group">
                <input type="text" name="seach_keyword" id="seach_keyword" class="form-control" value="<?php if(!empty($_GET['result'])){echo $_GET['result'];}?>" placeholder="Search for products...">
                <span class="input-group-btn">
                <button type="button" class="btn btn-default hidden-md hidden-lg" data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                <button type="submit" class="btn btn-default hidden-xs hidden-sm submit_btn"><i class="zmdi zmdi-search"></i></button>
                </span>
            </div>
        </form>
        <?php
        */
        ?>
        
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            
            <?php
            /*{
            ?>
            <li class="dropdown alert-drp">
                <a href="<?=base_url('Wallet_controller');?>"><i class="pe-7s-wallet top-nav-icon"></i>
                    <span class="">
                        <span  class="hidden-xs">
                price
                        </span>
                    </span>
                </a>
            </li>
            <?php
            }*/
            ?>
            
            <?php
            if($this->session->userdata('group')=='retailer' or $this->session->userdata('group')=='ADDO'){
            ?>
            <li class="dropdown alert-drp">
                <a href="<?=base_url('cart');?>"><i class="ti-shopping-cart top-nav-icon"></i>
                    <span class="top-nav-icon-badge">
                        <span id="div_cart">
                            <?php
                            if(!empty($this->cart->contents()))
                            {
                                $cart_count_row=count($this->cart->contents());
                                echo $cart_count_row;
                            }else{
                                echo '0';
                            }
                            ?>
                        </span>
                    </span>
                </a>
            </li>
            <?php
            }
            ?>
            
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url('assets/app');?>/img/profile/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li style="pointer-events: none;">
                        <a href="javascript:void(0);"><span style="text-transform: lowercase;">Hi, <?=$this->session->userdata('username');?></span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?=base_url('Main/my_profile');?>"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    
                    <?php
                    /*
                    ?>
                    <li>
                        <a href="<?=base_url('Wallet_controller');?>"><i class="pe-7s-wallet"></i><span>Wallet <span style="text-transform: lowercase;"><?='('.$this->session->userdata('user_reference_no').')';?></span></span></a>
                    </li>
                    <?php
                    */
                    ?>

                    <li>
                        <a href="<?=base_url('user/logout');?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </div>
</nav>