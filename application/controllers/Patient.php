<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function index() {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'dashboard';
        $data['page_title'] = get_phrase('patient_dashboard');
        $this->load->view('backend/index', $data);
    }
function download_invoice($invoice_id) {
 		
 		$query = $this->db->get('invoice');
 		$this->db->select('d.clinic_name,d.name doctor_name,d.phone doctor_phone,d.address doctor_address,d.email doctor_email,d.clinic_image,d.vat_percentage,d.service_tax,p.name,p.patient_id,i.fees,i.total_amount,i.invoice_number,i.title,i.creation_timestamp,i.due_timestamp,i.status,im.price,im.quantity,m.name');
 		$this->db->from('invoice i');
 		$this->db->join('patient p', 'p.patient_id=i.patient_id', 'left');
 		$this->db->join('invoice_medicine im', 'im.invoice_id=i.invoice_id', 'left');
 		$this->db->join('doctor d', 'd.doctor_id=i.doctor_id', 'left');
 		$this->db->join('medicine m', 'm.medicine_id=im.medicine_id', 'left');
 		$this->db->where('i.invoice_id',$invoice_id);
 		$query = $this->db->get();
 		if($query->num_rows() != 0)
 		{
 			
 			
 			
 			
 			$data =  $query->result_array();
 			
 			$total_amount1 = $data[0]['total_amount'] ;
 			$vat_percentage = round(($data[0]['total_amount'] * $data[0]['vat_percentage']) / 100  ) ;
 			$service_tax = round(($data[0]['fees'] * $data[0]['service_tax']) / 100) ;
 			$consultation_fees = $data[0]['fees'];
 			
 			$final_amount = $total_amount1 + $vat_percentage + $service_tax + $consultation_fees;
 			
 			if($data[0]['vat_percentage'] !== NULL){
 				
 				$total_amount = ($data[0]['total_amount'] / $data[0]['vat_percentage']) + $data[0]['total_amount'];
 			}
 			if($data[0]['service_tax'] !== NULL){
 				
 				$total_fees = ($data[0]['fees'] / $data[0]['service_tax']) + $data[0]['fees'];
 			}
 			
 			$html = '
        				<!DOCTYPE html>
<head>
<title>Invoice Details</title>
<STYLE>
body{
margin:50px;
margin-left:150px;
margin-right:150px;
background-color:#fff;
color:#000000 !important;
}
table{
 			
width:100%;
border-collapse:collapse;
}
table, th, td {
 			
 			
	color:#000000;
	text-align:center;
	padding:20px;
	    font-size: 16px;
font-weight:600;
}
th{
border-bottom:1px solid #000000;
}
td{
font-size: 15px !important;
    font-weight: 400;
}
h1{
text-align: center !important;
    color: #000000;
    FONT-SIZE: 39PX;
    FONT-WEIGHT: 700;
}
.underline{
width:100px;
height:2px;
background-color:fff !important;
border:2px solid #000000;
}
.text-center{
text-align:center;
}
.barcode{
    width: 50%;
    float: left;
    text-align: left;
}
.pet_image{
width: 50%;
    float: left;
       text-align: right;
}
.details_container{
    float: right !IMPORTANT;
}
.details_container p{
font-size:15px;
font-weight:600;
}
.details_container span{
font-size:14px;
font-weight:400;
margin-left:10px;
}
 			
.two{
    margin-left: 28px !important;
	}
	.three{
        margin-left: 7px !important;
	}
	.four{
        margin-left: 13px !important;
	}
	.tbl_two th{
	border-top:1px solid #000000;
	border-bottom:0px solid #000000;
	}
	.tbl_two th {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
.tbl_two td {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
hr{
    border: 0px solid #000000 !important;
    height: 1px !important;
    background-color: #000000 !important;
}
.last_section{
width:100%;
}
.last_section_container h4{
width:50%;
border-bottom:1px solid #000000;
}
.weight_history1{
margin-left:58px;
}
.weight_history2{
margin-left:22px;
}
.net_balance{
padding-right:61px !important;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="barcode">
<img src="assets/images/discovermypet_logo.png" width="100px" height="100px">
</div>
<div class="pet_image">
<img src='. base_url() . 'uploads/doctor_image/' .$data[0]['clinic_image'] .' width="100px" height="100px">
</div>
<h4 class="text-center">We Treat Your Pet Like Family</h4>
<hr>
 			
 			
 			
<div class=\'invoice_details\'>
<div style=\'float: right !IMPORTANT;\'>
 			
<p>Creation Date:<span class=\'two\'>'. $data[0]['creation_timestamp'] .'</span></p>
<p>Invoice Number:<span class=\'four\'>'. $data[0]['invoice_number'] .'</span></p>
<p>Doctor Name:<span class=\'four\'>'. $data[0]['doctor_name'] .'</span></p>
<p>Clinic Name:<span class=\'four\'>'. $data[0]['clinic_name'] .'</span></p>
<p>Address :<span class=\'four\'>'. $data[0]['doctor_address'] .'</span></p>
<p>Email Id :<span class=\'four\'>'. $data[0]['doctor_email'] .'</span></p>
<p>Contact No :<span class=\'four\'>'. $data[0]['doctor_phone'] .'</span></p>
</div>
</div>
 			
<table>
<tr>

<th>For</th>
 			
<th>Qty</th>
 			
<th>Price</th>


</tr>
';
 			 
 			for($x=0;$x<count($data);$x++){
 			
 				 $total_price = $data[$x]['total_amount'];
 			
 				 $html .=
 				 '<tr>

<td>'. $data[$x]['name']. '</td>
<td>'. $data[$x]['quantity']. '</td>
 				 
<td>'. $data[$x]['price']. '</td>


 				 
 				 
</tr>';
 			
 			
 			
 			}
 			$html .='</table><hr>
<table>
 					
	<tr style="border:none">
		<th>Total Amount</th>
		<td>'.  $total_amount1 . ' Rs</td>
	</tr>
	<tr style="border:none">
		<th>Vat Percentage ('. $data[0]['vat_percentage'] .' %'.')</th>
		<td>'. $vat_percentage  . ' Rs</td>
	</tr>
	
	<tr style="border:none">
		<th>Consultation Fees</th>
		<td>'. $consultation_fees . ' Rs</td>
	</tr>
	<tr style="border:none">
		<th>Service Tax ('. $data[0]['service_tax'] .' %'.')</th>
		<td>'. $service_tax  . ' Rs</td>
	</tr>



</table>
				<hr>
				<table>
	<tr style="border:none">
		<th>Final Amount</th>
		<td>'. $final_amount .' Rs</td>
	</tr>



</table>
   
 			
 			
</div>
</div>
</body>
</html>';
 			
 			ini_set('memory_limit', '512M');
 			$this->load->library('pdf');
 			 
 			$pdf = $this->pdf->load();
 			 
 			$pdf->WriteHTML($html); // write the HTML into the PDF
 			$pdf->Output('invoice_report.pdf', 'F'); // save to file because we can
 			$this->load->helper('download');
 			$data = file_get_contents('invoice_report.pdf');
 			ob_clean();
 			force_download('invoice_report.pdf', $data);
 			return $query->result_array();
 		}
 		else
 		{
 			return false;
 		}
 		
 	}
    function show_appointment($notification_id = "") {
    	if ($this->session->userdata('patient_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	$data['appointment'] = $this->db->get_where('appointment',array('appointment_id' => $notification_id))->result_array();
    	$data['page_name'] = 'show_appointment1';
    	$data['page_title'] = get_phrase('show_appointment');
    	$this->load->view('backend/index', $data);
    }
    
    function download_report($task = "",$patient_id = "") {
    	if ($this->session->userdata('patient_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	if($task == "birth"){
    		$query = $this->db->get('report');
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.blood_group,p.patient_id,p.color,p.name,p.birth_date,p.parent_name,p.sex,p.address,p.breed,r.timestamp operation_date,r.timestamp birth_date1');
    		$this->db->from('report r');
    		$this->db->join('patient p', 'p.patient_id=r.patient_id', 'left');
    		$this->db->join('doctor d', 'd.doctor_id=p.doctor_id', 'left');
    		$this->db->where('r.report_id',$patient_id);
    		$query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
    			$data =  $query->result_array();
    			$birth_date = date('m/d/Y', $data[0]['birth_date1']);
    			ini_set('memory_limit', '512M');
    			$html = '
        				<!DOCTYPE html>
<head>
<title>Birth Certificate</title>
<STYLE>
body{
margin:50px;
margin-left:150px;
margin-right:150px;
background-color:#fff;
color:#000000 !important;
}
table{
    
width:100%;
border-collapse:collapse;
}
table, th, td {
   border:1px solid #000000;
    
	color:#000000;
	text-align:center;
	padding:20px;
	    font-size: 16px;
font-weight:600;
}
th{
border-bottom:1px solid #000000;
}
td{
font-size: 15px !important;
    font-weight: 400;
}
h1{
text-align: center !important;
    color: #000000;
    FONT-SIZE: 39PX;
    FONT-WEIGHT: 700;
}
.underline{
width:100px;
height:2px;
background-color:fff !important;
border:2px solid #000000;
}
.text-center{
text-align:center;
}
.barcode{
    width: 50%;
    float: left;
    text-align: left;
}
.pet_image{
width: 50%;
    float: left;
       text-align: right;
}
.details_container{
    float: right !IMPORTANT;
}
.details_container p{
font-size:15px;
font-weight:600;
}
.details_container span{
font-size:14px;
font-weight:400;
margin-left:10px;
}
    
.two{
    margin-left: 28px !important;
	}
	.three{
        margin-left: 7px !important;
	}
	.four{
        margin-left: 13px !important;
	}
	.tbl_two th{
	border-top:1px solid #000000;
	border-bottom:0px solid #000000;
	}
	.tbl_two th {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
.tbl_two td {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
hr{
    border: 0px solid #000000 !important;
    height: 1px !important;
    background-color: #000000 !important;
}
.last_section{
width:100%;
}
.last_section_container h4{
width:50%;
border-bottom:1px solid #000000;
}
.weight_history1{
margin-left:58px;
}
.weight_history2{
margin-left:22px;
}
.net_balance{
padding-right:61px !important;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="barcode">
	<p>Name :<span style="margin-left:10px" class=\'two\'>'. $data[0]['doctor_name'] .'</span></p>
<p>Clinic Name :<span class=\'four\'>'. $data[0]['clinic_name'] .'</span></p>
				<p>Registration No:<span class=\'four\'>'. $data[0]['registration_no'] .'</span></p>
<p>Email Id :<span class=\'four\'>'. $data[0]['doctor_email_id'] .'</span></p>
						<p>Contact No:<span class=\'four\'>'. $data[0]['doctor_contact_no'] .'</span></p>
		<p>Address :<span class=\'four\'>'. $data[0]['doctor_address'] .'</span></p>
</div>
<div class="pet_image">
<img src='. $this->crud_model->get_image_url('patient' , $data[0]['patient_id']) .' width="100px" height="100px">
</div>
<h4 class="text-center">Birth Certificate</h4>
<hr>
    
    
    
    
    
<table class="table">
<tr>
		<th>Pet Name</th>
		<td>'. ucfirst($data[0]['name']) .'</td>
</tr>
<tr>
		<th>Parent Name</th>
		<td>'. ucfirst($data[0]['parent_name']) .'</td>
</tr>
<tr>
		<th>Birth Date (MM/DD/YYYY)</th>
		<td>'. $birth_date .'</td>
</tr>
<tr>
		<th>Gender</th>
		<td>'. ucfirst($data[0]['sex']) .'</td>
</tr>
<tr>
		<th>Blood Groop</th>
		<td>'. ucfirst($data[0]['blood_group']) .'</td>
</tr>
<tr>
		<th>Breed</th>
		<td>'. ucfirst($data[0]['breed']) .'</td>
</tr>
<tr>
		<th>Color</th>
		<td>'. ucfirst($data[0]['color']) .'</td>
</tr>
<tr>
		<th>Contact No</th>
		<td>'. ucfirst($data[0]['phone']) .'</td>
</tr>
<tr>
		<th>Email Id</th>
		<td>'. ucfirst($data[0]['email']) .'</td>
</tr>
<tr>
		<th>Address</th>
		<td>'. ucfirst($data[0]['address']) .'</td>
</tr>
    
    
</table>
   
    
    
</div>
</div>
</body>
</html>';
    
    			$this->load->library('pdf');
    			$pdf = $this->pdf->load();
    
    			//$header='Birth Report';
    
    			// $pdf->SetHeader($header);
    
    			//$pdf->SetFooter($_SERVER['HTTP_HOST'] . '|{PAGENO}|' . date(DATE_RFC822)); // Add a footer for good measure ;)
    
    			$pdf->WriteHTML($html); // write the HTML into the PDF
    			$pdf->Output('birth_report.pdf', 'F'); // save to file because we can
    			//        redirect(site_url('test.pdf'));
    			// load download helder
    			$this->load->helper('download');
    			// read file contents
    			$data = file_get_contents('birth_report.pdf');
    			force_download('birth_report.pdf', $data);
    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    
    
    	}
    
    	if($task == "operation"){
    		$query = $this->db->get('report');
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.patient_id,p.blood_group,p.parent_name,p.color,p.name,p.birth_date,p.sex,p.address,p.breed,r.timestamp operation_date');
    		$this->db->from('report r');
    		$this->db->join('patient p', 'p.patient_id=r.patient_id', 'left');
    		$this->db->join('doctor d', 'd.doctor_id=p.doctor_id', 'left');
    		$this->db->where('r.report_id',$patient_id);
    		$query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
    			$data =  $query->result_array();
    			$birth_date = date('m/d/Y', $data[0]['birth_date']);
    			$operation_date = date('m/d/Y', $data[0]['operation_date']);
    			ini_set('memory_limit', '512M');
    
    			$html = '
        				<!DOCTYPE html>
<head>
<title>Operation Certificate</title>
<STYLE>
body{
margin:50px;
margin-left:150px;
margin-right:150px;
background-color:#fff;
color:#000000 !important;
}
table{
    
width:100%;
border-collapse:collapse;
}
table, th, td {
   border:1px solid #000000;
    
	color:#000000;
	text-align:center;
	padding:20px;
	    font-size: 16px;
font-weight:600;
}
th{
border-bottom:1px solid #000000;
}
td{
font-size: 15px !important;
    font-weight: 400;
}
h1{
text-align: center !important;
    color: #000000;
    FONT-SIZE: 39PX;
    FONT-WEIGHT: 700;
}
.underline{
width:100px;
height:2px;
background-color:fff !important;
border:2px solid #000000;
}
.text-center{
text-align:center;
}
.barcode{
    width: 50%;
    float: left;
    text-align: left;
}
.pet_image{
width: 50%;
    float: left;
       text-align: right;
}
.details_container{
    float: right !IMPORTANT;
}
.details_container p{
font-size:15px;
font-weight:600;
}
.details_container span{
font-size:14px;
font-weight:400;
margin-left:10px;
}
    
.two{
    margin-left: 28px !important;
	}
	.three{
        margin-left: 7px !important;
	}
	.four{
        margin-left: 13px !important;
	}
	.tbl_two th{
	border-top:1px solid #000000;
	border-bottom:0px solid #000000;
	}
	.tbl_two th {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
.tbl_two td {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
hr{
    border: 0px solid #000000 !important;
    height: 1px !important;
    background-color: #000000 !important;
}
.last_section{
width:100%;
}
.last_section_container h4{
width:50%;
border-bottom:1px solid #000000;
}
.weight_history1{
margin-left:58px;
}
.weight_history2{
margin-left:22px;
}
.net_balance{
padding-right:61px !important;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="barcode">
	<p>Name :<span style="margin-left:10px" class=\'two\'>'. $data[0]['doctor_name'] .'</span></p>
<p>Clinic Name :<span class=\'four\'>'. $data[0]['clinic_name'] .'</span></p>
				<p>Registration No:<span class=\'four\'>'. $data[0]['registration_no'] .'</span></p>
<p>Email Id :<span class=\'four\'>'. $data[0]['doctor_email_id'] .'</span></p>
						<p>Contact No:<span class=\'four\'>'. $data[0]['doctor_contact_no'] .'</span></p>
		<p>Address :<span class=\'four\'>'. $data[0]['doctor_address'] .'</span></p>
</div>
<div class="pet_image">
<img src='. $this->crud_model->get_image_url('patient' , $data[0]['patient_id']) .' width="100px" height="100px">
</div>
<h4 class="text-center">Operation Certificate</h4>
<hr>
    
    
    
    
    
<table class="table">
<tr>
		<th>Pet Name</th>
		<td>'. ucfirst($data[0]['name']) .'</td>
</tr>
<tr>
		<th>Parent Name</th>
		<td>'. ucfirst($data[0]['parent_name']) .'</td>
</tr>
<tr>
		<th>DATE OF BIRTH (MM/DD/YYYY)</th>
<td>' . $birth_date .'</td>
</tr>
    
<tr>
<th>OPERATION DATE (MM/DD/YYYY)</th>
<td>' . $operation_date .'</td>
</tr>
    
<tr>
		<th>Gender</th>
		<td>'. ucfirst($data[0]['sex']) .'</td>
</tr>
<tr>
		<th>Blood Groop</th>
		<td>'. ucfirst($data[0]['blood_group']) .'</td>
</tr>
<tr>
		<th>Breed</th>
		<td>'. ucfirst($data[0]['breed']) .'</td>
</tr>
<tr>
		<th>Color</th>
		<td>'. ucfirst($data[0]['color']) .'</td>
</tr>
<tr>
		<th>Contact No</th>
		<td>'. ucfirst($data[0]['phone']) .'</td>
</tr>
<tr>
		<th>Email Id</th>
		<td>'. ucfirst($data[0]['email']) .'</td>
</tr>
<tr>
		<th>Address</th>
		<td>'. ucfirst($data[0]['address']) .'</td>
</tr>
    
    
</table>
  
    
    
</div>
</div>
</body>
</html>';
    
    
    			$this->load->library('pdf');
    			$pdf = $this->pdf->load();
    
    
    			$pdf->WriteHTML($html); // write the HTML into the PDF
    			$pdf->Output('operation_report.pdf', 'F'); // save to file because we can
    			//        redirect(site_url('test.pdf'));
    			// load download helder
    			$this->load->helper('download');
    			// read file contents
    			$data = file_get_contents('operation_report.pdf');
    			force_download('operation_report.pdf', $data);
    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    
    	}
    
    	if($task == "death"){
    		$query = $this->db->get('report');
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.patient_id,p.blood_group,p.color,p.age,p.phone,p.name,p.birth_date,p.sex,p.address,p.breed,p.parent_name,r.timestamp death_date,r.death_location,r.death_reason');
    		$this->db->from('report r');
    		$this->db->join('patient p', 'p.patient_id=r.patient_id', 'left');
    		$this->db->join('doctor d', 'd.doctor_id=p.doctor_id', 'left');
    		$this->db->where('r.report_id',$patient_id);
    		$query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
    			$data =  $query->result_array();
    			$birth_date = date('m/d/Y', $data[0]['birth_date']);
    			$death_date = date('m/d/Y', $data[0]['death_date']);
    			ini_set('memory_limit', '512M');
    
    
    			$html = '
        				<!DOCTYPE html>
<head>
<title>Death Certificate</title>
<STYLE>
body{
margin:50px;
margin-left:150px;
margin-right:150px;
background-color:#fff;
color:#000000 !important;
}
table{
    
width:100%;
border-collapse:collapse;
}
table, th, td {
   border:1px solid #000000;
    
	color:#000000;
	text-align:center;
	padding:20px;
	    font-size: 16px;
font-weight:600;
}
th{
border-bottom:1px solid #000000;
}
td{
font-size: 15px !important;
    font-weight: 400;
}
h1{
text-align: center !important;
    color: #000000;
    FONT-SIZE: 39PX;
    FONT-WEIGHT: 700;
}
.underline{
width:100px;
height:2px;
background-color:fff !important;
border:2px solid #000000;
}
.text-center{
text-align:center;
}
.barcode{
    width: 50%;
    float: left;
    text-align: left;
}
.pet_image{
width: 50%;
    float: left;
       text-align: right;
}
.details_container{
    float: right !IMPORTANT;
}
.details_container p{
font-size:15px;
font-weight:600;
}
.details_container span{
font-size:14px;
font-weight:400;
margin-left:10px;
}
    
.two{
    margin-left: 28px !important;
	}
	.three{
        margin-left: 7px !important;
	}
	.four{
        margin-left: 13px !important;
	}
	.tbl_two th{
	border-top:1px solid #000000;
	border-bottom:0px solid #000000;
	}
	.tbl_two th {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
.tbl_two td {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
hr{
    border: 0px solid #000000 !important;
    height: 1px !important;
    background-color: #000000 !important;
}
.last_section{
width:100%;
}
.last_section_container h4{
width:50%;
border-bottom:1px solid #000000;
}
.weight_history1{
margin-left:58px;
}
.weight_history2{
margin-left:22px;
}
.net_balance{
padding-right:61px !important;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="barcode">
	<p>Name :<span style="margin-left:10px" class=\'two\'>'. $data[0]['doctor_name'] .'</span></p>
<p>Clinic Name :<span class=\'four\'>'. $data[0]['clinic_name'] .'</span></p>
				<p>Registration No:<span class=\'four\'>'. $data[0]['registration_no'] .'</span></p>
<p>Email Id :<span class=\'four\'>'. $data[0]['doctor_email_id'] .'</span></p>
						<p>Contact No:<span class=\'four\'>'. $data[0]['doctor_contact_no'] .'</span></p>
		<p>Address :<span class=\'four\'>'. $data[0]['doctor_address'] .'</span></p>
</div>
<div class="pet_image">
<img src='. $this->crud_model->get_image_url('patient' , $data[0]['patient_id']) .' width="100px" height="100px">
</div>
<h4 class="text-center">Death Certificate</h4>
<hr>
    
    
    
    
    
<table class="table">
<tr>
		<th>Pet Name</th>
		<td>'. ucfirst($data[0]['name']) .'</td>
</tr>
<tr>
		<th>Parent Name</th>
		<td>'. ucfirst($data[0]['parent_name']) .'</td>
</tr>
<tr>
		<th>DATE OF BIRTH (MM/DD/YYYY)</th>
<td>' . $birth_date .'</td>
</tr>
    
<tr>
<th>Death Date (MM/DD/YYYY)</th>
<td>' . $death_date .'</td>
</tr>
    
<tr>
		<th>Gender</th>
		<td>'. ucfirst($data[0]['sex']) .'</td>
</tr>
<tr>
		<th>Blood Groop</th>
		<td>'. ucfirst($data[0]['blood_group']) .'</td>
</tr>
<tr>
		<th>Breed</th>
		<td>'. ucfirst($data[0]['breed']) .'</td>
</tr>
<tr>
		<th>Color</th>
		<td>'. ucfirst($data[0]['color']) .'</td>
</tr>
<tr>
		<th>Contact No</th>
		<td>'. ucfirst($data[0]['phone']) .'</td>
</tr>
<tr>
		<th>Email Id</th>
		<td>'. ucfirst($data[0]['email']) .'</td>
</tr>
<tr>
		<th>Address</th>
		<td>'. ucfirst($data[0]['address']) .'</td>
</tr>
<tr>
		<th>Death Reason</th>
		<td>'. ucfirst($data[0]['death_reason']) .'</td>
</tr>
<tr>
		<th>Death Location</th>
		<td>'. ucfirst($data[0]['death_location']) .'</td>
</tr>
    
    
</table>
    
    
    
</div>
</div>
</body>
</html>';
    
    			$this->load->library('pdf');
    			$pdf = $this->pdf->load();
    
    
    
    
    			$pdf->WriteHTML($html); // write the HTML into the PDF
    			$pdf->Output('death_report.pdf', 'F'); // save to file because we can
    			//        redirect(site_url('test.pdf'));
    			// load download helder
    			$this->load->helper('download');
    			// read file contents
    			$data = file_get_contents('death_report.pdf');
    			force_download('death_report.pdf', $data);
    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    
    	}
    
    	if($task == "sale"){
    		$query = $this->db->get('invoice');
    		$this->db->select('p.name,p.patient_id,i.invoice_number,i.title,i.creation_timestamp,i.due_timestamp,i.status,im.price,im.quantity,m.name');
    		$this->db->from('invoice i');
    		$this->db->join('patient p', 'p.patient_id=i.patient_id', 'left');
    		$this->db->join('invoice_medicine im', 'im.invoice_id=i.invoice_id', 'left');
    		$this->db->join('medicine m', 'm.medicine_id=im.medicine_id', 'left');
    		$this->db->where('i.invoice_id',$patient_id);
    		$query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
    			$data =  $query->result_array();
    			ini_set('memory_limit', '512M');
    			$html = '
        				<!DOCTYPE html>
<head>
<title>Invoice Details</title>
<STYLE>
body{
margin:50px;
margin-left:150px;
margin-right:150px;
background-color:#fff;
color:#000000 !important;
}
table{
    
width:100%;
border-collapse:collapse;
}
table, th, td {
    
    
	color:#000000;
	text-align:center;
	padding:20px;
	    font-size: 16px;
font-weight:600;
}
th{
border-bottom:1px solid #000000;
}
td{
font-size: 15px !important;
    font-weight: 400;
}
h1{
text-align: center !important;
    color: #000000;
    FONT-SIZE: 39PX;
    FONT-WEIGHT: 700;
}
.underline{
width:100px;
height:2px;
background-color:fff !important;
border:2px solid #000000;
}
.text-center{
text-align:center;
}
.barcode{
    width: 50%;
    float: left;
    text-align: left;
}
.pet_image{
width: 50%;
    float: left;
       text-align: right;
}
.details_container{
    float: right !IMPORTANT;
}
.details_container p{
font-size:15px;
font-weight:600;
}
.details_container span{
font-size:14px;
font-weight:400;
margin-left:10px;
}
    
.two{
    margin-left: 28px !important;
	}
	.three{
        margin-left: 7px !important;
	}
	.four{
        margin-left: 13px !important;
	}
	.tbl_two th{
	border-top:1px solid #000000;
	border-bottom:0px solid #000000;
	}
	.tbl_two th {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
.tbl_two td {
    text-align: right !important;
    padding: 5px !important;
    padding-right: 37px !important;
}
hr{
    border: 0px solid #000000 !important;
    height: 1px !important;
    background-color: #000000 !important;
}
.last_section{
width:100%;
}
.last_section_container h4{
width:50%;
border-bottom:1px solid #000000;
}
.weight_history1{
margin-left:58px;
}
.weight_history2{
margin-left:22px;
}
.net_balance{
padding-right:61px !important;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="barcode">
<img src="assets/images/barcode.png" width="100px" height="100px">
</div>
<div class="pet_image">
<img src='. $this->crud_model->get_image_url('patient' , $data[0]['patient_id']) .' width="100px" height="100px">
</div>
<h4 class="text-center">We Treat Your Pet Like Family</h4>
<hr>
    
    
    
<div class=\'invoice_details\'>
<div style=\'float: right !IMPORTANT;\'>
    
<p>Creation Date:<span class=\'two\'>'. $data[0]['creation_timestamp'] .'</span></p>
<p>Invoice Number:<span class=\'four\'>'. $data[0]['invoice_number'] .'</span></p>
</div>
</div>
    
<table>
<tr>
<th>Date</th>
<th>For</th>
    
<th>Qty</th>
    
<th>Price</th>
<th>Discount</th>
<th>Net Price</th>
</tr>
<tr>
<td>16/09/2016</td>
<td>'. $data[0]['name']. '</td>
<td>'. $data[0]['quantity']. '</td>
    
<td>'. $data[0]['price']. '</td>
<td></td>
<td>'. $data[0]['quantity']* $data[0]['price'] . '</td>
    
    
</tr>
    
    
</table>
<table class="tbl_two">
<tr>

<th></th>
<th></th>
<th>Net Balance</th>
</tr>
<tr>

<td></td>
<td></td>
<td class="net_balance">'. $data[0]['quantity']* $data[0]['price'] . '</td>
</tr>
</table>
   
    
    
</div>
</div>
</body>
</html>';
    
    			$this->load->library('pdf');
    			$pdf = $this->pdf->load();
    
    
    			$pdf->WriteHTML($html); // write the HTML into the PDF
    			$pdf->Output('sale_report.pdf', 'F'); // save to file because we can
    			//        redirect(site_url('test.pdf'));
    			// load download helder
    			$this->load->helper('download');
    			// read file contents
    			$data = file_get_contents('sale_report.pdf');
    			force_download('sale_report.pdf', $data);
    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    
    	}
    
    }
    
    function medical_health_record($task = "", $id = "") {
    	if ($this->session->userdata('patient_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	$data['page_name'] = 'medical_health_record';
    	$data['page_title'] = get_phrase('medical_health_record');
    	$this->load->view('backend/index', $data);
    }
    function report($task = "", $report_id = "") {
    	if ($this->session->userdata('patient_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    
    	$data['page_name'] = 'manage_report';
    	$data['page_title'] = get_phrase('report');
    	$this->load->view('backend/index', $data);
    }

    function doctor($task = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'show_doctor';
        $data['page_title'] = get_phrase('doctor');
        $this->load->view('backend/index', $data);
    }

    function blood_bank($task = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name'] = 'show_blood_bank';
        $data['page_title'] = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }

    function admit_history($task = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'show_admit_history';
        $data['page_title'] = get_phrase('admit_history');
        $this->load->view('backend/index', $data);
    }

    function operation_history($task = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'show_operation_history';
        $data['page_title'] = get_phrase('operation_history');
        $this->load->view('backend/index', $data);
    }

    function profile($task = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $patient_id = $this->session->userdata('login_user_id');
        if ($task == "update") {
                $this->crud_model->update_patient_profile_info($patient_id);
                $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
                redirect(base_url() . 'index.php?patient/profile');
        }

        if ($task == "change_password") {
            $password = $this->db->get_where('patient', array('patient_id' => $patient_id))->row()->password;
            $old_password = base64_encode($this->input->post('old_password'));
            $new_password = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');

            if ($password == $old_password && $new_password == $confirm_new_password) {
                $data['password'] = base64_encode($new_password);

                $this->db->where('patient_id', $patient_id);
                $this->db->update('patient', $data);

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?patient/profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?patient/profile');
            }
        }

        $data['page_name'] = 'edit_profile';
        $data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }

    function appointment($task = "", $appointment_id = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['appointment_info'] = $this->crud_model->select_appointment_info_by_patient_id();
        $data['page_name'] = 'show_appointment';
        $data['page_title'] = get_phrase('appointment');
        $this->load->view('backend/index', $data);
    }
    
    

    function appointment_pending($task = "", $appointment_id = "") {
        $tbl_name = "appointment";
        $login_user_id =  $this->session->userdata('login_user_id');
        $login_type =  $this->session->userdata('login_type');
        
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
        	if (!empty($_POST["user_id"])) {
        		$this->crud_model->save_requested_appointment_info();
        		$this->session->set_flashdata('message', get_phrase('request_for_appointment_sent'));
        		redirect(base_url() . 'index.php?patient/appointment_pending');
        	}else{
        		$this->crud_model->save_requested_appointment_info();
        		$this->session->set_flashdata('message', get_phrase('request_for_appointment_sent'));
        		redirect(base_url() . 'index.php?patient/appointment_pending');
        	}
        }

        $data['pending_appointment_info'] = $this->crud_model->select_pending_appointment_info_by_patient_id();
        $data['page_name'] = 'show_pending_appointment';
        $data['page_title'] = get_phrase('pending_appointment');
        $this->load->view('backend/index', $data);
    }

    function prescription($task = "", $prescription_id = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
if ($task == "download") {
        	$query = $this->db->get('prescription');
        	$this->db->select('prescription.timestamp,prescription.prescription_id precreption_id,p.name,p.age,p.sex,d.name doctor_name,pp.dose,pp.quantity,m.name  medicine_name');
        	$this->db->from('prescription');
        	$this->db->join('patient p', 'p.patient_id = prescription.patient_id', 'left');
        	$this->db->join('doctor d', 'd.doctor_id = prescription.doctor_id', 'left');
        	$this->db->join('product_prescreption pp', 'pp.precreption_id = prescription.prescription_id', 'left');
        	$this->db->join('medicine m', 'm.medicine_id = pp.medicine_id', 'left');
        	$this->db->where('prescription.prescription_id', $prescription_id);
        	$query = $this->db->get();
        	if($query->num_rows() != 0)
        	{
        		$data = $query->result_array();
        		$html = '<table border="1">
	    					<tbody>
	    				        <tr>
    								<th>Product Name</th>
    				                <th>Days</th>
    				                <th>Quantity</th>
    				                <th>Doctor Name</th>
    				                <th>Pet Name</th>
    				                <th>Date</th>
    				                <th>Time</th>
    			</tr>';
        		 
        		for($x=0;$x<count($data);$x++){
        		
        			 
        		
        			$html .=
        			'<tr>
			    					<td>'. 	$data[$x]['medicine_name'] .'</td>
			    					<td>'. 	$data[$x]['dose'] .'</td>
			    					<td>'. 	$data[$x]['quantity'] .'</td>
			    					<td>'. 	$data[$x]['doctor_name'] .'</td>
			    					<td>'. 	$data[$x]['name'] .'</td>
			    					<td>'.  date("D, d M Y", $data[$x]['timestamp']) .'</td>
			    					<td>'.  date("H:i", $data[$x]['timestamp']) .'</td>
			    				</tr>';
        		
        		
        		
        		}
        		$html .='</tbody>
    					</table>';
        		
        		ini_set('memory_limit', '512M');
        		$this->load->library('pdf');
        		 
        		$pdf = $this->pdf->load();
        		 
        		$pdf->WriteHTML($html); // write the HTML into the PDF
        		$pdf->Output('prescreption_report.pdf', 'F'); // save to file because we can
        		$this->load->helper('download');
        		$data = file_get_contents('prescreption_report.pdf');
        		ob_clean();
        		force_download('prescreption_report.pdf', $data);
        	
        		return $query->result_array();
        	}
        	else
        	{
        		return false;
        	}
        }

        $data['prescription_info'] = $this->crud_model->select_prescription_info_by_patient_id();
        $data['page_name'] = 'show_all_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }

    function invoice($task = "", $invoice_id = "") {
        if ($this->session->userdata('patient_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['invoice_info'] = $this->crud_model->select_invoice_info_by_patient_id();
        $data['page_name'] = 'show_all_invoice';
        $data['page_title'] = get_phrase('invoice');
        $this->load->view('backend/index', $data);
    }

    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('patient_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?patient/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?patient/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name'] = 'message';
        $page_data['page_title'] = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

}
