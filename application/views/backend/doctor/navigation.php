<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="assets/images/discovermypet_logo.png" class="discovermypet_logo_inner"  style="max-height:60px;"/>
            </a>

        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div class="sidebar-user-info">
<?php if($this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->profile_image !== NULL) { ?>


        <div class="sui-normal">
            <a href="#" class="user-link">
                <img src="<?php echo base_url()."uploads/doctor_image/"; ?><?php echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->profile_image ?>" alt="" class="img-circle profile_image">

                <span><?php echo get_phrase('welcome'); ?>,</span>
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

<?php }else{ ?>
<div class="sui-normal">
            <a href="#" class="user-link">
                <img src="<?php echo base_url()."uploads/user.jpg"; ?>" alt="" class="img-circle profile_image">

                <span><?php echo get_phrase('welcome'); ?>,</span>
                <strong><?php
                    echo $this->db->get_where($this->session->userdata('login_type'), array($this->session->userdata('login_type') . '_id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

<?php } ?>

        <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->				
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/profile">
                <i class="entypo-pencil"></i>
                <?php echo get_phrase('edit_profile'); ?>
            </a>

            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/profile">
                <i class="entypo-lock"></i>
                <?php echo get_phrase('change_password'); ?>
            </a>

            <span class="close-sui-popup">×</span><!-- this is mandatory -->			
        </div>
    </div>


    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor">
                <i class="fa fa-desktop"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_appointment' || $page_name == 'manage_requested_appointment') 
            echo 'opened active';?> ">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span><?php echo get_phrase('appointment'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_appointment') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/appointment">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('appointment_list'); ?></span>
                        </a>
                    </li>
                   
                </ul>
        </li>
         <li class="<?php if ($page_name == 'manage_patient' ||
            ($page_name == 'manage_prescription' && $menu_check == 'from_patient')) echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?doctor/patient">
                   <img src="assets/images/dog.png" class="supplier_icon">
                    <span><?php echo get_phrase('pet'); ?></span>
                </a>
        </li>
        <li class="<?php if ($page_name == 'medical_health_record') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/medical_health_record">
              <img src="assets/images/medical-records.png" class="medical_health_record_icon">
                <span><?php echo get_phrase('medical_health_record'); ?></span>
            </a>
        </li>
        
          <li class="<?php if ($page_name == 'add_invoice' || $page_name == 'manage_invoice') echo 'opened active has-sub'; ?> ">
            <a href="#">
                <i class="fa fa-file-text" aria-hidden="true" style="
    margin-right: 10px;
"></i>
                <span><?php echo get_phrase('invoice'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_invoice') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/invoice_add">
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('add_invoice'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_invoice') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/invoice_manage">
                        <i class="fa fa-align-justify"></i>
                        <span><?php echo get_phrase('manage_invoice'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        
          <li class="<?php if ($page_name == 'manage_prescription' || $page_name == 'manage_prescription') echo 'opened active has-sub'; ?> ">
            <a href="#">
                  <i class="fa fa-stethoscope"></i>
                <span><?php echo get_phrase('prescription'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_prescription') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/add_prescription">
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('add_prescription'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_prescription') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/prescription">
                        <i class="fa fa-align-justify"></i>
                        <span><?php echo get_phrase('manage_prescription'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        
        
        
        <li class="<?php if ($page_name == 'manage_medicine_category' || $page_name == 'manage_medicine_sub_category') echo 'opened active has-sub'; ?> ">
            <a href="#">
               <i class="fa fa-cubes" aria-hidden="true"    style=" margin-left: -2px;"></i>
                <span><?php echo get_phrase('stock'); ?></span>
            </a>
            <ul>
               <li class="<?php if ($page_name == 'add_product') echo 'active'; ?>">
                    <a onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/add_medicine/');">
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('add_product'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_medicine_category') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/medicine_category" >
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('main_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_medicine_sub_category') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/medicine_sub_category">
                          <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('sub_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'stock') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/stock">
                <i class="fa fa-medkit"></i>
                <span><?php echo get_phrase('manage_Stock'); ?></span>
            </a>
        </li>
            </ul>
        </li>
        
       
        <li class="<?php if ($page_name == 'supplier') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/supplier">
               <img src="assets/images/supplier.png" class="supplier_icon">
                <span><?php echo get_phrase('supplier'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'add_staff' || $page_name == 'manage_staff') echo 'opened active has-sub'; ?> ">
            <a href="#">
               <i class="fa fa-users" aria-hidden="true"     style="margin-left: -2px;"></i>
                <span><?php echo get_phrase('staff'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_staff') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/add_staff">
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('add_staff'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_staff') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
                        <i class="fa fa-align-justify"></i>
                        <span><?php echo get_phrase('manage_staff'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'staff_message') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?doctor/staff_message">
                        <i class="entypo-mail" style="margin-left: -4px;"></i>
                        <span><?php echo get_phrase('staff_messageing'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
       
        
       
        <li class="<?php if ($page_name == 'manage_report' || $page_name == 'manage_report') 
            echo 'opened active';?> ">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span><?php echo get_phrase('report'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'manage_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/report">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('report'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'invoice_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/invoice_manage">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('sales_report'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'stock_report') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?doctor/stock_report">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('stock_report'); ?></span>
                        </a>
                    </li>
                </ul>
        </li>
        
        <li>
              <a href="<?php echo base_url(); ?>index.php?doctor/message">
               <i class="entypo-mail" style="margin-left: -4px;"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'edit_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/profile">
                <i class="entypo-lock" style="margin-left: -3px;"></i>
                <span><?php echo get_phrase('profile'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'notification') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?doctor/notification">
<i class="fa fa-bell" aria-hidden="true" style="margin-right: 9px;"></i>
             
                <span><?php echo get_phrase('notification'); ?></span>
            </a>
        </li>
        
        
       
        
        
    </ul>

</div>