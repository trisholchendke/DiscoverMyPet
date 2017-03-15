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

<div class="mail-header" style="padding-bottom: 27px ;">
    <!-- title -->
    <h3 class="mail-title">
        <?php echo get_phrase('write_new_message'); ?>
    </h3>
</div>

<div class="mail-compose">

    <?php echo form_open('dog_walker/staff_message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
	

    <div class="form-group">
        <label for="subject"><?php echo get_phrase('select_option'); ?>:</label>
        <br><br>
        <select class="form-control" id="selected_mail_option" name="selected_mail_option">
			<option>- Select An Option -</option>
			<option>All Staff</option>
			<option>Perticular staff</option>
        </select>
    </div>
    
    <div class="form-group" id="select_user">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        	<?php
                $staff = $this->db->get_where('users',array('user_id' => $this->session->userdata('login_user_id')))->result_array();
                    foreach ($staff as $row) { ?>
 
                  
    <label class="checkbox-inline">
      <input   type="checkbox"  value="<?php echo $row['id']?>" name="reciever[]"><?php echo $row['name']?>
    </label>
 
 
                  
               
                <?php } ?>
                
    </div>


    <div class="compose-message-editor">
<!--     <textarea row="5" name="message" rows="" cols="" id="message"></textarea> -->
        <textarea  row="5" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" 
            name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>" 
            id="message"></textarea>
    </div>

    <hr>

    <button id="send" type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>

    </button>
</form>

</div>
<script>
	$(document).ready(function(){
		$('#send').prop('disabled',true);
		$('#select_user').hide();
		
		$('#selected_mail_option').change(function(){
			if($('#selected_mail_option').val() == "Perticular staff"){
				validate1();
				$('#select_user').show();
				
			}else{
				validate();
				$('#select_user').hide();
				
			}
		});
		$('#reciever').change(function(){
			validate1();
		});
		$('#message').keyup(function(){
			validate1();
			validate();
		});
		$('input[name=message').keyup(function () {
			validate();
		});
		

		validate = function (){
			if($('#selected_mail_option').val() != ""){
					$('#send').prop('disabled',false);
			}else{
				$('#send').prop('disabled',true);
			}
		}
		validate1 = function (){
			if($('#selected_mail_option').val() != "" && $('#reciever').val() != ""){
					$('#send').prop('disabled',false);
			}else{
				$('#send').prop('disabled',true);
			}
		}
	})
</script>