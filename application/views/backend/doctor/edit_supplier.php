<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
.modal{
top:0px !important;
}
.modal-dialog{
width:60% !important;
}
.modal-body{
    height: 450px !important;

}
.text_align_center{
text-align:center !important;
}
</style>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_supplier'); ?></h3>
                </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
             <?php $user    = $this->db->get_where('supplier', array('id' => $param2))->result_array();
             ?>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/supplier/update" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $user[0]['id']; ?>">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">
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
                    
                    <br>
                    <div class="row control-label text-center text_align_center">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>

                   
                </form>
 
            </div>

        </div>

    </div>
</div>