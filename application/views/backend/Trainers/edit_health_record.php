<?php $health_record    = $this->db->get_where('health_record', array('id' => $param2))->result_array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_health_record'); ?></h3>
                </div>
            </div>
            

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?trainers/medical_health_record/update" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_pet'); ?></label>

                        <div class="col-sm-5">
					<input type="hidden" name="id" value="<?php echo $health_record[0]['id'] ;?>" >
                        
                           <select name="selected_patient" class="form-control">
                           	 <?php
	                        $patient    =  $this->db->get_where('patient', array('user_id' => $this->session->userdata('login_user_id')))->result_array();
	                        foreach ($patient as $row) {
	                        	?>
	                               <option value="<?php echo $row['patient_id'] ;?>" <?php if ($health_record[0]['patient_id'] == $row['patient_id']) echo 'selected'; ?>> <?php echo $row['name'] ?></option>
	                        	<?php } ?>
	                        ?>
                           </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('health_record'); ?></label>

                        <div class="col-sm-5">
                            <input type="file" name="health_record" class="form-control" id="field-1" >
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