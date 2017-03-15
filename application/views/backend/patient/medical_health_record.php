<style>
.modal-dialog{
    width: 50% !important;
}
.modal-body{
    height: 370px !important;
}
.modal{
top:0px !important;
}
</style>

<div class="row">

    <div>
    
    <table class="table table-bordered table-striped datatable" style="display: block;    overflow-x: auto;" id="table-2">
    <thead>
           				 <tr>
                            <th><?php echo get_phrase('Date/Time'); ?></th>
         <th><?php echo get_phrase('pet_name'); ?></th>
         <th><?php echo get_phrase('health_record'); ?></th>
         <th><?php echo get_phrase('Weight'); ?></th>
         <th><?php echo get_phrase('Height'); ?></th>
         <th><?php echo get_phrase('Vaccine_Name'); ?></th>
         <th><?php echo get_phrase('Vaccine_Date'); ?></th>
         <th><?php echo get_phrase('Vaccine_Status'); ?></th>
         <th><?php echo get_phrase('Vaccine_Brand_Name'); ?></th>
         <th><?php echo get_phrase('Vaccine_Batch_No'); ?></th>
         <th><?php echo get_phrase('Deworming_Date'); ?></th>
         <th><?php echo get_phrase('Deworming_Status'); ?></th>
         <th><?php echo get_phrase('Deworming_Brand_Name'); ?></th>
         <th><?php echo get_phrase('Deworming_Batch_No'); ?></th>
         <th><?php echo get_phrase('Parasite_Control_Status'); ?></th>
         <th><?php echo get_phrase('Parasite_Control_Batch_No'); ?></th>
         <th><?php echo get_phrase('Diet'); ?></th>
         <th><?php echo get_phrase('Allergy'); ?></th>
         <th><?php echo get_phrase('Brief_Medical_History'); ?></th>
         <th><?php echo get_phrase('action'); ?></th>

                        </tr>
    </thead>

     <tbody>
                        <?php
 $this->db->select('*');
    	$this->db->from('health_record');
    	$this->db->where('patient_id',$this->session->userdata('login_user_id'));
       
        $this->db->order_by("id", "desc");
    	$query = $this->db->get();
    	$health_record =  $query->result_array();



                       
                        if($health_record == !FALSE){
                        	
                        foreach ($health_record as $row) { 
                        	?>   
                            <tr>
                             <td>
            <?php echo $row['creation_timestamp']; ?>
         </td>
         <td>
            <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
               echo $name;?>
         </td>
<?php if($row['health_record'] == NULL){?>
 <td></td>
<?php }else{ ?>
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
<?php } ?>
         
         <td>
            <?php echo $row['weight']; ?>
         </td>
         <td>
            <?php echo $row['height']; ?>
         </td>
         <td>
            <?php echo $row['vaccine_name']; ?>
         </td>
         <td>
            <?php echo $row['vaccine_date']; ?>
         </td>
         <td>
            <?php echo $row['vaccine_status']; ?>
         </td>
         <td>
            <?php echo $row['vaccine_brand_name']; ?>
         </td>
         <td>
            <?php echo $row['vaccine_batch_no']; ?>
         </td>
         <td>
            <?php echo $row['deworming_date']; ?>
         </td>
         <td>
            <?php echo $row['deworming_status']; ?>
         </td>
         <td>
            <?php echo $row['deworming_brand_name']; ?>
         </td>
         <td>
            <?php echo $row['deworming_batch_no']; ?>
         </td>
         <td>
            <?php echo $row['parasite_control_status']; ?>
         </td>
         <td>
            <?php echo $row['parasite_control_batch_no']; ?>
         </td>
         <td>
            <?php echo $row['diet']; ?>
         </td>
         <td>
            <?php echo $row['allergy']; ?>
         </td>
         <td>
            <?php echo $row['brief_medical_history']; ?>
         </td>
        <td>
                                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/view_health_record/<?php echo $row['id'] ?>');" 
                                        class="btn btn-default btn-sm btn-icon icon-left">
                                        <i class="entypo-eye"></i>
                                        View
                                    </a>
                                     
                                </td>
                            </tr>
                        <?php }  } else{?>
                       <tr>
                       	<td>No Record</td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
                       	<td></td>
	<td></td>
                       </tr>
                        <?php }?>
                        
                    </tbody>
</table>

</div>
</div>


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


