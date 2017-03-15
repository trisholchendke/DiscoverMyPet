<style>
.checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    

/*     .checkbox input[type="checkbox"]:focus + label::before { */
/*       outline: thin dotted; */
/*       outline: 5px auto -webkit-focus-ring-color; */
/*       outline-offset: -2px; } */
  
  
      

  .mail-env .mail-body .mail-compose .form-group label {
       position: relative !important;
    left: -4px !important;
    top: 0px !important;
    z-index: 10 !important;
}
</style>


<div class="row">

    <div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
        <h2 style="font-weight:500; margin:0px;color:#373e4a;font-family: inherit;line-height: 1.1;">
		<?php if($this->session->userdata('login_type') == "doctor"){ ?>
		<?php echo $this->db->get_where('doctor' , array('doctor_id' => $this->session->userdata('login_user_id') ))->row()->clinic_name; ?>
		<?} ?>
<?php if($this->session->userdata('login_type') == "doctor"){ ?>
<span  class="pull-right" style="font-weight:600;font-size:16px;"> <img class="img-circle profile_image" src="<?php echo base_url()."uploads/doctor_image/" . $this->db->get_where('doctor' , array('doctor_id' => $this->session->userdata('login_user_id') ))->row()->clinic_image; ?>"></span>
<?} ?>



    </div>

    <!-- Raw Links -->
    <div class="col-md-12 col-sm-12 clearfix ">

        <ul class="list-inline links-list pull-left">
            <!-- Language Selector -->			
            <li class="dropdown language-selector">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" style="cursor:text;text-transform: capitalize;">
                    <?php if($this->session->userdata('login_type') == "patient"){?>
                    <i class="entypo-user"></i> <?php echo 'pet'; ?>
                    
                    <?php }else{?>
                    <i class="entypo-user"></i> <?php echo $this->session->userdata('login_type'); ?>
                    
                    <?php };?>
                </a>
            </li>

            
            
            <!-- Message Notifications -->
            <?php if($this->session->userdata('login_type') == 'doctor' || $this->session->userdata('login_type') == 'patient') { ?>
            <li class="notifications dropdown">
                <?php
                $total_unread_message_number = 0;
                $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

                $this->db->where('sender', $current_user);
                $this->db->or_where('reciever', $current_user);
                $message_threads = $this->db->get('message_thread')->result_array();
                foreach ($message_threads as $row) {
                    $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                    $total_unread_message_number += $unread_message_number;
                }
                ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="cursor:text;text-transform: capitalize;">
                    <i class="entypo-mail"></i>
                    <?php if ($total_unread_message_number > 0): ?>
                        <span class="badge badge-info"><?php echo $total_unread_message_number; ?></span>
                    <?php endif; ?>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <ul class="dropdown-menu-list scroller">


                            <?php
                            $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
                            $this->db->where('sender', $current_user);
                            $this->db->or_where('reciever', $current_user);
                            $message_threads = $this->db->get('message_thread')->result_array();
                            foreach ($message_threads as $row):

                                // defining the user to show
                                if ($row['sender'] == $current_user)
                                    $user_to_show = explode('-', $row['reciever']);
                                if ($row['reciever'] == $current_user)
                                    $user_to_show = explode('-', $row['sender']);
                                $user_to_show_type = $user_to_show[0];
                                $user_to_show_id = $user_to_show[1];
                                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                                if ($unread_message_number == 0)
                                    continue;

                                // the last sent message from the opponent user
                                $this->db->order_by('timestamp', 'desc');
                                $last_message_row = $this->db->get_where('message', array('message_thread_code' => $row['message_thread_code']))->row();
                                $last_unread_message = $last_message_row->message;
                                $last_message_timestamp = $last_message_row->timestamp;
                                ?>
                                <li class="active">
                                    <a href="<?php echo base_url(); ?>index.php?<?php echo $this->session->userdata('login_type'); ?>/message/message_read/<?php echo $row['message_thread_code']; ?>">
                                        <span class="image pull-right">
                                            <img src="<?php echo $this->crud_model->get_image_url($user_to_show_type, $user_to_show_id); ?>" height="48" class="img-circle" />
                                        </span>

                                        <span class="line">
                                            <strong>
                                                <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
                                            </strong>
                                            - <?php echo date("d M, Y", $last_message_timestamp); ?>
                                        </span>

                                        <span class="line desc small">
                                            <!-- preview of the last unread message substring -->
                                            <?php
                                            echo substr($last_unread_message, 0, 50);
                                            ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li class="external">
                        <a href="<?php echo base_url(); ?>index.php?<?php echo $this->session->userdata('login_type'); ?>/message">
                            <?php echo get_phrase('view_all_messages'); ?>
                        </a>
                    </li>				
                </ul>
            </li>
            <?php } ?>
        </ul>


        <ul class="list-inline links-list pull-right">

            <li>
                <a href="<?php echo base_url(); ?>index.php?login/logout">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>
    </div>

</div>

<hr style="margin-top:0px;" />