<?php 
$bed_info = $this->db->get('bed')->result_array();
$patient_info = $this->db->get('patient')->result_array(); 
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_bed_allotment'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?pet_bakery/bed_allotment/create" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('bed_number'); ?></label>

                        <div class="col-sm-5">
                            <select name="bed_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_bed_number'); ?></option>
                                <?php foreach ($bed_info as $row) { ?>
                                    <option value="<?php echo $row['bed_id']; ?>"><?php echo $row['bed_number'] .' - '.$row['type'] ; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('patient'); ?></label>

                        <div class="col-sm-5">
                            <select name="patient_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_patient'); ?></option>
                                <?php foreach ($patient_info as $row) { ?>
                                    <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('allotment_(date/time)'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="allotment_date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                                <input type="text" name="allotment_time" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:00 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discharge_(date/time)'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="discharge_date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                                <input type="text" name="discharge_time" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:00 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here">
                            </div>
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