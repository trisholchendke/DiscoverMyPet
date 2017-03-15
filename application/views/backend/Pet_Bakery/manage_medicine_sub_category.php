<button onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/add_medicine_sub_category/');" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_sub_category'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('main_category'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        

        $query = $this->db->get('medicine_sub_category');
        $this->db->select('ms.id,ms.name medicine_sub_category_name,ms.user_id,mc.name medicine_category_name');
        $this->db->from('medicine_sub_category ms');
        $this->db->join('medicine_category mc', 'mc.medicine_category_id=ms.medicine_category_id', 'left');
        $this->db->where('ms.user_id',$this->session->userdata('login_user_id'));
        $this->db->where('mc.medicine_category_id !=',0);
        
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
        	$data = $query->result_array();?>
        	<?php 
        	foreach ($data as $row) { ?>
        	<?php 
        		if(!$row['medicine_category_name']){
        	?>
        	<?php }else{?>
        	<tr>
                 <td>
                  <?php echo $row['medicine_category_name'] ?>
                </td>
                <td><?php echo $row['medicine_sub_category_name'] ?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_medicine_sub_category/<?php echo $row['id'] ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        Edit
                    </a>
                </td>
            </tr>
        	
        	<?php }?>
            
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