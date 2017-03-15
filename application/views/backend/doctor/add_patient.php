<style>
.close_btn{
margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						<h3><?php echo get_phrase('add_pet'); ?></h3>
 <p> * Fields are Mandatory</p>
                                               
					</div>
 <button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>

				<div class="panel-body">

					<form name="add_pet" id="add_pet" role="form" class="" action="<?php echo base_url(); ?>index.php?doctor/patient/create" method="post" enctype="multipart/form-data">
						<center><p><b>Pet Details</b></p></center>
						<!--First row-->
						<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label for="field-1" class="control-label"><?php echo get_phrase('pet_name *'); ?></label>                     
								<input type="text" name="name" class="form-control" id="field-1" required>                     
						</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label for="field-1" class="control-label"><?php echo get_phrase('Master_ID:'); ?></label>
								<input type="text" name="master_id" class="form-control" id="field-1"  value="<?php echo rand(10000, 100000); ?>"  readonly>                        
						</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label for="field-1" class="control-label"><?php echo get_phrase('Mobile Access Code (MA Code)'); ?></label>
								<input type="text" name="unique_id" class="form-control" id="field-1">                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						   <div class="form-group">
							<label for="field-1" class="control-label"><?php echo get_phrase('microchip_no'); ?></label>

						   
								<input type="text" name="microchip_no" class="form-control" id="field-1" >                      
						</div>
						</div>
						</div>
						<!--First row-->
						
						<!--2nd Row-->
						<div class="row">
						
						<div class="col-md-3 col-sm-3 col-xs-12">
							   <div class="form-group">
							<label for="field-1" class="control-label"><?php echo get_phrase('species *'); ?></label>                        
								<select onchange="get_breed(this)" class="form-control" id="species" name="species" required>
									<option value="" disabled selected>-Select Species-</option>
									<option value="Cat">Cat</option>
									<option value="Dog">Dog</option>
								</select>                        
						</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label for="field-ta" class="control-label"><?php echo get_phrase('sex *'); ?></label>
								<select name="sex" class="form-control" required>
									<option value="" disabled selected><?php echo get_phrase('select_sex'); ?></option>
									<option value="Male"><?php echo get_phrase('male'); ?></option>
									<option value="Female"><?php echo get_phrase('female'); ?></option>
								</select>                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">					  
						<div class="form-group">
							<label for="field-ta" class="control-label"><?php echo get_phrase('blood_group'); ?></label>                        
								<select name="blood_group" class="form-control">
									<option value=""><?php echo get_phrase('select_blood_group'); ?></option>
									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
								</select>                        
						</div>
						</div>
						
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						   
					                <div class="form-group" id="breed_dog">
                        <label for="field-1" class="control-label"><?php echo get_phrase('breed'); ?></label>
                        
                          <select  name="breed" class="form-control">
                                <option value=""><?php echo get_phrase('select_breed'); ?></option>
                                <?php $breed = $this->db->get_where('breed',array('species' => "Dog"))->result_array();foreach ($breed as $row) { ?>
                                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        
                    </div>
					 <div class="form-group" id="breed_cat">
                        <label for="field-1" class="control-label"><?php echo get_phrase('breed'); ?></label>
                        
                          <select  name="breed" class="form-control">
                                <option value=""><?php echo get_phrase('select_breed'); ?></option>
                                <?php $breed = $this->db->get_where('breed',array('species' => "Cat"))->result_array();
                                               foreach ($breed as $row) { ?>
                                        <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                      
                    </div>
						</div>
						</div>
						<!--2nd Row ends -->
						
						<!--3rd Row-->
						<div class="row">
						
						<div class="col-md-3 col-sm-3 col-xs-12">
					  <div class="form-group" >
                        <label for="field-1" class="control-label"><?php echo get_phrase('birth_date'); ?></label>

                        
                            <input  type="text" onchange="calage()" name="birth_date"  id="dob"  class="form-control datepicker"  placeholder="date here">
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('age'); ?></label>

                        
                            <p>
    							<input class="form-control" type="text" id="age" name="age" value="0" readonly>
  							</p> 
                        
						</div>	
						</div>
						
							<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('sterilization_status'); ?></label>
                        <select  name="sterilization_status" class="form-control">
                            <option value="" selected=""  disabled="">-Select An Option-</option>
                        	<option>Yes</option>
                        	<option>No</option>
                        </select>                        
						</div>
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('color'); ?></label>
                        <select  name="color" class="form-control">
                                <option value="" selected=""  disabled="">-Select An Option-</option>
                        	<option>Amber</option>
                        	<option>Black</option>
                        	<option>Blue</option>
                        	<option>Brown</option>
                        	<option>Chocolate</option>
                        	<option>Cream</option>
                        	<option>Golden</option>
                        	<option>Grey</option>
                        	<option>Lemon Yellow</option>
                        	<option>Maroon</option>
                        	<option>Off White</option>
                        	<option>Orange</option>
                        	<option>Pink</option>
                                <option>Purple</option>
                                <option>Red</option>
                                <option>Silver</option>
                                <option>White</option>
                                <option>Yellow</option>
                        </select>                        
                    </div>
						</div>
						
						</div>
						<!--3rd Row ends-->
						
						<!--4th Row-->
						<div class="row">					
					
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('drug/vaccine_sensitivity'); ?></label>

                        
                            <input type="text" name="drug_sensitivity" class="form-control" id="field-1" >
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('Mating_Preference'); ?></label>

                        
                            <input type="text" name="mating_preference" class="form-control" id="field-1" >
                        
						</div>
						</div>
						
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('Remarks:'); ?></label>

                        
                            <textarea name="remarks" class="form-control" id="field-1">
                            
                            </textarea>
                        
                    </div>
                  
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
						                    
                     <div class="form-group">
                        <label class="control-label"><?php echo get_phrase('image'); ?></label>

                        

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height:50px;margin-left:-22px;border: 0px;" data-trigger="fileinput">
                                    <img src="http://placehold.it/200x150" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file" style="margin-left: 20px;"> 
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
						<!--4th Row Ends-->
						
						
						<!--heading row-->
						<div class="row">
						<center><p><b>Parent Details</b></p></center>
						<hr>
						</div>
						<!--heading row-->
					  
						<!--5th Row starts-->
						<div class="row">											
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                       		 <label for="field-1" class="control-label"><?php echo get_phrase('parent_name *'); ?></label>
                        
                            <input type="text" name="parent_name" class="form-control" id="field-1" required>
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						  <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_email *'); ?></label>

                        
                            <input type="email" name="email" class="form-control" id="field-1" required>
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_contact_no*'); ?></label>

                        
                            <input  name="parent_contact_no" class="form-control" id="field-1" pattern="\d{10}" title="Please enter exactly 10 digits number" required>
                        
						</div>
						</div>
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_address *'); ?></label>

                        
                            <input type="text" name="parent_address" class="form-control" id="field-1" required>
                        
						</div>
						</div>
						
						</div>
						<!--5th Row ends-->

						
											  
						<!--7th Row starts-->
						<div class="row">											
						
						<div class="col-md-3 col-sm-3 col-xs-12">
						 <div class="form-group">
                        <label for="field-1" class="control-label"><?php echo get_phrase('parent_password*'); ?></label>

                        
                            <input type="password" name="password" class="form-control" id="field-1" required>
                        
						</div>

						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 pull-right">
						<div class="control-label">
                        <input id="submit" type="submit" class="btn btn-success submit_btn_top_margin" value="Submit">
                    </div>
						</div>
						
						
						</div>
						<!--7th Row ends-->
						
					   
						
					</form>




				</div>

			</div>

		</div>
	</div>

	<script type="text/javascript">
	$('#breed_cat').css('display','none');
	  $('#breed_dog').css('display','none');
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


	if(dife[0]< 0 || dife[1] < 0 || dife[2]< 0 ){


	document.add_pet.age.value= "0";
            
	$("#dob").val("");
	alert("plz select birth date less than current date");
	}else{
	document.add_pet.age.value=dife[0]+" years, "+dife[1]+" months, and "+dife[2]+" days";
	}

	var monleft = (dife[0]*12)+dife[1];
	var secleft = diff/1000/60;
	var hrsleft = secleft/60;
	var daysleft = hrsleft/24;
	document.add_pet.months.value=monleft+" Month since your birth";
	document.add_pet.daa.value=daysleft+" days since your birth";
	document.add_pet.hours.value=hrsleft+" hours since your birth";
	document.add_pet.min.value=secleft+" minutes since your birth";
	var as = parseInt(calyear)+dife[0]+1;
	var diff =
	Date.UTC(as,calmon,calday,0,0,0) - Date.UTC(curyear,curmon,curday,0,0,0);
	var datee = diff/1000/60/60/24;
	document.add_pet.nbday.value=datee+" days left for your next birthday";
	} } </script> 
	<script>
		$(document).ready(function(){
			
			
			jQuery("#bording_number_add_appointment").hide();
			validate = function (){
				
			}
			
			
			$('input[name=name').keyup(function () {
				
				validate();
			});
			
			$('input[name=species').keyup(function () {
				
				validate();
			});
			
			$('input[name=sex').keyup(function () {
				
				validate();
			});
			
			$('input[name=parent_name').keyup(function () {
				
				validate();
			});
			
			$('input[name=email').keyup(function () {
				
				validate();
			});
			$('input[name=parent_address').keyup(function () {
				
				validate();
			});
			$('input[name=password').keyup(function () {
				
				validate();
			});
			
			
		});

	</script>