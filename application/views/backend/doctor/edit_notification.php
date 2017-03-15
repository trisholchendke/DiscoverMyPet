<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
.modal-dialog{
    width: 60% !important;
}
.modal-body{
    height: 495px !important;
}
</style>
<?php
$edit_data = $this->db->get_where('notification', array('notification_id' => $param2))->result_array();
?>

<div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('edit_notification'); ?>
                    </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="panel-body">

                    <?php echo form_open('doctor/notification/update/' . $param2, array('class' => 'form-horizontal form-groups validate invoice-edit', 'enctype' => 'multipart/form-data')); ?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="name" id="title" data-validate="required" 
                                   data-message-required="<?php echo get_phrase('value_required'); ?>" 
                                   value="<?php echo $edit_data[0]['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-7">
                        <textarea rows="" cols="" name=description class="form-control"><?php echo $edit_data[0]['description']; ?></textarea>
                        </div>
                    </div>
                    
 <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('profile_image'); ?></label>

                            <div class="col-sm-5">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img src="<?php echo base_url();?>/uploads/notification_image/<?php echo $edit_data[0]['image_path']; ?>" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image_path" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        


                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <button type="submit" class="btn btn-info" id="submit-button">
                                <?php echo get_phrase('update_notification'); ?></button>
                            <span id="preloader-form"></span>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
