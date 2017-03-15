<?php $patient = $this->db->get_where('patient' , array('user_id' => $this->session->userdata('login_user_id') ))->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_appointment'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"
                    action="<?php echo base_url(); ?>index.php?receptionist/appointment/create" method="post">

 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('appointment_type'); ?></label>
                        <div class="col-sm-7">
                            <select id="appointment_type" name="appointment_type" class="form-control">
                            	<option value="" disabled selected><?php echo get_phrase('select_option'); ?></option>
                            	<option>Consultation</option>
                            	<option>Boarding</option>
                            	<option>Vaccination</option>
                            	<option>Deworming</option>
                            	<option>Parasite Control</option>
                            </select>
                        </div>
                    </div>
 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('pet_name'); ?></label>

                        <div class="col-sm-7">
                            <select id="selected_patient" name="patient_id" class="select2">
                                <option value=""><?php echo get_phrase('select_pet_name'); ?></option>
                                <?php foreach ($patient as $row) { ?>
                                        <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?>-<?php echo $row['owner_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('(date/time)'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                                <input type="text" name="time_timestamp" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:00 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here">
                            </div>
                        </div>
                    </div>
                    
                    
  					<div class="form-group" id="bording_number">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('boarding_number'); ?></label>

                        <div class="col-sm-7">
                        <input type="text" name="bording_number" class="form-control" placeholder="Boarding Number">
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <input id="notify" type="checkbox" id="notify" name="notify" value="checked" checked>
                            <label class="control-label" for="notify"><?php echo get_phrase('notify_pet_with_') . 'SMS'; ?></label>
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script>
$(document).ready(function(){

	jQuery("#submit").prop("disabled", true);
	jQuery("#bording_number").hide();
	validate = function (){
		if($('#appointment_type').val() != "" && $('#notify').val() != "" && $('#selected_patient').val() != "" && $('input[name=date_timestamp]').val() != "" && $('input[name=time_timestamp]').val() != ""){
				jQuery("#submit").prop("disabled", false);
			}
	}
	$('input[name=date_timestamp').change(function () {
		validate();
	});
	
	$('input[name=time_timestamp').change(function () {
		validate();
	});
	
	$('#selected_patient').change(function(){
		 validate();
	});
	
	$('#appointment_type').change(function(){
		 if($('#appointment_type').val() == "Boarding"){
					jQuery("#bording_number").show();
			 }else{
					jQuery("#bording_number").hide();
				 }
	});
	
	$('#notify').change(function(){
		 validate();
	});
	
	$('#submit').click(function(){
		
	});
})
	</script>
	