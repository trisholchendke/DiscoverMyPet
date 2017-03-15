<?php $patient_info = $this->db->get_where('patient',array('user_id' => $this->session->userdata('login_user_id')))->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_report'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?pet_relocation/report/create" method="post" enctype="multipart/form-data">

				<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('select_pet_name'); ?></label>

                        <div class="col-sm-7">
                            <select name="patient_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_pet_name'); ?></option>
                                <?php foreach ($patient_info as $row) { ?>
                                    <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('type'); ?></label>

                        <div class="col-sm-7">
                            <select id="selected_type" name="type" class="form-control">
                                <option value=""><?php echo get_phrase('select_type'); ?></option>
                                <option value="operation"><?php echo get_phrase('operation'); ?></option>
                                <option value="birth"><?php echo get_phrase('birth'); ?></option>
                                <option value="death"><?php echo get_phrase('death'); ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="timestamp" class="form-control datepicker" id="field-1" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('parent_name'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="parent_name" class="form-control" id="field-1" >
                        </div>
                    </div>
                    <div class="form-group" id="death_location">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('death_location'); ?></label>

                        <div class="col-sm-7">
                            <input type="text"  name="death_location" class="form-control" id="field-1" >
                        </div>
                    </div>
                    <div class="form-group" id="death_reason">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('death_reason'); ?></label>

                        <div class="col-sm-7">
                            <input type="text"  name="death_reason" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script>

$(document).ready(function(){
	jQuery("#death_reason").hide();
	jQuery("#death_location").hide();
	$('#selected_type').change(function(){
		if($('#selected_type').val() == 'death'){
			jQuery("#death_reason").show();
			jQuery("#death_location").show();
		}else{
			jQuery("#death_reason").hide();
			jQuery("#death_location").hide();
			}
		
	});
	
})
</script>