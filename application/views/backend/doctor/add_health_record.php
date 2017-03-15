<style>
    hr{
	margin-top: 10px !important;
    margin-bottom: 10px !important;
	}
	center h3{
	font-size:14px;
	font-weight:600;
	}
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                 <button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                		<h3 style="margin-left:5px;">Add Health Record</h3>
 <p> * Fields are Mandatory</p>
               
            </div>

            <div class="panel-body">

                <form role="form" class="" action="<?php echo base_url(); ?>index.php?doctor/medical_health_record/create" method="post" role="form" enctype="multipart/form-data">
 					
					<!--First row-->
						<div class="row">
						
						<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('select_pet *'); ?></label>
                           <select name="selected_patient"  class="form-control" id="selected_patient1" required>
                           	<option value="" disabled="" selected="">Select Pet-Parent Name</option>
                           	 <?php
	                        $patient = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
	                        foreach ($patient as $row) { ?>
	                               <option value="<?php echo $row['patient_id'] ?>"> <?php echo $row['name'] ?>-<?php echo $row['parent_name'] ?></option>
	                        	<?php } ?>
	                        ?>
                           </select>
                        
						</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-xs-12">
						 <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('Weight (KG)'); ?></label>

                        
                        	<input type="number" min="0" name="weight" class="form-control">
                       
						</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-xs-12">
						 <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('Height (Inches)'); ?></label>

                        	<input type="number" min="0" name="height" class="form-control" step="0.01">
                        
						</div>
						</div>
						
						
						</div>
					<!--First row ends-->	
					
					<div class="row" style="margin-top: -15px;">
					<center>
                		<h3>Vaccination</h3>
                	</center>
					<hr>
					</div>
					<!--Second row-->
						<div class="row">
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('Vaccine_Name'); ?></label>
                              <div id="vaccine_name"></div>
                        
                        	
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('vaccine_status'); ?></label>

                        
                        	<select name="vaccine_status" class="form-control">
                        		<option value="" selected>--Select An Option--</option>
                        		<option>Scheduled</option>
                        		<option>Ended</option>
                        		<option>In Line</option>
                                        <option>First Time</option>
                                      
                        	</select>
                        
                       
                    </div>
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('vaccine_brand_name'); ?></label>

                        
                        	<input type="text"  name="vaccine_brand_name" class="form-control">
                        
						</div>
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						    
                    <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('vaccine_batch_no'); ?></label>

                        
                        	<input type="number"  min="0" name="vaccine_batch_no" class="form-control">
                       
						</div>
						</div>
						
						</div>
					<!--second row ends-->
					
					<div class="row text-center" style="margin-top: -15px;">
					<center>
                		<h3>Deworming</h3>
                	</center>
					<hr>
					</div>
					
					<!--third row-->
						<div class="row">
						
						<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('deworming_name'); ?></label>

                        
                        	<select name="deworming_name" class="form-control">
                        		<option value="" selected>--Select An Option--</option>
                        		<option>Roundworms</option>
                        		<option>Tapeworms</option>
                        		<option>Hookworms</option>
                                        <option>Heartworms</option>
                                        <option>Whipworms</option>
                                        <option>Ringworms</option>
                                        
                        	</select>
                        
						</div>
						</div>
<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('deworming_status'); ?></label>

                        
                        	<select name="deworming_status" class="form-control">
                        		<option value="" selected>--Select An Option--</option>
                        		<option>Scheduled</option>
                        		<option>Ended</option>
                        		<option>In Line</option>
                                        <option>First Time</option>
                                      
                        	</select>
                        
						</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-xs-12">
						 <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('deworming_brand_name'); ?></label>

                        <input type="text" ng-model="deworming_brand_name" class="form-control">
                        	
                        
						</div>
						</div>
						
						
						<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('deworming_batch_no'); ?></label>

                        
                        	<input type="number"  min="0" name="deworming_batch_no" class="form-control">
                        
						</div>
						</div>
						
						</div>
					<!--third row ends-->
                    
					<div class="row" style="margin-top: -15px;">
					<center>
                		<h3>Parasite Control</h3>
                	</center>
					<hr>
					</div>
                   
                			<!--fourth row-->
						<div class="row">
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('parasite_control_status'); ?></label>

                        
                        	<select name="parasite_control_status" class="form-control">
                        		<option value="" selected>--Select An Option--</option>
                        		<option>Scheduled</option>
                        		<option>Ended</option>
                        		<option>In Line</option>
                                        <option>First Time</option>
                                      
                        	</select>
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('parasite_control_brand_name'); ?></label>

                        
                        	<select name="parasite_control_brand_name" class="form-control">
                        		<option value="" selected>--Select An Option--</option>
                        		<option>Ticks</option>
                        		<option>Fleas</option>
                        		<option>Heartworm</option>
                                        <option>Intestinal Parasites</option>
                                      
                        	</select>
                        
						</div>
                    
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('parasite_control_batch_no'); ?></label>

                        
                        	<input type="number"  min="0" name="parasite_control_batch_no" class="form-control">
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('diet'); ?></label>

                        
                        	<input class="form-control" name="diet" class="form-control">
                        
						</div>
						</div>
						
						</div>
					<!--fourth row ends-->
                    
					
					                			<!--fifth row-->
						<div class="row">
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						    <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('Allergy'); ?></label>

                        
                        	<select name="allergy" class="form-control">
                        		<option value="" selected disabled>--Select An Option--</option>
                        		<option>Food/Mold</option>
                        		<option>Medicines/Wellness Products</option>
                        		<option>Dander/Feather</option>
                        		<option>Cigarette/Alcohol/Drugs</option>
                        		<option>Rubber/Plastic</option>
                        		<option>Perfumes/Fabrics</option>
                        		<option>Flea/Flea Control Products</option>
                        		<option>Dust/Cleaning Products</option>
                        		<option>Grass/Pollen</option>
                        		<option>Seasonal</option>
                        		<option>Others</option>
                        	</select>
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label  class="control-label"><?php echo get_phrase('brief_medical_history'); ?></label>

                        
                        	<input class="form-control" name="brief_medical_history" class="form-control">
                        
						</div>
                    
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div id="invoice_entry" style="margin-left: -15px;">

                    <div class="form-group">
                        
						<label  class="control-label"><?php echo get_phrase('health_record'); ?></label>
                        <div style="position:relative;">
                            <input type="file" class="health_record" name="health_record[]" class="form-control" id="field-1"><button type="button" class="btn btn-default" onclick="deleteParentElement(this)" style="position: absolute;top: -6px;right: -10px">
                                <i class="entypo-trash"></i>
                            </button>
                        </div>
                       

                    </div>
                </div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
						
                        <button type="button" style="margin-top: 20px;" class="btn btn-default btn-sm btn-icon icon-left"
                                onClick="add_entry()">
                                    <?php echo get_phrase('add_more_files'); ?>
                            <i class="entypo-plus"></i>
                        </button>
						
						</div>
						</div>
						
						</div>
					<!--fifth row ends-->
					
					<!--six row start-->
					<div class="row text-center">
					 
                        <input  type="submit" class="btn btn-success" value="Submit">
                    
					</div>
					<!--six row ends-->
                	
                   
                </form>

            </div>

        </div>

    </div>
</div>
 <script type="text/javascript">


 $( document ).ready(function() {
      
	$('#selected_patient1').change(function () {
          
$.ajax({
				url:"<?echo base_url(); ?>index.php?doctor/get_species_of_pet",
				dataType:"json",
				type:"post",
				data:{'patient_id':$('#selected_patient1').val()},
				success:function(data){
					

                                         if(data.data[0]['species'] == "Cat"){
var html = '<select class="form-control" name="vaccine_name"><option>Panleukopenia</option><option>Rhinotracheitis</option><option>Calicivirus</option><option>Rabies</option><option>Feline Leukemia (FeLV)</option><option>Chlamydophila</option><option>Feline Infectious Peritonitis</option><option>Bordetella</option><option>Giardia</option><option>Feline Immunodeficiency Virus</option><option>Combination Vaccine</option><option>Others</option></select>';

$('#vaccine_name').html(html);
}else{
var html = '<select class="form-control" name="vaccine_name"><option>Parvovirus</option><option>Rabies</option><option>Canine Distemper</option><option>Measles</option><option>Hepatitis</option><option>Adenovirus-2 (CAV-2)</option><option>Parainfluenza</option><option>Bordetella</option><option>Leptospirosis</option><option>Coronavirus</option><option>Lyme</option><option>Combination vaccine</option><option>Others</option></select>';
$('#vaccine_name').html(html);

}

				}
			});	

        });
              
	 validate = function (){
			
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
