<style>
.close_btn{
color: #000;
    position: absolute;
    right: 25px;
    top: -20px;
}
</style>
<?php
$patient_info = $this->crud_model->select_patient_info_by_patient_id($param2);
foreach ($patient_info as $row) { ?>

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
                            <h3><?php echo $row['name']; ?></h3>
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
						<?php if ($row['master_id'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('master_id');?></th>
                                <td><b><?php echo $row['master_id']; ?></b>
                                </td>
                            </tr> 
                        <?php endif; ?>

<?php if ($row['unique_id'] != ''): ?>
                            <tr>
                                <td><?php echo get_phrase('unique_key');?></td>
                                <td><b><?php echo $row['unique_id']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['microchip_no'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('microchip_no'); ?></th>
                                <td><b><?php echo $row['microchip_no']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['species'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('species');?></th>
                                <td><b><?php echo $row['species']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                         <?php if ($row['sex'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('sex');?></th>
                                <td><b><?php echo $row['sex']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['breed'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('breed');?></th>
                                <td><b><?php echo $row['breed']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['birth_date'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('birth_date');?></th>
                                <td><b><?php echo date('d/m/Y', $row['birth_date']); ?></b></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($row['age'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('age');?></th>
                                <td><b><?php echo $row['age']; ?></b></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['sterilization_status'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('sterilization_status');?></th>
                                <td><b><?php echo $row['sterilization_status']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['color'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('color');?></th>
                                <td><b><?php echo $row['color']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['drug_sensitivity'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('drug_sensitivity');?></th>
                                <td><b><?php echo $row['drug_sensitivity']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['mating_preference'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('mating_preference');?></th>
                                <td><b><?php echo $row['mating_preference']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['remarks'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('remarks');?></th>
                                <td><b><?php echo $row['remarks']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['brief_medical_history'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('brief_medical_history');?></th>
                                <td><b><?php echo $row['brief_medical_history']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['boarding_everytime_details'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('boarding_everytime_details');?></th>
                                <td><b><?php echo $row['boarding_everytime_details']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>



                        <?php if ($row['blood_group'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('blood_group');?></th>
                                <td><b><?php echo $row['blood_group']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['parent_name'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('parent_name');?></th>
                                <td><b><?php echo $row['parent_name']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['parent_contact_no'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('parent_contact_no');?></th>
                                <td><b><?php echo $row['parent_contact_no']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['email'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('email');?></th>
                                <td><b><?php echo $row['email']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if ($row['parent_contact_no'] != ''): ?>
                            <tr>
                                <th style="padding-left: 16px;font-weight: 600;font-size: 14px;color:#000;"><?php echo get_phrase('parent_contact_no');?></th>
                                <td><b><?php echo $row['parent_contact_no']; ?></b>
                                </td>
                            </tr>
                        <?php endif; ?>




                    </table>
                </div>
            </div>
            
        </section>

    </div>

<?php } ?>