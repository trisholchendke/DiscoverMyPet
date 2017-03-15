<?php $doctor = $this->db->get_where('doctor',array('doctor_id' => $this->session->userdata('doctor_id')))->result_array(); ?>
<?php $sub_doctor = $this->db->get_where('users',array('doctor_id' => $this->session->userdata('doctor_id')))->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('apply_for_appointment'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" method="post"
                    action="<?php echo base_url(); ?>index.php?patient/appointment_pending/create" 
                    enctype="multipart/form-data">
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
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('doctor'); ?></label>

                        <div class="col-sm-7">
                            <select id="band_type_choices"  class="select2">
                                <option  value=""><?php echo get_phrase('select_doctor'); ?></option>
                               
                                <?php if ($doctor != ''): ?>
                            <?php foreach ($doctor as $row) { ?>
                                        <option    name="doctor_id"  value="<?php echo $row['doctor_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                        <?php endif; ?>
                        <?php if ($sub_doctor != ''): ?>
                            <?php foreach ($sub_doctor as $row) { ?>
                                        <option   name="user_id" value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                        <?php endif; ?>
                            </select>
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
<script type="text/javascript">
$('document').ready(function() {   
	$("#band_type_choices").change(function(){
		if($("#band_type_choices option:selected").attr('name') == 'doctor_id'){
			$("#band_type_choices").attr('name','doctor_id')

		}
		if($("#band_type_choices option:selected").attr('name') == 'user_id'){
			$("#band_type_choices").attr('name','user_id')
		}
	});

});
</script>
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
	
