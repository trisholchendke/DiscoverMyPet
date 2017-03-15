<a href="<?php echo base_url(); ?>/index.php?doctor/stock">
	<button 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('back'); ?>
</button>
</a>
<div style="clear:both;"></div>
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
        </tr>
    </thead>

    <tbody>
        <?php 
       
        foreach ($stock_info as $row) { ?>   
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td>
                    <?php $name = $this->db->get('medicine_category' , array('medicine_category_id' => $row['medicine_category_id'] ))->row()->name;
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