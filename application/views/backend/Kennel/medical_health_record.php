<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/add_health_record/');" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_health_record'); ?>
</button>
<?php $user_id    = $this->session->userdata('login_user_id'); ?>
<div style="clear:both;"></div>
<br>
<div class="row">

    <div class="col-md-12">
 <table class="table table-bordered table-striped datatable" id="table-1">
                    <thead>
                        <tr>
                            <th><?php echo get_phrase('pet_name'); ?></th>
                            <th><?php echo get_phrase('health_record'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $login_user_id =  $this->session->userdata('login_user_id');
            			$health_record = $this->db->get_where('health_record', array('user_id' => $login_user_id))->result_array();
                        if($health_record == !FALSE){
                        	
                        foreach ($health_record as $row) { 
                        	?>   
                            <tr>
                               <td>
                    <?php $name = $this->db->get_where('patient' , array('patient_id' => $row['patient_id'] ))->row()->name;
                        echo $name;?>
                </td>
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
                                	 <td >
                                	 <a href="uploads/health_record/<?php echo $row['health_record'] ?>" download>
                                		<img witdh="50" height="50"  src="assets/images/pdf_image.jpg" />
                                	 </a>
                                </td>
                                <?php 
                                } 
                                ?>	
                                
                                <td>
                                    <a  onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/edit_health_record/<?php echo $row['id'] ?>');" 
                                        class="btn btn-default btn-sm btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        Edit
                                    </a>
                                    
                                    <a  
                                    	href="<?php echo base_url(); ?>index.php?kennel/medical_health_record/delete/<?php echo $row['id'] ?>" 
                                       class="btn btn-danger btn-sm btn-icon icon-left" onclick="return checkDelete();">
                                        <i class="entypo-cancel"></i>
                                        Delete
                                    </a>
                                     <li>
                            </li>
                                </td>
                            </tr>
                        <?php }  } else{?>
                       <tr>
                       	<td colspan="3">No Record</td>
                       </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
        
    </div>
    
</div>
