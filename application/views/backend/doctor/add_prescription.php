<style>
.text_align_center{
text-align:center !important;
}
</style>
<?php $patient_info = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_prescription'); ?></h3>
 <p> * Fields are Mandatory </p>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/prescription/create" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date *'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" id="date_timestamp" name="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here" required>
                                <input type="text"  id="time_timestamp" name="time_timestamp" class="form-control timepicker" data-template="dropdown" data-show-seconds="false" data-default-time="00:05 AM" data-show-meridian="false" data-minute-step="5"  placeholder="time here" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('pet *'); ?></label>

                        <div class="col-sm-7">
                            <select id="selected_pet" name="patient_id" class="select2" required>
                                <option value=""><?php echo get_phrase('select_pet_-Parent_name'); ?></option>
                                <?php foreach ($patient_info as $row) { ?>
                                        <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?>-<?php echo $row['parent_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <br>
                     <div id="invoice_entry">
	                    <div class="form-group">
	<label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Product *'); ?></label>
	                        <div class="col-sm-3">
                                     <select id="product" class="form-control">
                                         <option value="">No Product Added Yet</option>
                                     </select>
	                             <div id="medicine_id"></div>
	                        </div>
	                        
<div class="col-sm-2">
	                            <input id="quantity" type="text" class="form-control" name="quantity[]"  value="" 
	                                   placeholder="<?php echo get_phrase('Dose'); ?>" required>
	                        </div>
	                        <div class="col-sm-2">
	                            <input type="number" id="dose" class="form-control" name="dose[]"  value="" 
	                                   placeholder="<?php echo get_phrase('Days'); ?>" required>
	                        </div>
	                        
	                        
	                        
	                        <div class="col-sm-1">
	                            <button type="button" class="btn btn-default" onclick="deleteParentElement(this)">
	                                <i class="entypo-trash"></i>
	                            </button>
	                        </div>
	
	                    </div>
                	</div>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="button" class="btn btn-default btn-sm btn-icon icon-left"
                                onClick="add_entry()">
                                    <?php echo get_phrase('add_product'); ?>
                            <i class="entypo-plus"></i>
                        </button>
                    </div>
                </div>
                    
                    

                    <div class="control-label text_align_center">
                        <input id="submit" type="submit" class="btn btn-success " value="Submit" style="margin-top:15px;">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script>


    // CREATING BLANK INVOICE ENTRY
    var blank_invoice_entry = '';
    $(document).ready(function () {

    	
    	
    	validate = function (selectedItem){
    		
    	}

    	$('#date_timestamp').change(function () {
			validate();
		});
		
    	$('#time_timestamp').change(function () {
			validate();
		});
		
    	$('#selected_pet').change(function () {
			validate();
		});
               $('#product').change(function () {
			validate();
		});
		
    	$('#dose').keyup(function () {
			validate();
		});
		
    	$('#quantity').keyup(function () {
			validate();
		});
		
		
        blank_invoice_entry = $('#invoice_entry').html();
        $.ajax({
				url:"<?php echo base_url();?>/index.php?doctor/invoice_manage/get_all_medicine",
				dataType:"json",
				type:"post",
				success:function(data){
						 var str = '<select onchange="validate(this)" class="form-control" name="medicine_id[]" required><option value="" selected disabled>--Select Product --</option>';
					for (var x = 0; x < data.data.length; x++) {

$('#product').hide();
								str += "<option value="+ data.data[x].medicine_id  +">" + data.data[x].name + "</option>";
					} 
					 str += '</select></div></div> </div> </div>';
					 $("#medicine_id").html(str);
				}
			});
    });

    function add_entry()
    {
        if(typeof(Storage) !== "undefined") {
         if (localStorage.clickcount) {
            localStorage.clickcount = Number(localStorage.clickcount)+1;
         } else {
            localStorage.clickcount = 1;
         }
      
       }




    	 $.ajax({
				url:"<?php echo base_url();?>/index.php?doctor/invoice_manage/get_all_medicine",
				dataType:"json",
				type:"post",
				success:function(data){
						var str1 = "";
					for (var x = 0; x < data.data.length; x++) {
						 str1 += "<option value="+ data.data[x].medicine_id  +">" + data.data[x].name 

						 $("#" + localStorage.clickcount).html(str1);
					} 
					str1 +=  "</option>";
				}
			});
    	var str = '<div class="form-group"><div id="invoice_entry"><div class="col-sm-3 col-md-offset-3"><select id="' + localStorage.clickcount +'" class="form-control" name="medicine_id[]"><option value="" selected>--Select Product --</option></select></div></div><div class="col-sm-2 col-sm-2"><input type="text" class="form-control" name="dose[]"  value="" placeholder="Dose" ></div><div class="col-sm-2 col-md-2"><input type="quantity" class="form-control" name="quantity[]"  value="" placeholder="Days" ></div><div class="col-sm-2 col-md-2"><button type="button" class="btn btn-default" onclick="deleteParentElement(this)"><i class="entypo-trash"></i></button></div></div></div>';
		
 		str += "</div></div> </div> </div>";

		 $("#invoice_entry").append(str);
    }

    // REMOVING INVOICE ENTRY
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
validate();
    }

</script>
