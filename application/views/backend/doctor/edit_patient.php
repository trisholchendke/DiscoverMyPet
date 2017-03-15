<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>

<?php
$single_patient_info = $this->db->get_where('patient', array('patient_id' => $param2))->result_array();
foreach ($single_patient_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_pet'); ?></h3>
                    </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="panel-body">

                    <form role="form" name="edit_pet" class="form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/patient/update/<?php echo $row['patient_id']; ?>" method="post" enctype="multipart/form-data">
						
                        <center><p><b>Pet Details</b></p></center>
						<div class="row">
						
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label for="field-1" class="control-label"><?php echo get_phrase('pet_name'); ?></label>									
										<input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>">									
								</div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label for="field-1" class="control-label"><?php echo get_phrase('microchip_no'); ?></label>								
									<input type="text" name="microchip_no" class="form-control" id="field-1" value="<?php echo $row['microchip_no']; ?>" >                   
								</div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label for="field-1" class="control-label"><?php echo get_phrase('Mobile Access Code (MA Code)'); ?></label>
									<input type="text" name="unique_id" class="form-control" id="field-1" value="<?php echo $row['unique_id']; ?>" >                        
								</div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('species'); ?></label>
									<select onchange="get_breed(this)" name="species" class="form-control">
										<option value="Cat" <?php if($row['species'] == "Cat") echo "selected"?>>Cat</option>
										<option value="Dog" <?php if($row['species'] == "Dog") echo "selected"?>>Dog</option>
									</select>                        
								</div>
							</div>
								
							</div>
						
							
							<div class="row">
												
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label for="field-ta" class="control-label"><?php echo get_phrase('sex'); ?></label>
									<select name="sex" class="form-control">
										<option value="Male" <?php if($row['species'] == "Male") echo "selected"?>><?php echo get_phrase('male'); ?></option>
										<option value="Female" <?php if($row['species'] == "Female") echo "selected"?>><?php echo get_phrase('female'); ?></option>
									</select>                   
								</div>
						    </div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
									<label for="field-ta" class="control-label"><?php echo get_phrase('blood_group'); ?></label>
									<select name="blood_group" class="form-control">
										<option value="A+" <?php if($row['blood_group'] == "A+") echo "selected"?>>A+</option>
										<option value="A-" <?php if($row['blood_group'] == "A-") echo "selected"?>>A-</option>
										<option value="B+" <?php if($row['blood_group'] == "B+") echo "selected"?>>B+</option>
										<option value="B-" <?php if($row['blood_group'] == "B-") echo "selected"?>>B-</option>
										<option value="AB+" <?php if($row['blood_group'] == "AB+") echo "selected"?>>AB+</option>
										<option value="AB-" <?php if($row['blood_group'] == "AB-") echo "selected"?>>AB-</option>
										<option value="O+" <?php if($row['blood_group'] == "O+") echo "selected"?>>O+</option>
										<option value="O-" <?php if($row['blood_group'] == "O-") echo "selected"?>>O-</option>
									</select>                     
								</div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<?php if($row['breed'] == "Cat") {?>
								<div class="form-group" id="breed_cat" >
									<label for="field-1" class="control-label"><?php echo get_phrase('breed'); ?></label>										
										<select  onchange="get_breed(this)" name="breed" class="form-control">											   
												<?php $breed = $this->db->get_where('breed',array('species' => "Cat"))->result_array();
															   foreach ($breed as $row1) { ?>
														<option value="<?php echo $row1['name']; ?>" <?php if($row1['name'] == $row['breed']) echo "selected" ?>><?php echo $row1['name']; ?></option>
												<?php } ?>
										</select>										
								</div>
								<?php } ?>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<?php if($row['breed'] == "Cat") {?>
								<div class="form-group" id="breed_dog">
									<label for="field-1" class="control-label"><?php echo get_phrase('breed'); ?></label>
									
									  <select  name="breed" class="form-control">
                               
									<?php $breed = $this->db->get_where('breed',array('species' => "Dog"))->result_array();foreach ($breed as $row2) { ?>
                                        <option  value="<?php echo $row2['name']; ?>" <?php if($row2['name'] == $row['breed']) echo "selected" ?>><?php echo $row2['name']; ?></option>
									<?php } ?>
									</select>
									
								</div>
								<?php }; ?>
							</div>
							
							</div>
						
						    <div class="row">
							
								<div class="col-md-3 col-sm-3 col-xs-12">
									 <?php if($row['birth_date'] == 0){ ?>                   
										<div class="form-group" >
											<label for="field-1" class="control-label"><?php echo get_phrase('birth_date'); ?></label>
												<input  type="text" onchange="calage()" name="birth_date"  id="dob"  class="form-control datepicker"  placeholder="date here">										  
										</div>
										<?php }else{	?>
										<div class="form-group" >
																<label for="field-1" class="control-label"><?php echo get_phrase('birth_date'); ?></label>

															   

										 <input  type="text" onchange="calage()" name="birth_date"  id="dob"  class="form-control datepicker"  placeholder="date here" value="<?php echo date("m-d-Y", $row['birth_date']); ?>" >
															 
										 </div>
										<?php } ?>
								</div>
							
							
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
								<label for="field-1" class="control-label"><?php echo get_phrase('age'); ?></label>

								
									<p>
										<input class="form-control" type="text" id="age" name="age"  readonly value="<?php echo $row['age']; ?>">
										</p> 								
								</div>                    
							</div>
                    
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
								<label for="field-1" class="control-label"><?php echo get_phrase('sterilization_status'); ?></label>
								<select  name="sterilization_status" class="form-control">
									<option value="Yes" <?php if($row['sterilization_status'] == "Yes") echo "selected" ?>>Yes</option>
									<option value="Yes" <?php if($row['sterilization_status'] == "No") echo "selected" ?>>No</option>
									
								</select>								
								</div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								                    
                    <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('color'); ?></label>
                        <select  name="color" class="form-control">
                        	<option value="Amber" <?php if($row['color'] == "Amber") echo "selected" ?>>Amber</option>
                        	<option value="Black" <?php if($row['color'] == "Black") echo "selected" ?>>Black</option>
                        	<option value="Blue" <?php if($row['color'] == "Blue") echo "selected" ?>>Blue</option>
                        	<option value="Brown" <?php if($row['color'] == "Brown") echo "selected" ?>>Brown</option>
                        	<option value="Chocolate" <?php if($row['color'] == "Chocolate") echo "selected" ?>>Chocolate</option>
                        	<option value="Cream" <?php if($row['color'] == "Cream") echo "selected" ?>>Cream</option>
                        	<option value="Golden" <?php if($row['color'] == "Golden") echo "selected" ?>>Golden</option>
                        	<option value="Grey" <?php if($row['color'] == "Grey") echo "selected" ?>>Grey</option>
                        	<option value="Lemon Yellow" <?php if($row['color'] == "Lemon Yellow") echo "selected" ?>>Lemon Yellow</option>
                        	<option value="Off White" <?php if($row['color'] == "Off White") echo "selected" ?>>Off White</option>
                        	<option value="Orange" <?php if($row['color'] == "Orange") echo "selected" ?>>Orange</option>
                        	<option value="Pink" <?php if($row['color'] == "Pink") echo "selected" ?>>Pink</option>
                        	<option value="Purple" <?php if($row['color'] == "Purple") echo "selected" ?>>Purple</option>
							<option value="Red" <?php if($row['color'] == "Red") echo "selected" ?>>Red</option>
							<option value="Silver" <?php if($row['color'] == "Silver") echo "selected" ?>>Silver</option>
							<option value="White" <?php if($row['color'] == "White") echo "selected" ?>>White</option>
							<option value="Yellow" <?php if($row['color'] == "Yellow") echo "selected" ?>>Yellow</option>
													</select>
												  
							</div>
							</div>
							
							</div>
 
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class="form-group">
									<label for="field-1" class="control-label"><?php echo get_phrase('drug/vaccine_sensitivity'); ?></label>

									
										<input type="text" name="drug_sensitivity" class="form-control" id="field-1" value="<?php echo $row['drug_sensitivity']; ?>">
									
								</div>
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-12">
								 <div class="form-group">
									<label for="field-1" class="control-label"><?php echo get_phrase('Mating_Preference'); ?></label>

									
										<input type="text" name="mating_preference" class="form-control" id="field-1" value="<?php echo $row['mating_preference']; ?>">
								   
								</div>
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-12">
									 <div class="form-group">
									<label for="field-1" class="control-label"><?php echo get_phrase('Remarks:'); ?></label>

									
										<textarea name="remarks" class="form-control" rows="8" id="field-1">
										 <?php echo $row['remarks']; ?>
										</textarea>
									
								</div>
								</div>
								
								<div class="col-md-3 col-sm-3 col-xs-12">
									 <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('image'); ?></label>

                           

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->crud_model->get_image_url('patient' , $row['patient_id']);?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                       
                        </div>
								</div>
							</div>
                    
                    <center><p><b>Parent Details</b></p></center>
                    
					   <div class="row">
							<div class="col-md-3 col-sm-3 col-xs-12">
								  
                     <div class="form-group">
                       		 <label for="field-1" class="control-label"><?php echo get_phrase('parent_name'); ?></label>
                        
                            <input type="text" name="parent_name" class="form-control" id="field-1" value="<?php echo $row['parent_name']; ?>">
                        
                    </div>
							</div>
							
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_email'); ?></label>

                        
                            <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>">
                      
							</div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_contact_no'); ?></label>

                        
                            <input type="number" name="parent_contact_no" class="form-control" id="field-1" value="<?php echo $row['parent_contact_no']; ?>">
                    
                    </div>
							</div>
							
							<div class="col-md-3 col-sm-3 col-xs-12">
								 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_address'); ?></label>

                        
                            <input type="text" name="parent_address" class="form-control" id="field-1" value="<?php echo $row['parent_address']; ?>">
                       
                    </div>
							</div>
					   </div>
                   

                        <div class="row control-label text-center">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>
</script>
<script type="text/javascript">


 var get_breed = function(categoryID){
    var selectedValue = categoryID.value;

if(selectedValue == "Cat"){

  $('#breed_cat').css('display','block');
  $('#breed_dog').css('display','none');
}else{
$('#breed_cat').css('display','none');
  $('#breed_dog').css('display','block');
}

 }
var startyear = "1910";
var endyear = "2010";
var dat = new Date();
var curday = dat.getDate();
var curmon = dat.getMonth()+1;
var curyear = dat.getFullYear();
function checkleapyear(datea)
{
if(datea.getYear()%4 == 0)
{
if(datea.getYear()% 10 != 0)
{
return true;
}
else
{
if(datea.getYear()% 400 == 0)
return true;
else
return false;
}
}
return false; } function DaysInMonth(Y, M) {
with (new Date(Y, M, 1, 12)) {
setDate(0);
return getDate();
} } function datediff(date1, date2) {
var y1 = date1.getFullYear(), m1 = date1.getMonth(), d1 = date1.getDate(),
y2 = date2.getFullYear(), m2 = date2.getMonth(), d2 = date2.getDate();
if (d1 < d2) {
m1--;
d1 += DaysInMonth(y2, m2);
}
if (m1 < m2) {
y1--;
m1 += 12;
}
return [y1 - y2, m1 - m2, d1 - d2]; } 
function calage() {
var t=new Date($('#dob').val());  //converts the string into date object
var d =t.getDate(); //get the value of date
  var m = t.getMonth() + 1; //get the value of monthsvar m=d.getMonth()+1; //get the value of month
  
  var  y = t.getFullYear(); //get the value of year
    

var calday = d;
var calmon = m;
var calyear = y;
if(curday == "" || curmon=="" || curyear=="" || calday=="" || calmon=="" || calyear=="")
{
alert("please fill all the values and click go -");
}
else
{
var curd = new Date(curyear,curmon-1,curday);
var cald = new Date(calyear,calmon-1,calday);
var diff =
Date.UTC(curyear,curmon,curday,0,0,0) - Date.UTC(calyear,calmon,calday,0,0,0);
var dife = datediff(curd,cald);
if(dife[0] < 0 || dife[1] < 0 || dife[2] < 0 ){
document.edit_pet.age.value= "0";
$("#dob").val("");
alert("plz select birth date less than current date");
}else{
document.edit_pet.age.value=dife[0]+" years, "+dife[1]+" months, and "+dife[2]+" days";
}
var monleft = (dife[0]*12)+dife[1];
var secleft = diff/1000/60;
var hrsleft = secleft/60;
var daysleft = hrsleft/24;
document.edit_pet.months.value=monleft+" Month since your birth";
document.edit_pet.daa.value=daysleft+" days since your birth";
document.edit_pet.hours.value=hrsleft+" hours since your birth";
document.edit_pet.min.value=secleft+" minutes since your birth";
var as = parseInt(calyear)+dife[0]+1;
var diff =
Date.UTC(as,calmon,calday,0,0,0) - Date.UTC(curyear,curmon,curday,0,0,0);
var datee = diff/1000/60/60/24;
document.edit_pet.nbday.value=datee+" days left for your next birthday";
} } </script> 