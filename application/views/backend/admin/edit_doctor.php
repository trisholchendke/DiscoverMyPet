<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>


<?php 
$department_info = $this->db->get('department')->result_array();
$single_doctor_info = $this->db->get_where('doctor', array('doctor_id' => $param2))->result_array();
foreach ($single_doctor_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_doctor'); ?></h3>
                    </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-groups-bordered" action="<?php echo base_url(); ?>index.php?admin/doctor/update_doctor/<?php echo $row['doctor_id']; ?>" method="post" enctype="multipart/form-data">
						
						<div class="row">
						<div class="col-md-3">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('name'); ?></label>

                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>">
                           
                        </div>
                        </div>
						
						<div class="col-md-3">
						 <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('email'); ?></label>

                           
                                <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>">
                           
                        </div>
                        </div>
						
						<div class="col-md-3">
						 <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('password'); ?></label>

                           
                                <input type="text" name="password" class="form-control" id="field-1" value="<?php echo base64_decode($row['password']); ?>">
                           
                        </div>
                        </div>
						
						<div class="col-md-3">
						<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('phone'); ?></label>

                            
                                <input type="number" name="phone" class="form-control" id="field-1" value="<?php echo $row['phone']; ?>">
                           
                        </div>
                        </div>
                        </div>

						<div class="row">
						<div class="col-md-3">
						<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('alternate_contact_no'); ?></label>

                           
                                <input type="number" name="alternate_contact_no1" class="form-control" id="field-1" value="<?php echo $row['alternate_contact_no1']; ?>">
                           
                        </div>
							
						</div>
						
						<div class="col-md-3">
						<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('alternate_contact_no'); ?></label>

                                <input type="number" name="alternate_contact_no2" class="form-control" id="field-1" value="<?php echo $row['alternate_contact_no2']; ?>">
                        </div>
                        </div>
						
						
						<div class="col-md-3">
						 <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('website_name'); ?></label>

                            
                                <input type="text" name="website_name" class="form-control" id="field-1" value="<?php echo $row['website_name']; ?>">                        </div>
						
						</div>

						<div class="col-md-3">
						<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('registration_no'); ?></label>

                            
                                <input type="text" name="registration_no" class="form-control" id="field-1" value="<?php echo $row['registration_no']; ?>">
                            
                        </div>
						</div>
						
						</div>
						
						
						<div class="row">
						<div class="col-md-3">
						<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('state_council_registration_no'); ?></label>

                                <input type="text" name="state_council_registration_no" class="form-control" id="field-1" value="<?php echo $row['state_council_registration_no']; ?>">
                            
                        </div>
                        </div>
						
						<div class="col-md-3">
						 <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('clinic_name'); ?></label>
                                <input type="text" name="clinic_name" class="form-control" id="field-1" value="<?php echo $row['clinic_name']; ?>">                           
                        </div>
                        </div>
						
						<div class="col-md-3">
						<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('vat_percentage (%)'); ?></label>
                                <input type="number" name="vat_percentage" class="form-control" id="field-1" value="<?php echo $row['vat_percentage']; ?>">
                        </div>
                        </div>
						
						<div class="col-md-3">
						 <div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('service_tax (%)'); ?></label>
                                <input type="number" name="service_tax" class="form-control" id="field-1" value="<?php echo $row['service_tax']; ?>">                           
                        </div>
                        </div>
						
						
                        </div>
						
                       
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('payment_amount'); ?></label>

                                <input type="number" name="payment_amount" class="form-control" id="field-1" value="<?php echo $row['payment_amount']; ?>">
							</div>
							
							</div>
							
							
							<div class="col-md-3">
							<div class="form-group">
                            <label for="field-1" class="control-label"><?php echo get_phrase('payment_by'); ?></label>

                           
                                <input type="text" name="payment_by" class="form-control" id="field-1" value="<?php echo $row['payment_by']; ?>">
                           
                        </div>
						</div>
						
						<div class="col-md-6">
						 <div class="form-group">
                            <label for="field-ta" class="control-label"><?php echo get_phrase('address'); ?></label>

                           
                                <textarea name="address" class="form-control" id="field-ta">
                                    <?php echo $row['address']; ?>
                                </textarea>
                           
                        </div>
                        </div>
						
				
						
						
						
						
						
						</div>
                       <div class="row">
					   		<div class="col-md-3">
						                         <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('clinic_image'); ?></label>

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url();?>/uploads/doctor_image/<?php echo $row['clinic_image']; ?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="clinic_image" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                
                            
                        </div>
						</div>
						
						
						 <div class="col-sm-3">
 <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('profile_image'); ?></label>

                           
               
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url();?>/uploads/doctor_image/<?php echo $row['profile_image']; ?>" alt="...">
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

                        <div class="col-sm-12 text-center">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>