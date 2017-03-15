<?php
$department_info = $this->db->get('department')->result_array();
$single_doctor_info = $this->db->get_where('users', array('id' => $param2))->result_array();
foreach ($single_doctor_info as $row) {
	?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_user'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?admin/doctor/update_user/<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>">
                            </div>
                        </div>

                      <div class="form-group">
                                   <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('role'); ?></label>
											<div class="col-sm-5">
											<select  name="role" class="form-control" required>
													<option value"Doctor" <?php if($row['role'] == 'Doctor') echo "selected" ?>>Doctor</option>
						                           	<option value"Kennel" <?php if($row['role'] == 'Kennel') echo "selected" ?>>Kennel</option>
						                           	<option value"Groomer" <?php if($row['role'] == 'Groomer') echo "selected" ?>>Groomer</option>
						                           	<option value"Trainers" <?php if($row['role'] == 'Trainers') echo "selected" ?>>Trainers</option>
						                           	<option value"Breeder" <?php if($row['role'] == 'Breeder') echo "selected" ?>>Breeder</option>
						                           	<option value"Ambulance Service" <?php if($row['role'] == 'Ambulance Service') echo "selected" ?>>Ambulance Service</option>
						                           	<option value"Pet Relocation" <?php if($row['role'] == 'Doctor') echo "Pet Relocation" ?>>Pet Relocation</option>
						                           	<option value"Pet Bakery" <?php if($row['role'] == 'Doctor') echo "Pet Bakery" ?>>Pet Bakery</option>
						                           	<option value"Dog Walker" <?php if($row['role'] == 'Dog Walker') echo "selected" ?>>Dog Walker</option>
						                           	<option value"Obituary" <?php if($row['role'] == 'Obituary') echo "selected" ?>>Obituary</option>
						                           	<option value"Restaurants" <?php if($row['role'] == 'Restaurants') echo "selected" ?>>Restaurants</option>
						                          
											</select>
											</div>
						</div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                            <div class="col-sm-5">
                                <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>">
                            </div>
                        </div>
                        
						 <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('password'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="password" class="form-control" id="field-1" value="<?php echo base64_decode($row['password']); ?>">
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
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('profile'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="profile" class="form-control" id="field-ta">
                                    <?php echo $row['profile']; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('image'); ?></label>

                            <div class="col-sm-5">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo $this->crud_model->get_image_url('doctor' , $row['doctor_id']);?>" alt="...">
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

                        <div class="col-sm-3 control-label col-sm-offset-2">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>