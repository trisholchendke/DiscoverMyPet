<style>
.custom_input_size{
height:41px !important;
}
.modal-body{
    height: 500px !important;
    overflow: auto !important;
    overflow-x: hidden !important;
    padding: 6px !important;
    overflow-y: auto !important;
}
.modal{
    top: 0px !important;
}
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>

<?php
$menu_check                 = $param3;
$patient_info               = $this->db->get_where('patient',array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
$prescription_info   = $this->db->get_where('prescription', array('prescription_id' => $param2))->result_array();
	
$product_prescription_info   = $this->db->get_where('product_prescreption', array('precreption_id' => $prescription_info[0]['prescription_id']))->result_array();


$medicine  = $this->db->get_where('medicine', array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_prescription'); ?></h3>
                </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/prescription/update/<?php echo $prescription_info[0]['prescription_id'] ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                    <input type="text" name="date_timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                           placeholder="date here" value="<?php echo date("D, d M Y", $prescription_info[0]['timestamp']); ?>">
                                    <input type="text" name="time_timestamp" class="form-control timepicker" data-template="dropdown" 
                                           data-show-seconds="false" data-default-time="00:05 AM" data-show-meridian="false" 
                                           data-minute-step="5"  placeholder="time here" value="<?php echo date("H:i", $prescription_info[0]['timestamp']); ?>">
                                </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('pet'); ?></label>

                        <div class="col-sm-7">
                            <select id="selected_pet" name="patient_id" class="select2">
                                <?php foreach ($patient_info as $row) { ?>
                                        <option value="<?php echo $row['patient_id']; ?>" <?php if($prescription_info[0]['patient_id'] == $row['patient_id']) echo "selected"?>><?php echo $row['name']; ?>-<?php echo $row['parent_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
               
                    
                   
                    <?php 
                    for($i=0;$i<count($product_prescription_info);$i++){
                    
                    
                    ?>
					 <div class="form-group">
<input type="hidden" name="product_prescription_id[]" value="<?php echo $product_prescription_info[$i]['id'] ?>">
                     <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Product'); ?></label>
						<input type="hidden" name="medicine_invoice_id[]" value="<?php echo $product_prescription_info[$i]['id'] ?>">
                        <div class="col-sm-3">
                        
                        <select name="medicine_id[]" class="select2" value>
                            <?php
                            foreach ($medicine as $row2):
                                ?>
                                <option value="<?php echo $row2['medicine_id']; ?>" <?php if ($row2['medicine_id'] == $product_prescription_info[$i]['medicine_id']) echo 'selected'; ?>>
                                    <?php echo $row2['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <div class="col-sm-2">
                            <input  type="text" class="custom_input_size form-control" name="dose[]"  value="<?php echo $product_prescription_info[$i]['dose'] ?>" 
                                   placeholder="<?php echo get_phrase('dose'); ?>" >
                        </div>
                        
                        <div class="col-sm-2">
                            <input type="number" class="custom_input_size form-control" name="quantity[]"  value="<?php echo $product_prescription_info[$i]['quantity'] ?>" 
                                   placeholder="<?php echo get_phrase('quantity'); ?>" >
                        </div>
                      
                    

                    </div>
					<?php }?>
					

                    <div class="text-center" style="margin-top: 20px;">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit">
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
        blank_invoice_entry = $('#invoice_entry').html();
        $.ajax({
				url:"<?php echo base_url();?>/index.php?doctor/invoice_manage/get_all_medicine",
				dataType:"json",
				type:"post",
				success:function(data){
					for (var x = 0; x < data.data.length; x++) {
						 var str = '<select class="form-control" name="medicine_id[]"><option value="" selected disabled>--Select Product --</option>';
								str += "<option value="+ data.data[x].medicine_id  +">" + data.data[x].name + "</option>";
								
						 str += "</select></div></div> </div> </div>";

						 $("#medicine_id").html(str);
					} 
				}
			});
    });

    function add_entry()
    {
    	 $.ajax({
				url:"<?php echo base_url();?>/index.php?doctor/invoice_manage/get_all_medicine",
				dataType:"json",
				type:"post",
				success:function(data){
					for (var x = 0; x < data.data.length; x++) {
						 var str = '<div class="form-group"><div id="invoice_entry"><div class="col-sm-3"><select class="form-control" name="medicine_id[]"><option value="" selected disabled>Select Product</option><option value='+ data.data[x].medicine_id  +'>' + data.data[x].name + '</option></select></div><div class="col-sm-2"><input type="text" class="form-control" name="dose[]"  value="" placeholder="Dose" ></div><div class="col-sm-2"><input type="quantity" class="form-control" name="quantity[]"  value="" placeholder="Quantity" ></div><div class="col-sm-2"><button type="button" class="btn btn-default" onclick="deleteParentElement(this)"><i class="entypo-trash"></i></button></div></div></div>';
								
						 		str += "</div></div> </div> </div>";

								 $("#invoice_entry").append(str);
					} 
				}
			});
       
        
    }

    // REMOVING INVOICE ENTRY
    function deleteParentElement(n) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
    }

</script>