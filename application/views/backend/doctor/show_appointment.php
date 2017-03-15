<a href="<?php echo base_url(); ?>index.php?doctor">
	<button  
	    class="btn btn-primary pull-right">
	        <?php echo get_phrase('Back'); ?>
	</button>
</a>

<div style="clear:both;"></div>
<br>
<div class="row">

    <div class="col-md-12">
 <table class="table table-bordered table-striped datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('appointment_type'); ?></th>
                            <?php if ($appointment[0]['bording_number'] != ''): ?>
                           <th><?php echo get_phrase('bording_number'); ?></th>
                        <?php endif; ?>
                            <th><?php echo get_phrase('appointment (Date/Time)'); ?></th>
                            <th><?php echo get_phrase('doctor_name'); ?></th>
                            <?php if ($appointment[0]['user_id'] != ''): ?>
                             <th><?php echo get_phrase('sub_doctor_name'); ?></th>                        
                             <?php endif; ?>
                            <th><?php echo get_phrase('patient_name'); ?></th>
                            <th><?php echo get_phrase('status'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $appointment = $appointment;
                        if($appointment == !FALSE){
                        	
                        foreach ($appointment as $row) { 
                        	?>   
                            <tr>
                               <td>
                    				<?php echo $row['appointment_type']; ?>
                				</td>
                				 <?php if ($row['bording_number'] != ''): ?>
                            <td>
                    				<?php echo $row['bording_number']; ?>
                				</td>
                        <?php endif; ?>
                				
                    				<td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                				
                               <td>
                    				   <?php $name = $this->db->get('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                				</td>
                				 <?php if ($row['user_id'] != ''): ?>
                            <td>
                    				   <?php $name = $this->db->get('users' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?>
                				</td>
                        <?php endif; ?>
                				<td>
                    				   <?php $name = $this->db->get('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                				</td>
                               <td>
                    				<?php echo $row['status']; ?>
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