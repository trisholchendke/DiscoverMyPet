<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pet_Relocation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function index() {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'dashboard';
        $data['page_title'] = get_phrase('pet_relocation_dashboard');
        $this->load->view('backend/index', $data);
    }
    function download_report($task = "",$patient_id = "") {
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	if($task == "birth"){
    		$query = $this->db->get('report');
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.blood_group,p.patient_id,p.color,p.name,p.birth_date,p.sex,p.address,p.breed,r.timestamp operation_date,r.timestamp birth_date1,r.parent_name');
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
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.patient_id,p.blood_group,p.color,p.name,p.birth_date,p.sex,p.address,p.breed,r.timestamp operation_date,r.parent_name');
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
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.patient_id,p.blood_group,p.color,p.age,p.phone,p.name,p.birth_date,p.sex,p.address,p.breed,r.timestamp death_date,r.death_location,r.death_reason,r.parent_name');
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
<th>old Balance</th>
<th>Charges</th>
<th>Tax</th>
<th>Payments</th>
<th></th>
<th></th>
<th>Net Balance</th>
</tr>
<tr>
<td>0.00</td>
<td>0.00</td>
<td>*0.00</td>
<td>0.00</td>
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
	    	$login_user_id =  $this->session->userdata('login_user_id');
	    	$doctor_id =  $this->session->userdata('doctor_id');
	    	$login_type =  $this->session->userdata('login_type');
	    	$tbl_name = "health_record";
	    	
	    	if ($this->session->userdata('pet_relocation_login') != 1) {
	    		$this->session->set_userdata('last_page', current_url());
	    		redirect(base_url(), 'refresh');
	    	}
	    	
	    	if ($task == "create") {
	    	$config = array(
                'upload_path' => 'uploads/health_record/',
                'max_size' => 1024 * 100,
                'allowed_types' => 'gif|jpeg|jpg|png|pdf',
                'overwrite' => true,
                'remove_spaces' => true);
            $images = array();
            $this->load->library('upload');

            $files = $_FILES;
            $count = count($_FILES['health_record']['name']);
            $current_timestamp = time();


            for ($i = 0; $i < $count; $i++) {

                $_FILES['health_record']['name'] = $files['health_record']['name'][$i];
                $_FILES['health_record']['type'] = $files['health_record']['type'][$i];
                $_FILES['health_record']['tmp_name'] = $files['health_record']['tmp_name'][$i];
                $_FILES['health_record']['error'] = $files['health_record']['error'][$i];
                $_FILES['health_record']['size'] = $files['health_record']['size'][$i];

                $fileName = 'file' . '_' . $_FILES['health_record']['name'];
                $filetype = $_FILES['health_record']['type'];
                $images[] = $fileName;
                $config['file_name'] = $fileName;

                $this->upload->initialize($config);
                $this->upload->do_upload();
                if ($this->upload->do_upload('health_record')) {
                    $return['data'][] = $this->upload->data();
                    $return['status'] = "success";
                    $health_record = array(
	    				"patient_id" => $this->input->post('selected_patient'),
	    				"health_record" => $fileName,
	    				"file_type" => $filetype,
	    				"user_id" => $login_user_id,
	    				"doctor_id" => $doctor_id,
    				);
    			$this->crud_model->insert($tbl_name,$health_record,$login_user_id,$login_type);
                    
                } else {
                    $return['status'] = 'danger';
                    
                }

            }
            $this->session->set_flashdata('message', get_phrase('health_record_created_sucessfully'));
            redirect('pet_relocation/medical_health_record');
	    		
	    	}
	    	
	    	if ($task == "update") {
	    		$this->crud_model->update_health_record();
	    		$this->session->set_flashdata('message', get_phrase('health_record_update_sucessfully'));
	    	}
	    
	    	if ($task == "delete")
	    	{
	    		$this->crud_model->delete_health_record($id);
	    		$this->session->set_flashdata('message', get_phrase('health_record_deleted_sucessfully'));
	    		redirect('pet_relocation/medical_health_record');
	    	}
	    
	    	$data['user'] = $this->crud_model->select_user_info();
	    	$data['page_name'] = 'medical_health_record';
	    	$data['page_title'] = get_phrase('medical_health_record');
	    	$this->load->view('backend/index', $data);
	    }
    
 function supplier($task = "", $user_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	$tbl_name = 'supplier';
    	if ($task == "create") {
    		$data = array(
    				"name" => $this->input->post('name'),
    				"email" => $this->input->post('email'),
    				"phone" => $this->input->post('phone'),
    				"address" => $this->input->post('address'),
    				"user_id" => $login_user_id,
    				"doctor_id" => $doctor_id,
    				"role" => $login_type,
    		);
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message', get_phrase('new_supplier_created_sucessfully'));
    		redirect('pet_relocation/supplier');
    	}
    	if ($task == "update") {
    		$data = array(
    				"name" => $this->input->post('name'),
    				"email" => $this->input->post('email'),
    				"phone" => $this->input->post('phone'),
    				"address" => $this->input->post('address'),
    		);
    		$this->crud_model->update($tbl_name,$data,$this->input->post('id'));
    		$this->session->set_flashdata('message', get_phrase('supplier_updated_sucessfully'));
    		redirect('pet_relocation/supplier');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_user($user_id);
    		redirect('pet_relocation/supplier');
    	}
    
    	$data['user'] = $this->crud_model->select_supplier_info();
    	
    	$data['page_name'] = 'supplier';
    	$data['page_title'] = get_phrase('supplier');
    	$this->load->view('backend/index', $data);
    }
    
    function get_medicine_subcategory() {
    	$tbl_name = 'medicine_sub_category';
    	$data = $this->crud_model->get_medicine_sub_category($tbl_name,$this->input->post('medicine_category_id'));
    	if($data != FALSE){
    		return $this->output
    		->set_output(json_encode(array(
    				'status' => '200',
    				"data"  => $data,
    				'message' => 'data retrived sucessfully',
    		)));
    	}else{
    		$this->session->set_flashdata('message', get_phrase('no_medicine_sub_category_found'));
    	}
    }
    
 function manage_staff($task = "", $user_id = "") {
    if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	if ($task == "update") {
    		$this->crud_model->update_user($user_id);
    		$this->session->set_flashdata('message', get_phrase('staff_info_updated_successfuly'));
    		redirect('pet_relocation/manage_staff');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_user($user_id);
    		$this->session->set_flashdata('message', get_phrase('staff_deleted_successfuly'));
    		redirect('pet_relocation/manage_staff');
    	}
    
    	$data['user'] = $this->crud_model->select_user_info();
    	$data['page_name'] = 'manage_staff';
    	$data['page_title'] = get_phrase('manage_staff');
    	$this->load->view('backend/index', $data);
    }
    
    function add_staff($task = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "users";
    	
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create") {
    		$tbl_users = $this->db->get_where('users', array('email' => $this->input->post('email')))->result_array();
    		$tbl_doctor = $this->db->get_where('doctor', array('email' => $this->input->post('email')))->result_array();
    		$tbl_receptionist = $this->db->get_where('receptionist', array('email' => $this->input->post('email')))->result_array();
    		$tbl_pharmacist = $this->db->get_where('pharmacist', array('email' => $this->input->post('email')))->result_array();
    		$tbl_nurse = $this->db->get_where('nurse', array('email' => $this->input->post('email')))->result_array();
    		$tbl_laboratorist = $this->db->get_where('laboratorist', array('email' => $this->input->post('email')))->result_array();
    		$tbl_blood_donor = $this->db->get_where('blood_donor', array('email' => $this->input->post('email')))->result_array();
    		$tbl_admin = $this->db->get_where('admin', array('email' => $this->input->post('email')))->result_array();
    		$tbl_accountant = $this->db->get_where('accountant', array('email' => $this->input->post('email')))->result_array();
    		if($tbl_users != FALSE || $tbl_doctor != FALSE || $tbl_receptionist != FALSE || $tbl_pharmacist != FALSE  || $tbl_nurse != FALSE ||  $tbl_laboratorist != FALSE ||  $tbl_blood_donor != FALSE ||  $tbl_admin != FALSE ||  $tbl_accountant != FALSE){
    			$this->session->set_flashdata('message', get_phrase('staff_is_already_present'));
    		}else{
    			 
    			 
    			$data['doctor_id']              = $doctor_id;
    			$data['user_id']              = $login_user_id;
    			$data['name']              = $this->input->post('name');
    			$data['email']     = $this->input->post('email');
    			$data['password']         = base64_encode($this->input->post('password'));
    			$data['address'] = $this->input->post('address');
    			$data['phone']      = $this->input->post('phone');
    			$data['role']      = $this->input->post('role');
    		
    			$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    			$this->session->set_flashdata('message', get_phrase('new_staff_created_sucessfully'));
    			redirect('pet_relocation/manage_staff');
    		}
    	}
    
    	$data['page_name'] = 'add_staff';
    	$data['page_title'] = get_phrase('add_staff');
    	$this->load->view('backend/index', $data);
    }
    
function invoice_add($task = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "users";
    	
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	$tbl_name = "invoice";
    
    	if ($task == "create") {
    		$data = $this->crud_model->check_avilabiltiy_of_product($this->input->post());
    		if($data == FALSE){
    			$this->session->set_flashdata('message', get_phrase('medicine_not_avilable_in Stock'));
    		}else{
    			$data = array(
    					"title" => $this->input->post('title'),
    					"invoice_number" => $this->input->post('invoice_number'),
    					"fees" => $this->input->post('fees'),
    					"patient_id" => $this->input->post('patient_id'),
    					"creation_timestamp" => $this->input->post('creation_timestamp'),
    					"due_timestamp" => $this->input->post('due_timestamp'),
    					"status" => $this->input->post('status'),
    					"doctor_id" => $doctor_id,
    					"user_id" => $login_user_id,
    			);
    			
    			$data = $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    			$data1 = $this->crud_model->get_entry($tbl_name,$this->input->post('invoice_number'));
    			for($i=0; $i<sizeof($this->input->post('quantity'));$i++){
    				$quantity = $this->input->post('quantity');
    				$price = $this->input->post('price');
    				$medicine_id = $this->input->post('medicine_id');
    				$invoice_medicine = array(
    						"invoice_id" => $data1[0]['invoice_id'],
    						"quantity" => $quantity[$i],
    						"price" => $price[$i],
    						"medicine_id" => $medicine_id[$i],
    						"medicine_id" => $medicine_id[$i],
    						"doctor_id" => $doctor_id,
    						"user_id" => $login_user_id,
    				);
    			
    				$query = $this->crud_model->insert('invoice_medicine',$invoice_medicine,$login_user_id,$login_type);
    				if ($query !== FALSE)
    				{
    				
    					$this->db->set('quantity','`quantity` - '. $quantity[$i], FALSE); //value that used to update column
    					$this->db->where('medicine_id', $medicine_id[$i]); //which row want to upgrade
    					$this->db->update('medicine');
    					$this->session->set_flashdata('message', get_phrase('invoice_info_saved_successfuly'));
    					redirect('pet_relocation/invoice_manage');
    				}
    				else
    				{
    					echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message();
    				}
    			
    			}
    			
    			
    		}
    		
    	}
    
    	$data['page_name'] = 'add_invoice';
    	$data['page_title'] = get_phrase('invoice');
    	$this->load->view('backend/index', $data);
    }
    
    function invoice_manage($task = "", $invoice_id = "") {
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "update") {
    		$data = $this->crud_model->check_avilabiltiy_of_product($this->input->post());
    		if($data == FALSE){
    			$this->session->set_flashdata('message', get_phrase('medicine_not_avilable_in Stock'));
    		}else{
	    		$this->crud_model->update_invoice($invoice_id);
	    		redirect('pet_relocation/invoice_manage');
    		}
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_invoice($invoice_id);
    		redirect('pet_relocation/invoice_manage');
    	}
    	if ($task == "get_all_medicine") {
    		$login_type =  $this->session->userdata('login_type');
    		$data = $this->crud_model->select_medicine_info($login_type);
    		if($data == TRUE){
    			return $this->output
    			->set_output(json_encode(array(
    					'status' => '200',
    					'data' => $data,
    					'message' => 'all data retrived sucessfully',
    			)));
    		}else{
    			return $this->output
    			->set_output(json_encode(array(
    					'status' => '404',
    					'message' => 'data not retrived',
    			)));
    		}
    	}
    
    	$data['invoice_info'] = $this->crud_model->select_invoice_info();
    	$data['page_name'] = 'manage_invoice';
    	$data['page_title'] = get_phrase('invoice');
    	$this->load->view('backend/index', $data);
    }
    
    function receptionist($task = "", $receptionist_id = "") {
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create") {
    		$email = $_POST['email'];
    		$receptionist = $this->db->get_where('receptionist', array('email' => $email))->row()->name;
    		if ($receptionist == null) {
    			$this->crud_model->save_receptionist_info();
    			$this->session->set_flashdata('message', get_phrase('receptionist_info_saved_successfuly'));
    		} else {
    			$this->session->set_flashdata('message', get_phrase('duplicate_email'));
    		}
    		redirect(base_url() . 'index.php?pet_relocation/receptionist');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_receptionist_info($receptionist_id);
    		$this->session->set_flashdata('message', get_phrase('receptionist_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?pet_relocation/receptionist');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_receptionist_info($receptionist_id);
    		redirect(base_url() . 'index.php?pet_relocation/receptionist');
    	}
    
    	$data['receptionist_info'] = $this->crud_model->select_receptionist_info();
    	$data['page_name'] = 'manage_receptionist';
    	$data['page_title'] = get_phrase('receptionist');
    	$this->load->view('backend/index', $data);
    }
    
    
function medicine_category($task = "", $medicine_category_id = "")
    {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('pet_relocation_login') != 1)
    	{
    		$this->session->set_userdata('last_page' , current_url());
    		redirect(base_url(), 'refresh');
    	}
    	
    	$tbl_name = "medicine_category";
    	
    	if ($task == "create")
    	{
    		$data['name'] 		= $this->input->post('name');
        	$data['doctor_id']    = $doctor_id;
        	$data['user_id']    = $login_user_id;
        
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message' , get_phrase('medicine_category_info_saved_successfuly'));
    		redirect(base_url() .  'index.php?pet_relocation/medicine_category');
    	}
    
    	if ($task == "update")
    	{
    		$this->crud_model->update_medicine_category_info($medicine_category_id);
    		$this->session->set_flashdata('message' , get_phrase('medicine_category_info_updated_successfuly'));
    		redirect(base_url() .  'index.php?pet_relocation/medicine_category');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_medicine_category_info($medicine_category_id);
    		redirect(base_url() .  'index.php?pet_relocation/medicine_category');
    	}
    
    	$data['page_name']              = 'manage_medicine_category';
    	$data['page_title']             = get_phrase('main_category');
    	$this->load->view('backend/index', $data);
    }
    
function medicine_sub_category($task = "", $medicine_sub_category_id = "")
    {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	$tbl_name = "medicine_sub_category";
    	if ($this->session->userdata('pet_relocation_login') != 1)
    	{
    		$this->session->set_userdata('last_page' , current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create")
    	{
    		$data['medicine_category_id'] 		= $this->input->post('medicine_category_id');
    		$data['name'] 		= $this->input->post('name');
    		$data['user_id']    = $login_user_id;
    		$data['doctor_id']    = $doctor_id;
    		
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message' , get_phrase('medicine_sub_category_info_saved_successfuly'));
    		redirect(base_url() .  'index.php?pet_relocation/medicine_sub_category');
    	}
    
    	if ($task == "update")
    	{
    		$this->crud_model->update_medicine_sub_category_info($medicine_sub_category_id);
    		$this->session->set_flashdata('message' , get_phrase('medicine_sub_category_info_updated_successfuly'));
    		redirect(base_url() .  'index.php?pet_relocation/medicine_sub_category');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_medicine_sub_category_info($medicine_sub_category_id);
    		redirect(base_url() .  'index.php?pet_relocation/medicine_sub_category');
    	}
    
    	$data['page_name']              = 'manage_medicine_sub_category';
    	$data['page_title']             = get_phrase('sub_category');
    	$this->load->view('backend/index', $data);
    }
    
    
    function stock($task = "", $medicine_id = "")
    {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('pet_relocation_login') != 1)
    	{
    		$this->session->set_userdata('last_page' , current_url());
    		redirect(base_url(), 'refresh');
    	}
    		$tbl_name = 'medicine';
    
    	if ($task == "create")
    	{
    		$data = array(
    				"name" => $this->input->post('name'),
    				"medicine_category_id" => $this->input->post('medicine_category_id'),
    				"medicine_sub_category_id" => $this->input->post('medicine_sub_category_id'),
    				"description" => $this->input->post('description'),
    				"quantity" => $this->input->post('quantity'),
    				"price" => $this->input->post('price'),
    				"manufacturing_company" => $this->input->post('manufacturing_company'),
    				"supplier_id" => $this->input->post('supplier_id'),
    				"user_id" => $login_user_id,
    				"doctor_id" => $doctor_id,
    		);
    		
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message', get_phrase('new_medicine_created_sucessfully'));
    		redirect('pet_relocation/stock');
    	}
    
    	if ($task == "update")
    	{
    		$this->crud_model->update_medicine_info($medicine_id);
    		$this->session->set_flashdata('message', get_phrase('medicine_updated_sucessfully'));
    		redirect('pet_relocation/stock');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_medicine_info($medicine_id);
    		redirect(base_url() .'index.php?pet_relocation/stock');
    	}
    
    	$data['page_name']      = 'manage_medicine';
    	$data['page_title']     = get_phrase('stock');
    	$this->load->view('backend/index', $data);
    }
    

function patient($task = "", $patient_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	 
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	
    	$tbl_name = 'patient';
	    	if ($task == "create") {
	    		
	    		$data['name'] 		= $this->input->post('name');
	    		$data['email'] 		= $this->input->post('email');
	    		$data['password']       = base64_encode($this->input->post('password'));
	    		$data['address'] 	= $this->input->post('address');
	    		$data['phone']          = $this->input->post('phone');
	    		$data['sex']            = $this->input->post('sex');
	    		$data['birth_date']     = strtotime($this->input->post('birth_date'));
				$data['species']     = $this->input->post('species');
				$data['breed']     = $this->input->post('breed');
				$data['grooming_package']     = $this->input->post('grooming_package');
				$data['sterilization_status']     = $this->input->post('sterilization_status');
				$data['color']     = $this->input->post('color');
	    		$data['age']            = $this->input->post('age');
	    		$data['blood_group'] 	= $this->input->post('blood_group');
	    		$data['owner_email'] 	= $this->input->post('owner_email');
	    		$data['owner_address'] 	= $this->input->post('owner_address');
	    		$data['owner_contact_no'] 	= $this->input->post('owner_contact_no');
	    		$data['owner_name'] 	= $this->input->post('owner_name');
	    		$data['doctor_id'] 	= $doctor_id;
	    		$data['user_id'] 	= $login_user_id;
	    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
	    		$patient_id  =   $this->db->insert_id();
	    		move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');
	    		$this->session->set_flashdata('message', get_phrase('new_patient_created_sucessfully'));
	    		 redirect(base_url() . 'index.php?pet_relocation/patient');
	    	}
	    	
	    	if ($task == "update") {
	    		$data['name'] 		= $this->input->post('name');
		        $data['email'] 		= $this->input->post('email');
		        $data['address'] 	= $this->input->post('address');
		        $data['phone']          = $this->input->post('phone');
		        $data['sex']            = $this->input->post('sex');
		        $data['birth_date']     = strtotime($this->input->post('birth_date'));
		        $data['age']            = $this->input->post('age');
		        $data['blood_group'] 	= $this->input->post('blood_group');
				$data['breed']     = $this->input->post('breed');
				$data['species']     = $this->input->post('species');
				$data['grooming_package']     = $this->input->post('grooming_package');
				$data['sterilization_status']     = $this->input->post('sterilization_status');
				$data['color']     = $this->input->post('color');
				$data['owner_email'] 	= $this->input->post('owner_email');
				$data['owner_address'] 	= $this->input->post('owner_address');
				$data['owner_contact_no'] 	= $this->input->post('owner_contact_no');
				$data['owner_name'] 	= $this->input->post('owner_name');
        
       			 move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');
       			 
	    		$this->crud_model->update_patient_info($tbl_name,$data,$patient_id);
	    		$this->session->set_flashdata('message', get_phrase('patient_info_updated_sucessfully'));
	    		redirect('pet_relocation/patient');
	    	}
	    	
	    	
	    	if ($task == "delete") {
	    		$this->crud_model->delete_user($user_id);
	    		redirect('pet_relocation/patient');
	    	}
	
	        $data['$patient_info'] = $this->crud_model->select_patient_info_by_doctor_id();
	        $data['page_name'] = 'manage_patient';
	        $data['page_title'] = get_phrase('pet');
	        $this->load->view('backend/index', $data);
    }

    function medication_history($param1 = "", $prescription_id = "") {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $patient_name = $this->db->get_where('patient', array('patient_id' => $param1))->row()->name; // $param1 = $patient_id
        $data['prescription_info'] = $this->crud_model->select_medication_history($param1); // $param1 = $patient_id
        $data['menu_check'] = 'from_patient';
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('medication_history_of_:_') . $patient_name;
        $this->load->view('backend/index', $data);
    }

    function bed_allotment($task = "", $bed_allotment_id = "") {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_bed_allotment_info();
            $this->session->set_flashdata('message', get_phrase('bed_allotment_info_saved_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/bed_allotment');
        }

        if ($task == "update") {
            $this->crud_model->update_bed_allotment_info($bed_allotment_id);
            $this->session->set_flashdata('message', get_phrase('bed_allotment_info_updated_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/bed_allotment');
        }

        if ($task == "delete") {
            $this->crud_model->delete_bed_allotment_info($bed_allotment_id);
            redirect(base_url() . 'index.php?pet_relocation/bed_allotment');
        }

        $data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
        $data['page_name'] = 'manage_bed_allotment';
        $data['page_title'] = get_phrase('bed_allotment');
        $this->load->view('backend/index', $data);
    }

    function blood_bank($task = "", $blood_bank_id = "") {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name'] = 'show_blood_bank';
        $data['page_title'] = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }

    function report($task = "", $report_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "report";
    	
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
        	
        	$data['type'] 		= $this->input->post('type');
        	$data['description']    = $this->input->post('description');
        	$data['timestamp']      = strtotime($this->input->post('timestamp'));
        	$data['patient_id']     = $this->input->post('patient_id');
        	$data['parent_name']     = $this->input->post('parent_name');
        	$data['user_id']     = $login_user_id;
        	$data['doctor_id']     = $doctor_id;
        	if(isset($_POST['death_location']) && isset($_POST['death_location'])){
        		$data['death_location']     = $this->input->post('death_location');
        		$data['death_reason']     = $this->input->post('death_reason');
        	}
        	
        	
        	
        	$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
            $this->session->set_flashdata('message', get_phrase('report_info_saved_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/report');
        }

        if ($task == "update") {
            $this->crud_model->update_report_info($report_id);
            $this->session->set_flashdata('message', get_phrase('report_info_updated_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/report');
        }

        if ($task == "delete") {
            $this->crud_model->delete_report_info($report_id);
            redirect(base_url() . 'index.php?pet_relocation/report');
        }

        $data['page_name'] = 'manage_report';
        $data['page_title'] = get_phrase('report');
        $this->load->view('backend/index', $data);
    }

    function profile($task = "") {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
		$tbl_name = "users";
        $pet_relocation_id = $this->session->userdata('login_user_id');
        if ($task == "update") {
        		if(isset($_POST['name'])){
        			$data['name'] = $this->input->post('name');
        			$this->crud_model->update($tbl_name,$data,$pet_relocation_id);
        		}
        		if(isset($_POST['email'])){
        			$data['email'] = $this->input->post('email');
        			$this->crud_model->update($tbl_name,$data,$pet_relocation_id);
        		}
        		if(isset($_POST['address'])){
        			$data['address'] = $this->input->post('address');
        			$this->crud_model->update($tbl_name,$data,$pet_relocation_id);
        		}
        		if(isset($_POST['phone'])){
        			$data['phone'] = $this->input->post('phone');
        			$this->crud_model->update($tbl_name,$data,$pet_relocation_id);
        		}
                 $this->session->set_flashdata('message', get_phrase('profile_info_update_sucessfully'));
                redirect(base_url() . 'index.php?pet_relocation/profile');
        }

        if ($task == "change_password") {
            $password = $this->db->get_where('users', array('id' => $pet_relocation_id))->row()->password;
            $old_password = base64_encode($this->input->post('old_password'));
            $new_password = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');

            if ($password == $old_password && $new_password == $confirm_new_password) {
                $data['password'] = base64_encode($new_password);
                $this->db->where('id', $pet_relocation_id);
                $this->db->update('users', $data);

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?pet_relocation/profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?pet_relocation/profile');
            }
        }

        $data['page_name'] = 'edit_profile';
        $data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }

    
function appointment($task = "", $appointment_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');;
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name =  'appointment';
    	
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
         	$data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        	$data['status']     = 'approved';
        	$data['patient_id'] = $this->input->post('patient_id');
        	$data['doctor_id'] = $doctor_id;
        	$data['user_id'] = $login_user_id;
        	$data['bording_number'] = $this->input->post('bording_number');
        	$data['appointment_type'] = $this->input->post('appointment_type');
        	
            $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
        
	        $notify = $this->input->post('notify');
	        if($notify != '') {
	            $patient_name   =   $this->db->get_where('patient',
	                                array('patient_id' => $data['patient_id']))->row()->name;
	            $doctor_name    =   $this->db->get_where('doctor',
	                                array('doctor_id' => $data['doctor_id']))->row()->name;
	            $date           =   date('l, d F Y', $data['timestamp']);
	            $time           =   date('g:i a', $data['timestamp']);
	            $message        =   $patient_name . ', you have an appointment with doctor ' . $doctor_name . ' on ' . $date . ' at ' . $time . '.';
	            $receiver_phone =   $this->db->get_where('patient',
	            array('patient_id' => $data['patient_id']))->row()->phone;
	            $receiver_email =   $this->db->get_where('patient',
	            		array('patient_id' => $data['patient_id']))->row()->email;
	            
	            $this->sms_model->send_sms($message, $receiver_phone);
	            $this->email_model->sendmail($message,$receiver_email);
	        }
	        
            $this->session->set_flashdata('message', get_phrase('appointment_info_saved_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/appointment');
        }

        if ($task == "update") {
            $this->crud_model->update_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_updated_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/appointment');
        }

        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(base_url() . 'index.php?pet_relocation/appointment');
        }
        
       $data['notice_info'] = $this->crud_model->select_notice_info();
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('appointment');
        $this->load->view('backend/index', $data);
    }
    
 function appointment_requested($task = "", $appointment_id = "") {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "approve") {
            $this->crud_model->approve_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_approved'));
            redirect(base_url() . 'index.php?pet_relocation/appointment_requested');
        }

        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(base_url() . 'index.php?pet_relocation/appointment_requested');
        }

        $data['requested_appointment_info'] = $this->crud_model->select_requested_appointment_info_by_doctor_id();
        $data['page_name'] = 'manage_requested_appointment';
        $data['page_title'] = get_phrase('requested_appointment');
        $this->load->view('backend/index', $data);
    }

    function prescription($task = "", $prescription_id = "", $menu_check = '', $patient_id = '') {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_prescription_info();
            $this->session->set_flashdata('message', get_phrase('prescription_info_saved_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/prescription');
        }

        if ($task == "update") {
            $this->crud_model->update_prescription_info($prescription_id);
            $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
            if ($menu_check == 'from_prescription')
                redirect(base_url() . 'index.php?pet_relocation/prescription');
            else
                redirect(base_url() . 'index.php?pet_relocation/medication_history/' . $patient_id);
        }

        if ($task == "delete") {
            $this->crud_model->delete_prescription_info($prescription_id);
            if ($menu_check == 'from_prescription')
                redirect(base_url() . 'index.php?pet_relocation/prescription');
            else
                redirect(base_url() . 'index.php?pet_relocation/medication_history/' . $patient_id);
        }

        $data['prescription_info'] = $this->crud_model->select_prescription_info_by_doctor_id();
        $data['menu_check'] = 'from_prescription';
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }

    function diagnosis_report($task = "", $diagnosis_report_id = "") {
        if ($this->session->userdata('pet_relocation_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_diagnosis_report_info();
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_saved_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/prescription');
        }

        if ($task == "delete") {
            $this->crud_model->delete_diagnosis_report_info($diagnosis_report_id);
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_deleted_successfuly'));
            redirect(base_url() . 'index.php?pet_relocation/prescription');
        }
    }

    /* private messaging */

	function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('pet_relocation_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?pet_relocation/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?pet_relocation/message/message_read/' . $param2, 'refresh');
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
    function staff_message($param1 = 'message_home', $param2 = '', $param3 = '') {
    	if ($this->session->userdata('pet_relocation_login') != 1)
    		redirect(base_url(), 'refresh');
    
    		if ($param1 == 'send_new') {
    			if($this->input->post('selected_mail_option') == "All Staff"){
    				$message = $this->input->post('message');
    
    				$this->db->where("user_id", $this->session->userdata('login_user_id'));
    				$query = $this->db->get('users');
    				if($query->num_rows() != 0)
    				{
    					$data = $query->result_array();
    					for($i=0;$i<sizeof($data);$i++){
    						$email = $this->email_model->sendmail_to_staff($message,$data[$i]['email']);
    					}
    					 
    					if($email == TRUE){
    						$this->session->set_flashdata('message', get_phrase('email_send_sucessfully'));
    						redirect('/pet_relocation/staff_message', 'refresh');
    					}
    					return $query->result_array();
    				}
    				else
    				{
    					return false;
    				}
    
    
    			}else{
    				$reciever = $this->input->post('reciever');
    				$id=array();
    				for ($x = 0; $x <= count($this->input->post('reciever')); $x++) {
    					array_push($id,$reciever[$x]);
    					$message = $this->input->post('message');
    
    					$this->db->where_in("id",$id);
    					$query = $this->db->get('users');
    					if($query->num_rows() != 0)
    					{
    						$data = $query->result_array();
    						for ($x = 0; $x <= count($data); $x++) {
    							$email = $this->email_model->sendmail_to_staff($message,$data[$x]['email']);
    							 
    							if($email == TRUE){
    								$this->session->set_flashdata('message', get_phrase('email_send_sucessfully'));
    								redirect('/pet_relocation/staff_message', 'refresh');
    							}
    						}
    						return $query->result_array();
    					}
    					else
    					{
    						return false;
    					}
    				}
    
    
    			}
    			 
    		}
    
    		if ($param1 == 'send_reply') {
    			$this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
    			$this->session->set_flashdata('message', get_phrase('message_sent!'));
    			redirect(base_url() . 'index.php?pet_relocation/message/message_read/' . $param2, 'refresh');
    		}
    
    
    		if ($param1 == 'message_read') {
    			$page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
    			$this->crud_model->mark_thread_messages_read($param2);
    		}
    
    		$page_data['message_inner_page_name'] = $param1;
    		$page_data['page_name'] = 'staff_message';
    		$page_data['page_title'] = get_phrase('staff_messaging');
    		$this->load->view('backend/index', $page_data);
    }
    
    function blood_donor($task = "", $blood_donor_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');;
    	$doctor_id =  $this->session->userdata('doctor_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "blood_donor";
    	
    	if ($this->session->userdata('pet_relocation_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	
    
    	if ($task == "create") {
    		
    		$email = $_POST['email'];
    		$blood_donor = $this->db->get_where('blood_donor', array('email' => $email))->row()->name;
    		if ($blood_donor == null) {
    			
    			$data['name']                       = $this->input->post('name');
    			$data['email']                      = $this->input->post('email');
    			$data['address']                    = $this->input->post('address');
    			$data['phone']                      = $this->input->post('phone');
    			$data['sex']                        = $this->input->post('sex');
    			$data['age']                        = $this->input->post('age');
    			$data['blood_group']                = $this->input->post('blood_group');
    			$data['last_donation_timestamp']    = strtotime($this->input->post('last_donation_timestamp'));
    			$data['doctor_id']    = $doctor_id;
    			$data['user_id']    = $login_user_id;
    			
    			 
    			$data = $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    			
    			$this->session->set_flashdata('message', get_phrase('blood_donor_info_saved_successfuly'));
    			
    		} else {
    			$this->session->set_flashdata('message', get_phrase('duplicate_email'));
    		}
    		redirect(base_url() . 'index.php?pet_relocation/blood_donor');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_blood_donor_info($blood_donor_id);
    		$this->session->set_flashdata('message', get_phrase('blood_donor_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?pet_relocation/blood_donor');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_blood_donor_info($blood_donor_id);
    		redirect(base_url() . 'index.php?pet_relocation/blood_donor');
    	}
    
    	$data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
    	$data['page_name'] = 'manage_blood_donor';
    	$data['page_title'] = get_phrase('blood_donor');
    	$this->load->view('backend/index', $data);
    }

}
