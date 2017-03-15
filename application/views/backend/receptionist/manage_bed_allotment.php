<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_bed_allotment/');" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('boarding_allotment'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('bed_number');?></th>
            <th><?php echo get_phrase('bed_type');?></th>
            <th><?php echo get_phrase('patient');?></th>
            <th><?php echo get_phrase('allotment_date');?></th>
            <th><?php echo get_phrase('allotment_time');?></th>
            <th><?php echo get_phrase('discharge_date');?></th>
            <th><?php echo get_phrase('discharge_time');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
        
        $query = $this->db->get('bed_allotment');
        $this->db->select('p.name patient_name,b.bed_number,b.type,ba.allotment_date,ba.allotment_time,ba.discharge_date,ba.discharge_time,ba.bed_allotment_id');
        $this->db->from('bed_allotment ba');
        $this->db->join('bed b', 'b.bed_id=ba.bed_id', 'left');
        $this->db->join('patient p', 'p.patient_id = ba.patient_id', 'left');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
        	?>
        	<?php
        	$data = $query->result_array();
        	foreach ($data as $row) {
        	?>
        	
        	
        	
            <tr>
                <td>
                    <?php echo $row['bed_number']?>
                </td>
                <td>
                    <?php echo $row['type']?>
                </td>
                <td>
                    <?php echo $row['patient_name']?>
                </td>
                <td>
                	<?php echo date("d M, Y -  H:i", $row['allotment_date']); ?>
                </td>
                <td>
                    <?php echo date("h:i:sa",$row['allotment_time']); ?>
                </td>
                <td>
                    <?php echo date("d M, Y -  H:i", $row['discharge_date']); ?>
                </td>
                <td>
                     <?php echo date("h:i:sa",$row['discharge_time']); ?>
                </td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_bed_allotment/<?php echo $row['bed_allotment_id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="<?php echo base_url();?>index.php?receptionist/bed_allotment/delete/<?php echo $row['bed_allotment_id']?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
                </td>
            </tr>
        <?php }};?>
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