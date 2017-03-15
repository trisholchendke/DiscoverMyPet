
 <form id="add_pet" role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?doctor/invoice_manage" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <select id="medicine_category" name="medicine_category" class="select2">
                                
                                <option value="" selected="" disabled="">-- Select Main Category --</option>
                               <?php $medicine_category_info = $this->db->get_where('medicine_category',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine_category_info as $row) { ?>
                                    <option value="<?php echo $row['medicine_category_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                           <select id="medicine_sub_category" name="medicine_sub_category" class="select2">
                                
                                <option value="" selected="" disabled="">-- Select Sub Category --</option>
                               <?php $medicine_sub_category_info = $this->db->get_where('medicine_sub_category',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($medicine_sub_category_info as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3">
                            <input type="text" placeholder="Brand Name" name="brand_name" class="form-control" id="field-1" />
                        </div>
                        
                        <div class="col-sm-3">
                           <select id="supplier"  name="supplier" class="select2">
                                
                                <option value="" selected="" disabled="">-- Select Supplier --</option>
                               <?php $supplier = $this->db->get_where('supplier',array('doctor_id' =>  $this->session->userdata('login_user_id')))->result_array(); 
                               foreach ($supplier as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input id="submit" type="submit" class="btn btn-success" value="Submit">
                    </div>
                    
                     <div class="col-sm-3 control-label col-sm-offset-2">
                       			 <input  
                       			 	type="submit" name="download"
                       				class="btn btn-default btn-sm btn-icon icon-left"
                       				value="Download Report"
                       			>
                    </div>
                </form>
                <br>
                <br>
                <br>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('invoice_number'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('creation_date'); ?></th>
            <th><?php echo get_phrase('due_date'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('fees'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php $medicine_category_info = $this->db->get_where('invoice' , array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
        $array = json_decode(json_encode($medicine_category_info), True);
        foreach ($array as $row) { ?>      
            <tr>
                <td><?php echo $row['invoice_number'] ?></td>
                <td><?php echo $row['title'] ?></td>
                
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td><?php echo $row['creation_timestamp'] ?></td>
                <td><?php echo $row['due_timestamp'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><?php echo $row['fees'] ?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/view_invoice/<?php echo $row['invoice_id'] ?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-eye"></i>
                        View Invoice
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
