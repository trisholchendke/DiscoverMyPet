<?php $supplier= $this->db->get('supplier',array( 'user_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_stock'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?obituary/stock/create" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-5">
                            <input id="name" type="text" name="name" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('main_category'); ?></label>
                        <div class="col-sm-6">
                            <select id="medicine_category_id" onchange="get_medicine_subcategory(this)" name="medicine_category_id" class="select2">
                                <option value=""><?php echo get_phrase('select_main_category'); ?></option>
                                <?php 
                                		
                                		$this->db->select('*');
                                		$this->db->from('medicine_category');
                                		$this->db->where('user_id',$this->session->userdata('login_user_id'));
                                		$query = $this->db->get();
if($query->num_rows() != 0)
    		{ $medicine_category_info = $query->result_array()?>
    		
    		 <?php foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
    		<?php
    		
    		}
    		else
    		{
    			return false;
    		}
    		?>
                                		
    		
                                
                               
                            </select>
                        </div>
                    </div>
                    
                   <div id="medicine_sub_category"></div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Spplier'); ?></label>

                        <div class="col-sm-5">
                            <select name="supplier_id" class="form-control" id="supplier_id">
                                <option value=""><?php echo get_phrase('select_supplier'); ?></option>
                                <?php foreach ($supplier as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-9">
                            <textarea id="description" name="description" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('quantity'); ?></label>

                        <div class="col-sm-9">
                             <input type="number" min="0" name="quantity" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price (Unit)'); ?></label>

                        <div class="col-sm-5">
                            <input type="number" min="0" name="price" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Brand_Name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="manufacturing_company" class="form-control" id="field-1" >
                        </div>
                    </div>
                    

                     <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
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
		jQuery("#submit").prop("disabled", true);
		validate = function (){
			if($('input[name=manufacturing_company]').val() != "" && $('input[name=price]').val() != "" && $('input[name=quantity]').val() != "" && $('#medicine_category_id').val() != "" && $('#supplier_id').val() != "" && $("input[name=name]").val() != "" && $('#description').val() != ""){
					jQuery("#submit").prop("disabled", false);
				}
		}
		$('#medicine_category_id').change(function () {
			validate();
		});
		$('#medicine_sub_category').change(function () {
			validate();
		});
		$('#supplier_id').change(function () {
			validate();
		});
		$("input[name=name]").keyup(function(){
			validate();
		});
		
		$('#description').keyup(function () {
			validate();
		});
		$('input[name=quantity]').keyup(function () {
			
			if(!isNaN($('input[name=quantity]').val()) == true){
					validate();
				}else{
												alert("enter only number");
												$('input[name=quantity]').val() = "";
					}
		});
		$('input[name=price]').keyup(function () {
			validate();
		});
		$('input[name=manufacturing_company]').keyup(function () {
			validate();
		});
	})

function get_medicine_subcategory(categoryID) {
      var selectedValue = categoryID.value;
    $.ajax({
		 url:"<?php echo base_url() ;?>index.php?obituary/get_medicine_subcategory",
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