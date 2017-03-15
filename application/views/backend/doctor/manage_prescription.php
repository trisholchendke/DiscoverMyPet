<?php if($menu_check == 'from_prescription') { ?>
<div style="clear:both;"></div>
<br>
<?php } ?>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('pet');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($prescription_info as $row) { ?>   
            <tr>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
                        echo $name;?>
                </td>
                
                
                <td>
                    <?php if($menu_check == 'from_prescription') { ?>
                        <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_prescription/<?php echo $row['prescription_id']?>/<?php echo $menu_check; ?>');" 
                            class="btn btn-default btn-sm btn-icon icon-left">
                                <i class="entypo-pencil"></i>
                                Edit
                        </a>
                    <?php } ?>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/show_prescription/<?php echo $row['prescription_id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="fa fa-eye"></i>
                            View Prescription
                    </a>
                    <?php if($menu_check == 'from_prescription') { ?>
                        <a href="<?php echo base_url();?>index.php?doctor/prescription/delete/<?php echo $row['prescription_id']?>"
                            class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                                <i class="entypo-cancel"></i>
                                Delete
                        </a>
                    <?php } ?>
                    <a href="<?php echo base_url(); ?>index.php?doctor/prescription/download/<?php echo $row['prescription_id']?>"
                            class="btn btn-success btn-sm btn-icon icon-left">
                                <i class="entypo-download"></i>
                                Download
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