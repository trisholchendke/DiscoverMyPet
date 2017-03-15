<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
.modal-body{
    height: 430px !important;
}
.modal{
top:0px !important;
}
.modal-dialog{
    width: 55% !important;

}
</style>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_supplier'); ?></h3>
                </div>
                <button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/supplier/create" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="field-1" >
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-6">
                            <textarea name="address" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="phone" class="form-control" id="field-1">
                        </div>
                    </div>
                    
                    
                    

                    <div class="text-center">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit" style="margin-top: 20px;">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script>
	$(document).ready(function(){
		jQuery("#submit").prop("disabled", true);
		validate = function (){
			if($('input[name=name]').val() != "" && $('input[name="email"]').val() != "" && $('input[name="address"]').val() != "" && $('input[name="phone"]').val() != ""){
					jQuery("#submit").prop("disabled", false);
				}
		}
		
		$('input[name=name]').keyup(function () {
			validate();
		});
		$('input[name=email]').keyup(function () {
			validate();
		});
		$('input[name=address]').keyup(function () {
			validate();
		});
		$('input[name=phone]').keyup(function () {
			validate();
		});
	})

function get_medicine_subcategory(categoryID) {
      var selectedValue = categoryID.value;
    $.ajax({
		 url:"<?php echo base_url() ;?>index.php?doctor/get_medicine_subcategory",
		 dataType:"json",
		 data:{medicine_category_id:selectedValue},
		 type:"post",
		 success:function(data){
			 if(data.status == 200){
					 var str = ' <div class="form-group"><label for="field-ta" class="col-sm-3 control-label">Sub Category</label><div class="col-sm-5"><div class="item" ><select class="form-control" name="medicine_sub_category_id"><option value="" selected disabled>--Select Sub Category--</option>';
				 for(var i=0;i<data.data.length;i++){
						str += "<option value="+ data.data[i].id  +">" + data.data[i].name + "</option>";
						
					 }
				 str += "</select></div></div> </div> </div>";

				 $("#medicine_sub_category").html(str);
			}
		 }
	 });
}
</script>