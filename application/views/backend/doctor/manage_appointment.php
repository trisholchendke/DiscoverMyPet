<style>
.checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    

/*     .checkbox input[type="checkbox"]:focus + label::before { */
/*       outline: thin dotted; */
/*       outline: 5px auto -webkit-focus-ring-color; */
/*       outline-offset: -2px; } */
  
  
      

  .mail-env .mail-body .mail-compose .form-group label {
       position: relative !important;
    left: -4px !important;
    top: 0px !important;
    z-index: 10 !important;
}
</style>



<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_patient/');" 
    class="btn btn-primary pull-right" id="add_pet_btn"><i class="fa fa-plus-circle" aria-hidden="true" style="margin-right: 7px;"></i><?php echo get_phrase('add_pet'); ?>
</button>
<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_appointment');" 
    class="btn btn-primary pull-right" style="margin-right:5px;"><i class="fa fa-plus-circle" style="margin-right: 7px;" aria-hidden="true"></i><?php echo get_phrase('add_appointment'); ?>
</button>

<div style="clear:both;"></div>
<br>
 <form name="health_record" class="form-inline" action="<?php echo base_url(); ?>index.php?doctor/appointment" method="post" role="form" enctype="multipart/form-data">
	<div class="row medical_health_record_row">
<div class="col-md-12">
<h4><i class="fa fa-filter" aria-hidden="true"></i> Filter By</h4>
</div>
		<div class="col-md-3 col-lg-3">

			    	<select name="selected_patient"  id="selected_patient" class="form-control" >
			                           	<option value=""  selected="">Select Pet</option>
			                           	 <?php
				                        $patient = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
				                        foreach ($patient as $row) { ?>
				                               <option value="<?php echo $row['patient_id'] ?>" <?php if(isset($_POST['selected_patient'] )){
                                    	if($_POST['selected_patient'] == $row['patient_id']) echo "selected";
                                    }?>> <?php echo $row['name'] ?></option>
				                        	<?php } ?>
				                        ?>
			                           </select>
		</div>
		
		<div class="col-md-3 col-lg-3">

			    	<select id="appointment_type" name="appointment_type" class="form-control">
                            	<option value=""  selected><?php echo get_phrase('appointment_type'); ?></option>
                            	<option <?php if(isset($_POST['appointment_type'] )){
                                    	if($_POST['appointment_type'] == 'Consultation') echo "selected";
                                    }?>>Consultation</option>
                            	<option <?php if(isset($_POST['appointment_type'] )){
                                    	if($_POST['appointment_type'] == 'Boarding') echo "selected";
                                    }?>>Boarding</option>
                            	<option <?php if(isset($_POST['appointment_type'] )){
                                    	if($_POST['appointment_type'] == 'Vaccination') echo "selected";
                                    }?>>Vaccination</option>
                            	<option <?php if(isset($_POST['appointment_type'] )){
                                    	if($_POST['appointment_type'] == 'Deworming') echo "selected";
                                    }?>>Deworming</option>
                            	<option <?php if(isset($_POST['appointment_type'] )){
                                    	if($_POST['appointment_type'] == 'Parasite Control') echo "selected";
                                    }?>>Parasite Control</option>
                            </select>
		</div>
		
		  <div class="col-md-2">
		      <input type="submit" value="submit" class="btn btn-primary" id="filter_btn">
		  </div>
	  </div>
    </form>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
           
            <th><?php echo get_phrase('appointment_type');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('pet_name');?></th>
            <th><?php echo get_phrase('parent_name');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            
            <th><?php echo get_phrase('boarding_number');?></th>
            <th><?php echo get_phrase('appointment_status');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($appointment_info as $row) { 


?>   
            <tr>
                
                <td><?php echo $row['appointment_type']; ?></td>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->parent_name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td>
                
                <td><?php echo $row['bording_number']?></td>
                <td><a  
                        href="<?php echo base_url(); ?>index.php?doctor/appointment_status/<?php echo $row['appointment_id']?>"
                         class="btn btn-default btn-sm btn-icon icon-left">
                           <?php echo $row['appointment_status']?>
                    </a></td>
                <td>
                    
                    
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_appointment/<?php echo $row['appointment_id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    
                    <a href="<?php echo base_url();?>index.php?doctor/appointment/delete/<?php echo $row['appointment_id']?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
"iDisplayLength": 5,
"order": [],
 "aaSorting": [],
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"      
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
    
</script>