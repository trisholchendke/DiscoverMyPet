<?php
$messages = $this->db->get_where('message', array('message_thread_code' => $current_message_thread_code))->result_array();
foreach ($messages as $row):

    $sender = explode('-', $row['sender']);
    $sender_account_type = $sender[0];
    $sender_id = $sender[1];

    ?>
    <div class="mail-info">

        <div class="mail-sender " style="padding:7px;">

<?php if($sender_account_type == "patient"){?>  

<?php }else{ ?> 
<?php if($this->db->get_where('doctor' , array('doctor_id' => $sender_id ))->row()->profile_image !== NULL){ ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo base_url(); ?>/uploads/doctor_image/<?php $profile_image = $this->db->get_where('doctor' , array('doctor_id' => $sender_id ))->row()->profile_image;
                        echo $profile_image;?>" class="img-circle" width="30"> 
                <span><?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?></span>
            </a>

<?}else{?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php base_url(); ?>/uploads/user.jpg" class="img-circle" width="30"> 
                <span><?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?></span>
            </a>

<?php } ?>
<?php } ?>         



                
        </div>

        <div class="mail-date" style="padding:7px;">
            <?php echo date("d M, Y", $row['timestamp']); ?> 
        </div>

    </div>

    <div class="mail-text">			
        <p> <?php echo $row['message']; ?></p>
    </div>

<?php endforeach; ?>

<?php echo form_open('doctor/message/send_reply/' . $current_message_thread_code, array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
    <div>
        <textarea row="5" class="form-control"  name="message" 
                  placeholder="<?php echo get_phrase('reply_message'); ?>" required></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>
    </button>
    <br><br>
</div>
</form>