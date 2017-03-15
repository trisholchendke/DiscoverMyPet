<style>
#field-1{
height:40px;
}
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
.modal{
top:0px !important;
}
.modal-dialog{
    width: 50% !important;
}
.modal-body{
height:312px !important;
}
</style>

<?php 

        $this->db->select('*');
    	$this->db->from('medicine_category');
    	$this->db->where('doctor_id',$this->session->userdata('login_user_id'));
        $this->db->or_where('category_for_all','True');
    	$query = $this->db->get();
    	$medicine_category_info = $query->result_array();
 ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_sub_category'); ?></h3>
                </div>
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/medicine_sub_category/create" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('select_main_category'); ?></label>

                        <div class="col-sm-7">
                            <select id="medicine_category_id" name="medicine_category_id" class="select2" required>
                                <option value="" selected disabled><?php echo get_phrase('select_main_category'); ?></option>
                               <?php foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" id="field-1" required>
                        </div>
                    </div>
<br>

                     <div class="form-group">
                    <div class=" col-sm-12 " style="text-align:center;">
                        <button id="submit" type="submit" class="btn btn-info" id="submit-button">
                            <?php echo get_phrase('Submit'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                </form>

            </div>

        </div>

    </div>
</div>
<script>
	$(document).ready(function(){
		
		validate = function (){
			
		}
		
		$('#medicine_category_id').change(function () {
			validate();
		});
		
		
		
		$('input[name=name]').keyup(function () {
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