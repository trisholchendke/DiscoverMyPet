<?php
$medicine_category_info = $this->db->get('medicine_category')->result_array();
$edit_data  = $this->db->get_where('medicine', array('medicine_id' => $param2))->result_array();
?>
<?php $supplier= $this->db->get('supplier')->result_array(); 
?>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_stock'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?kennel/stock/update/<?php echo $edit_data[0]['medicine_id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>

                            <div class="col-sm-5">
                                <input type="hidden" name="id" class="form-control" id="field-1" value="<?php echo $edit_data[0]['medicine_id']; ?>">
                                <input type="text" name="name" class="form-control" id="field-1" value="<?php echo $edit_data[0]['name']; ?>">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="field-ta"><?php echo $edit_data[0]['description']; ?></textarea>
                            </div>
                        </div>
                         <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('quantity'); ?></label>

                        <div class="col-sm-9">
                             <input type="number" name="quantity" class="form-control" id="field-1"  value="<?php echo $edit_data[0]['quantity']; ?>">
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price (Unit)'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="price" class="form-control" id="field-1" value="<?php echo $edit_data[0]['price']; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('manufacturing_company'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="manufacturing_company" class="form-control" id="field-1" value="<?php echo $edit_data[0]['manufacturing_company']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('category'); ?></label>
                        <div class="col-sm-6">
                            <select id="medicine_category_id" onchange="get_medicine_subcategory(this)" name="medicine_category_id" class="select2">
                                <?php 
                                		
                                		$this->db->select('*');
                                		$this->db->from('medicine_category');
                                		$this->db->where('user_id',$this->session->userdata('login_user_id'));
                                		$query = $this->db->get();
if($query->num_rows() != 0)
    		{ $medicine_category_info = $query->result_array()?>
    		
    		 <?php foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>" <?php if($row['medicine_category_id'] == $row['medicine_category_id']) echo "selected"?> ><?php echo $row['name']; ?></option>
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
                     <div class="form-group" id="medicine_sub_category">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('sub category'); ?></label>
                        <div class="col-sm-4">
                            <select  name="medicine_sub_category_id" class="form-control">
                            	<option value="<?php echo($edit_data[0]['medicine_sub_category_id']); ?>"><?php $name = $this->db->get_where('medicine_sub_category' , array('medicine_category_id' => $edit_data[0]['medicine_category_id'] ))->row()->name;
                        echo $name;?></option>
                            </select>
                        </div>
                    </div>
                   <div id="medicine_sub_category1"></div>
                        
                        <?php ?>
                        <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('Spplier'); ?></label>

                        <div class="col-sm-5">
                            <select name="supplier_id" class="form-control">
                                <?php foreach ($supplier as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if ($edit_data[0]['supplier_id'] == $row['id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
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
    <script>

function get_medicine_subcategory(categoryID) {
      var selectedValue = categoryID.value;
    $.ajax({
		 url:"<?php echo base_url() ;?>index.php?kennel/get_medicine_subcategory",
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
				 

				 $("#medicine_sub_category").hide();
				 $("#medicine_sub_category1").html(str);
			}
		 }
	 });
}
</script>
