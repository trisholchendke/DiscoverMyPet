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
<?php  
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    
    $this->db->from("patient");
    $data =  $this->db->count_all_results();
    
    if ($data == 0){ ?>
     <h3>Please Add Pet, To Send Email</h3>
<?php }else{ ?>

<?php echo form_open('doctor/message/send_new/', array('class' => 'form','enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control" name="reciever" onchange="selected_option(this)" required>
            <option value="" selected disabled><?php echo get_phrase('select_option'); ?></option>
            <option>Multiple Pet</option>
            <option>Single Pet</option>
        </select>
    </div>
    <div class="form-group" id="multiple_pet">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        	<?php
                $pet = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
                    foreach ($pet as $row) { ?>
 
                  
    <label class="checkbox-inline">
      <input   id="checked_pet" type="checkbox"   value="patient-<?php echo $row['patient_id']; ?>" name="reciever1[]"><?php echo $row['name']?>
    </label>
 
 
                  
               
                <?php } ?>
    </div>
    <div class="form-group" id="single_pet">
        <label for="subject"><?php echo get_phrase('recipient'); ?>:</label>
        <br><br>
        <select class="form-control select2" id="reciever" name="reciever" required>

            <option value=""><?php echo get_phrase('select_a_pet'); ?></option>
            <optgroup label="<?php echo get_phrase('pet'); ?>">
                <?php
                    $patient_info = $this->db->get_where('patient', array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array();
                    foreach ($patient_info as $row) { ?>

                        <option value="patient-<?php echo $row['patient_id']; ?>">
                            - <?php echo $row['name']; ?></option>

                <?php }  ?>
            </optgroup>
        </select>
    </div>


    <div>
        <textarea row="5" class="form-control" name="message" placeholder="<?php echo get_phrase('write_your_message'); ?>"  
            required></textarea>
    </div>

    <hr>

    <button id="myForm" type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('send'); ?>
        <i class="entypo-mail"></i>

    </button>
</form>

<?php }; ?>

    

</div>

<script type="text/javascript">
    
	$(document).ready(function(){

		$('#multiple_pet').hide();
		$('#single_pet').hide();
	 });
 
	 var selected_option = function(selectedItem){
	    if(selectedItem.value == "Multiple Pet"){
            var telefono = document.getElementById("reciever");  
            telefono.removeAttribute("required");
	    	$('#multiple_pet').show();
	    	 $('#single_pet').hide();
	     }else{
	    	 $('#single_pet').show();
	    	 $('#multiple_pet').hide();
	     }
	 }
</script>
