<?php
ob_start();


ini_set('max_execution_time', 300);
set_time_limit(300);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('email_model');
         $this->load->model('sms_model');
    }
 
 	function index() {
       if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'dashboard';
        $data['page_title'] = get_phrase('doctor_dashboard');
        $this->load->view('backend/index', $data);
    }
    
function get_species_of_pet() {
        $this->db->select('species');
    	$this->db->from('patient');
    	$this->db->where('patient_id',$_POST['patient_id']);
    	$query = $this->db->get();
    	$data =  $query->result_array();
        return $this->output
    		->set_output(json_encode(array(
    				'status' => '200',
    				'data' => $data,
    		)));


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
 	
 	function get_medicine_data() {
 		$data = $this->crud_model->get_medicine_data();
 		$arr = $data;
 		
 		echo json_encode($arr);
 	}
 	
 	function manage_breed($task = "",$breed_id = "") {
 		$login_user_id =  $this->session->userdata('login_user_id');
 		$login_type =  $this->session->userdata('login_type');
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $tbl_name = "breed";
        if($task == "create"){
        	
        	$data['name'] 		= $this->input->post('breed');
        	$data['doctor_id'] 		= $login_user_id;
        	 
        	 
        	 
        	$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
        	$this->session->set_flashdata('message', get_phrase('breed_info_saved_successfuly'));
        	redirect(base_url() . 'index.php?doctor/manage_breed');
        }
        
        if($task == "update"){
        	
        	$data['name'] 		= $this->input->post('breed');
        	
        	$this->crud_model->update_breed_info($tbl_name,$data,$breed_id);
        	$this->session->set_flashdata('message', get_phrase('breed_info_updated_successfuly'));
        	redirect(base_url() . 'index.php?doctor/manage_breed');
        }
        
        
	
        $data['page_name'] = 'manage_breed';
        $data['page_title'] = get_phrase('manage_breed');
        $this->load->view('backend/index', $data);
    }
    
    
    function add_prescription() {
    	$data['page_name'] = 'add_prescription';
    	$data['page_title'] = get_phrase('add_prescription');
    	$this->load->view('backend/index', $data);
    }
    
    
    function stock_report($task = "") {
    	
    	$data['product'] = $this->crud_model->stock_report();
    	
    	
    	$data['page_name'] = 'stock_report';
    	$data['page_title'] = get_phrase('stock_report');
    	$this->load->view('backend/index',$data);
    	
    	
    	
    					
    	
    	if(isset($_POST['download'])){
    		
    		$html = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet /Welcome</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 30px;">
									<div style="text-align:center;margin-bottom:10px;">
									<img src="'. base_url() . 'assets/images/discovermypet_logo.png" width="100" height="100">
									</div>
									<h1 style="border-top: 1px solid #5D6975;border-bottom: 1px solid #5D6975;color: #5D6975;font-size: 2.4em;line-height: 1.4em;font-weight: normal;text-align: center;margin: 0 0 20px 0;background: url(dimension.png);">STOCK REPORT</h1>
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td>
				<table style="width:100%;">
				<tr>
					<td class="img" valign="top" style="padding: 10px;font-size:13px;width:100%;line-height:2; text-align:left;color:#000;">
						<table style="width:100%;border-spacing:0px !important;border-collapse:collapse;">
						<thead>
          <tr style="background: #F5F5F5;">
            <th style="width:150px;text-align:center;padding: 10px 10px;">PRODUCT NAME</th>
            <th style="width:150px;text-align:center;">MAIN CATEGORY</th>
            <th style="width:150px;text-align:center;">SUB CATEGORY</th>
             <th style="width:150px;text-align:center;">DESCRIPTION</th>
            <th style="text-align:center;">PRICE</th>            
            <th style="width:150px;text-align:center;">BRAND NAME</th>
            <th style="text-align:center;">SUPPLIER</th>
			<th style="text-align:center;width:125px;">QUANTITY</th>
          </tr>
        </thead><tbody>
						
    				';
    		 
    			$total = 0; 
    		for($x=0;$x<count($data['product']);$x++){
    			$total += $data['product'][$x]['quantity'];
    		
    			$html .= 
    			'

 <tr>
            <td style="padding: 10px 10px;text-align:center;">'.$data['product'][$x]['name'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $this->db->get_where('medicine_category' , array('medicine_category_id' => $data['product'][$x]['medicine_category_id'] ))->row()->name .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $this->db->get_where('medicine_sub_category' , array('id' => $data['product'][$x]['medicine_sub_category_id'] ))->row()->name .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $data['product'][$x]['description'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $data['product'][$x]['price'] .'</td>            
            <td style="padding: 10px 10px;text-align:center;">'. $data['product'][$x]['manufacturing_company'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $this->db->get_where('supplier' , array('id' => $data['product'][$x]['supplier_id'] ))->row()->name .'</td>
			<td style="padding: 10px 10px;text-align:center;">'.$data['product'][$x]['quantity'] .'</td>
          </tr>' ;
    		
    		
    		}
    		$html .='
         
		   
		  <tr>

            <td colspan="6"></td>
            <td style="padding: 10px 10px;text-align:center;"><span style="background: #f5f5f5;padding: 5px 20px;margin-top: 20px;display: inline-block;font-size: 15px;font-weight: 600;">TOTAL</span></td>
            <td style="padding: 10px 10px;text-align:center;"><span style="background: #f5f5f5;padding: 5px 20px;margin-top: 20px;display: inline-block;font-size: 15px;font-weight: 600;">'. $total .'</span></td>
			
            
          </tr>
		          </tbody>
						</table>
					</td>
					
				</tr>
				</table>
				</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>';
    		
    		ini_set('memory_limit', '512M');
    		$this->load->library('pdf');
    	
    		$pdf = $this->pdf->load();
    	
    		$pdf->WriteHTML($html); // write the HTML into the PDF
    		$pdf->Output('stock_report3.pdf', 'F'); // save to file because we can
    		$this->load->helper('download');
    		$data = file_get_contents('stock_report3.pdf');
    		ob_clean();
    		force_download('stock_report3.pdf', $data);
    	}
    	
    	
    }
    
    function invoice_report() {


    	
    	$data['product'] = $this->crud_model->stock_report();
    	
    	$data['page_name'] = 'invoice_report';
    	$data['page_title'] = get_phrase('sale_report');
    	$this->load->view('backend/index',$data);
    	
    	if(isset($_POST['download'])){
    		$html = '<table border="1">
	    					<tbody>
	    				        <tr>
    					        <th>Product Name</th>
    				                <th>Main Category</th>
    				                <th>Sub Category</th>
    				                <th>Description</th>
    				                <th>Price</th>
    				                <th>Quantity</th>
    				                <th>Brand Name</th>
    				                <th>Supplier</th>
    			</tr>';
    		 
    		for($x=0;$x<count($data['product']);$x++){
    	
    			 
    	
    			$html .=
    			'<tr>
			    					<td>'. 	$data['product'][$x]['name'] .'</td>
			    					<td>'.  $this->db->get_where('medicine_category' , array('medicine_category_id' => $data['product'][$x]['medicine_category_id'] ))->row()->name .'</td>
			    					<td>'.  $this->db->get_where('medicine_sub_category' , array('id' => $data['product'][$x]['medicine_sub_category_id'] ))->row()->name .'</td>
			    					<td>'. $data['product'][$x]['description'] .'</td>
			    					<td>'. $data['product'][$x]['price'] .'</td>
			    					<td>'.$data['product'][$x]['quantity'] .'</td>
			    					<td>'. $data['product'][$x]['manufacturing_company'] .'</td>
			    					<td>'. $this->db->get_where('supplier' , array('id' => $data['product'][$x]['supplier_id'] ))->row()->name .'</td>
			    				</tr>';
    	
    	
    	
    		}
    		$html .='</tbody>
    					</table>';
    	
    		ini_set('memory_limit', '512M');
    		$this->load->library('pdf');
    		 
    		$pdf = $this->pdf->load();
    		 
    		$pdf->WriteHTML($html); // write the HTML into the PDF
    		$pdf->Output('stock_report3.pdf', 'F'); // save to file because we can
    		$this->load->helper('download');
    		$data = file_get_contents('stock_report3.pdf');
    		ob_clean();
    		force_download('stock_report3.pdf', $data);
    	}
    }
    
    function get_notification() {
    	if($this->input->post('pet_unique_id') != ""){
            $notification = $this->crud_model->get_notification();
			if($notification !== FALSE){
				return $this->output
				->set_output(json_encode(array(
						'status' => '200',
						"method" => $this->input->server('REQUEST_METHOD'),
						"content_type" => $this->input->server('CONTENT_TYPE'),
						"data" => $notification,
						'message' => 'all data retrived sucessfully',
				)));
			}else{
				return $this->output
				->set_output(json_encode(array(
						'status' => '404',
						'message' => 'no data found',
				)));
			}

         }else{
                  return $this->output
		    		->set_output(json_encode(array(
		    				'status' => '404',
		    				'message' => 'all data required',
		    		)));
         }
    }

    function show_appointment($notification_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
		$data['appointment'] = $this->db->get_where('appointment',array('appointment_id' => $notification_id))->result_array();
    	$data['page_name'] = 'show_appointment';
    	$data['page_title'] = get_phrase('show_appointment');
    	$this->load->view('backend/index', $data);
    }
    
    function notification($task = "",$notification_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "notification";
    	$current_timestamp = time();
    	
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	
    	if ($task == "create") {
    		$current_timestamp = time();
    		if($_FILES["image_path"]["type"] == 'image/jpeg' || $_FILES["image_path"]["type"] == 'image/png'){
    			$file_extension = '.jpg';
    		}else if($_FILES["image_path"]["type"] == 'application/pdf'){
    			$file_extension = '.pdf';
    		}else{
    			$file_extension = "";
    		}
    	
    		move_uploaded_file($_FILES["image_path"]["tmp_name"], "uploads/notification_image/" . $current_timestamp .$file_extension);
    		$notification = array(
    				"name" => $this->input->post('name'),
    				"description" => $this->input->post('description'),
    				"image_path" => $current_timestamp.$file_extension,
    				"file_type" => $_FILES["image_path"]["type"],
    				"doctor_id" => $login_user_id,
    		);
    		 
    		$this->crud_model->insert($tbl_name,$notification,$login_user_id,$login_type);
    		$this->session->set_flashdata('message', get_phrase('notification_created_sucessfully'));
    		redirect('doctor/notification');
    	
    	}
    	
    	
    	if ($task == "update") {
    		$this->crud_model->update_notification($notification_id);
    		$this->session->set_flashdata('message', get_phrase('notification_update_sucessfully'));
    		redirect('doctor/notification');
    	}
    	 
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_notification_record($notification_id);
    		$this->session->set_flashdata('message', get_phrase('notification_deleted_sucessfully'));
    		redirect('doctor/notification');
    	}
    	
    	
    	$data['page_name'] = 'manage_notification';
    	$data['page_title'] = get_phrase('manage_notification');
    	$this->load->view('backend/index', $data);
       
    }
    
   
function download_report($task = "",$patient_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	if($task == "birth"){
    		$query = $this->db->get('report');
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.blood_group,p.patient_id,p.color,p.name,p.birth_date,p.sex,p.address,p.breed,p.parent_name,r.timestamp operation_date,r.timestamp birth_date1');
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
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,d.clinic_name,d.registration_no,p.patient_id,p.blood_group,p.color,p.name,p.birth_date,p.sex,p.address,p.breed,p.parent_name,r.timestamp operation_date');
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
    		$this->db->select('d.address doctor_address,d.phone doctor_contact_no,d.email doctor_email_id,d.name doctor_name,p.parent_name,d.clinic_name,d.registration_no,p.patient_id,p.blood_group,p.color,p.age,p.phone,p.name,p.birth_date,p.sex,p.address,p.breed,r.timestamp death_date,r.death_location,r.death_reason');
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
    
    function notice($task = "", $notice_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create") {
    		$this->crud_model->save_notice_info();
    		$this->session->set_flashdata('message', get_phrase('notice_info_saved_successfuly'));
    		redirect(base_url() . 'index.php?doctor/notice');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_notice_info($notice_id);
    		$this->session->set_flashdata('message', get_phrase('notice_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?doctor/notice');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_notice_info($notice_id);
    		redirect(base_url() . 'index.php?doctor/notice');
    	}
    
    	$data['notice_info'] = $this->crud_model->select_notice_info();
    	$data['page_name'] = 'manage_notice';
    	$data['page_title'] = get_phrase('noticeboard');
    	$this->load->view('backend/index', $data);
    }
	function medical_health_record($task = "", $id = "") {
		
	    	$login_user_id =  $this->session->userdata('login_user_id');
	    	$doctor_id =  $this->session->userdata('doctor_id');
	    	$login_type =  $this->session->userdata('login_type');
	    	$tbl_name = "health_record";
	    	
	    	if ($this->session->userdata('doctor_login') != 1) {
	    		$this->session->set_userdata('last_page', current_url());
	    		redirect(base_url(), 'refresh');
	    	}
	    	
	    	if ($task == "create") {
if(isset($_FILES['health_record']) && count($_FILES['health_record']['error']) == 1 && $_FILES['health_record']['error'][0] > 0){
$health_record = array(
									"patient_id" => $this->input->post('selected_patient'),
									
									
									"doctor_id" => $login_user_id,
									"weight" => $this->input->post('weight'),
									"height" => $this->input->post('height'),
									"vaccine_name" => $this->input->post('vaccine_name'),
									"vaccine_date" => $this->input->post('vaccine_date'),
									"vaccine_status" => $this->input->post('vaccine_status'),
									"vaccine_brand_name" => $this->input->post('vaccine_brand_name'),
									"vaccine_batch_no" => $this->input->post('vaccine_batch_no'),
									"deworming_name" => $this->input->post('deworming_name'),
									"deworming_date" => $this->input->post('deworming_date'),
									"deworming_status" => $this->input->post('deworming_status'),
									"deworming_brand_name" => $this->input->post('deworming_brand_name'),
									"deworming_batch_no" => $this->input->post('deworming_batch_no'),
									"deworming_date" => $this->input->post('deworming_date'),
									"parasite_control_status" => $this->input->post('parasite_control_status'),
									"parasite_control_brand_name" => $this->input->post('parasite_control_brand_name'),
									"parasite_control_batch_no" => $this->input->post('parasite_control_batch_no'),
									"diet" => $this->input->post('diet'),
									"brief_medical_history" => $this->input->post('brief_medical_history'),
									"creation_timestamp" => date('Y-m-d', time()),
									"allergy" => $this->input->post('allergy'),
							);
							$insert = $this->crud_model->insert($tbl_name,$health_record,$login_user_id,$login_type);
$this->session->set_userdata(array(
									'last_inserted_id'       => $this->db->insert_id(),
							));
							if($insert !== FALSE){
								$this->db->select('*');
								$this->db->from('patient');
								$this->db->where('verify_dog',"true");
								$this->db->where('unique_id !=',"");
								$this->db->where('patient_id',$this->input->post('selected_patient'));
								$query = $this->db->get();
								$data = $query->result_array();
					
								if(count($data)>0){
					
									$unique_id   =   $this->db->get_where('patient',
											array('patient_id' => $this->input->post('selected_patient')))->row()->unique_id   ;
											if (isset($_POST["weight"]) && !empty($_POST["weight"])) {
												$parameter = array("action" => "add_weight","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","pet_code" => $unique_id ,"weight" => $this->input->post('weight'),"post_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result1 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result1->success== '1'){
													$insert_id = $this->db->insert_id();
													$weight = array("add_weight" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $weight);
												}
											}
					
											if (isset($_POST["vaccine_name"]) && !empty($_POST["vaccine_name"]) && isset($_POST["vaccine_status"]) && !empty($_POST["vaccine_status"])) {
												$parameter = array("action" => "add_vaccination","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('vaccine_name'), "pet_code" => $unique_id ,"status" => $this->input->post('vaccine_status'),"vaccine_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result2 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result2->success== '1'){
					
														
													$add_vaccination = array("add_vaccination" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_vaccination);
					
												}
											}
					
											if (isset($_POST["deworming_status"]) && !empty($_POST["deworming_status"]) && isset($_POST["deworming_name"]) && !empty($_POST["deworming_name"])) {
												$parameter = array("action" => "add_dewormer","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('deworming_name'), "pet_code" => $unique_id ,"status" => $this->input->post('deworming_status'),"dewormer_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result3 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result3->success== '1'){
													$add_dewormer = array("add_dewormer" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_dewormer);
					
												}
											}
					
											if (isset($_POST["parasite_control_status"]) && !empty($_POST["parasite_control_status"]) && isset($_POST["parasite_control_brand_name"]) && !empty($_POST["parasite_control_brand_name"])) {
					
												$parameter = array("action" => "add_parasite","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $_POST["parasite_control_brand_name"], "pet_code" => 'D2172' ,"status" => $_POST["parasite_control_status"],"parasite_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result4 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result4->success== '1'){
					
													$add_parasite = array("add_parasite" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_parasite);
					
					
					
					
												}
											}
					
											if (isset($_POST["diet"]) && !empty($_POST["diet"])) {
					
												$parameter = array("action" => "add_diet","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('diet'), "pet_code" => $unique_id ,"post_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result5 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result5->success== '1'){
					
													$add_diet = array("add_diet" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_diet);
					
					
					
												}
											}
					
											if (isset($_POST["allergy"]) && !empty($_POST["allergy"])) {
					
												$parameter = array("action" => "add_allergy","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('allergy'), "pet_code" => $unique_id ,"post_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result5 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result5->success== '1'){
					
													$add_allergy = array("add_allergy" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_allergy);
					
					
					
												}
											}
					
					
					
					
					
					
					
					
								}else{
					
					
								}
					
					
							}
   $this->session->set_flashdata('message', get_phrase('health_record_created_sucessfully'));
					redirect('doctor/medical_health_record');
} else if(isset($_FILES['health_record'])){ //this is just to check if isset($_FILE). Not required.
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
									"doctor_id" => $login_user_id,
									"weight" => $this->input->post('weight'),
									"height" => $this->input->post('height'),
									"vaccine_name" => $this->input->post('vaccine_name'),
									"vaccine_date" => $this->input->post('vaccine_date'),
									"vaccine_status" => $this->input->post('vaccine_status'),
									"vaccine_brand_name" => $this->input->post('vaccine_brand_name'),
									"vaccine_batch_no" => $this->input->post('vaccine_batch_no'),
									"deworming_name" => $this->input->post('deworming_name'),
									"deworming_date" => $this->input->post('deworming_date'),
									"deworming_status" => $this->input->post('deworming_status'),
									"deworming_brand_name" => $this->input->post('deworming_brand_name'),
									"deworming_batch_no" => $this->input->post('deworming_batch_no'),
									"deworming_date" => $this->input->post('deworming_date'),
									"parasite_control_status" => $this->input->post('parasite_control_status'),
									"parasite_control_brand_name" => $this->input->post('parasite_control_brand_name'),
									"parasite_control_batch_no" => $this->input->post('parasite_control_batch_no'),
									"diet" => $this->input->post('diet'),
									"brief_medical_history" => $this->input->post('brief_medical_history'),
									"creation_timestamp" => date('Y-m-d', time()),
									"allergy" => $this->input->post('allergy'),
							);
							$insert = $this->crud_model->insert($tbl_name,$health_record,$login_user_id,$login_type);
							$this->session->set_userdata(array(
									'last_inserted_id'       => $this->db->insert_id(),
							));
							if($insert !== FALSE){
								$this->db->select('*');
								$this->db->from('patient');
								$this->db->where('verify_dog',"true");
								$this->db->where('unique_id !=',"");
								$this->db->where('patient_id',$this->input->post('selected_patient'));
								$query = $this->db->get();
								$data = $query->result_array();
					
								if(count($data)>0){
					
									$unique_id   =   $this->db->get_where('patient',
											array('patient_id' => $this->input->post('selected_patient')))->row()->unique_id   ;
											if (isset($_POST["weight"]) && !empty($_POST["weight"])) {
												$parameter = array("action" => "add_weight","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","pet_code" => $unique_id ,"weight" => $this->input->post('weight'),"post_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result1 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result1->success== '1'){
													$insert_id = $this->db->insert_id();
													$weight = array("add_weight" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $weight);
												}
											}
					
											if (isset($_POST["vaccine_name"]) && !empty($_POST["vaccine_name"]) && isset($_POST["vaccine_status"]) && !empty($_POST["vaccine_status"])) {
												$parameter = array("action" => "add_vaccination","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('vaccine_name'), "pet_code" => $unique_id ,"status" => $this->input->post('vaccine_status'),"vaccine_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result2 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result2->success== '1'){
					
														
													$add_vaccination = array("add_vaccination" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_vaccination);
					
												}
											}
					
											if (isset($_POST["deworming_status"]) && !empty($_POST["deworming_status"]) && isset($_POST["deworming_name"]) && !empty($_POST["deworming_name"])) {
												$parameter = array("action" => "add_dewormer","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('deworming_name'), "pet_code" => $unique_id ,"status" => $this->input->post('deworming_status'),"dewormer_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result3 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result3->success== '1'){
													$add_dewormer = array("add_dewormer" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_dewormer);
					
												}
											}
					
											if (isset($_POST["parasite_control_status"]) && !empty($_POST["parasite_control_status"]) && isset($_POST["parasite_control_brand_name"]) && !empty($_POST["parasite_control_brand_name"])) {
					
												$parameter = array("action" => "add_parasite","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $_POST["parasite_control_brand_name"], "pet_code" => 'D2172' ,"status" => $_POST["parasite_control_status"],"parasite_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result4 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result4->success== '1'){
					
													$add_parasite = array("add_parasite" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_parasite);
					
					
					
					
												}
											}
					
											if (isset($_POST["diet"]) && !empty($_POST["diet"])) {
					
												$parameter = array("action" => "add_diet","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('diet'), "pet_code" => $unique_id ,"post_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result5 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result5->success== '1'){
					
													$add_diet = array("add_diet" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_diet);
					
					
					
												}
											}
					
											if (isset($_POST["allergy"]) && !empty($_POST["allergy"])) {
					
												$parameter = array("action" => "add_allergy","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","name" => $this->input->post('allergy'), "pet_code" => $unique_id ,"post_date" => date('Y-m-d', time()),"post_time" => date('h:i', time()));
												$result5 = $this->crud_model->ApiDiscoverMyPet($parameter);
												if($result5->success== '1'){
					
													$add_allergy = array("add_allergy" => "true");
														
													$this->db->where('id', $this->session->userdata('last_inserted_id'));
													$this->db->update('health_record', $add_allergy);
					
					
					
												}
											}
					
					
					
					
					
					
					
					
								}else{
					
					
								}
					
					
							}
					
						} else {
							$return['status'] = 'danger';
					
						}
					
					}
					$this->session->set_flashdata('message', get_phrase('health_record_created_sucessfully'));
					redirect('doctor/medical_health_record');
}

				
			}
	    	
	    	if ($task == "update") {
	    		$this->crud_model->update_health_record();
                           $this->session->set_flashdata('message', get_phrase('health_record_update_sucessfully'));
                        redirect('doctor/medical_health_record');
	    		
	    	}
	    
	    	if ($task == "delete")
	    	{
	    		$this->crud_model->delete_health_record($id);
	    		$this->session->set_flashdata('message', get_phrase('health_record_deleted_sucessfully'));
	    		redirect('doctor/medical_health_record');
	    	}
	    
	    	
	    	
	    	$data['health_record'] = $this->crud_model->get_all_health_record();
	    	$data['page_name'] = 'medical_health_record';
	    	$data['page_title'] = get_phrase('medical_health_record');
	    	$this->load->view('backend/index', $data);
	}
    
    function supplier($task = "", $user_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('doctor_login') != 1) {
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
    				"doctor_id" => $login_user_id,
    				"role" => $login_type,
    		);
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message', get_phrase('new_supplier_created_sucessfully'));
    		redirect('doctor/supplier');
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
    		redirect('doctor/supplier');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_user($user_id);
    		redirect('doctor/supplier');
    	}
    
    	$data['user'] = $this->crud_model->select_supplier_info();
    	
    	$data['page_name'] = 'supplier';
    	$data['page_title'] = get_phrase('supplier');
    	$this->load->view('backend/index', $data);
    }
    
    function get_medicine_subcategory() {
    	$tbl_name = 'medicine_sub_category';
    	$data = $this->crud_model->get_medicine_sub_category($tbl_name,$this->input->post('medicine_category_id'));
    	if(sizeof($data>0)){
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
    if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	if ($task == "update") {
    		$this->crud_model->update_user($user_id);
    		$this->session->set_flashdata('message', get_phrase('staff_info_updated_successfuly'));
    		redirect('doctor/manage_staff');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_user($user_id);
    		$this->session->set_flashdata('message', get_phrase('staff_deleted_successfuly'));
    		redirect('doctor/manage_staff');
    	}
    
    	$data['user'] = $this->crud_model->select_user_info();
    	$data['page_name'] = 'manage_staff';
    	$data['page_title'] = get_phrase('manage_staff');
    	$this->load->view('backend/index', $data);
    }
    
    function add_staff($task = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "users";
    	
    	if ($this->session->userdata('doctor_login') != 1) {
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
    			 
    			 
    			$data['doctor_id']              = $login_user_id;
    			$data['name']              = $this->input->post('name');
    			$data['email']     = $this->input->post('email');
    			$data['password']         = base64_encode($this->input->post('password'));
    			$data['address'] = $this->input->post('address');
    			$data['phone']      = $this->input->post('phone');
    			$data['role']      = $this->input->post('role');
    		
    			$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    			$this->session->set_flashdata('message', get_phrase('new_staff_created_sucessfully'));
    			redirect('doctor/manage_staff');
    		}
    	}
    
    	$data['page_name'] = 'add_staff';
    	$data['page_title'] = get_phrase('add_staff');
    	$this->load->view('backend/index', $data);
    }
    
    function invoice_add($task = "") {

    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('doctor_login') != 1) {
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
                         "total_amount" => $this->input->post('total_amount'),
    					 "due_timestamp" => $this->input->post('due_timestamp'),
    					 "status" => $this->input->post('status'),
    					 "doctor_id" => $login_user_id,
    			);
    			
    			$data = $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
                $insert_id = $this->db->insert_id();
                

    			$order = array("order" => array());
    			for($i=0; $i<count($this->input->post('quantity'));$i++){

    				$quantity = $this->input->post('quantity');
    				$price = $this->input->post('price');
    				$medicine_id = $this->input->post('medicine_id');
    				$invoice_medicine = array(
    						"invoice_id" => $insert_id,
    						"quantity" => $quantity[$i],
    						"price" => $price[$i],
    						"medicine_id" => $medicine_id[$i],
    						"medicine_id" => $medicine_id[$i],
    						"doctor_id" => $login_user_id,
    				);
    			
    				$query = $this->crud_model->insert('invoice_medicine',$invoice_medicine,$login_user_id,$login_type);
    				if ($query !== FALSE)
    				{
    				
    					$this->db->set('quantity','`quantity` - '. $quantity[$i], FALSE); 
    					$this->db->where_in('medicine_id', $medicine_id[$i]); 
    					$this->db->update('medicine');

                                       $query = $this->db->get('invoice');
    		$this->db->select('m.name product_name,im.quantity,im.price');
    		$this->db->from('invoice i');
    		$this->db->join('invoice_medicine im', 'im.invoice_id= i.invoice_id', 'left');
                $this->db->join('medicine m', 'm.medicine_id= im.medicine_id', 'left');
    		$this->db->where('i.invoice_id', $insert_id);
               
                $query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
                       $data = $query->result_array();
                      $order['order'][$i]['product_name'] .= $data[$i]['product_name'];
                      $order['order'][$i]['qty'] .= $data[$i]['quantity'];
                      $order['order'][$i]['rate'] .= $data[$i]['price'];
                     
    		}
    		else
    		{
    			return false;
    		}
    				}
    				else
    				{
    					echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message();
    				}
    			
    			}


$this->db->select('*');
         			$this->db->from('patient');
         			$this->db->where('verify_dog',"true");
                                $this->db->where('patient_id',$this->input->post('patient_id'));
         			$query = $this->db->get();
         			$data = $query->result_array();

if(count($data)>0){
$order1 = json_encode($order,TRUE);
     


$unique_id   =   $this->db->get_where('patient',
	                                array('patient_id' => $this->input->post('patient_id')))->row()->unique_id;

  $parameter = array("action" => "add_billing","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==",product =>  $order1,"pet_code" =>$unique_id,"post_date" =>date('Y-m-d', time()),"post_time" => date('h:i', time()),"payment_status" => $this->input->post('status'));
    $add_billing = $this->crud_model->ApiDiscoverMyPet($parameter); 
if($add_billing->success == '1'){
 $add_billing = array("add_billing" => "true");
         
        $this->db->where('invoice_id',$insert_id);
        $this->db->update('invoice', $add_billing);


}else{
print_r($add_billing);
die('no');
} 


}

  

    			$this->session->set_flashdata('message', get_phrase('invoice_info_saved_successfuly'));
    			redirect('doctor/invoice_manage');
    			
    		}
    		
    	}
    
    	$data['page_name'] = 'add_invoice';
    	$data['page_title'] = get_phrase('invoice');
    	$this->load->view('backend/index', $data);
    }
    
    
    function invoice_manage($task = "", $invoice_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "update") {
    		$data = $this->crud_model->check_avilabiltiy_of_product($this->input->post());
    		if($data == FALSE){
    			$this->session->set_flashdata('message', get_phrase('medicine_not_avilable_in Stock'));
    		}else{
	    		$this->crud_model->update_invoice($invoice_id);
    		}
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_invoice($invoice_id);
    		redirect('doctor/invoice_manage');
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

if(isset($_POST['download'])){
    		
    		$html = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet Sales Invoice</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 30px;">
									<div style="text-align:center;margin-bottom:10px;">
									<img src="'. base_url() .'assets/images/discovermypet_logo.png" width="100" height="100">
									</div>
									<h1 style="border-top: 1px solid #5D6975;border-bottom: 1px solid #5D6975;color: #5D6975;font-size: 2.4em;line-height: 1.4em;font-weight: normal;text-align: center;margin: 0 0 20px 0;background: url(dimension.png);">SALES INVOICE</h1>
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td>
				<table style="width:100%;">
				<tr>
					<td class="img" valign="top" style="padding: 10px;font-size:13px;width:100%;line-height:2; text-align:left;color:#000;">
						<table style="width:100%;border-spacing:0px !important;border-collapse:collapse;">
						<thead>
          <tr style="background: #F5F5F5;">
            <th style="width:150px;text-align:center;padding: 10px 10px;">TITLE</th>
            <th style="width:150px;text-align:center;">INVOICE NUMBER</th>
            <th style="width:150px;text-align:center;">PATIENT</th>
             <th style="width:150px;text-align:center;">CREATION DATE</th>
            <th style="text-align:center;">DUE DATE</th>            
            <th style="width:150px;text-align:center;">STATUS</th>
            <th style="text-align:center;">CONSULTATION FEES</th>
			<th style="text-align:center;width:125px;">TOTAL AMOUNT</th>
          </tr>
        </thead>
						<tbody>
          ';
$total = 0; 
$service_tax = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->service_tax;
$vat_percentage = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->vat_percentage ;
    		for($x=0;$x<count($data['invoice_info']);$x++){
    			$total += round($data['invoice_info'][$x]['total_amount'] + $data['invoice_info'][$x]['fees'] + (($data['invoice_info'][$x]['fees'] *  $service_tax) / 100)  + (($data['invoice_info'][$x]['total_amount'] *  $vat_percentage) / 100));
    		
    			$html .= 
    			'
<tr>
            <td style="padding: 10px 10px;text-align:center;">'. $data['invoice_info'][$x]['name'].'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $data['invoice_info'][$x]['invoice_number'].'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $this->db->get_where('patient', array('patient_id' => $data['invoice_info'][$x]['patient_id']))->row()->name .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $data['invoice_info'][$x]['creation_timestamp'].'</td>
            <td style="padding: 10px 10px;text-align:center;">'. $data['invoice_info'][$x]['due_timestamp'].'</td>            
            <td style="padding: 10px 10px;text-align:center;">'. $data['invoice_info'][$x]['status'].'</td>
            <td style="padding: 10px 10px;text-align:center;">RS '. $data['invoice_info'][$x]['fees'].'</td>
			<td style="padding: 10px 10px;text-align:center;">RS '. round($data['invoice_info'][$x]['total_amount'] + $data['invoice_info'][$x]['fees'] + (($data['invoice_info'][$x]['fees'] *  $service_tax) / 100)  + (($data['invoice_info'][$x]['total_amount'] *  $vat_percentage) / 100)) .'</td>
          </tr> 

 ' ;
    		
    		
    		}
    		 $html .= '
		   
		 

            <td colspan="6"></td>
            <td style="padding: 10px 10px;text-align:center;"><span style="background: #f5f5f5;padding: 5px 20px;margin-top: 20px;display: inline-block;font-size: 15px;font-weight: 600;">TOTAL</span></td>
            <td style="padding: 10px 10px;text-align:center;"><span style="background: #f5f5f5;padding: 5px 20px;margin-top: 20px;display: inline-block;font-size: 15px;font-weight: 600;">RS '. round($total) .'</span></td>
			
            
          </tr>
		          </tbody>
						</table>
					</td>
					
				</tr>
				</table>
				</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

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
    	}
    
    	
$data['page_name'] = 'manage_invoice';
    	$data['page_title'] = get_phrase('invoice');
    	$this->load->view('backend/index', $data);


        

    }
    
    function receptionist($task = "", $receptionist_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
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
    		redirect(base_url() . 'index.php?doctor/receptionist');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_receptionist_info($receptionist_id);
    		$this->session->set_flashdata('message', get_phrase('receptionist_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?doctor/receptionist');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_receptionist_info($receptionist_id);
    		redirect(base_url() . 'index.php?doctor/receptionist');
    	}
    
    	$data['receptionist_info'] = $this->crud_model->select_receptionist_info();
    	$data['page_name'] = 'manage_receptionist';
    	$data['page_title'] = get_phrase('receptionist');
    	$this->load->view('backend/index', $data);
    }
    
    
function medicine_category($task = "", $medicine_category_id = "")
    {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('doctor_login') != 1)
    	{
    		$this->session->set_userdata('last_page' , current_url());
    		redirect(base_url(), 'refresh');
    	}
    	
    	$tbl_name = "medicine_category";
    	
    	if ($task == "create")
    	{
    		$data['name'] 		= $this->input->post('name');
        	$data['doctor_id']    = $login_user_id;
        
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message' , get_phrase('medicine_category_info_saved_successfuly'));
    		redirect(base_url() .  'index.php?doctor/medicine_category');
    	}
    
    	if ($task == "update")
    	{
    		$this->crud_model->update_medicine_category_info($medicine_category_id);
    		$this->session->set_flashdata('message' , get_phrase('medicine_category_info_updated_successfuly'));
    		redirect(base_url() .  'index.php?doctor/medicine_category');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_medicine_category_info($medicine_category_id);
    		redirect(base_url() .  'index.php?doctor/medicine_category');
    	}
    
    	$data['page_name']              = 'manage_medicine_category';
    	$data['page_title']             = get_phrase('main_category');
    	$this->load->view('backend/index', $data);
    }
    
function medicine_sub_category($task = "", $medicine_sub_category_id = "")
    {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	$tbl_name = "medicine_sub_category";
    	if ($this->session->userdata('doctor_login') != 1)
    	{
    		$this->session->set_userdata('last_page' , current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create")
    	{
    		$data['medicine_category_id'] 		= $this->input->post('medicine_category_id');
    		$data['name'] 		= $this->input->post('name');
    		$data['doctor_id']    = $login_user_id;
    		
    		
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message' , get_phrase('medicine_sub_category_info_saved_successfuly'));
    		redirect(base_url() .  'index.php?doctor/medicine_sub_category');
    	}
    
    	if ($task == "update")
    	{
    		$this->crud_model->update_medicine_sub_category_info($medicine_sub_category_id);
    		$this->session->set_flashdata('message' , get_phrase('medicine_sub_category_info_updated_successfuly'));
    		redirect(base_url() .  'index.php?doctor/medicine_sub_category');
    	}
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_medicine_sub_category_info($medicine_sub_category_id);
    		redirect(base_url() .  'index.php?doctor/medicine_sub_category');
    	}
    
    	$data['page_name']              = 'manage_medicine_sub_category';
    	$data['page_title']             = get_phrase('sub_category');
    	$this->load->view('backend/index', $data);
    }
    
   
    
    function stock($task = "", $medicine_id = "")
    {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	
    	if ($this->session->userdata('doctor_login') != 1)
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
    				"doctor_id" => $login_user_id,
    		);
    		
    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    		$this->session->set_flashdata('message', get_phrase('new_medicine_created_sucessfully'));
    		redirect('doctor/stock');
    	}
    
    	if ($task == "update")
    	{
    		$this->crud_model->update_medicine_info($medicine_id);
    		$this->session->set_flashdata('message', get_phrase('medicine_updated_sucessfully'));
    		redirect('doctor/stock');
    	}
    	
    
    	if ($task == "delete")
    	{
    		$this->crud_model->delete_medicine_info($medicine_id);
    		redirect(base_url() .'index.php?doctor/stock');
    	}
    	
    	$data['medicine_info'] = $this->crud_model->stock();
    
    	$data['page_name']      = 'manage_medicine';
    	$data['page_title']     = get_phrase('stock');
    	$this->load->view('backend/index', $data);
    }
    

function patient($task = "", $patient_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	 
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    	
    	$tbl_name = 'patient';
	    	if ($task == "create") {

    		$tbl_doctor = $this->db->get_where('doctor', array('email' => $this->input->post('email')))->result_array();
    
    		$tbl_admin = $this->db->get_where('admin', array('email' => $this->input->post('email')))->result_array();
$tbl_patient = $this->db->get_where('patient', array('email' => $this->input->post('email')))->result_array();
    		
    		if($tbl_doctor != FALSE || $tbl_patient != FALSE){
    			$this->session->set_flashdata('message', get_phrase('pet_is_already_present_with_this_email'));
    		}else{
	    		
	    		$data['name'] 		= $this->input->post('name');
	    		$data['microchip_no'] 		= $this->input->post('microchip_no');
                        $data['unique_id'] 		= $this->input->post('unique_id');
		        $data['species']     = $this->input->post('species');
	    		$data['sex']            = $this->input->post('sex');
		        $data['breed']     = $this->input->post('breed');
	    		$data['birth_date']     = strtotime($this->input->post('birth_date'));
	    		$data['age']            = $this->input->post('age');
		        $data['sterilization_status']     = $this->input->post('sterilization_status');
			$data['color']     = $this->input->post('color');
			$data['drug_sensitivity']     = $this->input->post('drug_sensitivity');
			$data['mating_preference']     = $this->input->post('mating_preference');
			$data['master_id']     = $this->input->post('master_id');
			$data['remarks']     = $this->input->post('remarks');
			$data['brief_medical_history']     = $this->input->post('brief_medical_history');
	    		$data['parent_name'] 	= $this->input->post('parent_name');
	    		$data['parent_contact_no'] 	= $this->input->post('parent_contact_no');
	    		
	    		
	    		
	    		
	    		
	    		$data['email'] 		= $this->input->post('email');
	    		$data['password']       = base64_encode($this->input->post('password'));
	    		
                $data['parent_address']       = $this->input->post('parent_address');
	    		
	    		$data['phone']          = $this->input->post('parent_contact_no');
			
	    		$data['blood_group'] 	= $this->input->post('blood_group');
	    		$data['doctor_id'] 	= $login_user_id;
	    		$insert = $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);




$clinic_name   =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_name;
$clinic_image   =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_image;
$doctor_name   =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->name;
$doctor_contact   =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->phone;

$doctor_email   =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->email;
$website_name = $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->website_name;
$message = "Thank you for signing up at " . $clinic_name . " Login Id :"  . $this->input->post('email') . " Password :" . $this->input->post('password') . " at " . $website_name ;
 $this->sms_model->sms($message,$this->input->post('parent_contact_no'));
$message1 = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet /Welcome</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		#tbl_appointment tr:nth-child(even){background-color: #fcddcf;}
		#tbl_appointment tr:nth-child(odd){background-color: #fdefe9;}
		#tbl_appointment tr td{
		    padding: 13px 21px; 
			border-spacing:1px;
			border:1px solid #fff;
		}
		#tbl_appointment tr th{
		    
			border-spacing:1px;
			border:1px solid #fff;
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 0px;">
									<div class="h2" style="color:#1f1f1f; font-size:20px;margin-bottom:10px; line-height:24px; font-weight:bold;text-center;">
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;"><img src="'.base_url().'uploads/doctor_image/'. $clinic_image .'" width="50" height="50px;"></div>
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;">'. $clinic_name .'</div>
										</div>
										<img src="'.base_url().'assets/images/3.png" width="100%" height="70px;">
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td>
				<table style="width:100%">
				<tr>
					<td class="img" valign="top" style="padding: 10px;font-size:0pt;width:50%;line-height:0pt; text-align:left">
						<div style="font-size:50px;font-weight:600;margin-top:60px;color:#c00000;">Welcome</div>
						<div style="margin-top:75px;">
						<div style="font-size:13px;color:#000;font-weight: 600;margin-top:30px;">Proud Pet Parent!</div>
						<div style="font-size:13px;color:#000;font-weight: 600;margin-top:30px;">Thanks for signing up at Dr. '. $doctor_name. ' Clinic!</div>
						<div style="font-size:13px;color:#000;font-weight: 600;margin-top:20px;">This Clinic Provides the best care for your pet!</div>
						
						<div style="font-size:13px;color:#000;font-weight: 600;margin-top:30px;">To access your pet\'s-health records, download our</div>
						<div style="font-size:13px;color:#000;font-weight: 600;margin-top:15px;">App, Discover My Pet<sup>TM</sup> <a href="#" style="color:blue;">here!</a></div>
						<div class="h2" style="color:#1f1f1f;margin-top: 40px; font-size:13px; line-height:24px;">
											<div style="font-weight: 600;color: #000000;font-size: 14px;">Dr. '. $doctor_name .',</div>
											<div style="font-weight: 600;color: #000000;font-size: 14px;">'.$clinic_name .'</div>
											<div style="font-weight: 600;color: #000000;font-size: 14px;">'. $doctor_contact .'</div>
											<div style="font-weight: 600;color: #000000;font-size: 14px;"><a href="#" style="color:blue;">'. $website_name .'</a></div>
											<div style="font-weight: 600;color: #000000;font-size: 14px;"><a href="#" style="color:blue;">'. $doctor_email .'</a></div>
										</div>
						
						</div>
						
					</td>
					<td class="img" style="font-size:0pt;width:50%;line-height:0pt; text-align:left">
						<a href="#" target="_blank"><img src="'.base_url().'assets/images/3.jpg" alt="" border="0" width="100%" height="400" style="margin-bottom: 10px;" /></a>
						
					</td>
				</tr>
				</table>
				</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<div class="h2" style="color:#1f1f1f;margin-top: 20px;font-size:13px; line-height:24px;">
											<a href="#"><img src="'.base_url().'assets/images/5.png" width="100%"></a>
											
											
										</div>
					</td>
				</tr>
				<tr>
				<td>
					<div style="color:#c4c4c4 !important;margin:10px;font-size: 14px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
											DISCLAIMER: This message, including any attachments may contain proprietary, confidential and privileged information for the sole use of the intended recipient(s),
and is protected by law. If you are not the intended recipient, please notify the sender immediately and destroy all copies of the original message and attachments, if any.
Any unauthorized review, use, disclosure, dissemination, forwarding, printing or copying of this email or any action taken in reliance on this e-mail is strictly prohibited and
may be unlawful. Discover My Pet TM  reserves the right to record, monitor and inspect all email communications through its internal and external networks.
Your messages can be subject to such lawful supervision as Discover My Pet TM deems necessary in order to protect their information, interests and reputation.
Discover My Pet TM  prohibits and may take steps to prevent their information systems from being used to view, store or forward offensive or discriminatory
material. If this message contains such material, please report it to  <a href="#" style="color:blue;">info@discovermypet.in</a>. 
Please ensure you have adequate virus protection before you open or detach any documents from this transmission.
Discover My Pet<sup>TM</sup> does not accept any liability for viruses.
											</div>
				</td>
				</tr>
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>
    ';
$this->email_model->pet_add_successfully($message1,$this->input->post('email'));




	    		$patient_id  =   $this->db->insert_id();
	    		move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');

                       
	    		$this->session->set_flashdata('message', get_phrase('new_patient_created_sucessfully'));
if (isset($_POST["unique_id"]) && !empty($_POST["unique_id"])) {
   $parameter = array("action" => "verify_dog","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","pet_code" =>      $_POST['unique_id'],"phn_no" => $this->input->post('parent_contact_no'));
    $result = $this->crud_model->ApiDiscoverMyPet($parameter);   
if($result->success== '1'){
$verify_dog = array("verify_dog" => "true");
         $lastid = $this->db->insert_id();
         $this->db->where('patient_id', $lastid);
        $this->db->update('patient', $verify_dog);
}
}

	    		 redirect(base_url() . 'index.php?doctor/patient');
}
	    	}
	    	
	    	if ($task == "update") {
	    		$data['name'] 		= $this->input->post('name');
	    		$data['microchip_no'] 		= $this->input->post('microchip_no');
$data['unique_id'] 		= $this->input->post('unique_id');
		        $data['species']     = $this->input->post('species');
	    		$data['sex']            = $this->input->post('sex');
		        $data['breed']     = $this->input->post('breed');
	    		$data['birth_date']     = strtotime($this->input->post('birth_date'));
	    		$data['age']            = $this->input->post('age');
		        $data['sterilization_status']     = $this->input->post('sterilization_status');
			$data['color']     = $this->input->post('color');
			$data['drug_sensitivity']     = $this->input->post('drug_sensitivity');
			$data['mating_preference']     = $this->input->post('mating_preference');
			$data['master_id']     = $this->input->post('master_id');
			$data['remarks']     = $this->input->post('remarks');
			$data['brief_medical_history']     = $this->input->post('brief_medical_history');
	    		$data['parent_name'] 	= $this->input->post('parent_name');
	    		$data['parent_contact_no'] 	= $this->input->post('parent_contact_no');
	    		
	    	       $data['email'] 		= $this->input->post('email');
	    		$data['password']       = base64_encode($this->input->post('password'));
                       $data['parent_address']       = $this->input->post('parent_address');
	    		
	    		$data['phone']          = $this->input->post('parent_contact_no');
			
	    		$data['blood_group'] 	= $this->input->post('blood_group');
	    		
       			 move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');
       			 
	    		$this->crud_model->update_patient_info($tbl_name,$data,$patient_id);
	    		$this->session->set_flashdata('message', get_phrase('patient_info_updated_sucessfully'));

$this->db->select('*');
         			$this->db->from('patient');
         			$this->db->where('verify_dog',"true");
                                $this->db->where('patient_id',$patient_id);
         			$query = $this->db->get();
         			$data = $query->result_array();

if(count($data)>0){

}else{
if (isset($_POST["unique_id"]) && !empty($_POST["unique_id"])) {
   $parameter = array("action" => "verify_dog","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","pet_code" =>      $_POST['unique_id'],"phn_no" => $this->input->post('parent_contact_no'));
    $result = $this->crud_model->ApiDiscoverMyPet($parameter);   
if($result->success== '1'){
$verify_dog = array("verify_dog" => "true");
         $lastid = $this->db->insert_id();
         $this->db->where('patient_id', $patient_id);
        $this->db->update('patient', $verify_dog);
                                

}
}
  
}


	    		redirect('doctor/patient');
	    	}
	    	
	    	
	    	if ($task == "delete") {
	    		$this->crud_model->delete_user($user_id);
	    		redirect('doctor/patient');
	    	}
	
	        $data['$patient_info'] = $this->crud_model->select_patient_info_by_doctor_id();
	        $data['page_name'] = 'manage_patient';
	        $data['page_title'] = get_phrase('pet');
	        $this->load->view('backend/index', $data);
    }


    function medication_history($param1 = "", $prescription_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
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


    

	function report($task = "", $report_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "report";
    	
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
        	
        	$data['type'] 		= $this->input->post('type');
        	$data['description']    = $this->input->post('description');
        	$data['timestamp']      = strtotime($this->input->post('timestamp'));
        	$data['patient_id']     = $this->input->post('patient_id');
        	$data['parent_name']     = $this->input->post('parent_name');
        	$data['doctor_id']     = $login_user_id;
        	if(isset($_POST['death_location']) && isset($_POST['death_location'])){
        		$data['death_location']     = $this->input->post('death_location');
        		$data['death_reason']     = $this->input->post('death_reason');
        	}
        	
        	
        	
        	$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
            $this->session->set_flashdata('message', get_phrase('report_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/report');
        }

        if ($task == "update") {
            $this->crud_model->update_report_info($report_id);
            $this->session->set_flashdata('message', get_phrase('report_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/report');
        }

        if ($task == "delete") {
            $this->crud_model->delete_report_info($report_id);
            redirect(base_url() . 'index.php?doctor/report');
        }

        $data['page_name'] = 'manage_report';
        $data['page_title'] = get_phrase('report');
        $this->load->view('backend/index', $data);
    }

    function profile($task = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $doctor_id = $this->session->userdata('login_user_id');
        if ($task == "update") {
                $this->crud_model->update_doctor_info($doctor_id);
                redirect(base_url() . 'index.php?doctor/profile');
                $this->session->set_flashdata('message', get_phrase('profile_updated_sucessfully'));
        }

        if ($task == "change_password") {
            $password = $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->password;
            $old_password = base64_encode($this->input->post('old_password'));
            $new_password = $this->input->post('new_password');
            $confirm_new_password = $this->input->post('confirm_new_password');

            if ($password == $old_password && $new_password == $confirm_new_password) {
                $data['password'] = base64_encode($new_password);

                $this->db->where('doctor_id', $this->session->userdata('login_user_id'));
                $this->db->update('doctor', $data);

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?doctor/profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?doctor/profile');
            }
        }

        $data['page_name'] = 'edit_profile';
        $data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }
    
    function appointment_status($appointment_id = "") {
    	
    	$this->db->where('appointment_id',$appointment_id);
    	$query = $this->db->get('appointment');
    	if($query->num_rows() != 0)
    	{
    		$data = $query->result_array();
    		if($data[0]['appointment_status'] == "Close"){
    			$this->db->where('appointment_id', $appointment_id);
    			$update = $this->db->update('appointment',array('appointment_status' => 'Open'));
if($update !== FALSE){
 $message = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		#tbl_appointment tr:nth-child(even){background-color: #fcddcf;}
		#tbl_appointment tr:nth-child(odd){background-color: #fdefe9;}
		#tbl_appointment tr td{
		    padding: 13px 21px; 
			border-spacing:1px;
			border:1px solid #fff;
		}
		#tbl_appointment tr th{
		    
			border-spacing:1px;
			border:1px solid #fff;
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
								<div style="margin-top:20px;padding-bottom: 30px;">
									<div style="color:#1f1f1f;padding: 14px 0px;
 font-size:20px;margin-bottom:20px; line-height:24px; font-weight:bold;text-center;">
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;"><img src="'. base_url() . 'uploads/doctor_image/'.$this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_image .'" style="height: 40px;width: 40px;">' . $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_name. '</div>
										</div>
								<div style="padding:10px;background-color:#000000;">
										
											<div style="padding:10px;background-color:#000000;">
										
										<div style="font-weight: 500;color: #fff;font-size: 20px;"><img src="http://solutionner.com/DiscoverMyPet/assets/images/discovermypet_logo.png" style="height: 40px;width: 40px;"><span style="margin-left:5px;vertical-align: 13px;">Discover My Pet<sup style="margin-left:5px">TM</sup></span></div>
									</div>
										</div>
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				
				
				
				<!-- END Content -->
				<!-- Footer -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<div class="h2" style="color:#1f1f1f; font-size:13px; line-height:24px;padding: 15px;">
											
											<div style="font-weight: 600;background-color: #00e7e2;text-align:center;font-size: 14px;width:100%;height:700px;">
											<div style="padding-top:70px;text-align:center;font-size:65px;">Thank you</div>
											<div style="padding-top:30px;">FOR TAKING SERVICES FROM US</div>
											<div>WE WISH FOR BETTER HEALTH OF YOUR PET BABY!</div>
											<div>TO BOOK AN APPOINTMENT,DOWNLOAD OUR APP DISCOVER MY PET<SUP>TM</SUP>.ENJOY!</div>
											<div style="margin-top: 40px;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" style="padding: 6px 32px;background-color: #fff;text-decoration: none;color: #000;cursor: pointer !important;">GET APP</a></div>
											<div style="margin-top: 10px;"><img src="http://solutionner.com/DiscoverMyPet/assets/images/mail.png" style="height: auto;width: 600px;margin-left: 16px;margin-top: -50px;"></div>
											
											</div>
											
											<div style="font-weight: 600;margin-top:15px;background-color: #bfbfbf;text-align:center;font-size: 14px;width:100%;height:3px;">
											</div>
										</div>
										
										<!-- <div style="font-weight: 400;color:#c4c4c4;margin-top:15px;margin-bottom:30px;text-align:center;font-size: 14px;width:100%;border:1px solid #f2f2f2">
										
											</div> -->
										
										
					</td>
				</tr>
				<tr>
				<td>
					<div style="color:#c4c4c4 !important;font-size: 14px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
											DISCLAIMER: This message, including any attachments may contain  proprietary, confedential privileged information for the sole use of the intended recipient(s), and is protected by law.
											</div>
				</td>
				</tr>
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>
	';
$message1 = '<!DOCTYPE html>
<html xmlns=\'http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	
	<title>Discover My Pet</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		#tbl_appointment tr:nth-child(even){background-color: #fcddcf;}
		#tbl_appointment tr:nth-child(odd){background-color: #fdefe9;}
		#tbl_appointment tr td{
		    padding: 13px 21px; 
			border-spacing:1px;
			border:1px solid #fff;
		}
		#tbl_appointment tr th{
		    
			border-spacing:1px;
			border:1px solid #fff;
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 10px;">
									<div class="h2" style="color:#1f1f1f; font-size:20px;margin-bottom:20px; line-height:24px; font-weight:bold;text-center;">
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;"><img src="'. base_url() . 'uploads/doctor_image/'.$this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_image .'" width="50" height="50px;"></div>
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;">' . $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_name. '</div>
										</div>
										
										<img src="'. base_url() .'assets/images/3.png" height="70px;">
											
										
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				
				
				
				<!-- END Content -->
				<!-- Footer -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<div class="h2" style="color:#1f1f1f; font-size:13px; line-height:24px;padding: 15px;">
											
											<div style="font-weight: 600;background-color: #00e7e2;text-align:center;font-size: 14px;width:100%;height:700px;">
											<div style="padding-top: 70px;text-align: center;font-size: 105px;font-family: Century Schoolbook;font-weight: 600 !important;color: #000000;font-style: italic;">thank you.</div>
											<div style="font-size: 15px;font-weight: 600;padding-top:65px;padding-bottom:0px;line-height:2.3">FOR TAKING SERVICES FROM US.</div>
											<div style="padding-bottom:0px;padding-top:0px;line-height:1.3;font-size: 15px;font-weight: 600;">WE WISH FOR BETTER HEALTH OF YOUR PET BABY!</div>
											<div style="padding-bottom:0px;padding-top:0px;    line-height: 1.6;font-size: 15px;font-weight: 600;">TO BOOK AN APPOINTMENT, DOWNLOAD OUR APP DISCOVER MY PET<SUP>TM</SUP> . ENJOY!</div>
											
											<div style="margin-top: 40px;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" style="padding: 6px 32px;background-color: #fff;text-decoration: none;color: #000;cursor: pointer !important;">GET APP</a></div>
											<div style="margin-top: 10px;"><img src="'. base_url() .'assets/images/mail.png" style="height: auto;width: 600px;margin-left: 16px;margin-top: -50px;"></div>
											
											</div>
											
											<div style="font-weight: 600;margin-top:15px;background-color: #bfbfbf;text-align:center;font-size: 14px;width:100%;height:3px;">
											</div>
										</div>
										
										<!-- <div style="font-weight: 400;color:#c4c4c4;margin-top:15px;margin-bottom:30px;text-align:center;font-size: 14px;width:100%;border:1px solid #f2f2f2">
										
											</div> -->
										
										
					</td>
				</tr>
				<tr>
				<td>
					<div style="color:#c4c4c4 !important;font-size: 13px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
											DISCLAIMER: This message, including any attachments may contain proprietary, confidential and privileged information for the sole use of the intended recipient(s),
and is protected by law. If you are not the intended recipient, please notify the sender immediately and destroy all copies of the original message and attachments, if any.
Any unauthorized review, use, disclosure, dissemination, forwarding, printing or copying of this email or any action taken in reliance on this e-mail is strictly prohibited and
may be unlawful. Discover My Pet TM  reserves the right to record, monitor and inspect all email communications through its internal and external networks.
Your messages can be subject to such lawful supervision as Discover My Pet TM deems necessary in order to protect their information, interests and reputation.
Discover My Pet TM  prohibits and may take steps to prevent their information systems from being used to view, store or forward offensive or discriminatory
material. If this message contains such material, please report it to  <a href="#" style="color:blue;font-weight:600">info@discovermypet.in.</a>
Please ensure you have adequate virus protection before you open or detach any documents from this transmission.
Discover My Pet <SUP>TM</SUP>  does not accept any liability for viruses.

											</div>
				</td>
				</tr>
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>';

$message2 = '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>DISCOVER MY PET</title>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <style type="text/css">

     
         .ps-top-to-bottom {
            position: relative;
        }

            .ps-top-to-bottom:after {
                content: "";
                position: absolute;
                background-image: -webkit-gradient(linear, 0 100%, 0 0, from(#000), to(transparent));
                background-image: -webkit-linear-gradient(#000, transparent);
                background-image: -moz-linear-gradient(#000, transparent);
                background-image: -o-linear-gradient(#000, transparent);
                background-image: linear-gradient(rgba(255, 0, 0, 0),#383c38, rgba(255, 255, 0, 0));
                top: -3px;
                bottom: -3px;
                width: 3px;
            }

            .ps-top-to-bottom:before {
                left: -3px;
            }

            .ps-top-to-bottom:after {
                right: -3px;
            }

        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }

        .ExternalClass {
            width: 100%;
            background-color: #ffffff;
        }

        .user_fe {
            margin-top: -1.4%;
            position: absolute;
            margin-left: -6%;
        }

        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
           
            
        }

        table {
            border-collapse: collapse;
        }

        
      
    </style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: \'Varela Round\', sans-serif;">

    <!-- Wrapper -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

				
				 <!--Start Header-->
                <table width="600" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                        <td style="padding: 6px 0px 0px;background: #fff none repeat scroll 0% 0%;">
                            <table width="550" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                <tr>
                                    <td width="100%">
                                        <!--Start logo-->
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                            <tr>
                                                <td class="center" style="">
												<div>
												<a href="#"><img src="'. base_url() .'assets/images/discover_logo.png"></a>
													
													</div>
                                                </td>
                                            </tr>
                                        </table><!--End logo-->
                                        <!--Start nav-->
                                     
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--End Header-->
			
			
			
			
                <!--Start Header-->
                <table width="600" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                        <td style="padding: 6px 0px 0px;background: #cc0000 none repeat scroll 0% 0%;">
                            <table width="550" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                <tr>
                                    <td width="100%">
                                        <!--Start logo-->
                                        <table border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                            <tr>
                                                <td class="center" style="">
												<div style="padding:20px;">
												<div style="text-align:center;font-weight: 600;font-size: 26px;color: #fff;">
                                                    A FRESH PERSPECTIVE
													</div>
													<div style="text-align:center;color:#fff;font-size:15px;font-weight:500;">Access pet Health Documents </div>
													<div style="text-align:center;	color:#fff;font-size:14px;font-weight:500;">from Dr. '.$this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->name.' Clinic!</div>
													
													<div style="text-align:center;margin-top:20px;color:#fff;font-size:14px;font-weight:500;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" style="text-decoration:none;color:#fff;font-size:14px;">Download Now!</a></div>
													</div>
                                                </td>
                                            </tr>
                                        </table><!--End logo-->
                                        <!--Start nav-->
                                        <table border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                            <tr>
                                                <td class="center" style="font-size: 13px; color: #272727; font-weight: light; text-align: center; font-family: \'Open Sans\', sans-serif; line-height: 25px; vertical-align: middle; padding: 10px 0px 10px 0px;"></td>
                                            </tr>
                                        </table><!--End nav-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--End Header-->
                <!-- Start Headliner-->
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                        <td valign="middle" width="50%" align="center" style="padding: 20px" class="center">
                            <a href="#"><img src="'. base_url() .'assets/images/calender.png"  width="120" height="120"></a>
                        </td>
						 <td valign="top" width="50%" align="left" style="padding: 20px" class="center">
						 <div style="text-alight:center">
                            <div style="font-weight: 600;font-size:16px;margin-bottom:20px;">APPOINMENTS</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">Complete Updates on</div>
							<div style="font-weight: 600;font-size:16px;line-height: 1.4;">Pet\'s Appointment</div>
							<div style="font-weight: 600;font-size:16px;line-height: 1.4;">Schedule </div>
							<div style="font-weight: 600;font-size:16px;margin-top:20px;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" target="_blank" style="text-decoration: none;"><img src="'. base_url() .'assets/images/live.png" width="150" height="39"></a></div>
                            
                        </td>
                    </tr>
                </table>
                <!-- Start Headliner-->
				<!-- Start Headliner-->
                <table width="600" border="0" style="background-color:#ebffeb;" cellpadding="0" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                        <td valign="middle" width="50%" align="center" style="padding: 20px" class="center">
                            <a href="#"><img src="'. base_url() .'assets/images/prescription.png"  width="120" height="120"></a>
                        </td>
						 <td valign="top" width="50%" align="left" style="padding: 20px" class="center">
						 <div style="text-alight:center">
                            <div style="font-weight: 600;font-size:16px;margin-bottom:20px;">PRESCRIPTIONS</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">List Of Medicines</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">To Remind You Take</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">Care Of Your Pet Baby</div>
                            <div style="font-weight: 600;font-size:16px;margin-top:20px;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" target="_blank" style="text-decoration: none;"><img src="'. base_url() .'assets/images/clean.png" width="150" height="39"></a></div>
                            
							</div>
                        </td>
                    </tr>
                </table>
                <!-- Start Headliner-->
				<!-- Start Headliner-->
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                        <td valign="middle" width="50%" align="center" style="padding: 20px" class="center">
                            <a href="#"><img src="'. base_url() .'assets/images/report.png"  width="120" height="120"></a>
                        </td>
						 <td valign="top" width="50%" align="left" style="padding: 20px" class="center">
						  <div style="text-alight:center">
                            <div style="font-weight: 600;font-size:16px;margin-bottom:20px;">HEALTH REPORTS</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">Pet Reports Accessible</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">The Best Way</div>
                            
                            <div style="font-weight: 600;font-size:16px;margin-top:20px;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" target="_blank" style="text-decoration: none;"><img src="'. base_url() .'assets/images/Dial.png" width="150" height="39"></a></div>
                            
							</div>
                        </td>
                    </tr>
                </table>
                <!-- Start Headliner-->
				<!-- Start Headliner-->
                <table width="600" border="0" cellpadding="0" style="background-color:#ebffeb;" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                        <td valign="middle" width="50%" align="center" style="padding: 20px" class="center">
                            <a href="#"><img src="'. base_url() .'assets/images/bill.png"  width="120" height="120"></a>
                        </td>
						 <td valign="top" width="50%" align="left" style="padding: 20px" class="center">
						<div style="text-alight:center">
                            <div style="font-weight: 600;font-size:16px;margin-bottom:20px;">BILLS & FINANCES</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">Complete Pet</div>
                            <div style="line-height: 1.4;font-weight: 600;font-size:16px;">Finance Management</div>
                            <div style="font-weight: 600;font-size:16px;line-height: 1.4;">Through Bills</div>
                            
                            <div style="font-weight: 600;font-size:16px;margin-top:20px;"><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" target="_blank" style="text-decoration: none;"><img src="'. base_url() .'assets/images/Tackle.png" width="150" height="39"></a></div>
                            
							</div>
                        </td>
                    </tr>
                </table>
                <!-- Start Headliner-->
               <!-- Start Headliner-->
                <table width="600" border="0" cellpadding="0" style="background-color:#00b0ac;" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                       
						 <td valign="top" width="50%" align="left" style="padding: 20px" class="center">
						<div style="text-alight:center">
                            
                            <div style="font-weight: 500;font-size:19px;text-align:center;color:#fff;padding: 0px 51px;"><a href="#"><img src="'. base_url() .'assets/images/many_more.png" width="150" style="margin-bottom:10px;"></a></div>
                            <div style="font-weight: 500;font-size:19px;text-align:center;color:#fff;padding: 0px 51px;">NEW APP: UNIQUE FEATURE FOR ALL PET PARENTS</div>
                            <div style="font-weight: 500;font-size:16px;color:#fff;padding: 14px 33px;text-align: center;">Get pet record on finger tips by Sign Up, & Share Code To Veterinary Doctor</div>
                            <!-- <div style="font-weight: 600;font-size:16px;">Through Bills</div> -->
                            
                            <div style="font-weight: 600;font-size:16px;margin-top:20px;text-align:center;"><a href="https://itunes.apple.com/in/app/discovermypet/id1125498169?mt=8" target="_blank" style="background-color: #404040;padding: 4px 14px;color: #fff;text-decoration: none;text-align: center;border-radius: 5px;border: 2px solid #385d8a;">GET IOS APP</a><a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" target="_blank" style="background-color: #404040;padding: 4px 14px;color: #fff;text-decoration: none;text-align: center;border-radius: 5px;border: 2px solid #385d8a;margin-left:10px;">GET ANDROID APP</a></div>
                            
							</div>
                        </td>
                    </tr>

                </table>
                <!-- Start Headliner-->
				
				 <!-- Start Headliner-->
                <table width="600" border="0" cellpadding="0" style="background-color:#fff;" cellspacing="0" align="center" class="deviceWidth table_shadow">
                    <tr>
                       
						 <td valign="top" width="100%" align="left" style="padding: 5px 0px" class="center">
						 <div style="color:#c4c4c4 !important;margin:10px 0px;font-size: 14px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
											DISCLAIMER: This message, including any attachments may contain proprietary, confidential and privileged information for the sole use of the intended recipient(s),
and is protected by law. If you are not the intended recipient, please notify the sender immediately and destroy all copies of the original message and attachments, if any.
Any unauthorized review, use, disclosure, dissemination, forwarding, printing or copying of this email or any action taken in reliance on this e-mail is strictly prohibited and
may be unlawful. Discover My Pet TM  reserves the right to record, monitor and inspect all email communications through its internal and external networks.
Your messages can be subject to such lawful supervision as Discover My Pet TM deems necessary in order to protect their information, interests and reputation.
Discover My Pet TM  prohibits and may take steps to prevent their information systems from being used to view, store or forward offensive or discriminatory
material. If this message contains such material, please report it to  <a href="#" style="color:blue;">info@discovermypet.in</a>. 
Please ensure you have adequate virus protection before you open or detach any documents from this transmission.
Discover My Pet<sup>TM</sup> does not accept any liability for viruses.
											</div>
						                       </td>
                    </tr>

                </table>
                <!-- Start Headliner-->


            </td>
        </tr>
    </table>
    <!-- End Wrapper -->
</body>
</html>';
$pet_id = $this->db->get_where('appointment', array('appointment_id' => $appointment_id))->row()->patient_id;
$pet_email = $this->db->get_where('patient', array('patient_id' => $pet_id))->row()->email;

$this->email_model->appointment_close_email($message1,$pet_email);
$this->email_model->promotional_mail($message2,$pet_email);
}

    			$this->session->set_flashdata('message', get_phrase('appointment_status_changed_successfuly'));
$pet_id   =   $this->db->get_where('appointment',
 	                                array('appointment_id' => $appointment_id))->row()->patient_id;
$clinic_name  =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_name;
$doctor_name  =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->name;
$doctor_contact_no  =   $this->db->get_where('doctor',
 	                                array('doctor_id' => $this->session->userdata('login_user_id')))->row()->phone;

$pet_contact_no   =   $this->db->get_where('patient',
 	                                array('patient_id' => $pet_id))->row()->parent_contact_no;
                        $message = "Thank you for choosing " . $clinic_name   . ' For any query related to your pet, please contact , Dr.' . $doctor_name . " Contact No:". $doctor_contact_no . ' ,Download Discover My Pet App. https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en';
$sms1 = 'Dear Pet Parent, Now you can access your pet’s data from '. $clinic_name . ' . Just Download Discover My Pet TM APP and avail an access! https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en';
                        $this->sms_model->sms($message,$pet_contact_no);
$this->sms_model->sms($sms1,$pet_contact_no);
                       
    			redirect(base_url() . 'index.php?doctor/appointment');
    			
    		}
    		if($data[0]['appointment_status'] == "Open"){
    			$this->db->where('appointment_id', $appointment_id);
    			$this->db->update('appointment',array('appointment_status' => 'Close'));
    			$this->session->set_flashdata('message', get_phrase('appointment_status_changed_successfuly'));
    			redirect(base_url() . 'index.php?doctor/appointment');
    		}
    		return $query->result_array();
    	}
    	else
    	{
    		return false;
    	}
    }

	function appointment($task = "", $appointment_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name =  'appointment';
    	
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
         	$data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        	$data['status']     = 'approved';
        	$data['patient_id'] = $this->input->post('patient_id');
        	$data['doctor_id'] = $login_user_id;
        	$data['bording_number'] = $this->input->post('bording_number');
        	$data['appointment_type'] = $this->input->post('appointment_type');
        	$data['appointment_status'] = "Close";
        	
            $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
        
	        $notify = $this->input->post('notify');
	        if($notify != '') {
	            $patient_name   =   $this->db->get_where('patient',
	                                array('patient_id' => $data['patient_id']))->row()->name;
$pet_email   =   $this->db->get_where('patient',
	                                array('patient_id' => $data['patient_id']))->row()->email;
 $parent_name   =   $this->db->get_where('patient',
	                                array('patient_id' => $data['patient_id']))->row()->parent_name;
	            $clinic_name    =   $this->db->get_where('doctor',
	                                array('doctor_id' => $data['doctor_id']))->row()->clinic_name;
$doctor_name    =   $this->db->get_where('doctor',
	                                array('doctor_id' => $data['doctor_id']))->row()->name;
	            $date           =   date('l, d F Y', $data['timestamp']);
$doctor_address    =   $this->db->get_where('doctor',
	                                array('doctor_id' => $data['doctor_id']))->row()->address;
	            $date           =   date('l, d F Y', $data['timestamp']);
	            $time           =   date('g:i a', $data['timestamp']);
	            $message        =   $patient_name . ', you have an appointment with doctor ' . $doctor_name . ' has been confirmed for' .$clinic_name. ' on '  . $date . ' at ' . $time . '.';

$sms        =   'Dear ' . $parent_name . ', your appointment with Dr. ' . $doctor_name . ' on ' . $date . ' at ' . $time . ' Doctor Address :' . $doctor_address;
	            $receiver_phone =   $this->db->get_where('patient',
	            array('patient_id' => $data['patient_id']))->row()->phone;
	            $receiver_email =   $this->db->get_where('patient',
	            		array('patient_id' => $data['patient_id']))->row()->email;
	            
	   $message = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet / Welcome</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		#tbl_appointment tr:nth-child(even){background-color: #fcddcf;}
		#tbl_appointment tr:nth-child(odd){background-color: #fdefe9;}
		
		
		 
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td width="100%">
									

									<div style="padding-bottom: 30px;">
									<a href="#"><img src="'.base_url() .'assets/images/appoinment.png" width="100%"></a>
										
											

									</div>


								</td>
								
							</tr>
							<tr>
							<td align="center">
									
									<div style="padding-bottom: 30px;width: 78%;">
									<table id="appoinment_tbl" style="border-collapse:collapse;width:100%;border-collapse:collapse;">
									<caption style="color:#fff;border:1px solid #000;padding: 6px 5px;background-color:#000;text-align:left;">'.$patient_name.'</caption>
									<caption style="color:#fff;border:1px solid #000;padding: 16px 5px;border-top:0px;border-bottom:0px;"></caption>
									<tr>
										<th style="border:1px solid #000;border-right: 0px !important;text-align:left;padding: 5px 5px;">Date</th>
										<td style="border:1px solid #000;border-left:0px;padding: 5px 5px;color: #000;font-weight: 600;">'. $date .'</td>
									</tr>
									<tr>
										<th style="border:1px solid #000;border-right: 0px !important;text-align:left;padding: 5px 5px;">Time</th>
										<td style="border:1px solid #000;border-left:0px;padding: 5px 5px;color: #000;font-weight: 600;">'. $time .'</td>
									</tr>
									<tr>
										<th style="border:1px solid #000;border-right: 0px !important;text-align:left;padding: 5px 5px;">Doctor\'s Name</th>
										<td style="border:1px solid #000;border-left:0px;padding: 5px 5px;color: #000;font-weight: 600;">'. $doctor_name .'</td>
									</tr>
									<tr>
										<th style="border:1px solid #000;border-right: 0px !important;text-align:left;padding: 5px 5px;">Clinic\'s Name</th>
										<td style="border:1px solid #000;border-left:0px;padding: 5px 5px;color: #000;font-weight: 600;">'. $clinic_name .'</td>
									</tr>
									<tr>
										<th style="border:1px solid #000;border-right: 0px !important;text-align:left;padding: 5px 5px;">Location</th>
										<td style="border:1px solid #000;border-left:0px;padding: 5px 5px;color: #000;font-weight: 600;">'. $doctor_address .'</td>
									</tr>
									<tr>
										<th style="border:1px solid #000;padding: 16px 5px;border-right: 0px !important;text-align:left;padding: 5px 5px;"></th>
										<td style="border:1px solid #000;border-left:0px;padding: 16px 5px;color: #000;font-weight: 600;"></td>
									</tr>
									</table>
									
									</div>

								</td>
								
							</tr>
							<tr>
							<td>
									
									<div style="padding: 20px;width: 100%;">
									<div style="font-size:13px;color:#000;font-weight:600;">Thank You for Choosing '. $clinic_name . ' ! </div>
									<div style="font-size:13px;color:#000;font-weight:600;">You can access your pet baby\'s record on Discover My Pet<SUP>TM</SUP>App. Cherish Pet Parenting!</div>
									<div style="font-size:13px;color:#000;font-weight:600;">Click <a href="https://play.google.com/store/apps/details?id=discovermypet.navitorhealthcare&hl=en" style="color:blue;">here</a> to download APP.</div>
									</div>

								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<div class="h2" style="color:#1f1f1f;margin-top: 20px;font-size:13px; line-height:24px;">
											<a href="#"><img src="'.base_url() .'assets/images/5.png" width="100%"></a>
											
											
										</div>
					</td>
				</tr>
				<tr>
				<td>
					<div style="color:#c4c4c4 !important;margin: 10px 0px;font-size: 14px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
											DISCLAIMER: This message, including any attachments may contain proprietary, confidential and privileged information for the sole use of the intended recipient(s),
and is protected by law. If you are not the intended recipient, please notify the sender immediately and destroy all copies of the original message and attachments, if any.
Any unauthorized review, use, disclosure, dissemination, forwarding, printing or copying of this email or any action taken in reliance on this e-mail is strictly prohibited and
may be unlawful. Discover My Pet TM  reserves the right to record, monitor and inspect all email communications through its internal and external networks.
Your messages can be subject to such lawful supervision as Discover My Pet TM deems necessary in order to protect their information, interests and reputation.
Discover My Pet TM  prohibits and may take steps to prevent their information systems from being used to view, store or forward offensive or discriminatory
material. If this message contains such material, please report it to  info@discovermypet.in. 
Please ensure you have adequate virus protection before you open or detach any documents from this transmission.
Discover My Pet <SUP>TM</SUP>  does not accept any liability for viruses.

											</div>
				</td>
				</tr>
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>
    ';        
	            $this->email_model->sendmail_of_appointment($message,$pet_email);
$this->sms_model ->sms($sms ,$receiver_phone);
	        }
	        
            $this->session->set_flashdata('message', get_phrase('appointment_info_saved_successfuly'));
          $data = $this->crud_model->check_pet_code();
if(count($data)>0){
   $parameter = array("action" => "add_appointment","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","appointment_type" => $this->input->post('appointment_type') ,"pet_code" => $data[0]['unique_id'],"appointment_dt" => date('Y-d-m', strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') )),"appointment_tm" => date('H:i', strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') )));
    $result = $this->crud_model->ApiDiscoverMyPet($parameter);   
if($result->success== '1'){
$add_appointment = array("add_appointment" => "true");
         $lastid = $this->db->insert_id();
         $this->db->where('appointment_id', $lastid);
        $this->db->update('appointment', $add_appointment);
 
}else{

}


}

            redirect(base_url() . 'index.php?doctor/appointment');
        }

        if ($task == "update") {
            $update = $this->crud_model->update_appointment_info($appointment_id);
if($update !== FALSE){


$this->db->select('*');
         			$this->db->from('patient');
         			$this->db->where('verify_dog',"true");
                                $this->db->where('patient_id',$this->input->post('patient_id'));
         			$query = $this->db->get();
         			$data = $query->result_array();

if(count($data)>0){
$unique_id   =   $this->db->get_where('patient',
	                                array('patient_id' => $this->input->post('patient_id')))->row()->unique_id;
$parameter = array("action" => "add_appointment","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","appointment_type" => $this->input->post('appointment_type') ,"pet_code" => $unique_id,"appointment_dt" => date('Y-d-m', strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') )),"appointment_tm" => date('H:i', strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') )));
    $result = $this->crud_model->ApiDiscoverMyPet($parameter);   
if($result->success== '1'){
         $add_appointment = array("add_appointment" => "true");
         
         $this->db->where('appointment_id', $appointment_id);
        $this->db->update('appointment', $add_appointment);



}

  
}else{
$add_appointment = array("add_appointment" => "NULL");
         
         $this->db->where('appointment_id', $appointment_id);
        $this->db->update('appointment', $add_appointment);
}
  
}



            $this->session->set_flashdata('message', get_phrase('appointment_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/appointment');
        }

        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(base_url() . 'index.php?doctor/appointment');
        }
        
        
        
        $data['appointment_info'] = $this->crud_model->select_appointment_info_by_doctor_id();
        $data['page_name'] = 'manage_appointment';
        $data['page_title'] = get_phrase('appointment');
        $this->load->view('backend/index', $data);
    }
    
	function event($task = "", $event_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name =  'event';
    	
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
        	$data['doctor_id'] = $login_user_id;
        	$data['event_name'] = $this->input->post('event_name');
        	$data['event_date'] = $this->input->post('event_date');
        	$data['event_time'] = $this->input->post('event_time');
        	
            $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
        
	        
            $this->session->set_flashdata('message', get_phrase('event_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/appointment');
        }

        if ($task == "update") {
            $this->crud_model->update_event_info($event_id);
            $this->session->set_flashdata('message', get_phrase('event_info_updated_successfuly'));
            redirect(base_url() . 'index.php?doctor/appointment');
        }

        if ($task == "delete") {
            $this->crud_model->delete_event_info($event_id);
            $this->session->set_flashdata('message', get_phrase('event_deleted_successfuly'));
            redirect(base_url() . 'index.php?doctor/appointment');
        }
        
       
        $data['page_name'] = 'manage_event';
        $data['page_title'] = get_phrase('events');
        $this->load->view('backend/index');
    }

    function appointment_requested($task = "", $appointment_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "approve") {
            $this->crud_model->approve_appointment_info($appointment_id);
            $this->session->set_flashdata('message', get_phrase('appointment_info_approved'));
            redirect(base_url() . 'index.php?doctor/appointment_requested');
        }

        if ($task == "delete") {
            $this->crud_model->delete_appointment_info($appointment_id);
            redirect(base_url() . 'index.php?doctor/appointment_requested');
        }

        $data['requested_appointment_info'] = $this->crud_model->select_requested_appointment_info_by_doctor_id();
        $data['page_name'] = 'manage_requested_appointment';
        $data['page_title'] = get_phrase('requested_appointment');
        $this->load->view('backend/index', $data);
    }

    function prescription($task = "", $prescription_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $insert = $this->crud_model->save_prescription_info();
            if( $insert !== "FALSE"){
	            $this->session->set_flashdata('message', get_phrase('prescription_info_saved_successfuly'));
	            redirect(base_url() . 'index.php?doctor/prescription');
            }
        }

        if ($task == "update") {
            $this->crud_model->update_prescription_info($prescription_id);
            $this->session->set_flashdata('message', get_phrase('prescription_info_updated_successfuly'));
redirect(base_url() . 'index.php?doctor/prescription');
        }

        if ($task == "delete") {
            $this->crud_model->delete_prescription_info($prescription_id);
            //redirect(base_url() . 'index.php?doctor/prescription');
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
        		$html = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet /Welcome</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 30px;">
									<div style="text-align:center;margin-bottom:10px;">
									<img src="'.base_url() .'assets/images/discovermypet_logo.png" width="100" height="100">
									</div>
									<h1 style="border-top: 1px solid #5D6975;border-bottom: 1px solid #5D6975;color: #5D6975;font-size: 2.4em;line-height: 1.4em;font-weight: normal;text-align: center;margin: 0 0 20px 0;background: url(dimension.png);">PRESCRIPTION REPORT</h1>
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<td>
				<table style="width:100%;">
				<tr>
					<td class="img" valign="top" style="padding: 10px;font-size:13px;width:100%;line-height:2; text-align:left;color:#000;">
						<table style="width:100%;border-spacing:0px !important;border-collapse:collapse;">
						<thead>
          <tr style="background: #F5F5F5;">
            <th style="width:150px;text-align:center;padding: 10px 10px;">PRODUCT NAME</th>
            <th style="text-align:center;">DAYS</th>
            <th style="text-align:center;">QAUNTITY</th>
             
            <th style="width:150px;text-align:center;">DOCTOR NAME</th>            
            <th style="width:150px;text-align:center;">PET NAME</th>
            <th style="width:150px;text-align:center;">DATE</th>
			<th style="text-align:center;width:125px;">TIME</th>
          </tr>
        </thead><tbody>
	';
        		 
        		for($x=0;$x<count($data);$x++){
        		
        			 
        		
        			$html .=
        			'<tr>
            <td style="padding: 10px 10px;text-align:center;">'.$data[$x]['medicine_name'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'.$data[$x]['dose'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'.$data[$x]['quantity'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'.$data[$x]['doctor_name'] .'</td>
            <td style="padding: 10px 10px;text-align:center;">'.$data[$x]['name'] .'</td>            
            <td style="padding: 10px 10px;text-align:center;">'. date("D, d M Y", $data[$x]['timestamp']) .'</td>
            <td style="padding: 10px 10px;text-align:center;">'. date("H:i", $data[$x]['timestamp']) .'
</td>
			
          
            
          </tr>';
        		
        		
        		
        		}
        		$html .='
          
		          </tbody>
						</table>
					</td>
					
				</tr>
				</table>
				</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>';
        		
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

        $data['prescription_info'] = $this->crud_model->select_prescription_info_by_doctor_id();
        $data['menu_check'] = 'from_prescription';
        $data['page_name'] = 'manage_prescription';
        $data['page_title'] = get_phrase('prescription');
        $this->load->view('backend/index', $data);
    }

    function diagnosis_report($task = "", $diagnosis_report_id = "") {
        if ($this->session->userdata('doctor_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_diagnosis_report_info();
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_saved_successfuly'));
            redirect(base_url() . 'index.php?doctor/prescription');
        }

        if ($task == "delete") {
            $this->crud_model->delete_diagnosis_report_info($diagnosis_report_id);
            $this->session->set_flashdata('message', get_phrase('diagnosis_report_info_deleted_successfuly'));
            redirect(base_url() . 'index.php?doctor/prescription');
        }
    }

    /* private messaging */

function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('doctor_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?doctor/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?doctor/message/message_read/' . $param2, 'refresh');
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
        if ($this->session->userdata('doctor_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
        	if($this->input->post('selected_mail_option') == "All Staff"){
$message1 = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		#tbl_appointment tr:nth-child(even){background-color: #fcddcf;}
		#tbl_appointment tr:nth-child(odd){background-color: #fdefe9;}
		#tbl_appointment tr td{
		    padding: 13px 21px; 
			border-spacing:1px;
			border:1px solid #fff;
		}
		#tbl_appointment tr th{
		    
			border-spacing:1px;
			border:1px solid #fff;
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 15px;">
									<div class="h2" style="color:#1f1f1f; font-size:20px;margin-bottom:10px; line-height:24px; font-weight:bold;text-center;">
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;"><img src="'. base_url() . 'uploads/doctor_image/'.$this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_image .'" width="50" height="50"></div>
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;">' . $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_name. '</div>
										</div>
										<img src="'.base_url() .'assets/images/3.png" width="100%" height="70px;">
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<a href="#" target="_blank"><img src="'.base_url() .'assets/images/staff.jpg" alt="" border="0" width="100%" height="400" style="margin-bottom: 10px;" /></a>
						
					</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<div class="h2" style="color:#1f1f1f;margin-top: 20px;margin-bottom:40px; font-size:13px; line-height:24px;">
											<div style="font-weight: 600;color: #000000;text-align:center;font-size: 14px;margin-bottom:20px;font-size:18px;">Staff Message</div>
											<div style="font-weight: 600;background-color: #ddd9c3;text-align:left;font-size: 14px;height:400px;padding:10px	">'. $this->input->post('message') .'</div>
											
											
										</div>
					</td>
				</tr>
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>
    ';
        		
        		
        		$this->db->where("doctor_id", $this->session->userdata('login_user_id'));
        		$query = $this->db->get('users');
        		if($query->num_rows() != 0)
        		{
        			$data = $query->result_array();
        			for($i=0;$i<count($data);$i++){
        				$email = $this->email_model->sendmail_to_staff($message1,$data[0]['email']);
        			}
        			
        			if($email == TRUE){
        				$this->session->set_flashdata('message', get_phrase('email_send_sucessfully'));
        				redirect('/doctor/staff_message', 'refresh');
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


$message1 = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<title>Discover My Pet</title>
	

	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none }
		a { color:#00b8e4; text-decoration:underline }
		h3 a { color:#1f1f1f; text-decoration:none }
		.text2 a { color:#ea4261; text-decoration:none }


		/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
		p { padding:0 !important; margin:0 !important } 
		
		#tbl_appointment tr:nth-child(even){background-color: #fcddcf;}
		#tbl_appointment tr:nth-child(odd){background-color: #fdefe9;}
		#tbl_appointment tr td{
		    padding: 13px 21px; 
			border-spacing:1px;
			border:1px solid #fff;
		}
		#tbl_appointment tr th{
		    
			border-spacing:1px;
			border:1px solid #fff;
		}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="margin-top:20px;padding-bottom: 15px;">
									<div class="h2" style="color:#1f1f1f; font-size:20px;margin-bottom:10px; line-height:24px; font-weight:bold;text-center;">
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;"><img src="'. base_url() . 'uploads/doctor_image/'.$this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_image .'" width="50" height="50"></div>
											<div style="font-weight: 600;color: #000000;font-size: 14px; text-align:center;">' . $this->db->get_where('doctor', array('doctor_id' => $this->session->userdata('login_user_id')))->row()->clinic_name. '</div>
										</div>
										<img src="'.base_url() .'assets/images/3.png" width="100%" height="70px;">
										
										
											

									</div>


								</td>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<a href="#" target="_blank"><img src="'.base_url() .'assets/images/staff.jpg" alt="" border="0" width="100%" height="400" style="margin-bottom: 10px;" /></a>
						
					</td>
				</tr>
				
				
				<!-- END Content -->
				<!-- Footer -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<div class="h2" style="color:#1f1f1f;margin-top: 20px;margin-bottom:40px; font-size:13px; line-height:24px;">
											<div style="font-weight: 600;color: #000000;text-align:center;font-size: 14px;margin-bottom:20px;font-size:18px;">Staff Message</div>
											<div style="font-weight: 600;background-color: #ddd9c3;text-align:left;font-size: 14px;height:400px;padding:10px	">'. $this->input->post('message') .'</div>
											
											
										</div>
					</td>
				</tr>
				<!-- END Footer -->
			</table>
		</td>
	</tr>
</table>

</body>
</html>
    ';
        			$message = $this->input->post('message');
        			 
        			$this->db->where_in("id",$id);
        			$query = $this->db->get('users');
        			if($query->num_rows() != 0)
        			{
        				$data = $query->result_array();
        				for ($x = 0; $x <= count($data); $x++) {
        						$email = $this->email_model->sendmail_to_staff($message1,$data[$x]['email']);
        			          
        					if($email == TRUE){
        						$this->session->set_flashdata('message', get_phrase('email_send_sucessfully'));
        						redirect('/doctor/staff_message', 'refresh');
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
            redirect(base_url() . 'index.php?doctor/message/message_read/' . $param2, 'refresh');
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
    
    function bed($task = "", $bed_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create") {
    		$this->crud_model->save_bed_info();
    		$this->session->set_flashdata('message', get_phrase('bed_info_saved_successfuly'));
    		redirect(base_url() . 'index.php?doctor/bed');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_bed_info($bed_id);
    		$this->session->set_flashdata('message', get_phrase('bed_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?doctor/bed');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_bed_info($bed_id);
    		redirect(base_url() . 'index.php?doctor/bed');
    	}
    
    	$data['bed_info'] = $this->crud_model->select_bed_info();
    	$data['page_name'] = 'manage_bed';
    	$data['page_title'] = get_phrase('bed');
    	$this->load->view('backend/index', $data);
    }
    
    function bed_allotment($task = "", $bed_allotment_id = "") {
    	if ($this->session->userdata('doctor_login') != 1) {
    		$this->session->set_userdata('last_page', current_url());
    		redirect(base_url(), 'refresh');
    	}
    
    	if ($task == "create") {
    		$this->crud_model->save_bed_allotment_info();
    		$this->session->set_flashdata('message', get_phrase('bed_allotment_info_saved_successfuly'));
    		redirect(base_url() . 'index.php?doctor/bed_allotment');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_bed_allotment_info($bed_allotment_id);
    		$this->session->set_flashdata('message', get_phrase('bed_allotment_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?doctor/bed_allotment');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_bed_allotment_info($bed_allotment_id);
    		redirect(base_url() . 'index.php?doctor/bed_allotment');
    	}
    
    	$data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
    	$data['page_name'] = 'manage_bed_allotment';
    	$data['page_title'] = get_phrase('bed_allotment');
    	$this->load->view('backend/index', $data);
    }
    
	function blood_bank($task = "", $blood_bank_id = "") {
	        if ($this->session->userdata('doctor_login') != 1) {
	            $this->session->set_userdata('last_page', current_url());
	            redirect(base_url(), 'refresh');
	        }
	
	        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
	        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
	        $data['page_name'] = 'show_blood_bank';
	        $data['page_title'] = get_phrase('blood_bank');
	        $this->load->view('backend/index', $data);
	    }
    
  function blood_donor($task = "", $blood_donor_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	$tbl_name = "blood_donor";
    	
    	if ($this->session->userdata('doctor_login') != 1) {
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
    			$data['doctor_id']    = $login_user_id;
    			
    			 
    			$data = $this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
    			
    			$this->session->set_flashdata('message', get_phrase('blood_donor_info_saved_successfuly'));
    			
    		} else {
    			$this->session->set_flashdata('message', get_phrase('duplicate_email'));
    		}
    		redirect(base_url() . 'index.php?doctor/blood_donor');
    	}
    
    	if ($task == "update") {
    		$this->crud_model->update_blood_donor_info($blood_donor_id);
    		$this->session->set_flashdata('message', get_phrase('blood_donor_info_updated_successfuly'));
    		redirect(base_url() . 'index.php?doctor/blood_donor');
    	}
    
    	if ($task == "delete") {
    		$this->crud_model->delete_blood_donor_info($blood_donor_id);
    		redirect(base_url() . 'index.php?doctor/blood_donor');
    	}
    
    	$data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
    	$data['page_name'] = 'manage_blood_donor';
    	$data['page_title'] = get_phrase('blood_donor');
    	$this->load->view('backend/index', $data);
    }
    

}


?>
