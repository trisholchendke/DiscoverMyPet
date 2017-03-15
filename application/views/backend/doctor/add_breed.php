<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_breed'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"
                    action="<?php echo base_url(); ?>index.php?doctor/manage_breed/create" method="post">

 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('breed'); ?></label>
                        <div class="col-sm-7">
                           <input class="form-control" type="text" name="breed" placeholder="Enter Breed">
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
	validate = function (){
		if($('input[name=breed]').val() != ""){
				jQuery("#submit").prop("disabled", false);
			}
	}
	$('input[name=breed').change(function () {
		validate();
	});
	
	
})
	</script>
	