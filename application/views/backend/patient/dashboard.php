   <style>
     table tr td{
   
    overflow-y: auto !important;
    border: 1px solid #ebebeb !important;
    }
   </style>
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
            <div>
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
                            $patient_id      = $this->session->userdata('login_user_id');
                            $appointments   = $this->db->get_where('appointment' , array('status' =>'approved' ,'appointment_type' =>'Boarding' ,'patient_id' => $patient_id ))->result_array();
                            foreach ($appointments as $row):
                            ?>
                                {
                                	icon : "asterisk",
                                        img  : '<?php echo base_url(); ?>assets/images/Boarding.png',
                                    start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                                    <?php echo date('d', $row['timestamp']); ?>,
                                                    <?php echo date('H', $row['timestamp']); ?>),
                                    allDay: false,
                                    id:"<?php echo $row['appointment_id']; ?>",
                                },
                            <?php endforeach ?>
                            <?php
                            $patient_id      = $this->session->userdata('login_user_id');
                            $appointments   = $this->db->get_where('appointment' , array('status' =>'approved' ,'appointment_type' =>'Deworming' ,'patient_id' => $patient_id ))->result_array();
                            foreach ($appointments as $row):
                            ?>
                                {
                                	icon : "thermometer-quarter",
                                        img  : '<?php echo base_url(); ?>assets/images/Deworming.png',
                                    start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                                    <?php echo date('d', $row['timestamp']); ?>,
                                                    <?php echo date('H', $row['timestamp']); ?>),
                                    allDay: false,
                                    id:"<?php echo $row['appointment_id']; ?>",
                                    
                                },
                            <?php endforeach ?>
                            <?php
                            $patient_id      = $this->session->userdata('login_user_id');
                            $appointments   = $this->db->get_where('appointment' , array('status' =>'approved' ,'appointment_type' =>'Vaccination' ,'patient_id' => $patient_id ))->result_array();
                            foreach ($appointments as $row):
                            ?>
                                {
                                	icon : "meetup",
                                        img  : '<?php echo base_url(); ?>assets/images/Vaccinations.png',
                                    start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                                    <?php echo date('d', $row['timestamp']); ?>,
                                                    <?php echo date('H', $row['timestamp']); ?>),
                                    allDay: false,
                                    id:"<?php echo $row['appointment_id']; ?>",
                                },
                            <?php endforeach ?>
                            <?php
                            $patient_id      = $this->session->userdata('login_user_id');
                            $appointments   = $this->db->get_where('appointment' , array('status' =>'approved' ,'appointment_type' =>'Consultation' ,'patient_id' => $patient_id ))->result_array();
                            foreach ($appointments as $row):
                            ?>
                                {
                                	icon : "envelope-open",
                                    img  : '<?php echo base_url(); ?>assets/images/Consultation.png',
                                    start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                                    <?php echo date('d', $row['timestamp']); ?>,
                                                    <?php echo date('H', $row['timestamp']); ?>),
                                    allDay: false,
                                    id:"<?php echo $row['appointment_id']; ?>",
                                },
                            <?php endforeach ?>
                            <?php
                            $patient_id      = $this->session->userdata('login_user_id');
                            $appointments   = $this->db->get_where('appointment' , array('status' =>'approved' ,'appointment_type' =>'Parasite Control' ,'patient_id' => $patient_id ))->result_array();
                            foreach ($appointments as $row):
                            ?>
                                {
                                	icon : "bandcamp",
                                        img  : '<?php echo base_url(); ?>assets/images/parasite_control.png',
                                    start   :   new Date(<?php echo date('Y', $row['timestamp']); ?>, 
                                                    <?php echo date('m', $row['timestamp']) - 1; ?>, 
                                                    <?php echo date('d', $row['timestamp']); ?>,
                                                    <?php echo date('H', $row['timestamp']); ?>),
                                    allDay: false,
                                    id:"<?php echo $row['appointment_id']; ?>",
                                },
                            <?php endforeach ?>
                ],

            eventRender: function(event, element) {
            	element.find(".fc-event-time").after($("<span class=\"fc-event-icons\" style=\"display:inline-block !important;\"></span>").html('<img onclick="get_appointment_id(this.id)" width="20" height="20" src="'+ event.img +'" id="'+ event.id +'">'));
            }
        });
    get_appointment_id = function(id){
		location.href = "<?php echo base_url();?>index.php?/patient/show_appointment/" + id;
   }
    });
</script>