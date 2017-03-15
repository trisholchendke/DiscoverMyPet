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

        <div class="sui-normal">
            <a href="#" class="user-link">

                <span><?php echo get_phrase('welcome'); ?>,</span>
                <strong><?php
                    echo $this->db->get_where('users', array('id' =>
                        $this->session->userdata('login_user_id')))->row()->name;
                    ?>
                </strong>
            </a>
        </div>

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
            <a href="<?php echo base_url(); ?>index.php?receptionist">
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
                        <a href="<?php echo base_url(); ?>index.php?receptionist/appointment">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('appointment_list'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manage_requested_appointment') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>index.php?receptionist/appointment_requested">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('requested_appointments'); ?></span>
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
                <li class="<?php if ($page_name == 'manage_medicine_category') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/medicine_category" >
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('main_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_medicine_sub_category') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/medicine_sub_category">
                          <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('sub_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'stock') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?receptionist/stock">
                <i class="fa fa-medkit"></i>
                <span><?php echo get_phrase('manage_Stock'); ?></span>
            </a>
        </li>
            </ul>
        </li>
        
         <li class="<?php if ($page_name == 'add_invoice' || $page_name == 'manage_invoice') echo 'opened active has-sub'; ?> ">
            <a href="#">
                <i class="fa fa-file-text" aria-hidden="true" style="
    margin-right: 10px;
"></i>
                <span><?php echo get_phrase('invoice_and_prescription'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'add_invoice') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/invoice_add">
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('add_invoice'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_invoice') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/invoice_manage">
                        <i class="fa fa-align-justify"></i>
                        <span><?php echo get_phrase('manage_invoice'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php if ($page_name == 'supplier') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?receptionist/supplier">
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
                    <a href="<?php echo base_url(); ?>index.php?receptionist/add_staff">
                        <i class="fa fa-plus"></i>
                        <span><?php echo get_phrase('add_staff'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_staff') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/manage_staff">
                        <i class="fa fa-align-justify"></i>
                        <span><?php echo get_phrase('manage_staff'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'staff_message') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/staff_message">
                        <i class="entypo-mail" style="margin-left: -4px;"></i>
                        <span><?php echo get_phrase('staff_messageing'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php if ($page_name == 'manage_patient' ||
            ($page_name == 'manage_prescription' && $menu_check == 'from_patient')) echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?receptionist/patient">
                   <img src="assets/images/dog.png" class="supplier_icon">
                    <span><?php echo get_phrase('pet'); ?></span>
                </a>
        </li>
        
       
        
        
        <li class="<?php if ($page_name == 'medical_health_record') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?receptionist/medical_health_record">
              <img src="assets/images/medical-records.png" class="medical_health_record_icon">
                <span><?php echo get_phrase('medical_health_record'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'manage_blood_bank' || $page_name == 'manage_blood_donor') echo 'opened active has-sub'; ?> ">
            <a href="#">
                <i class="fa fa-tint" style="margin-right: 10px;"></i>
                <span><?php echo get_phrase('blood_bank'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'manage_blood_bank') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/blood_bank">
                        <i class="fa fa-tint"></i>
                        <span><?php echo get_phrase('manage_blood_bank'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_blood_donor') echo 'active'; ?>">
                    <a href="<?php echo base_url(); ?>index.php?receptionist/blood_donor">
                        <i class="fa fa-user"></i>
                        <span><?php echo get_phrase('blood_donor'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="<?php if ($page_name == 'manage_report') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?receptionist/report">
                <i class="fa fa-hospital-o" style="    margin-right: 9px;"></i>
                <span><?php echo get_phrase('report'); ?></span>
            </a>
        </li>
        
        <!-- MESSAGE -->
        <li>
              <a href="<?php echo base_url(); ?>index.php?receptionist/message">
               <i class="entypo-mail" style="margin-left: -4px;"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>
        
        <li class="<?php if ($page_name == 'edit_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?receptionist/profile">
                <i class="entypo-lock" style="margin-left: -3px;"></i>
                <span><?php echo get_phrase('profile'); ?></span>
            </a>
        </li>
        
        
       
        
        
    </ul>

</div>