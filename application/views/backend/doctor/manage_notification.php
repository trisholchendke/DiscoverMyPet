<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_notification');" 
    class="btn btn-primary pull-right" style="margin:5px;"><i class="fa fa-plus-circle" style="margin-right: 7px;" aria-hidden="true"></i>
        <?php echo get_phrase('add_notification'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('description'); ?></th>
            <th><?php echo get_phrase('notification_image'); ?></th>
            <th><?php echo get_phrase('option'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        

        $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
        $this->db->order_by("notification_id","desc");
        $query = $this->db->get('notification');
      
        if($query->num_rows() != 0)
        {
        	$data = $query->result_array();?>
        	<?php 
        	foreach ($data as $row) { ?>
        	<tr>
        	
        	<td><?php echo $row['name']?></td>
        	<td><?php echo $row['description']?></td>
        	<td>
        		<img width="50" height="50" src="uploads/notification_image/<?php echo $row['image_path']?>">
        	</td>
        	 <td>
                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_notification/<?php echo $row['notification_id'] ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        Edit
                    </a>
                    <a href="<?php echo base_url(); ?>index.php?doctor/notification/delete/<?php echo $row['notification_id'] ?>" 
                       class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                        <i class="entypo-cancel"></i>
                        Delete
                    </a>
                </td>
        	</tr>
            
        <?php } ?>
        	
        	<?php 
        	}
        	else
        	{
        		return false;
        	}
        	?>
       
        <?php ?>
        
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
