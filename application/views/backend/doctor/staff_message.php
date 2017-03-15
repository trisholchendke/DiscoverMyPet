<hr />
<div class="mail-env">

    <!-- Mail Body -->
    <div class="mail-body">

        <!-- message page body -->
        
<?php  
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    
    $this->db->from("users");
    $data =  $this->db->count_all_results();
    
    if ($data == 0){ ?>
     <h3>Please Add Staff, To Send Email</h3>
<?php }else{ ?>

<?php include $message_inner_page_name . '.php'; ?>

<?php }; ?>
    </div>

    <!-- Sidebar -->
    <div class="mail-sidebar" style="min-height: 800px;" >
            <a href="<?php echo base_url(); ?>index.php?doctor/staff_message/staff_message_new" class="btn btn-success btn-icon btn-block">
                <?php echo get_phrase('new_message'); ?>
                <i class="entypo-pencil"></i>
            </a>
        </div>


    </div>
</div>

        <!-- compose new email button -->

        


</div>