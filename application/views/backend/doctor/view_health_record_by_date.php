<div style="clear:both;"></div>
<br>
<div class="row">

    <div class="col-md-12">
     <form name="health_record"  class="form-inline" action="<?php echo base_url(); ?>index.php?doctor/get_health_record_by_patient" method="post" role="form" enctype="multipart/form-data">
	    
					<div class="row medical_health_record_row">
	<div class="col-md-2">
				<select name="selected_patient"  id="selected_patient" class="form-control" >
									<option value="" disabled="" selected="">-- Select Option --</option>
									 <?php
									$patient = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
									foreach ($patient as $row) { ?>
										   <option value="<?php echo $row['patient_id'] ?>"> <?php echo $row['name'] ?></option>
										<?php } ?>
									?>
								   </select>
	</div>
				<div class="col-md-3">
				<label class="lbl_margin_right">From Date</label>
				<input type="date" name="from_date" class="form-control">
				</div>

					<div class="col-md-3">
				<label class="lbl_margin_right"> To Date</label>
				<input type="date" name="to_date" class="form-control">
	</div>
	  <div class="col-md-2">
	  <input type="submit" value="submit" class="btn btn-default">
	  
			</div>
			</div>

    </form>
 <table class="table table-bordered table-striped datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('pet_name'); ?></th>
                            <th><?php echo get_phrase('health_record'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
            			$health_record = $health_record;
                        if($health_record == !FALSE){
                        	
                        foreach ($health_record as $row) { 
                        	?>   
                            <tr>
                               <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                                <?php 
                                
                                if($row['file_type'] == "image/jpeg") 
                                {
                                	
                                ?>
                                <td>
                                <a href="uploads/health_record/<?php echo $row['health_record'] ?>" download>
                                	<img witdh="50" height="50"  src="uploads/health_record/<?php echo $row['health_record'] ?>" />
                                </a>
                                </td>
                                <?php 
                                }else if($row['file_type'] == "application/pdf"){
                                	?>
                                	 <td >
                                	 <a href="uploads/health_record/<?php echo $row['health_record'] ?>" download>
                                		<img witdh="50" height="50"  src="assets/images/pdf_image.jpg" />
                                	 </a>
                                </td>
                                <?php 
                                } 
                                ?>	
                                
                                <td>
                                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/view_health_record/<?php echo $row['id'] ?>');" 
                                        class="btn btn-default btn-sm btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        View
                                    </a>
                                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_health_record/<?php echo $row['id'] ?>');" 
                                        class="btn btn-default btn-sm btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        Edit
                                    </a>
                                    
                                    <a  
                                    	href="<?php echo base_url(); ?>index.php?doctor/medical_health_record/delete/<?php echo $row['id'] ?>" 
                                       class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                                        <i class="entypo-cancel"></i>
                                        Delete
                                    </a>
                                     <li>
                            </li>
                                </td>
                            </tr>
                        <?php }  } else{?>
                       <tr>
                       	<td >No Record</td>
                       	<td></td>
                       	<td></td>
                       </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
        
    </div>
    
</div>
<?php for($count=1; $count<=3; $count++){ ?>
    <script type="text/javascript">
        jQuery(window).load(function ()
        {
            var $ = jQuery;

            $("#table-<?php echo $count ?>").dataTable({
                "sPaginationType": "bootstrap",
"iDisplayLength": 5,
                "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
            });

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });

            // Highlighted rows
            $("#table-<?php echo $count ?> tbody input[type=checkbox]").each(function (i, el)
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
<?php } ?>