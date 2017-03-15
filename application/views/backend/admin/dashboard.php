<div class="row">
    <div class="col-sm-3" <?php 
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Doctor');
    $this->db->from("doctor");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num" data-start="0" data-end="
               <?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Doctor');
					$this->db->from("doctor");
					echo $this->db->count_all_results(); 
				?>
               "
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Doctor') ?></h3>
            </div>
        </a>
    </div>


    <div class="col-sm-3" <?php 
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Kennel');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-red">
               <div class="icon icon1"><i><img class="img_kennel" src="assets/images/kennel.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Groomer');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-aqua">
               <div class="icon icon1"><i><img class="img_trainer" src="assets/images/groomer.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Groomer');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Groomer') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3" <?php 
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Trainers');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-blue">
                <div class="icon icon1"><i><img class="img_trainer" src="assets/images/dog-training.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Breeder');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-cyan">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/breeder.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Ambulance Service');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-purple">
                <div class="icon icon2"><i><img class="img_ambulance" src="assets/images/ambulance.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Pet Relocation');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-pink">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/breeder.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Pet Bakery');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-orange">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/bakery.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Dog Walker');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-blue">
                 <div class="icon icon2"><i><img class="img_breeder" src="assets/images/dog_walker.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Obituary');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-blue">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/death-certificate.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
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
     $this->db->where('admin_id',$this->session->userdata('login_user_id'));
    $this->db->where('role','Restaurants');
    $this->db->from("users");
    $data = $this->db->count_all_results();
    
    if ($data == 0) echo 'hidden'; ?>>
        <a href="<?php echo base_url(); ?>index.php?admin/doctor">
            <div class="tile-stats tile-white-blue">
                <div class="icon icon2"><i><img class="img_breeder" src="assets/images/hotel.png"></i></div>
                <div class="num" data-start="0" data-end="<?php 
	                $this->db->where('admin_id',$this->session->userdata('login_user_id'));
	                $this->db->where('role','Restaurants');
					$this->db->from("users");
					echo $this->db->count_all_results(); 
				?>" 
                     data-duration="1500" data-delay="0">0 &pound;</div>
                <h3><?php echo get_phrase('Restaurants') ?></h3>
            </div>
        </a>
    </div>

<div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
            <div class="tile-stats tile-white-gray">
                <div class="icon"><i class="fa fa-h-square"></i></div>
                <div class="num">&nbsp;</div>
                <h3><?php echo get_phrase('settings') ?></h3>
            </div>
        </a>
    </div>



</div>




    
</div>