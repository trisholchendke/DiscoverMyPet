<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('appointment_type');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('pet');?></th>
            <th><?php echo get_phrase('bording_number');?></th>
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('sub_doctor');?></th>
        </tr>
    </thead>

   <tbody>
        <?php  
        	$login_user_id =  $this->session->userdata('login_user_id');
            $patient_info = $this->db->get_where('appointment', array('patient_id' => $login_user_id,'status' => 'pending'))->result_array();
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
                 <td>
                	<?php if($row['user_id'] == NULL){ ?>
                		<p>-</p>
                	<?php }else {?>
                		 <?php $name = $this->db->get_where('users' , array('id' => $row['user_id'] ))->row()->name;
                        echo $name;?>
                	
                	<?php }?>
                </td>
                
            </tr>
        <?php } ?>
    </tbody>
</table>