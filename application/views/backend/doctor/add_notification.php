<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
.modal-dialog{
width: 50% !important;
}
.modal-body{
    height: 385px !important;
}
</style>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_notification'); ?></h3>
                    <p> * Fields are Mandatory</p>
                </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"
                    action="<?php echo base_url(); ?>index.php?doctor/notification/create" method="post">

 					<div class="form-group" >
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('name *'); ?></label>

                        <div class="col-sm-7">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
 					<div class="form-group" >
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description *'); ?></label>

                        <div class="col-sm-7">
                        <textarea rows="" cols="" name=description class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('notification_image *'); ?></label>

                        <div class="col-sm-5">
                            <input id="image_path" type="file"  name="image_path" class="form-control" id="field-1">
                        </div>

                    </div>

                    <div class="col-sm-12 text-center">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit" style="margin-top:20px;">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>\

<script type="text/javascript">
 $( document ).ready(function() {
	 jQuery("#submit").prop("disabled", true);
	 validate = function (){
			if($('#description').val() != "" && $('input[name=name').val() != "" && $('#image_path').get(0).files.length>0){
					jQuery("#submit").prop("disabled", false);
				}
		}
		
	 	$('input[name=name').keyup(function () {
			validate();
		});
		
	 	$('#description').keyup(function () {
			validate();
		});
		
	 	$('#description').keyup(function () {
			validate();
		});
	 	$('#image_path').change(function () {
			validate();
		});
		
	});
</script>