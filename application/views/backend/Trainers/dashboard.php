<div class="row">
    <!-- CALENDAR-->
    <div class="col-md-12 col-xs-12">    
        <div class="panel panel-primary " data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa fa-calendar"></i>
                    <?php echo get_phrase('appointment_schedule'); ?>
                </div>
            </div>
            <div class="panel-body" style="padding:0px;">
                <div class="calendar-env">
                    <div class="calendar-body">
                        <div id="appointment_calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    
    $(document).ready(function()
    {
        $('#appointment_calendar').fullCalendar
        ({
            header:
            {
                left: 'title',
                right: 'month,agendaWeek,agendaDay today prev,next'
            },

            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,

            events:
            [
                <?php
                $appointments   = $this->db->get_where('appointment' , array('user_id' => $this->session->userdata('login_user_id') ))->result_array();
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