
<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_appointment');" 
    class="btn btn-primary pull-right" style="margin:5px;">
        <?php echo get_phrase('add_appointment'); ?>
</button>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th></th>
            <th><?php echo get_phrase('appointment_type');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('pet_name');?></th>
            <th><?php echo get_phrase('owner_name');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('breeder');?></th>
            <th><?php echo get_phrase('boarding_number');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php $appointment_info = $this->db->get_where('appointment',array('user_id' => $this->session->userdata('login_user_id')))->result_array();
        foreach ($appointment_info as $row) { ?>   
            <tr>
                <td></td>
                <td><?php echo $row['appointment_type']; ?></td>
                <td><?php echo date("d M, Y -  H:i", $row['timestamp']); ?></td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->owner_name;
                        echo $name;?>
                </td>
                <td>
                    <?php $name = $this->db->get('doctor' , array('user_id' => $row['user_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
                <?php if(!$row['user_id'])
                {
                	?>
                	No Sub Doctor
                	<?php }else{?>
                	<?php $name = $this->db->get_where('users' , array('id' => $row['user_id'] ))->result_array();
                        print_r($name[0]['name']);?>
                	<?php }?>
                    
                </td>
                <td><?php echo $row['bording_number']?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_appointment/<?php echo $row['appointment_id']?>');" 
                        class="btn btn-default btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="<?php echo base_url();?>index.php?doctor/appointment/delete/<?php echo $row['appointment_id']?>" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <!-- CALENDAR-->
    <div class="col-md-12 col-xs-12">    
        <div class="panel panel-primary " data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa fa-calendar"></i>
                    <?php echo get_phrase('event_schedule'); ?>
                </div>
            </div>
            <div class="panel-body" style="padding:0px;">
                <div class="calendar-env">
                    <div class="calendar-body">
                        <div id="notice_calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    
    $(document).ready(function()
    {
        var calendar = $('#notice_calendar');
				
        $('#notice_calendar').fullCalendar
        ({
            header:
            {
                left: 'title',
                right: 'month,agendaWeek,agendaDay today prev,next'
            },
            
            defaultView: 'agendaDay',

            //defaultView: 'basicWeek',

            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,

            events:
            [
                <?php
                $user_id      = $this->session->userdata('login_user_id');
                $appointments   = $this->db->get_where('appointment' , array('user_id' => $user_id ))->result_array();
                foreach ($appointments as $row):
                ?>
                    {
                        title   :   "<?php  $name = $this->db->get_where('patient' , 
                                                array('patient_id' => $row['patient_id'] ))->row()->name;
                                            echo $name;?>",
                        start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                        <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                        <?php echo date('d', $row['timestamp']); ?>,
                                        <?php echo date('H', $row['timestamp']); ?>),
                        allDay: false
                    },
                <?php endforeach ?>
            ]
        });
    });
</script>