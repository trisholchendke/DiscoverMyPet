<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_appointment');" 
    class="btn btn-primary pull-right" style="margin:5px;">
        <?php echo get_phrase('add_appointment'); ?>
</button>
<div style="clear:both;"></div>
<br>
 <form name="health_record" class="form-inline" action="<?php echo base_url(); ?>index.php?doctor/appointment_result" method="post" role="form" enctype="multipart/form-data">
	<div class="row medical_health_record_row">
		<div class="col-md-2 col-lg-2">
			    	<select name="selected_patient"  id="selected_patient" class="form-control" >
			                           	<option value="" disabled="" selected="">Select Pet</option>
			                           	 <?php
				                        $patient = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
				                        foreach ($patient as $row) { ?>
				                               <option value="<?php echo $row['patient_id'] ?>"> <?php echo $row['name'] ?></option>
				                        	<?php } ?>
				                        ?>
			                           </select>
		</div>
		
		<div class="col-md-2 col-lg-2">
			    	<select id="appointment_type" name="appointment_type" class="form-control">
                            	<option value="" disabled selected><?php echo get_phrase('appointment_type'); ?></option>
                            	<option>Consultation</option>
                            	<option>Boarding</option>
                            	<option>Vaccination</option>
                            	<option>Deworming</option>
                            	<option>Parasite Control</option>
                            </select>
		</div>
		
		  <div class="col-md-2">
		      <input type="Submit" value="Submit" class="btn btn-default">
		  </div>
	  </div>
    </form>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th><?php echo get_phrase('appointment_type');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('pet_name');?></th>
            <th><?php echo get_phrase('parent_name');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('sub_doctor');?></th>
            <th><?php echo get_phrase('boarding_number');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
    <?php if($appointment_info !== FALSE){ ?>
        <?php foreach ($appointment_info as $row) { ?>   
            <tr>
                <td></td>
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
                <td>
                <?php if(!$row['user_id'])
                {
                	?>
                	No Sub Doctor
                	<?php }else{?>
                	<?php $name = $this->db->get_where('users' , array('id' => $row['user_id'] ))->result_array();
                        print_r($name[0]['name']);?>
                	<?php }?>
                    
                </td>
                <td><?php echo $row['bording_number']?></td>
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
    <?php }else{?>
    <?php }?>
       
    </tbody>
</table>




<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
"iDisplayLength": 5,
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