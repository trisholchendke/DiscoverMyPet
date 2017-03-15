<style>
.edit_btn{
padding-right: 18px !important;
    padding-left: 41px !important;

}
.display_btn{
    padding-right: 5px !important;
    padding-left: 36px !important;
}
</style>

<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_doctor/');" 
    class="btn btn-primary pull-right"><i class="fa fa-plus-circle" style="margin-right: 7px;" aria-hidden="true"></i>
        <?php echo get_phrase('add_doctor'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('image');?></th>
            <th><?php echo get_phrase('name');?></th>
               <th><?php echo get_phrase('role');?></th>
            <th><?php echo get_phrase('email');?></th>
            <th><?php echo get_phrase('address');?></th>
            <th><?php echo get_phrase('phone');?></th>
          
             <th><?php echo get_phrase('password');?></th>
 <th><?php echo get_phrase('payment_amount');?></th>
 <th><?php echo get_phrase('payment_by');?></th>
 <th><?php echo get_phrase('vci_registration_no');?></th>
<th><?php echo get_phrase('state_council_registration_no');?></th>
            <th><?php echo get_phrase('options');?></th>

            
        </tr>
    </thead>

    <tbody>
        <?php foreach ($doctor_info as $row) { ?>   
            <tr>
                <td>
                    <img src="<?php echo base_url();?>/uploads/doctor_image/<?php echo $row['profile_image']; ?>" 
                         class="img-circle" width="40px" height="40px">
                </td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['role']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
               
                
                <td><?php echo base64_decode($row['password']); ?></td>
 <td><?php echo $row['payment_amount']?></td>
                <td><?php echo $row['payment_by']?></td>
<td><?php echo $row['registration_no']?></td>
<td><?php echo $row['state_council_registration_no']?></td>
                <td>

                 <?php if($row['doctor_id'])
                    {
                    ?>
                      <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_doctor/<?php echo $row['doctor_id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left edit_btn">
                            <i class="entypo-pencil"></i>
                            Edit
                  </a>
                    <?php }else{?>
                      <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_user/<?php echo $row['id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                  
                    <?php }?>

<?php if($row['doctor_id'])
                    {
                    ?>
                      <a  href="<?php echo base_url();?>/index.php?admin/doctor/delete/<?php echo $row['doctor_id'] ?>" 
                       class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                             <i class="entypo-cancel"></i>
                            Delete
                  </a>
                    <?php }else{?>
                      <a  href="<?php echo base_url();?>/index.php?admin/doctor/delete/<?php echo $row['id'] ?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                             Delete
                    </a>
                  
                    <?php }?>


                   
                    <?php if($row['doctor_id'])
                    {
                    ?>
                    	<a  href="<?php echo base_url(); ?>index.php?admin/display_doctor/<?php echo $row['doctor_id']?>" 
                        class="btn btn-default btn-sm btn-icon icon-left display_btn">
                            <i class="entypo-eye"></i>
                           Display
                    </a>
                    <?php }else{?>
                   <a  href="<?php echo base_url(); ?>index.php?admin/display_user/<?php echo $row['id']?>" 
                        class="btn btn-default btn-sm btn-icon icon-left display_btn">
                            <i class="entypo-eye"></i>
                           Display
                    </a>
                    <?php }?>
                    
                      
                   
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


