<?php
$doctor_id          = $this->session->userdata('login_user_id');
$single_doctor_info = $this->db->get_where('doctor', array('doctor_id' => $doctor_id))->result_array();
foreach ($single_doctor_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_profile'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/profile/update" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                            <div class="col-sm-5">
                                <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>"  required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                            <div class="col-sm-5">
                                <textarea name="address" class="form-control " 
                                    id="field-ta"><?php echo $row['address']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                            <div class="col-sm-5">
                                <input type="text"  min=0 name="phone" pattern="\d{10}" title="Please enter exactly 10 digits number"  class="form-control" id="field-1" value="<?php echo $row['phone']; ?>" required>
                            </div>
                        </div>

<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('alternate_contact_no'); ?></label>

                            <div class="col-sm-5">
                                <input  pattern="\d{8,11}" title="pleaze enter min 8 digits & max 11 digits number"  name="alternate_contact_no1" class="form-control" id="field-1" value="<?php echo $row['alternate_contact_no1']; ?>">
                            </div>
                        </div>
<div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('alternate_contact_no'); ?></label>

                            <div class="col-sm-5">
                                <input  pattern="\d{8,11}" title="pleaze enter min 8 digits & max 11 digits number" name="alternate_contact_no2" class="form-control" id="field-1" value="<?php echo $row['alternate_contact_no2']; ?>">
                            </div>
                        </div>

                       
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('website_name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="website_name" class="form-control" id="field-1" value="<?php echo $row['website_name']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('registration_no'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="registration_no" class="form-control" id="field-1" value="<?php echo $row['registration_no']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('clinic_name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="clinic_name" class="form-control" id="field-1" value="<?php echo $row['clinic_name']; ?>" required>
                            </div>
                        </div>
                       
                         <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('clinic_logo'); ?></label>

                            <div class="col-sm-5">

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
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('vat_percentage (%)'); ?></label>

                            <div class="col-sm-5">
                                <input type="number" name="vat_percentage" class="form-control" id="field-1" step=any value="<?php echo $row['vat_percentage']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('service_tax (%)'); ?></label>

                            <div class="col-sm-5">
                                <input type="number" name="service_tax" class="form-control" step=any id="field-1" value="<?php echo $row['service_tax']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('profile_image'); ?></label>

                            <div class="col-sm-5">

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
                        
                        
                        
                       
                        
                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('change_password'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/profile/change_password" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('old_password'); ?></label>

                            <div class="col-sm-5">
                                <input type="password" name="old_password" class="form-control" id="field-1">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('new_password'); ?></label>

                            <div class="col-sm-5">
                                <input type="password" name="new_password" class="form-control" id="field-1">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password'); ?></label>

                            <div class="col-sm-5">
                                <input type="password" name="confirm_new_password" class="form-control" id="field-1">
                            </div>
                        </div>
                        
                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>