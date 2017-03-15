<html  ng-app="invoice" ng-controller="view_invoice">
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
<style>
.close_btn{
color: #000;
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 20px;
}
.common_invoice_data{
    font-size: 13px !important;
    font-weight: 600;
}
.common_size_weight{
font-weight: 600;
    font-size: 13px;
}
.tbl_hr{
    margin-top: 5px !important;
    margin-bottom: 10px !important;
}
.common_data{
    margin-left: 15px;
    margin-top: 7px;
    font-weight: 600;
}
.common_data1{
    margin-right: 15px;
    margin-top: 7px;
    font-weight: 600;
}
.payment_to{
    font-size: 15px !important;
    font-weight:600 !important;
    margin-left:15px !important;
}
.bill_to{
    font-size: 15px !important;
    font-weight:600 !important;
    margin-right:15px !important;
}
</style>
	</head>
	
	<body>
		<?php
$doctor_data = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->result_array();
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
<div class="row" style="padding:15px;">
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
</div>
    <div id="invoice_print">
        <table width="100%" border="0">
            <tr>
                <td width="50%"><img src="<?php echo base_url(); ?>/uploads/doctor_image/<?php echo $doctor_data[0]['clinic_image'];  ?>" style="max-height:80px;"></td>
                <td align="right">
                    <h5 class="common_invoice_data"><?php echo get_phrase('invoice_number'); ?> : <?php echo $row['invoice_number']; ?></h4>
                    <h5 class="common_invoice_data"><?php echo get_phrase('issue_date'); ?> : <?php echo $row['creation_timestamp']; ?></h5>
                    <h5 class="common_invoice_data"><?php echo get_phrase('due_date'); ?> : <?php echo $row['due_timestamp']; ?></h5>
                    <h5 class="common_invoice_data"><?php echo get_phrase('status'); ?> : <?php echo $row['status']; ?></h5>
                </td>
            </tr>
        </table>
        <hr class="tbl_hr">
        <table width="100%" border="0" style="margin-top: -17px;">    
            <tr     style="background-color: #f8f8f8;">
                <td align="left"><h4 class="payment_to"><?php echo get_phrase('payment_to'); ?> </h4></td>
                <td align="right"><h4 class="bill_to"><?php echo get_phrase('bill_to'); ?> </h4></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <div class="common_data">Clinic Name :<?php echo $doctor_data[0]['clinic_name']; ?></div>
                    <div class="common_data">Doctor Name :<?php echo $doctor_data[0]['name']; ?></div>
                    <div class="common_data">Address :<?php echo $doctor_data[0]['address']; ?></div>
                    <div class="common_data">Phone:<?php echo $doctor_data[0]['phone']; ?></div>
                    <div class="common_data">Email :<?php echo $doctor_data[0]['email']; ?></div>
                    <div class="common_data">Website Name :<?php echo $doctor_data[0]['website_name']; ?></div>
                </td>
                <td align="right" valign="top">
                    <div class="common_data1">Pet Name :<?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name; ?></div>
                    <div class="common_data1">Address :<?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->parent_address; ?></div>
                    <div class="common_data1">Phone :<?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->phone; ?></div>
                </td>
            </tr>
        </table>
    </div>
    
    <hr class="tbl_hr">
    <table class="table table-bordered">
    	<tbody>
    		<tr>
    			<th>Product Name</th>
    			<th>Product Price</th>
    			<th>Quantity</th>
    			<th>Price</th>
    		</tr>
    		
        <?php
                         $owner = $row['invoice_id'];

    $query = $this->db->get_where('invoice_medicine', array('invoice_id =' => $owner))->result();
    $array = json_decode(json_encode($query), True);
    $total = 0;
    for ($x = 0; $x <count($array); $x++) {
    	 $total += ($array[$x]['price']);
    	
    ?>
    <tr>
    		<td><?php $name = $this->db->get_where('medicine' , array('medicine_id' => $array[$x]['medicine_id'] ))->row()->name;
                        echo $name;?></td>
    		<td><?php $name = $this->db->get_where('medicine' , array('medicine_id' => $array[$x]['medicine_id'] ))->row()->price;
                        echo $name;?></td>
    		<td><?php echo($array[$x]['quantity']); ?></td>
    		<td><i class="fa fa-inr" aria-hidden="true"></i><?php echo($array[$x]['price']); ?></td>
    		</tr>
    		<?php };?>
    		<tr>
    			<td class="text-right" colspan="3" style="font-weight:600 !important;">Total Price</td>
    			<td class="text-left" colspan="4">
    			<i class="fa fa-inr" aria-hidden="true"></i>
    				<?php echo $total ;?>
    			</td>
    		</tr>
                <tr>
    			<td class="text-right common_size_weight" colspan="3">Fees</td>
    			<td class="text-left common_size_weight" colspan="4">
    			<i class="fa fa-inr" aria-hidden="true"></i>
    				<?php echo $row['fees'] ;?>
    			</td>
    		</tr>
                 <tr>
    			<td class="text-right common_size_weight" colspan="3">Service Tax (<?php echo $doctor_data[0]['service_tax']; ?> %) </td>
    			<td class="text-left common_size_weight" colspan="4">
    			<i class="fa fa-inr" aria-hidden="true"></i>
    				<?php echo round(($row['fees'] * $doctor_data[0]['service_tax'] ) /100);?>
    			</td>
    		</tr>
                <tr>
    			<td class="text-right common_size_weight" colspan="3">Vat Percentage (<?php echo $doctor_data[0]['vat_percentage']; ?> %)</td>
    			<td class="text-left common_size_weight" colspan="4">
    			<i class="fa fa-inr" aria-hidden="true"></i>
    				<?php echo round(($total * $doctor_data[0]['vat_percentage'] ) /100);?>
    			</td>
    		</tr>
                <tr>
    			<td class="text-right common_size_weight" colspan="3">Final Amount</td>
    			<td class="text-left common_size_weight" colspan="4">
    			<i class="fa fa-inr" aria-hidden="true"></i>
    				<?php echo $total + $row['fees'] + round(($row['fees'] * $doctor_data[0]['service_tax'] ) /100) + round(($total * $doctor_data[0]['vat_percentage'] ) /100) ;?>
    			</td>
    		</tr>
    			
    		
    	</tbody>
    </table>

   
<div class="text-center">

<?php endforeach; ?>

<a href="<?php echo base_url();?>/index.php?doctor/download_invoice/<?php echo  $param2;?>">
	<button class="btn btn-primary">Download</button>
</a>
</div>
	</body>
</html>






