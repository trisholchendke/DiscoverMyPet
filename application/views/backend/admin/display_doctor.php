<?php
$this->db->select('*');
    	$this->db->from('doctor');
    	$this->db->where('doctor_id',$param2);
$this->db->order_by("doctor_id", "desc");
    	$query = $this->db->get();
    	$single_doctor_info = $query->result_array();

foreach ($single_doctor_info as $row) {
	?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('display user'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?admin/doctor/update/<?php echo $row['doctor_id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $row['name']; ?>" readonly>
                            </div>
                        </div>
                        
                        
                              <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                            <?php echo $row['name']; ?>
                               
                            </div>
                        </div>
                        
                       <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('role'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="role" class="form-control" id="field-1" value="<?php echo $row['role']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                            <div class="col-sm-5">
                                <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $row['email']; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="address" class="form-control" id="field-ta" readonly>
                                    <?php echo $row['address']; ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                            <div class="col-sm-5">
                                <input type="text" name="phone" class="form-control" id="field-1" value="<?php echo $row['phone']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('profile'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="profile" class="form-control" id="field-ta" readonly>
                                    <?php echo $row['profile']; ?>
                                </textarea>
                            </div>
                        </div>
                        
                          <td>
                   
                </td>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('image'); ?></label>

                            <div class="col-sm-5">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                  
                                </div>
										 <img src="<?php echo $this->crud_model->get_image_url('doctor' , $row['doctor_id']);?>" 
                         class="img-circle" width="40px" height="40px">
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>