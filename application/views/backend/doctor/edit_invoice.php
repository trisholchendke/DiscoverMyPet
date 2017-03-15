<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>

<?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
$edit_invoice = $this->db->get_where('invoice_medicine', array('invoice_id' => $edit_data[0]['invoice_id']))->result_array();
$medicine = $this->db->get_where('medicine',array("doctor_id" => $this->session->userdata('login_user_id')))->result_array();
?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_invoice'); ?>
                    </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="panel-body">

                    <?php echo form_open('doctor/invoice_manage/update/' . $param2, array('class' => 'form-horizontal form-groups validate invoice-edit', 'enctype' => 'multipart/form-data')); ?>
                     <input type="hidden" id="service_tax" value=" <?php $service_tax = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->service_tax;
                                        echo $service_tax;
                                    ?>">
                <input type="hidden" id="vat_percentage" value=" <?php $vat_percentage = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->vat_percentage;
                                        echo $vat_percentage;
                                    ?>">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('invoice_title'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                                   data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                   value="<?php echo $edit_data[0]['title']; ?>">
                        </div>
                    </div>
                      <div class="form-group">
                       <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('fees'); ?></label>
                       <div class="col-sm-5">
                           <input type="number" onkeyup="calculate_service_tax(this)" class="form-control" name="fees" value="<?php echo $edit_data[0]['fees'] ?>" >
                       </div>
                     </div>
                       <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Service Tax (<?php $service_tax = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->service_tax;
                                        echo $service_tax;
                                    ?>%)</label>

                    <div class="col-sm-5">
                        <input type="text" id="service_tax1" class="form-control" name="service_tax" readonly>
                    </div>
                </div>
                    <hr>
                    <div >
                    <div class="form-group">
                    <?php 
                    for($i=0;$i<count($edit_invoice);$i++){
                    
                    
                    ?>
                     <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Product'); ?></label>
						<input type="hidden" name="medicine_invoice_id[]" value="<?php echo $edit_invoice[$i]['id'] ?>">
                        <div class="col-sm-4">
                        
                        <select onchange="get_product_data(this)" id="<?php echo $i; ?>" name="medicine_id[]" class="form-control">
                            <?php
                            foreach ($medicine as $row2):
                                ?>
                                <option value="<?php echo $row2['medicine_id']; ?>" <?php if ($row2['medicine_id'] == $edit_invoice[$i]['medicine_id']) echo 'selected'; ?>>
                                    <?php echo $row2['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        
                        </div>
                        <div class="col-sm-3">
                            <input onkeyup="cal_price(this)" id="quantity_<?php echo $i; ?>" type="text" class="form-control" name="quantity[]"  value="<?php echo $edit_invoice[$i]['quantity'] ?>" 
                                   placeholder="<?php echo get_phrase('quantity'); ?>" >
                        </div>
                        <div class="col-sm-2">
                            <input id="price_<?php echo $i; ?>" type="text" class="form-control" name="price[]"  value="<?php echo $edit_invoice[$i]['price'] ?>" 
                                   placeholder="<?php echo get_phrase('price (Unit)'); ?>" readonly>
                        </div>
                        <input type="hidden"  id="actual_amount_<?php echo $i; ?>">
                    <?php }?>
                       

                    </div>
                </div>
                    <hr>
                    
                   <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_amount'); ?></label>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control" name="total_amount"  
                                       value="<?php echo $edit_data[0]['total_amount']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                 <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Vat Percentage (<?php $vat_percentage = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->vat_percentage;
                                        echo $vat_percentage;
                                    ?>%)</label>

                    <div class="col-sm-5">
                            <input type="number" name="vat_percentage"  id="vat_percentage1" class="form-control" readonly>
                           
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Final Amount</label>

                    <div class="col-sm-5">
                            <input type="number" name="final_amount"  id="final_amount" class="form-control" readonly>
                           
                    </div>
                </div>
                    

                   <div class="form-group">
                   
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Select Pet'); ?></label>

                    <div class="col-sm-5">
                        <select name="patient_id" class="form-control">
                            <option><?php echo get_phrase('select_a_patient'); ?></option>
                            <?php
                            $patients = $this->db->get_where('patient',array('doctor_id' =>$this->session->userdata('login_user_id') ))->result_array();
                            foreach ($patients as $row2):
                                ?>
                                <option value="<?php echo $row2['patient_id']; ?>" <?php if ($edit_data[0]['patient_id'] == $row2['patient_id']) echo 'selected'; ?>>
                                    <?php echo $row2['name']; ?>-<?php echo $row2['parent_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('creation_date'); ?></label>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input type="text" class="form-control datepicker" name="creation_timestamp"  
                                       value="<?php echo $edit_data[0]['creation_timestamp']; ?>" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="due_timestamp" <?php if ($edit_data[0]['status'] == 'paid') echo 'hidden'; ?>>
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('due_date'); ?></label>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <input type="text" class="form-control datepicker" name="due_timestamp"  
                                       value="<?php echo $edit_data[0]['due_timestamp']; ?>" >
                            </div>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('payment_status'); ?></label>

                        <div class="col-sm-5">
                            <select name="status" class="selectboxit" id="payment_status">
                                <option><?php echo get_phrase('select_a_status'); ?></option>
                                <option value="paid" <?php if ($edit_data[0]['status'] == 'paid') echo 'selected'; ?>>
                                    <?php echo get_phrase('paid'); ?>
                                </option>
                                <option value="unpaid"<?php if ($edit_data[0]['status'] == 'unpaid') echo 'selected'; ?>>
                                    <?php echo get_phrase('unpaid'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
<hr>
                    


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-primary" id="submit-button">
                                <?php echo get_phrase('update_invoice'); ?></button>
                            <span id="preloader-form"></span>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>



<script>
	var get_product_data = function(selectedItem){
		$.ajax({
				url:"<?php echo base_url();?>/index.php?doctor/get_medicine_data",
				dataType:"json",
				type:"post",
				data:{"medicine_id":selectedItem.value},
				success:function(data){
					var actual_price = data[0].price;
$('input[name=total_amount').val($('input[name=total_amount').val() - $("#price_" + selectedItem.id).val() +              actual_price * $("#quantity_" + selectedItem.id).val());
$('#vat_percentage1').val(Math.round(($('input[name=total_amount').val() * $('#vat_percentage').val()) / 100));

					$("#price_" + selectedItem.id).val(actual_price * $("#quantity_" + selectedItem.id).val());
					$("#actual_amount_" + selectedItem.id).val(data[0].price);




					
$('#final_amount').val(Math.round(Number($('input[name=total_amount').val()) + Number($('#vat_percentage1').val()) + Number($('#service_tax1').val()) + Number($('input[name=fees').val())));

				}
			});
	}
	function cal_price(selectedItem) {
		
		   var id = selectedItem.id;
		   id = id.replace("quantity_", "");
		$.ajax({
			url:"<?php echo base_url();?>/index.php?doctor/get_medicine_data",
			dataType:"json",
			type:"post",
			data:{"medicine_id":$("#" + id).val()},
			success:function(data){
				$("#actual_amount_" + id).val(data[0].price);

$('input[name=total_amount').val($('input[name=total_amount').val() - $("#price_" + id).val() + $("#actual_amount_" + id).val() * selectedItem.value);
$('#vat_percentage1').val(Math.round(($('input[name=total_amount').val() * $('#vat_percentage').val()) / 100));
				$("#price_" + id).val($("#actual_amount_" + id).val() * selectedItem.value);
                              


$('#final_amount').val(Math.round(Number($('input[name=total_amount').val()) + Number($('#vat_percentage1').val()) + Number($('#service_tax1').val()) + Number($('input[name=fees').val())));
			}
		});

		
	}
	
	 $('#service_tax1').val(Math.round(($('input[name=fees').val() * $('#service_tax').val()) / 100));
	 $('#vat_percentage1').val(Math.round(($('input[name=total_amount').val() * $('#vat_percentage').val()) / 100));
	 $('#final_amount').val(Math.round(Number($('input[name=total_amount').val()) + Number($('#vat_percentage1').val()) + Number($('#service_tax1').val()) + Number($('input[name=fees').val())));
	function calculate_service_tax(selectedItem){
		
	    $('#service_tax1').val(Math.round((selectedItem.value * $('#service_tax').val()) / 100));
 $('#final_amount').val(Math.round(Number($('input[name=total_amount').val()) + Number($('#vat_percentage1').val()) + Number($('#service_tax1').val()) + Number($('input[name=fees').val())));
	}
	
    var blank_invoice_entry = '';
    $(document).ready(function () {

    $('#payment_status').change(function(){
				if($('#payment_status').val() == "unpaid"){
					jQuery("#due_timestamp").show();
				}else{
					jQuery("#due_timestamp").hide();
					}
				 validate();
			});
        blank_invoice_entry = $('#invoice_entry_temp').html();
        $('#invoice_entry_temp').remove();
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
