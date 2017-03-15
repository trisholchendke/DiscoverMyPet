<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_health_record'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?sub_doctor/medical_health_record/create" method="post" role="form" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_pet'); ?></label>

                        <div class="col-sm-5">
                        
                           <select name="selected_patient" class="form-control" id="selected_patient">
                           	<option value="" disabled="" selected="">-- Select Option --</option>
                           	 <?php
	                        $patient = $this->db->get_where('patient',array('user_id' => $this->session->userdata('login_user_id')))->result_array();
	                        foreach ($patient as $row) { ?>
	                               <option value="<?php echo $row['patient_id'] ?>"> <?php echo $row['name'] ?></option>
	                        	<?php } ?>
	                        ?>
                           </select>
                        </div>
                    </div>

                      <hr>
                    <div id="invoice_entry">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('health_record'); ?></label>

                        <div class="col-sm-5">
                            <input type="file" class="health_record" name="health_record[]" class="form-control" id="field-1">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
                                <i class="entypo-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="button" class="btn btn-default btn-sm btn-icon icon-left"
                                onClick="add_entry()">
                                    <?php echo get_phrase('add_more_files'); ?>
                            <i class="entypo-plus"></i>
                        </button>
                    </div>
                </div>

                <hr>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
 <script type="text/javascript">
 $( document ).ready(function() {
	 jQuery("#submit").prop("disabled", true);
	 validate = function (){
			if($('#selected_patient').val() != "" && $('.health_record').get(0).files.length>0){
					jQuery("#submit").prop("disabled", false);
				}
		}
		$('#selected_patient').change(function () {
			validate();
		});
		$('.health_record').change(function () {
			var file1 = $('.health_record').get(0).files;
			if(file1.length>0){
				validate();
			}
		});
	});
</script>
<script>

    // CREATING BLANK INVOICE ENTRY
    var blank_invoice_entry = '';
    $(document).ready(function () {
        blank_invoice_entry = $('#invoice_entry').html();
    });

    function add_entry()
    {
        $("#invoice_entry").append(blank_invoice_entry);
    }

    // REMOVING INVOICE ENTRY
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }

</script>
