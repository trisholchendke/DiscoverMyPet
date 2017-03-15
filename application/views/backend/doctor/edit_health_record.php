<?php $health_record    = $this->db->get_where('health_record', array('id' => $param2))->result_array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_health_record'); ?></h3>
                </div>
            </div>
            

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/medical_health_record/update" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_pet'); ?></label>

                        <div class="col-sm-5">
					<input type="hidden" name="id" value="<?php echo $health_record[0]['id'] ;?>" >
                        
                           <select name="selected_patient" class="form-control">
                           	 <?php
	                        $patient    = $this->crud_model->select_patient_info();
	                        foreach ($patient as $row) {
	                        	?>
	                               <option value="<?php echo $row['patient_id'] ;?>" <?php if ($health_record[0]['patient_id'] == $row['patient_id']) echo 'selected'; ?>> <?php echo $row['name'] ?>-<?php echo $row['parent_name'] ?></option>
	                        	<?php } ?>
	                        ?>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Weight (KG)'); ?></label>

                        <div class="col-sm-7">
                        	<input type="number" min="0" name="weight" class="form-control" value="<?php echo $health_record[0]['weight']?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Height (Inches)'); ?></label>

                        <div class="col-sm-7">
                        	<input type="number" min="0" step="0.01" name="height" class="form-control" value="<?php echo $health_record[0]['height']?>">
                        </div>
                    </div>
                	<center>
                		<h3>Vaccination</h3>
                	</center>
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Vaccine_Name'); ?></label>

                        <div class="col-sm-7">
                        	<select name="vaccine_name" class="form-control">
                        		<option <?php if($health_record[0]['vaccine_name'] == "Parvovirus") echo "selected"; ?>>Parvovirus</option>
                        		<option <?php if($health_record[0]['vaccine_name'] == "Rabies") echo "selected"; ?>>Rabies</option>
                        		<option <?php if($health_record[0]['vaccine_name'] == "Canine Distemper") echo "selected"; ?>>Canine Distemper</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Measles") echo "selected"; ?>>Measles</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Hepatitis") echo "selected"; ?>>Hepatitis</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Adenovirus-2 (CAV-2)") echo "selected"; ?>>Adenovirus-2 (CAV-2)</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Parainfluenza") echo "selected"; ?>>Parainfluenza</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Bordetella") echo "selected"; ?>>Bordetella</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Coronavirus") echo "selected"; ?>>Coronavirus</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Lyme") echo "selected"; ?>>Lyme</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Combination vaccine") echo "selected"; ?>>Combination vaccine</option>
                                        
                                        <option <?php if($health_record[0]['vaccine_name'] == "Panleukopenia") echo "selected"; ?>>Panleukopenia</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Rhinotracheitis") echo "selected"; ?>>Rhinotracheitis</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Calicivirus") echo "selected"; ?>>Calicivirus</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Rabies") echo "selected"; ?>>Rabies</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Feline Leukemia (FeLV)") echo "selected"; ?>>Feline Leukemia (FeLV)</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Chlamydophila") echo "selected"; ?>>Chlamydophila</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Feline Infectious Peritonitis") echo "selected"; ?>>Feline Infectious Peritonitis</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Bordetella") echo "selected"; ?>>Bordetella</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Giardia") echo "selected"; ?>>Giardia</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Feline Immunodeficiency Virus") echo "selected"; ?>>Feline Immunodeficiency Virus</option>
                                        <option <?php if($health_record[0]['vaccine_name'] == "Combination Vaccine") echo "selected"; ?>>Combination Vaccine</option>
<option <?php if($health_record[0]['vaccine_name'] == "Others") echo "selected"; ?>>Others</option>
                         </select>              
                        </div>
                    </div>
                    
                    
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('vaccine_status'); ?></label>

                        <div class="col-sm-7">
                        	<select name="vaccine_status" class="form-control">
                        		
                        		<option <?php if($health_record[0]['vaccine_status'] == "Scheduled") echo "selected"; ?>>Scheduled</option>
                        		<option <?php if($health_record[0]['vaccine_status'] == "Ended") echo "selected"; ?>>Ended</option>
                        		<option <?php if($health_record[0]['vaccine_status'] == "In Line") echo "selected"; ?>>In Line</option>
                                        <option <?php if($health_record[0]['vaccine_status'] == "First Time") echo "selected"; ?>>First Time</option>
                                      
                        	</select>
                        </div>
                    </div>
                    
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('vaccine_brand_name'); ?></label>

                        <div class="col-sm-7">
                        	<input type="text"   name="vaccine_brand_name" class="form-control" value="<?php echo $health_record[0]['vaccine_brand_name']?>">     
                    </div>
</div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('vaccine_batch_no'); ?></label>

                        <div class="col-sm-7">
                        	<input type="number"  min="0" name="vaccine_batch_no" class="form-control" value="<?php echo $health_record[0]['vaccine_batch_no']?>">
                        </div>
                    </div>
                    
                    <center>
                		<h3>Deworming</h3>
                	</center>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('deworming_name'); ?></label>

                        <div class="col-sm-7">
                        	<select name="deworming_name" class="form-control">
                        		
                        		<option <?php if($health_record[0]['deworming_name'] == "Roundworms") echo "selected"; ?>>Roundworms</option>
                        		<option <?php if($health_record[0]['deworming_name'] == "Tapeworms") echo "selected"; ?>>Tapeworms</option>
                        		<option <?php if($health_record[0]['deworming_name'] == "Hookworms") echo "selected"; ?>>Hookworms</option>
                                        <option <?php if($health_record[0]['deworming_name'] == "Heartworms") echo "selected"; ?>>Heartworms</option>
                                        <option <?php if($health_record[0]['deworming_name'] == "Whipworms") echo "selected"; ?>>Whipworms</option>
                                        <option <?php if($health_record[0]['deworming_name'] == "Ringworms") echo "selected"; ?>>Ringworms</option>
                                        
                        	</select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('deworming_brand_name'); ?></label>

                        <div class="col-sm-7">
                        	<input class="form-control" name="deworming_brand_name" class="form-control" value="<?php echo $health_record[0]['deworming_brand_name']?>">
                        </div>
                    </div>
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('deworming_status'); ?></label>

                        <div class="col-sm-7">
                        	<select name="deworming_status" class="form-control">
                        		
                        		<option <?php if($health_record[0]['deworming_status'] == "Scheduled") echo "selected"; ?>>Scheduled</option>
                        		<option <?php if($health_record[0]['deworming_status'] == "Ended") echo "selected"; ?>>Ended</option>
                        		<option <?php if($health_record[0]['deworming_status'] == "In Line") echo "selected"; ?>>In Line</option>
                                        <option <?php if($health_record[0]['deworming_status'] == "First Time") echo "selected"; ?>>First Time</option>
                                      
                        	</select>
                        </div>
                    </div>
                    
                	
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('deworming_batch_no'); ?></label>

                        <div class="col-sm-7">
                        	<input type="number"  min="0" name="deworming_batch_no" class="form-control" value="<?php echo $health_record[0]['deworming_batch_no']?>">
                        </div>
                    </div>
                    
                    <center>
                		<h3>Parasite Control</h3>
                	</center>
                    
                    
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('parasite_control_status'); ?></label>

                        <div class="col-sm-7">
                        	<select name="parasite_control_status" class="form-control">
                        		
                        		<option <?php if($health_record[0]['parasite_control_status'] == "Scheduled") echo "selected"; ?>>Scheduled</option>
                        		<option <?php if($health_record[0]['parasite_control_status'] == "Ended") echo "selected"; ?>>Ended</option>
                        		<option <?php if($health_record[0]['parasite_control_status'] == "In Line") echo "selected"; ?>>In Line</option>
                                        <option <?php if($health_record[0]['parasite_control_status'] == "First Time") echo "selected"; ?>>First Time</option>
                                      
                        	</select>
                        </div>
                    </div>
                    
                    
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('parasite_control_brand_name'); ?></label>

                        <div class="col-sm-7">
                        	<select name="parasite_control_brand_name" class="form-control">
                        		
                        		<option <?php if($health_record[0]['parasite_control_brand_name'] == "Ticks") echo "selected"; ?>>Ticks</option>
                        		<option <?php if($health_record[0]['parasite_control_brand_name'] == "Fleas") echo "selected"; ?>>Fleas</option>
                        		<option <?php if($health_record[0]['parasite_control_brand_name'] == "Heartworm") echo "selected"; ?>>Heartworm</option>
                                        <option <?php if($health_record[0]['parasite_control_brand_name'] == "Intestinal Parasites") echo "selected"; ?>>Intestinal Parasites</option>
                                </select>
                        </div>
                    </div>
                    
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('parasite_control_batch_no'); ?></label>

                        <div class="col-sm-7">
                        	<input type="number"  min="0" name="parasite_control_batch_no" class="form-control" value="<?php echo $health_record[0]['parasite_control_batch_no']?>">
                        </div>
                    </div>
                    
                    
                	<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('diet'); ?></label>

                        <div class="col-sm-7">
                        	<input class="form-control" name="diet" class="form-control" value="<?php echo $health_record[0]['diet']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Allergy'); ?></label>

                        <div class="col-sm-7">
                        	<select name="allergy" class="form-control">
                        		<option value="" selected disabled>--Select An Option--</option>
                        		<option <?php if($health_record[0]['allergy'] == "Food/Mold") echo "selected"; ?>>Food/Mold</option>
                        		<option <?php if($health_record[0]['allergy'] == "Medicines/Wellness Products") echo "selected"; ?>>Medicines/Wellness Products</option>
                        		<option <?php if($health_record[0]['allergy'] == "Dander/Feather") echo "selected"; ?>>Dander/Feather</option>
                        		<option <?php if($health_record[0]['allergy'] == "Cigarette/Alcohol/Drugs") echo "selected"; ?>>Cigarette/Alcohol/Drugs</option>
                        		<option <?php if($health_record[0]['allergy'] == "Rubber/Plastic") echo "selected"; ?>>Rubber/Plastic</option>
                        		<option <?php if($health_record[0]['allergy'] == "Perfumes/Fabrics") echo "selected"; ?>>Perfumes/Fabrics</option>
                        		<option <?php if($health_record[0]['allergy'] == "Flea/Flea Control Products") echo "selected"; ?>>Flea/Flea Control Products</option>
                        		<option <?php if($health_record[0]['allergy'] == ">Dust/Cleaning Products") echo "selected"; ?>>Dust/Cleaning Products</option>
                        		<option <?php if($health_record[0]['allergy'] == "Grass/Pollen") echo "selected"; ?>>Grass/Pollen</option>
                        		<option <?php if($health_record[0]['allergy'] == "Seasonal") echo "selected"; ?>>Seasonal</option>
                        		<option <?php if($health_record[0]['allergy'] == "Others") echo "selected"; ?>>Others</option>
                        	</select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('brief_medical_history'); ?></label>

                        <div class="col-sm-7">
                        	<input class="form-control" name="brief_medical_history" class="form-control" value="<?php echo $health_record[0]['brief_medical_history']?>">
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('health_record'); ?></label>

                            <div class="col-sm-5">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url();?>/uploads/health_record/<?php echo $health_record[0]['health_record']; ?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="health_record" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                   
                  <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>