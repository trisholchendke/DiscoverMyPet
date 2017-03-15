<style>

.fa fa-envelope-open{ 
color:red;
}
.calendar-env .calendar-body .fc-content .fc-view table tbody tr td.fc-day {   
    border: 1px solid #ebebeb !important;    
}

</style>

<div class="row">
    <div class="col-md-12 col-xs-12">    
      

<div class="row">
    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Sub Doctor');
    $this->db->from("users");
    $data =  $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div 
	                class="num" 
	                data-start="0" 
	                data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Sub Doctor');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>"
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('sub_doctor') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Kennel');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-red">
                <div class="icon icon1"><i><img class="img_kennel" src="assets/images/kennel.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Kennel');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Kennel') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Groomer');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-aqua">
               <div class="icon icon1"><i><img class="img_trainer" src="assets/images/groomer.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Groomer');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Groomer') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3"  <?php 
    
    $this->db->where('role','Trainers');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-blue">
                <div class="icon icon1"><i><img class="img_trainer" src="assets/images/dog-training.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Trainers');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Trainers') ?></h3>
            </div>
        </a>
    </div>
    
    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Breeder');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-cyan">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/breeder.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Breeder');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Breeder') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Ambulance Service');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-purple">
                <div class="icon icon2"><i><img class="img_ambulance" src="assets/images/ambulance.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Ambulance Service');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Ambulance Service') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Pet Relocation');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-pink">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/breeder.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Pet Relocation');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Pet Relocation') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Pet Bakery');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-orange">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/bakery.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Pet Bakery');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Pet Bakery') ?></h3>
            </div>
        </a>
    </div>
    
     <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Dog Walker');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-green">
               <div class="icon icon2"><i><img class="img_breeder" src="assets/images/dog_walker.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Dog Walker');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Dog Walker') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Obituary');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-brown">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/death-certificate.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Obituary');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Obituary') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Restaurants');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-plum">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/hotel.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Restaurants');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Restaurants') ?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Receptionist');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/manage_staff">
            <div class="tile-stats tile-white-plum">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/reception.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Receptionist');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Receptionist') ?></h3>
            </div>
        </a>
    </div>
    
    <div class="col-sm-3" <?php 
    $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
    $this->db->from("patient");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?doctor/patient">
            <div class="tile-stats tile-white-green">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/pet_1.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('doctor_id',$this->session->userdata('login_user_id'));
					$this->db->from("patient");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('pet') ?></h3>
            </div>
        </a>
    </div>
</div>

    </div>
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
                        $doctor_id      = $this->session->userdata('login_user_id');
                        $appointments   = $this->db->get_where('appointment' , array('appointment_type' =>'Consultation','status' =>'approved','doctor_id' => $doctor_id ))->result_array();
                        foreach ($appointments as $row):
                        ?>
                            {
                            	icon : "asterisk",
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
                        $doctor_id      = $this->session->userdata('login_user_id');
                        $appointments   = $this->db->get_where('appointment' , array('appointment_type' =>'Boarding','status' =>'approved','doctor_id' => $doctor_id ))->result_array();
                        foreach ($appointments as $row):
                        ?>
                            {
                            	icon : "check-circle",
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
                        $doctor_id      = $this->session->userdata('login_user_id');
                        $appointments   = $this->db->get_where('appointment' , array('appointment_type' =>'Vaccination','status' =>'approved','doctor_id' => $doctor_id ))->result_array();
                        foreach ($appointments as $row):
                        ?>
                            {
                            	icon : "bell",
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
                        $doctor_id      = $this->session->userdata('login_user_id');
                        $appointments   = $this->db->get_where('appointment' , array('appointment_type' =>'Deworming','status' =>'approved','doctor_id' => $doctor_id ))->result_array();
                        foreach ($appointments as $row):
                        ?>
                            {
                            	icon : "bandcamp",
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
                        $doctor_id      = $this->session->userdata('login_user_id');
                        $appointments   = $this->db->get_where('appointment' , array('appointment_type' =>'Parasite Control','status' =>'approved','doctor_id' => $doctor_id ))->result_array();
                        foreach ($appointments as $row):
                        ?>
                            {
                            	icon : "thermometer-quarter",
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
            	element.find(".fc-event-time").after($("<span class=\"fc-event-icons\" style=\"display:inline !important;\"></span>").html('<img onclick="get_appointment_id(this.id)" width="20" height="20" src="'+ event.img +'" id="'+ event.id +'">'));
            }
        });
        
        get_appointment_id = function(id){
			location.href = "<?php echo base_url();?>index.php?/doctor/show_appointment/" + id;
       }
    });
</script>