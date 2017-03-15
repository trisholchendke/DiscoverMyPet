
<div style="clear:both;"></div>
<br>

  <form id="add_pet" role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/stock" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select id="medicine_category" name="medicine_category" class="form-control">
                                
                                <option value="" selected="" disabled="">Select Main Category</option>
                               <?php $medicine_category_info = $this->db->get_where('medicine_category',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>" <?php if(isset($_POST['medicine_category'] )){
                                    	if($_POST['medicine_category'] == $row['medicine_category_id']) echo "selected";
                                    }?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                           <select id="medicine_sub_category" name="medicine_sub_category" class="form-control">
                                
                                <option value="" selected="" disabled="">Select Sub Category</option>
                               <?php $medicine_sub_category_info = $this->db->get_where('medicine_sub_category',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine_sub_category_info as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['medicine_sub_category'] )){
                                    	if($_POST['medicine_sub_category'] == $row['id']) echo "selected";
                                    }?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-2">
                            <input type="text" name="brand_name" class="form-control" id="field-1" placeholder="Brand Name" value="<?php if(isset($_POST['brand_name'] )){
                                    	echo $_POST['brand_name'];
                                    }?>"/>
                        </div>
                        
                        <div class="col-sm-2">
                           <select id="supplier"  name="supplier" class="form-control">
                                
                                <option value="" selected="" disabled="">Select Supplier</option>
                               <?php $supplier = $this->db->get_where('supplier',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($supplier as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['supplier'] )){
                                    	if($_POST['supplier'] == $row['id']) echo "selected";
                                    }?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                      <div class="col-sm-2 col-md-2">
                        <input id="submit" type="submit" class="btn btn-primary" value="Submit" style="width:100%;">
                    </div>
                    </div>

                   
                </form>
                <br>
                <br>
                <br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('main_category'); ?></th>
            <th><?php echo get_phrase('sub_category'); ?></th>
            <th><?php echo get_phrase('description'); ?></th>
            <th><?php echo get_phrase('price (Unit)'); ?></th>
            <th><?php echo get_phrase('quantity'); ?></th>
            <th><?php echo get_phrase('brand_name'); ?></th>
            <th><?php echo get_phrase('supplier'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        foreach ($medicine_info as $row) { ?>   
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td>
                   <?php $name = $this->db->get_where('medicine_category' , array('medicine_category_id' => $row['medicine_category_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('medicine_sub_category' , array('id' => $row['medicine_sub_category_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td><?php echo $row['manufacturing_company'] ?></td>
               	<td>
                    <?php $name = $this->db->get_where('supplier' , array('id' => $row['supplier_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_medicine/<?php echo $row['medicine_id'] ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        Edit
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
"iDisplayLength": 5,

"order": [],
 "aaSorting": [],
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>

