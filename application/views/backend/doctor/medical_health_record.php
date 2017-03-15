<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_health_record/');" 
   class="btn btn-primary pull-right"><i class="fa fa-plus-circle" style="margin-right: 7px;" aria-hidden="true"></i>
<?php echo get_phrase('add_health_record'); ?>
</button>
<?php $doctor_id    = $this->session->userdata('login_user_id'); ?>
<div style="clear:both;"></div>
<br>
<div class="row">
<div class="col-md-12">
<form name="health_record" class="form-inline" action="<?php echo base_url(); ?>index.php?doctor/medical_health_record" method="post" role="form" enctype="multipart/form-data">
   <div class="row medical_health_record_row">
<div class="col-md-12">
<h4><i class="fa fa-filter" aria-hidden="true"></i> Filter By</h4>
</div>
      <div class="col-md-3 col-lg-3">

         <select name="selected_patient"  id="selected_patient" class="form-control" style="width:100%;">
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

         <input type="text" name="from_date" class="form-control datepicker" style="width:100%;" data-format="D, dd MM yyyy" 
            placeholder="From Date" value="<?php if(isset($_POST['from_date'] ) && !empty($_POST['from_date'])){
             
           echo date("D, d M Y", strtotime($_POST['from_date'])); 
               }else{
            echo "";
}?>">
      </div>
      <div class="col-md-3 col-lg-3">

         <input type="text" name="to_date" class="form-control datepicker" style="width:100%;" data-format="D, dd MM yyyy" 
            placeholder="To Date" value="<?php if(isset($_POST['to_date'] ) && !empty($_POST['to_date'])){
             
           echo date("D, d M Y", strtotime($_POST['to_date'])); 
               }else{
            echo "";
}?>">
      </div>
      <div class="col-md-2 col-lg-2">
         <input type="submit" value="submit" class="btn btn-primary" style="width:100%">
      </div>
   </div>
</form>
<table class="table table-bordered table-striped datatable" id="table-2" style="display: block;    overflow-x: auto;">
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
         <th><?php echo get_phrase('Deworming_name'); ?></th>
         <th><?php echo get_phrase('Deworming_Status'); ?></th>
         <th><?php echo get_phrase('Deworming_Brand_Name'); ?></th>
         <th><?php echo get_phrase('Deworming_Batch_No'); ?></th>
         <th><?php echo get_phrase('Parasite_Control_Status'); ?></th>
         <th><?php echo get_phrase('Parasite_Control_Brand_name'); ?></th>
         <th><?php echo get_phrase('Parasite_Control_Batch_No'); ?></th>
         <th><?php echo get_phrase('Diet'); ?></th>
         <th><?php echo get_phrase('Allergy'); ?></th>
         <th><?php echo get_phrase('Brief_Medical_History'); ?></th>
         <th><?php echo get_phrase('action'); ?></th>
      </tr>
   </thead>
   <tbody>
      <?php
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
<?php if($row['health_record'] == 0){ ?>
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
            <?php echo $row['deworming_name']; ?>
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
            <?php echo $row['parasite_control_brand_name']; ?>
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
               class="btn btn-default btn-sm btn-icon icon-left" style="padding-right: 18px;
">
            <i class="entypo-eye"></i>
            View
            </a>
            <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_health_record/<?php echo $row['id'] ?>');" 
               class="btn btn-default btn-sm btn-icon icon-left" style="padding-right: 23px;">
            <i class="entypo-pencil"></i> 
            Edit
            </a>
            <a  
               href="<?php echo base_url(); ?>index.php?doctor/medical_health_record/delete/<?php echo $row['id'] ?>" 
               class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
            <i class="entypo-cancel"></i>
            Delete
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