<style>
.close_btn{
color: #000;
    position: absolute;
    right: 25px;
    top: -20px;
}
</style>


<?php
 $health_record    = $this->db->get_where('health_record', array('id' => $param2))->result_array();
foreach ($health_record as $row) { 
	?>

    <div class="profile-env">

        <header class="row">
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="col-sm-3">

                <a href="#" class="profile-picture">
                    <img src="<?php echo $this->crud_model->get_image_url('patient', $row['patient_id']); ?>" 
                         class="img-responsive img-circle" />
                </a>

            </div>

            <div class="col-sm-9">

                <ul class="profile-info-sections">
                    <li style="padding:0px; margin:0px;">
                        <div class="profile-name">
                            <h3><?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?></h3>
                        </div>
                    </li>
                </ul>

            </div>


        </header>

        <section class="profile-info-tabs">

            <div class="row">

                <div class="">
                    <br>
                    <table class="table table-bordered">
						<?php if ($row['health_record'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;color: #000 !important;font-size: 14px;"><?php echo get_phrase('health_record');?></td>
                                 <?php 
                                
                                if($row['file_type'] == "image/jpeg") 
                                {
                                	
                                ?>
                                <td>
                                <a href="uploads/health_record/<?php echo $row['health_record'] ?>" download>
                                	<img witdh="50" height="50"  src="uploads/health_record/<?php echo $row['health_record'] ?>" />
                                </a>
                                </td>
                                <?php 
                                }else if($row['file_type'] == "application/pdf"){
                                	?>
                                	 <td>
                                	 <a href="uploads/health_record/<?php echo $row['health_record'] ?>" download>
                                		<img witdh="50" height="50"  src="assets/images/pdf_image.jpg" />
                                	 </a>
                                </td>
                                <?php 
                                } 
                                ?>	
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['weight'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;color: #000 !important;font-weight: 600;font-size: 14px;"><?php echo get_phrase('weight'); ?></td>
                                <td><b><?php echo $row['weight']; ?></b></td>
                            </tr>
                        <?php endif; ?>

                         <?php if ($row['creation_timestamp'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;color: #000 !important;font-size: 14px;"><?php echo get_phrase('Date'); ?></td>
                                <td><b><?php echo $row['creation_timestamp'] ; ?></b></td>
                            </tr>
                        <?php endif; ?>
                       
                        
                        <?php if ($row['height'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('height'); ?></td>
                                <td><b><?php echo $row['height']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['vaccine_name'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;color: #000 !important;font-size: 14px;"><?php echo get_phrase('vaccine_name'); ?></td>
                                <td><b><?php echo $row['vaccine_name']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['vaccine_date'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('vaccine_date'); ?></td>
                                <td><b><?php echo $row['vaccine_date']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['vaccine_status'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('vaccine_status'); ?></td>
                                <td><b><?php echo $row['vaccine_status']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['vaccine_brand_name'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('vaccine_brand_name'); ?></td>
                                <td><b><?php echo $row['vaccine_brand_name']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['vaccine_batch_no'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('vaccine_batch_no'); ?></td>
                                <td><b><?php echo $row['vaccine_batch_no']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['deworming_date'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('deworming_date'); ?></td>
                                <td><b><?php echo $row['deworming_date']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['deworming_status'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('deworming_status'); ?></td>
                                <td><b><?php echo $row['deworming_status']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['deworming_brand_name'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('deworming_brand_name'); ?></td>
                                <td><b><?php echo $row['deworming_brand_name']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['deworming_batch_no'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('deworming_batch_no'); ?></td>
                                <td><b><?php echo $row['deworming_batch_no']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                         <?php if ($row['parasite_control_status'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('parasite_control_status'); ?></td>
                                <td><b><?php echo $row['parasite_control_status']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        
                        <?php if ($row['parasite_control_batch_no'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('parasite_control_batch_no'); ?></td>
                                <td><b><?php echo $row['parasite_control_batch_no']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['diet'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('diet'); ?></td>
                                <td><b><?php echo $row['diet']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['allergy'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('allergy'); ?></td>
                                <td><b><?php echo $row['allergy']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['brief_medical_history'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('brief_medical_history'); ?></td>
                                <td><b><?php echo $row['brief_medical_history']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['creation_timestamp'] != ''): ?>
                            <tr>
                                <td style="padding-left: 16px;font-weight: 600;    color: #000;font-size: 14px;"><?php echo get_phrase('created_date'); ?></td>
                                <td><b><?php echo $row['creation_timestamp']; ?></b></td>
                            </tr>
                        <?php endif; ?>

                    </table>
                </div>
            </div>
            
        </section>

    </div>

<?php } ?>