<style>
.modal-dialog{
    width: 50% !important;
}
.modal{
top:0px !important;
}
.modal-body{
    height: 395px !important;
}
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>

<?php
$patient_info = $this->db->get('patient')->result_array();
$single_appointment_info = $this->db->get_where('appointment', array('appointment_id' => $param2))->result_array();
foreach ($single_appointment_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_appointment'); ?></h3>
                    </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" 
                        action="<?php echo base_url(); ?>index.php?doctor/appointment/update/<?php echo $row['appointment_id']; ?>" 
                        method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('appointment_type'); ?></label>
                        <div class="col-sm-7">
                            <select id="appointment_type" name="appointment_type" class="form-control">
                            	<option <?php if($row['appointment_type'] == "Consultation") echo "selected"?>>Consultation</option>
                            	<option <?php if($row['appointment_type'] == "Boarding") echo "selected"?>>Boarding</option>
                            	<option <?php if($row['appointment_type'] == "Vaccination") echo "selected"?>>Vaccination</option>
                            	<option <?php if($row['appointment_type'] == "Deworming") echo "selected"?>>Deworming</option>
                            	<option <?php if($row['appointment_type'] == "Parasite Control") echo "selected"?>>Parasite Control</option>
                            </select>
                        </div>
                    </div>
 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('pet_name'); ?></label>

                        <div class="col-sm-7">
                            <select id="selected_patient" name="patient_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_pet_name'); ?></option>
                                <?php foreach ($patient_info as $row1) { ?>
                                        <option value="<?php echo $row1['patient_id']; ?>" <?php if($row['patient_id'] == $row1['patient_id']) echo "selected"?>><?php echo $row1['name']; ?>-<?php echo $row1['parent_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
  					<div class="form-group" id="bording_number">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('boarding_number'); ?></label>

                        <div class="col-sm-7">
                        <input type="text" name="bording_number" class="form-control" placeholder="Boarding Number" value="<?php echo $row['bording_number']?>">
                        </div>
                    </div>
                      <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-7">
                                <div class="date-and-time">
                                    <input type="text" name="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                           placeholder="date here" value="<?php echo date("D, d M Y", $row['timestamp']); ?>">
                                    <input type="text" name="time_timestamp" class="form-control timepicker" data-template="dropdown" 
                                           data-show-seconds="false" data-default-time="00:05 AM" data-show-meridian="false" 
                                           data-minute-step="5"  placeholder="time here" value="<?php echo date("H:i", $row['timestamp']); ?>">
                                </div>
                            </div>
                        </div>
                    
                        
                        <div class="form-group">
                            <div class="col-sm-7 col-sm-offset-3">
                                <input type="checkbox" id="notify" name="notify" value="checked" checked>
                                <label class="control-label" for="notify"><?php echo get_phrase('notify_pet_with_') . 'SMS'; ?></label>
                            </div>
                        </div>

<div class="text-center">
                       <div class="row control-label text-center" style="margin-top:15px;text-align:center !important;">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
</div>
                    </form>
 
                </div>

            </div>

        </div>
    </div>
<?php } ?>
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