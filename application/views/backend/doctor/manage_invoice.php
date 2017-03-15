<style>
.download_btn{
    margin-right: 15px;
}
</style> 
<form id="add_pet" role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/invoice_manage" method="post" enctype="multipart/form-data">
<div class="row">
                    <div class="col-md-6">

<h4><i class="fa fa-filter" aria-hidden="true"></i> Filter By</h4>
</div>
<div class="col-md-6">
<button id="download_btn" type="submit" name="download" class="btn pull-right btn-primary download_btn" style="margin-bottom:15px;"><i class="fa fa-download" style="margin-right:7px;" aria-hidden="true"></i>Download Report</button>
</div>
</div>

                        <div class="col-sm-3">
						<div class="form-group">
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
                            <input type="text" placeholder="Brand Name" name="brand_name" class="form-control" id="field-1" value="<?php if(isset($_POST['brand_name'] )){
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
                    

                    <div class="col-sm-2">
                        <input id="submit" type="submit" class="btn btn-primary" value="Submit" style="width:100%;">
                    </div>
<div>

</div>
                </form>
                <br>
                <br>
                <br>
<br>
<table class="table table-bordered table-striped">
<tbody>

<tr>
 <th colspan="7">Total Invoice</th>
 <td colspan="8">RS <?php $sum = 0;

for ($i = 0; $i <count($invoice_info); $i++) {
$service_tax = ($invoice_info[$i]['fees'] * $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->service_tax )/ 100;
$vat_percentage = ($invoice_info[$i]['total_amount'] * $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->vat_percentage)/ 100;
   $sum += round($invoice_info[$i]['total_amount'] + $invoice_info[$i]['fees']  + $service_tax  + $vat_percentage);


}

echo $sum; ?></td>
</tr>
</tbody>

</table>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('invoice_number'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('creation_date'); ?></th>
            <th><?php echo get_phrase('due_date'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
<th><?php echo get_phrase('total_amount'); ?></th>
            <th><?php echo get_phrase('fees'); ?></th>
            
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>

    <?php if($invoice_info !== FALSE){?>
        <?php 
        
        foreach ($invoice_info as $row) {
$service_tax = ($row['fees'] * $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->service_tax )/ 100;
$vat_percentage = ($row['total_amount'] * $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->vat_percentage)/ 100;
 ?>      
            <tr>
                <td><?php echo $row['invoice_number'] ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['patient_name'] ?></td>
                <td><?php echo $row['creation_timestamp'] ?></td>
                <td><?php echo $row['due_timestamp'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td>RS <?php echo round($row['total_amount'] + $row['fees']  + $service_tax  + $vat_percentage) ;?></td>
                <td>RS <?php echo $row['fees'] ?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_invoice/<?php echo $row['invoice_id'] ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        Edit
                    </a>
                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/view_invoice/<?php echo $row['invoice_id'] ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-eye"></i>
                        View Invoice
                    </a>
                    <a href="<?php echo base_url(); ?>index.php?doctor/invoice_manage/delete/<?php echo $row['invoice_id'] ?>" 
                       class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                        <i class="entypo-cancel"></i>
                        Delete
                    </a>
<a href="<?php echo base_url();?>/index.php?doctor/download_invoice/<?php echo $row['invoice_id'] ?>" 
                       class="btn btn-success btn-sm btn-icon icon-left">
                        <i class="entypo-download"></i>
                        Download
                    </a>
                    
                    
                </td>
            </tr>
        <?php } ?>
        <?php }else{?>
        
        <?php };?>
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
