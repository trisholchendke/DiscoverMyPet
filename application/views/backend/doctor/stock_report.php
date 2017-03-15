<style>
.submit_btn{
       padding: 6px 23px !important;
    margin-top: -5px !important;
}
.page-body .select2-container .select2-choice {
   height: 31px !important;
    line-height: 32px !important;
    outline: none;
    padding-left: 15px !important;
    padding: 0px 15px !important;
}
</style>

 <form id="add_pet" role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/stock_report" method="post" enctype="multipart/form-data">

<div class="col-md-12" style="margin-bottom: 25px;" >
<h4 class="pull-left"><i class="fa fa-filter" aria-hidden="true"></i> Filter By</h4>
<input  id="download_btn"
                       			 	type="submit" name="download"
                       				class="btn pull-right btn-primary download_btn"
                       				value="Download Report" style="margin-bottom:15px;margin-right: -15px;"
                       				>
</div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select id="medicine_category" name="medicine_category" class="select2">
                                
                                    <option value="" selected disabled>Select Main Category</option>
                               <?php $medicine_category_info = $this->db->get_where('medicine_category',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>" <?php if(isset($_POST['medicine_category'] )){
                                    	if($_POST['medicine_category'] == $row['medicine_category_id']) echo "selected";
                                    }?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                           <select id="medicine_sub_category" name="medicine_sub_category" class="select2">
                                <option value="" selected disabled>Select Sub Category</option>
                               <?php $medicine_sub_category_info = $this->db->get_where('medicine_sub_category',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine_sub_category_info as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"  <?php if(isset($_POST['medicine_sub_category'] )){
                                    	if($_POST['medicine_sub_category'] == $row['id']) echo "selected";
                                    }?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                           <select id="medicine_id" name="medicine_id" class="select2">
                               <option value="" selected disabled>Select Product</option>
                               <?php $medicine = $this->db->get_where('medicine',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine as $row) { ?>
                                    <option value="<?php echo $row['medicine_id']; ?>" <?php if(isset($_POST['medicine_id'] )){
                                    	if($_POST['medicine_id'] == $row['medicine_id']) echo "selected";
                                    }?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                       			 <input id="submit" type="submit" class="btn btn-primary submit_btn" value="Submit">
                       			 
                        			
                    			
                    	</div>
                    </div>

                   
</form>
<br>
<table class="table table-bordered table-striped">
<tbody>

<tr>
 <th colspan="7">Total Stock</th>
 <td colspan="8"><?php $sum = 0;

for ($i = 0; $i <count($product); $i++) {
   $sum += $product[$i]['quantity'];


}

echo $sum; ?></td>
</tr>
</tbody>

</table>
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
        </tr>
    </thead>

    <tbody>

        <?php 
        foreach ($product as $row) { ?>   
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

