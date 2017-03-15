<div style="clear:both;"></div>
<br>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('appointment_type');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('pet');?></th>
            <th><?php echo get_phrase('bording_number');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            
        </tr>
    </thead>

    <tbody>
        <?php  
$this->db->select('*');
    	$this->db->from('appointment');
    	$this->db->where('patient_id',$this->session->userdata('login_user_id'));
$this->db->where('status','approved');
$this->db->order_by("appointment_id", "desc");
    	$query = $this->db->get();
    	$patient_info = $query->result_array();
        	
            foreach ($patient_info as $row) { ?>  
            <tr>
                <td><?php echo $row['appointment_type'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                
                        echo $name;?>
                </td>
                <td><?php echo $row['bording_number'] ?></td>
                <td>
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row['doctor_id'] ))->row()->name;
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