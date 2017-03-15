<?php $event_info = $this->db->get_where('event', array('event_id' => $param2))->result_array();
foreach ($event_info as $row) {
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_event'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"
                    action="<?php echo base_url(); ?>index.php?receptionist/event/update/<?php echo $row['event_id']; ?>" method="post">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('event_name'); ?></label>

                        <div class="col-sm-7">
                            <div>
                                <input type="text" name="event_name" class="form-control"  placeholder="Event Name" value="<?php echo $row['event_name']; ?>">
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="event_date" class="form-control datepicker" placeholder="date here" value="<?php echo $row['event_date']; ?>">
                                <input type="text" name="event_time" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:00 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here" value="<?php echo $row['event_time']; ?>>
                            </div>
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
<?php }?>
<script>
$(document).ready(function(){

	jQuery("#submit").prop("disabled", true);
	validate = function (){
		if($('input[name=event_time]').val() != "" && $('input[name=event_name]').val() != "" && $('input[name=event_date]').val() != ""){
				jQuery("#submit").prop("disabled", false);
			}
	}
	$('input[name=event_name').change(function () {
		validate();
	});
	$('input[name=event_date').change(function () {
		validate();
	});
	$('input[name=event_time').change(function () {
		validate();
	});
	$('#submit').click(function(){
	});
})
	</script>
	