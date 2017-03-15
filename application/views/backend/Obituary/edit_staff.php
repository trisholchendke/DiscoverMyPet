<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_staff'); ?></h3>
                </div>
            </div>
             <?php 
             	$user    = $this->db->get_where('users', array('id' => $param2))->result_array();
             ?>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?obituary/manage_staff/update" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $user[0]['id']; ?>">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">
                            <input type="hidden" name="id" class="form-control" id="field-1" value="<?php echo $user[0]['id']; ?>">
                            <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $user[0]['name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-5">
                            <input type="email" name="email" class="form-control" id="field-1" value="<?php echo $user[0]['email']; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('role'); ?></label>

                        <div class="col-sm-5">
                           <select name="role" class="form-control" value="<?php echo $user[0]['role']; ?>">
	                           	<option value="Sub Doctor" <?php if($user[0]['role'] == "Sub Doctor") echo "selected"?>>Sub Doctor</option>
	                           	<option value="Kennel"  <?php if($user[0]['role'] == "Kennel") echo "selected"?>>Kennel</option>
	                           	<option value="Groomer" <?php if($user[0]['role'] == "Groomer") echo "selected"?>>Groomer</option>
	                           	<option value="Trainers" <?php if($user[0]['role'] == "Trainers") echo "selected"?>>Trainers</option>
	                           	<option value="Breeder" <?php if($user[0]['role'] == "groomer") echo "selected"?>>Breeder</option>
	                           	<option value="Ambulance Service"  <?php if($user[0]['role'] == "Ambulance Service") echo "selected"?>>Ambulance Service</option>
	                           	<option value="Pet Relocation" <?php if($user[0]['role'] == "Pet Relocation") echo "selected"?>>Pet Relocation</option>
	                           	<option value="Pet Bakery" <?php if($user[0]['role'] == "Pet Bakery") echo "selected"?>>Pet Bakery</option>
	                           	<option value="Dog Walker" <?php if($user[0]['role'] == "Dog Walker") echo "selected"?>>Dog Walker</option>
	                           	<option value="Obituary" <?php if($user[0]['role'] == "Restaurants") echo "selected"?>>Restaurants</option>
	                           	<option value="Restaurants" <?php if($user[0]['role'] == "Restaurants") echo "selected"?>>Restaurants</option>
                           </select>
                        </div>
                    </div>

                    
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-9">
                            <textarea name="address" class="form-control" id="field-ta" ><?php echo $user[0]['address'] ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="phone" class="form-control" id="field-1" value="<?php echo $user[0]['phone']; ?>">
                        </div>
                    </div>
                    
                    
                    

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>