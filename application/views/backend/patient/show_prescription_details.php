<style>
.close_btn{
color: #000;
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 18px;
}
.modal-body{
height: 350px !important;
    overflow-y: auto !important;
}
.modal-dialog{
    width: 60% !important;
}
.modal{
top:0px !important;
}
</style>

<?php
$edit_data      = $this->db->get_where('prescription', array('prescription_id' => $param2))->result_array();

$patient_info   = $this->db->get_where('patient' , array('patient_id' => $edit_data[0]['patient_id'] ))->result_array();
?>
<div class="row" style="padding:15px;">
<button type="button" class="close pull-right close_btn" data-dismiss="modal" aria-hidden="true">×</button>
</div>
    <div id="prescription_print">
        <table width="100%" border="0">
            <tr>
                <td align="left" valign="top">
                    <?php foreach ($patient_info as $row2){ ?>
                        <?php echo 'Pet Name: '.$row2['name']; ?><br>
                        <?php echo 'Age: '.$row2['age']; ?><br>
                        <?php echo 'Sex: '.$row2['sex']; ?><br>
                    <?php } ?>
                </td>
                <td align="right" valign="top">
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $edit_data[0]['doctor_id'] ))->row()->name;
                          echo 'Doctor Name: '.$name;?><br>
                    <?php echo 'Date: '.date("d M, Y", $edit_data[0]['timestamp']); ?><br>
                    <?php echo 'Time: '.date("H:i", $edit_data[0]['timestamp']); ?><br>
                </td>
            </tr>
        </table>
        
        <hr>
        <table width="100%" border="1" class="table table-bordered">
           <tr>
           		<th>Product Name</th>
           		<th>Days</th>
           		<th>Quantity</th>
           </tr>
          
                 <?php
                 $data = $this->db->get_where('product_prescreption',array("precreption_id" =>$edit_data[0]['prescription_id']))->result_array();
                 if(count($data)>0){
                 foreach ($data as $row2){
          		?>
          		 <tr>
	           		<td><?php  $name = $this->db->get_where('medicine' , array('medicine_id' => $row2['medicine_id'] ))->row()->name; echo $name;?></td>
	           		<td><?php echo $row2['dose']; ?></td>
	           		<td><?php echo $row2['quantity']; ?></td>
           		 </tr>
           		<?php } }else{; ?>
           		<tr>
	           		<td colspan="3">No Data</td>
           		 </tr>
           		<?php };?>
          
        </table>
    </div>

<div class="row text-center">
    <a href="<?php echo base_url(); ?>index.php?patient/prescription/download/<?php echo $edit_data[0]['prescription_id']?>">
       <button class="btn btn-primary">Download</button>
    </a>
</div>
   

<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'prescription', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Prescription</title>');
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