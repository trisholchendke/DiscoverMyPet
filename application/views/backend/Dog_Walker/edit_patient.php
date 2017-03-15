<?php
$single_patient_info = $this->db->get_where('patient', array('patient_id' => $param2))->result_array();
foreach ($single_patient_info as $row) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_patient'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?dog_walker/patient/update/<?php echo $row['patient_id']; ?>" method="post" enctype="multipart/form-data">
						
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                            <div class="col-sm-5">
                                <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="address" class="form-control" id="field-ta">
                                    <?php echo $row['address']; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="phone" class="form-control" id="field-1" value="<?php echo $row['phone']; ?>">
                            </div>
                        </div>
<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('species'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="species" class="form-control" id="field-1" value="<?php echo $row['species']; ?>">
                        </div>
                    </div>
<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('breed'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="breed" class="form-control" id="field-1" value="<?php echo $row['breed']; ?>">
                        </div>
                    </div>
<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Grooming_Package'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="grooming_package" class="form-control" id="field-1" value="<?php echo $row['grooming_package']; ?>">
                        </div>
                    </div>
<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('sterilization_status'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="sterilization_status" class="form-control" id="field-1" value="<?php echo $row['sterilization_status']; ?>">
                        </div>
                    </div>
<div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('color'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="color" class="form-control" id="field-1" value="<?php echo $row['color']; ?>">
                        </div>
                    </div>


                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('sex'); ?></label>

                            <div class="col-sm-5">
                                <select name="sex" class="form-control">
                                    <option value=""><?php echo get_phrase('select_sex'); ?></option>
                                    <option value="male" <?php if ($row['sex'] == 'male')echo 'selected';?>>
                                        <?php echo get_phrase('male'); ?>
                                    </option>
                                    <option value="female" <?php if ($row['sex'] == 'female')echo 'selected';?>>
                                        <?php echo get_phrase('female'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('birth_date'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="birth_date" class="form-control datepicker" id="field-1" value="<?php echo date("m/d/Y", $row['birth_date']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('age'); ?></label>

                            <div class="col-sm-5">
                                <input type="number" name="age" class="form-control" id="field-1" value="<?php echo $row['age']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('blood_group'); ?></label>

                            <div class="col-sm-5">
                                <select name="blood_group" class="form-control">
                                    <option value=""><?php echo get_phrase('select_blood_group'); ?></option>
                                    <option value="A+" <?php if ($row['blood_group'] == 'A+')echo 'selected';?>>A+</option>
                                    <option value="A-" <?php if ($row['blood_group'] == 'A-')echo 'selected';?>>A-</option>
                                    <option value="B+" <?php if ($row['blood_group'] == 'B+')echo 'selected';?>>B+</option>
                                    <option value="B-" <?php if ($row['blood_group'] == 'B-')echo 'selected';?>>B-</option>
                                    <option value="AB+" <?php if ($row['blood_group'] == 'AB+')echo 'selected';?>>AB+</option>
                                    <option value="AB-" <?php if ($row['blood_group'] == 'AB-')echo 'selected';?>>AB-</option>
                                    <option value="O+" <?php if ($row['blood_group'] == 'O+')echo 'selected';?>>O+</option>
                                    <option value="O-" <?php if ($row['blood_group'] == 'O-')echo 'selected';?>>O-</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('image'); ?></label>

                            <div class="col-sm-5">

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
                         <div class="form-group">
                       		 <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner_name'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="owner_name" class="form-control" id="field-1" value="<?php echo $row['owner_name'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                       		 <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner_contact_no'); ?></label>
                        <div class="col-sm-6">
                            <input type="number" name="owner_contact_no" class="form-control" id="field-1" value="<?php echo $row['owner_contact_no'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                       		 <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner_address'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="owner_address" class="form-control" id="field-1" value="<?php echo $row['owner_address'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                       		 <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('owner_email'); ?></label>
                        <div class="col-sm-6">
                            <input type="text" name="owner_email" class="form-control" id="field-1" value="<?php echo $row['owner_email'];?>">
                        </div>
                    </div>

                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>