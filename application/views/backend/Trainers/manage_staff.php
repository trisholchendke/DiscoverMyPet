<div style="clear:both;"></div>
<br>
<div class="row">

    <div class="col-md-12">
 <table class="table table-bordered table-striped datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('name'); ?></th>
                            <th><?php echo get_phrase('email'); ?></th>
                            <th><?php echo get_phrase('address'); ?></th>
                            <th><?php echo get_phrase('Phone'); ?></th>
                            <th><?php echo get_phrase('Role'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        
	                        $login_user_id =  $this->session->userdata('login_user_id');
	                        $login_type =  $this->session->userdata('login_type');
	                        $report_info    = $this->db->get_where('users',array('user_id' => $this->session->userdata('login_user_id')))->result_array();
                        foreach ($report_info as $row) { ?>   
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['role'] ?></td>
                                <td>
                                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_staff/<?php echo $row['id'] ?>');" 
                                        class="btn btn-default btn-sm btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        Edit
                                    </a>
                                    
                                    <a  
                                       class="btn btn-danger btn-sm btn-icon icon-left" href="<?php echo base_url(); ?>index.php?trainers/manage_staff/delete/<?php echo $row['id'] ?>" onclick="return checkDelete();">
                                        <i class="entypo-cancel"></i>
                                        Delete
                                    </a>
                                     <li>
                            </li>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        
    </div>
    
</div>

<?php for($count=1; $count<=3; $count++){ ?>
    <script type="text/javascript">
        jQuery(window).load(function ()
        {
            var $ = jQuery;

            $("#table-<?php echo $count ?>").dataTable({
                "sPaginationType": "bootstrap",
                "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
            });

            $(".dataTables_wrapper select").select2({
                minimumResultsForSearch: -1
            });

            // Highlighted rows
            $("#table-<?php echo $count ?> tbody input[type=checkbox]").each(function (i, el)
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
<?php } ?>