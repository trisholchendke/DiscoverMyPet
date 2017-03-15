<style>
.close_btn {
    margin-right: 10px;
    margin-top: 10px;
    font-size: 20px;
}
</style>
<?php $supplier= $this->db->get_where('supplier',array( 'doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_product'); ?></h3>
<p> * Fields are Mandatory</p>
                </div>
                <button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="panel-body">
         

                <form id="commentForm" role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/stock/create" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name *'); ?></label>

                        <div class="col-sm-6">

                            <input id="name" type="text" name="name" minlength="2" class="form-control" id="field-1" required>

 
     
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('main_category *'); ?></label>
                        <div class="col-sm-6">
                            <select id="medicine_category_id" onchange="get_medicine_subcategory(this)" name="medicine_category_id" class="form-control" required>
                                <option value=""><?php echo get_phrase('select_main_category'); ?></option>
                                <?php 
                                		
                                		$this->db->select('*');
                                		$this->db->from('medicine_category');
                                		$this->db->where('doctor_id',$this->session->userdata('login_user_id'));
$this->db->or_where('category_for_all','True');
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
                    
                   <div id="medicine_sub_category_add_stock"></div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Supplier *'); ?></label>

                        <div class="col-sm-6">
                            <select name="supplier_id" class="form-control" id="supplier_id" required>
                                <option value=""><?php echo get_phrase('select_supplier'); ?></option>
                                <?php foreach ($supplier as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-6">
                            <textarea id="description" name="description" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Brand_Name *'); ?></label>

                        <div class="col-sm-6">
                            <input type="text" name="manufacturing_company" class="form-control" id="field-ta" required>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('quantity *'); ?></label>

                        <div class="col-sm-6">
                             <input type="number"  name="quantity" class="form-control" id="field-ta" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('price (Unit) *'); ?></label>

                        <div class="col-sm-6">
                            <input type="number"  name="price" class="form-control" id="field-ta" required>
                        </div>
                    </div>
                    
                   
                    

                     <div class="form-group">
                    <div class="text-center">
                        <button id="add_stock" type="submit" class="btn btn-info" id="submit-button">
                            <?php echo get_phrase('Submit'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                </form>

            </div>

        </div>

    </div>
</div>


<script type="text/javascript">
    	$(document).ready(function(){
        	
    	})
    	function cancel(){
			window.history.back();
		}
 </script>
<script>
function get_medicine_subcategory(categoryID) {
    var selectedValue = categoryID.value;
    
  $.ajax({
		 url:"<?php echo base_url() ;?>index.php?doctor/get_medicine_subcategory",
		 dataType:"json",
		 data:{medicine_category_id:selectedValue},
		 type:"post",
		 success:function(data){
			 
			 if(data.status == 200){
					 var str = '<div class="form-group"><label for="field-ta" class="col-sm-3 control-label">Sub Category</label><div class="col-sm-5"><div class="item" ><select class="form-control" name="medicine_sub_category_id" required><option value="" selected disabled>--Select Sub Category--</option>';
				 for(var i=0;i<data.data.length;i++){
						str += "<option value="+ data.data[i].id  +">" + data.data[i].name + "</option>";
						
					 }
				 str += "</select></div></div> </div> </div>";
				 
				 $("#medicine_sub_category_add_stock").html(str);
			}
		 }
	 });
}
</script>
