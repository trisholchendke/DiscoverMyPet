<?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
$edit_invoice = $this->db->get_where('invoice_medicine', array('invoice_id' => $edit_data[0]['invoice_id']))->result_array();
$medicine = $this->db->get_where('medicine')->result_array();
?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_invoice'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open('groomer/invoice_manage/update/' . $param2, array('class' => 'form-horizontal form-groups validate invoice-edit', 'enctype' => 'multipart/form-data')); ?>

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
                        <input type="number" class="form-control" name="fees" value="<?php echo $edit_data[0]['fees'] ?>" >
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
                        
                        <select name="medicine_id[]" class="select2" value>
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
                            <input type="text" class="form-control" name="quantity[]"  value="<?php echo $edit_invoice[$i]['quantity'] ?>" 
                                   placeholder="<?php echo get_phrase('quantity'); ?>" >
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="price[]"  value="<?php echo $edit_invoice[$i]['price'] ?>" 
                                   placeholder="<?php echo get_phrase('price (Unit)'); ?>" >
                        </div>
                    <?php }?>
                       

                    </div>
                </div>
                    <hr>


                   <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Select Pet'); ?></label>

                    <div class="col-sm-5">
                        <select name="patient_id" class="select2">
                            <option><?php echo get_phrase('select_a_patient'); ?></option>
                            <?php
                            $patients = $this->db->get_where('patient',array('user_id' =>$this->session->userdata('login_user_id') ))->result_array();
                            foreach ($patients as $row2):
                                ?>
                                <option value="<?php echo $row2['patient_id']; ?>" <?php if ($edit_data[0]['patient_id'] == $row2['patient_id']) echo 'selected'; ?>>
                                    <?php echo $row2['name']; ?>
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
                            <button type="submit" class="btn btn-info" id="submit-button">
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

    // CREATING BLANK INVOICE ENTRY
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
