<?php
	$breed_info = $this->db->get_where('breed', array('breed_id' => $param2))->result_array();
	foreach ($breed_info as $row) {
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_breed'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" enctype="multipart/form-data"
                    action="<?php echo base_url(); ?>index.php?doctor/manage_breed/update/<?php echo $breed_info[0]['breed_id']; ?>" method="post">

 					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('breed'); ?></label>
                        <div class="col-sm-7">
                           <input class="form-control" type="text" name="breed" placeholder="Enter Breed" value="<?php echo $breed_info[0]['name']; ?>">
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<?php }; ?>
	