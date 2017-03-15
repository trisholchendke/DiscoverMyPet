<style>
.modal{
top:0px !important;
}
.modal-dialog{
    width: 50% !important;
}
.modal-body{
    height: 430px !important;
}
.close_btn{
margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>
<?php $patient = $this->db->get_where('patient' , array('doctor_id' => $this->session->userdata('login_user_id') ))->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_appointment'); ?></h3>
                     <p> * Fields are Mandatory</p>
                </div>
 <button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"
                    action="<?php echo base_url(); ?>index.php?doctor/appointment/create" method="post">

 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('appointment_type *'); ?></label>
                        <div class="col-sm-7">
                            <select id="appointment_type_add_appointment" name="appointment_type" class="form-control" required>
                            	<option value=""  selected><?php echo get_phrase('select_option'); ?></option>
                            	<option>Consultation</option>
                            	<option>Boarding</option>
                            	<option>Vaccination</option>
                            	<option>Deworming</option>
                            	<option>Parasite Control</option>
                            </select>
                        </div>
                    </div>
 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('pet_name *'); ?></label>

                        <div class="col-sm-7">
                            <select id="selected_patient_add_appointment" name="patient_id" class="form-control" required>
                                <option value=""><?php echo get_phrase('select_pet_-Parent_name'); ?></option>
                                <?php foreach ($patient as $row) { ?>
                                        <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?>-<?php echo $row['parent_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('(date/time) *'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" id="datepicker" name="date_timestamp" id="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here" required>
                                <input type="text" name="time_timestamp" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:00 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here" required>
                            </div>
                        </div>
                    </div>
                    
                    
  					<div class="form-group" id="bording_number_add_appointment">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('boarding_number *'); ?></label>

                        <div class="col-sm-7">
                          <input type="text" id="bording_number" name="bording_number" class="form-control" placeholder="Boarding Number" required>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <input id="notify" type="checkbox" id="notify" name="notify" value="checked" checked>
                            <label class="control-label" for="notify"><?php echo get_phrase('notify_pet_with_') . 'SMS'; ?></label>
                        </div>
                    </div>

                    <div class="text-center">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit" style="margin-top:20px;">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<div class="loading"></div>
<script>

	$(document).ready(function(){
 
	
    	jQuery("#bording_number_add_appointment").css("display","none");
    	validate = function (){
    		
    	}
    	
    	$('input[name=date_timestamp').change(function () {
             validate();
    	});
    	
    	$('input[name=time_timestamp').change(function () {
    		validate();
    	});
    	
    	
    	$('#selected_patient_add_appointment').change(function(){
              validate();
    	});
    	
    	$('#appointment_type_add_appointment').change(function(){
                if(jQuery('#appointment_type_add_appointment').val() == "Boarding"){
    					jQuery("#bording_number_add_appointment").show();
    			 }else{
                                     var telefono = document.getElementById("bording_number");  
                                     telefono.removeAttribute("required");
    					jQuery("#bording_number_add_appointment").hide();
                                           
    				 }
    	});
    	
    	
    	$('#notify').change(function(){
    		 validate();
    	});
    	
    	$('#submit').click(function(){
    		
    	});
	});

</script>


