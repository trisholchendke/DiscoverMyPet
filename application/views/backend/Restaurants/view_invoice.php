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
	</head>
	
	<body>
		<?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
    <div id="invoice_print">
        <table width="100%" border="0">
            <tr>
                <td width="50%"><img src="assets/images/logo.png" style="max-height:80px;"></td>
                <td align="right">
                    <h4><?php echo get_phrase('invoice_number'); ?> : <?php echo $row['invoice_number']; ?></h4>
                    <h5><?php echo get_phrase('issue_date'); ?> : <?php echo $row['creation_timestamp']; ?></h5>
                    <h5><?php echo get_phrase('due_date'); ?> : <?php echo $row['due_timestamp']; ?></h5>
                    <h5><?php echo get_phrase('status'); ?> : <?php echo $row['status']; ?></h5>
                </td>
            </tr>
        </table>
        <hr>
        <table width="100%" border="0">    
            <tr>
                <td align="left"><h4><?php echo get_phrase('payment_to'); ?> </h4></td>
                <td align="right"><h4><?php echo get_phrase('bill_to'); ?> </h4></td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?><br>            
                </td>
                <td align="right" valign="top">
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name; ?><br>
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->address; ?><br>
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->phone; ?><br>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <hr>
    <table class="table table-bordered">
    	<tbody>
    		<tr>
    			<th>Product Name</th>
    			<th>Quantity</th>
    			<th>Price</th>
    		</tr>
    		
        <?php
                         $owner = $row['invoice_id'];

    $query = $this->db->get_where('invoice_medicine', array('invoice_id =' => $owner))->result();
    $array = json_decode(json_encode($query), True);
    $total = 0;
    for ($x = 0; $x <count($array); $x++) {
    	 $total += ($array[$x]['quantity'] * $array[$x]['price']);
    	
    ?>
    <tr>
    		<td><?php $name = $this->db->get_where('medicine' , array('medicine_id' => $array[$x]['medicine_id'] ))->row()->name;
                        echo $name;?></td>
    		<td><?php echo($array[$x]['quantity']); ?></td>
    		<td><?php echo($array[$x]['price']); ?></td>
    		</tr>
    		<?php };?>
    		<tr>
    			<td class="text-left" colspan="2">Total Price</td>
    			<td class="text-left" colspan="3">
    				<?php echo $total ;?>
    			</td>
    		</tr>
    			
    		
    	</tbody>
    </table>

    <a onClick="PrintElem('#invoice_print')" class="btn btn-primary btn-icon icon-left hidden-print">
        Print Invoice
        <i class="entypo-doc-text"></i>
    </a>


<?php endforeach; ?>
	</body>
</html>






