<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
function check_pet_code()
    {
        $this->db->select('*');
    	$this->db->from('patient');
    	$this->db->where('patient_id' ,$_POST['patient_id']);
        $this->db->where('verify_dog' ,"true");
    	$query = $this->db->get();
    	
    	return $query->result_array();
    }
    function ApiDiscoverMyPet($params)
    {

    	
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'http://discovermypet.in/doctor/dr_sw.php');
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $params);
     
    
     
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
     
    $result = json_decode($buffer);
 
    if(isset($result->success) && $result->success== '1')
    {
       return $result;

    }
     
    else
    {
         return false;


    }
    }
    
    function get_medicine_data()
    {
    	$this->db->select('*');
    	$this->db->from('medicine');
    	$this->db->where('medicine_id' ,$_POST['medicine_id']);
    	$query = $this->db->get();
    	$data = $query->result_array();
    	return $query->result_array();
    }
    function stock()
    {
    	if (isset($_POST["medicine_category"]) && !empty($_POST["medicine_category"])) {
    		$this->db->where('medicine_category_id' , $_POST["medicine_category"]);
    		 
    	}else{
    		 
    	}
    	if (isset($_POST["medicine_sub_category"]) && !empty($_POST["medicine_sub_category"])) {
    		$this->db->where('medicine_sub_category_id' ,  $_POST["medicine_sub_category"]);
    		 
    	}
    	if (isset($_POST["supplier"]) && !empty($_POST["supplier"])) {
    		$this->db->where('supplier_id' ,  $_POST["supplier"]);
    		 
    	}
    	if (isset($_POST["brand_name"]) && !empty($_POST["brand_name"])) {
    		$this->db->where('manufacturing_company' ,  $_POST["brand_name"]);
    		 
    	}
    	$this->db->where('doctor_id', $this->session->userdata('login_user_id'));
        $this->db->order_by("medicine_id","desc");
    	$query = $this->db->get('medicine');
    	return $query->result_array();
    	
    }
    
    function stock_report()
    {
    	$doctor_id = $this->session->userdata('login_user_id');
    	if (isset($_POST["medicine_category"]) && !empty($_POST["medicine_category"])) {
    		$this->db->where('medicine_category_id' , $_POST["medicine_category"]);
    	
    	}else{
    		 
    	}
    	if (isset($_POST["medicine_sub_category"]) && !empty($_POST["medicine_sub_category"])) {
    		$this->db->where('medicine_sub_category_id' ,  $_POST["medicine_sub_category"]);
    	
    	}
    	if (isset($_POST["medicine_id"]) && !empty($_POST["medicine_id"])) {
    		$this->db->where('medicine_id' ,  $_POST["medicine_id"]);
    	
    	}
    	 
    	$this->db->select('*');
    	$this->db->select('SUM(quantity) as quantity');
    	$this->db->where('doctor_id' ,  $this->session->userdata('login_user_id'));
    	$this->db->group_by('name');
        $this->db->order_by("medicine_id", "desc");
    	return $this->db->get('medicine')->result_array();
    }
    
    function get_all_health_record()
    {
    	
    	
    	if(isset($_POST['selected_patient']) && !empty($_POST['selected_patient'])){


    	    $this->db->where('patient_id', $_POST['selected_patient']);
    	}
    	if(isset($_POST['from_date']) && !empty($_POST['from_date'] && $_POST['to_date']) && !empty($_POST['to_date'])){

    		
$this->db->where('creation_timestamp BETWEEN "'. date('Y-m-d', strtotime($_POST['from_date'])). '" and "'. date('Y-m-d', strtotime($_POST['to_date'])).'"');

    		
    	}
    	$this->db->where('doctor_id', $this->session->userdata('login_user_id'));
        $this->db->order_by("id","desc");
    	$query = $this->db->get('health_record');
    	$data = $query->result_array();

    	return $query->result_array();
    }
    
    
    function get_notification()
    {
            $query = $this->db->get('patient');
    		$this->db->select('n.notification_id,n.description,n.image_path,n.file_type,p.unique_id pet_unique_id');
    		$this->db->from('patient p');
    		$this->db->join('notification n', 'n.doctor_id = p.doctor_id', 'left');
    		$this->db->where('p.unique_id', $this->input->post('pet_unique_id'));
                $query = $this->db->get();
    		if($query->num_rows() != 0)
    		{

    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    }
  function get_stock_result()
    {
	  	if(isset($_POST['medicine_category'])){
	  		$medicine_category = $this->input->post('medicine_category');
	  	}else{
	  		
	  		$medicine_category = "";
	  	}
	  	
	  	if(isset($_POST['medicine_sub_category'])){
	  		$medicine_sub_category = $this->input->post('medicine_sub_category');
	  	}else{
	  		
	  		$medicine_sub_category = "";
	  	}
	  	
	  	if(isset($_POST['brand_name'])){
	  		$brand_name = $this->input->post('brand_name');
	  	}else{
	  		
	  		$brand_name = "";
	  	}
	  	
	  	if(isset($_POST['supplier'])){
	  		$supplier = $this->input->post('supplier');
	  	}else{
	  		
	  		$supplier = "";
	  	}
	  	
    	$this->db->where('medicine_category_id', $medicine_category);
    	$this->db->or_where('medicine_sub_category_id', $medicine_sub_category);
    	$this->db->or_where('manufacturing_company', $brand_name);
    	$this->db->or_where('supplier_id', $supplier);
    	
    	$query = $this->db->get('medicine');
    	return $query->result_array();
    }
    
  function get_invoice_result()
    {
	  	if(isset($_POST['medicine_category'])){
	  		$medicine_category = $this->input->post('medicine_category');
	  	}else{
	  		
	  		$medicine_category = "";
	  	}
	  	
	  	if(isset($_POST['medicine_sub_category'])){
	  		$medicine_sub_category = $this->input->post('medicine_sub_category');
	  	}else{
	  		
	  		$medicine_sub_category = "";
	  	}
	  	
	  	if(isset($_POST['brand_name'])){
	  		$brand_name = $this->input->post('brand_name');
	  	}else{
	  		
	  		$brand_name = "";
	  	}
	  	
	  	if(isset($_POST['supplier'])){
	  		$supplier = $this->input->post('supplier');
	  	}else{
	  		
	  		$supplier = "";
	  	}
	  	
    	$this->db->where('medicine_category_id', $medicine_category);
    	$this->db->or_where('medicine_sub_category_id', $medicine_sub_category);
    	$this->db->or_where('manufacturing_company', $brand_name);
    	$this->db->or_where('supplier_id', $supplier);
    	
    	$query = $this->db->get('medicine');
    	$data = $query->result_array();
    	$medicine_id = array();
    	for ($i = 0; $i < sizeof($data); $i++) {
    		array_push(	$medicine_id ,$data[$i]['medicine_id']);
    	}
    	
    	if(count($medicine_id)>0){
    		$this->db->where_in('medicine_id', $medicine_id);
    		$query = $this->db->get('invoice_medicine');
    		$data1 = $query->result_array();
    		
    		$invoice_id = array();
    		for ($i = 0; $i < sizeof($data1); $i++) {
    			array_push($invoice_id ,$data1[$i]['invoice_id']);
    		}
    		 
    		$this->db->where_in('invoice_id', $invoice_id);
    		$query = $this->db->get('invoice');
    		$data2 = $query->result_array();
    		 
    	}
    	
    	
    	
    	
    	return $query->result_array();
    }
    
  function save_user_info1($admin_id)
    {
    	$data['admin_id'] 		=$admin_id;
    	$data['name'] 		= $this->input->post('name');
    	$data['email'] 		= $this->input->post('email');
    	$data['password']       = base64_encode($this->input->post('password'));
    	$data['address'] 	= $this->input->post('address');
    	$data['phone']          = $this->input->post('phone');
    	$data['role'] 	= $this->input->post('role');

    	
    
    	$this->db->insert('users',$data);
    
    	$doctor_id  =   $this->db->insert_id();
    	move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/doctor_image/" . $admin_id . '.jpg');
    }
    
    function get_entry($tbl_name,$invoice_number){
    	$this->db->where('invoice_number', $invoice_number);
    	$query = $this->db->get($tbl_name);
    	return $query->result_array();
    }
    
    function get_medicine_sub_category($tbl_name,$medicine_category_id){
    	$this->db->where('medicine_category_id', $medicine_category_id);
    	$query = $this->db->get($tbl_name);
   		 if($query->num_rows() != 0)
    		{
    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();
        foreach ($result as $row)
            return $row[$field];
        //return	$this->db->get_where($type,array($type.'_id'=>$type_id))->row()->$field;	
    }
function display_user_info($user_id)
    {
    	$this->db->where('user_id',$user_id);
    	return $this->db->get('patient')
    	->result_array();
    }
    
    function display_user_staff_info($user_id)
    {
    	$this->db->where('user_id',$user_id);
    	return $this->db->get('users')
    	->result_array();
    }
    
    function display_doctor_user_info($doctor_id)
    {
    	$this->db->where('doctor_id',$doctor_id);
$this->db->order_by("doctor_id", "desc");
    	return $this->db->get('patient')
    	->result_array();
    }
    
    function display_doctor_staff_info($doctor_id)
    {
    	$this->db->where('doctor_id',$doctor_id);
$this->db->order_by("id", "desc");
    	return $this->db->get('users')
    	->result_array();
    }
    
    
    function insert($tbl_name,$data,$login_user_id,$login_type) 
    {
    	if($tbl_name != FALSE && $data != FALSE && $login_user_id != FALSE && $login_type !=  FALSE){
    		switch ($login_type) {
    			case "doctor":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "sub_doctor":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "kennel":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "groomer":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "trainers":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "breeder":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "ambulance_service":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "pet_relocation":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "pet_bakery":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "dog_walker":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "obituary":
    				$this->db->insert($tbl_name, $data);
    				break;
    				case "restaurants":
    				$this->db->insert($tbl_name, $data);
    				break;
    		}
    	}
    }
    function update($tbl_name,$data,$id) 
    {
    	$this->db->where('id', $id);
        $this->db->update($tbl_name, $data);
    }
    function update_breed_info($tbl_name,$data,$breed_id) 
    {
    	$this->db->where('breed_id', $breed_id);
        $this->db->update($tbl_name, $data);
    }
    function update_patient_info($tbl_name,$data,$id) 
    {
    	$this->db->where('patient_id', $id);
        $this->db->update($tbl_name, $data);
    }
    
    function update_health_record() 
    {
    	if (isset($_FILES['health_record']['name']) && !empty($_FILES['health_record']['name'])) {
    		$current_timestamp = time();
    		if($_FILES["health_record"]["type"] == 'image/jpeg' || $_FILES["health_record"]["type"] == 'image/png'){
    			$file_extension = '.jpg';
    		}else if($_FILES["health_record"]["type"] == 'application/pdf'){
    			$file_extension = '.pdf';
    		}else{
    			$file_extension = "";
    		}
    	
    		move_uploaded_file($_FILES["health_record"]["tmp_name"], "uploads/health_record/" . $current_timestamp .$file_extension);
    		
    		$health_record = array(
    				"patient_id" => $this->input->post('selected_patient'),
    				"health_record" => $current_timestamp.$file_extension,
    				"file_type" => $_FILES["health_record"]["type"],
    				"weight" => $this->input->post('weight'),
    				"height" => $this->input->post('height'),
    				"vaccine_name" => $this->input->post('vaccine_name'),
    				"vaccine_date" => $this->input->post('vaccine_date'),
    				"vaccine_status" => $this->input->post('vaccine_status'),
    				"vaccine_brand_name" => $this->input->post('vaccine_brand_name'),
    				"vaccine_batch_no" => $this->input->post('vaccine_batch_no'),
    				"deworming_name" => $this->input->post('deworming_name'),
    				"deworming_status" => $this->input->post('deworming_status'),
    				"deworming_brand_name" => $this->input->post('deworming_brand_name'),
    				"deworming_batch_no" => $this->input->post('deworming_batch_no'),
    				"deworming_date" => $this->input->post('deworming_date'),
    				"parasite_control_status" => $this->input->post('parasite_control_status'),
    				"parasite_control_batch_no" => $this->input->post('parasite_control_batch_no'),
                                 "parasite_control_brand_name" => $this->input->post('parasite_control_brand_name'),
    				"diet" => $this->input->post('diet'),
    				"brief_medical_history" => $this->input->post('brief_medical_history'),
    				"allergy" => $this->input->post('allergy'),
    		);
    		 
    		$this->db->where('id',  $this->input->post('id'));
    		$this->db->update('health_record', $health_record);
    	
    	}
    	else{
    		$health_record = array(
    				"patient_id" => $this->input->post('selected_patient'),

    				"weight" => $this->input->post('weight'),
    				"height" => $this->input->post('height'),
    				"vaccine_name" => $this->input->post('vaccine_name'),
    				"vaccine_date" => $this->input->post('vaccine_date'),
    				"vaccine_status" => $this->input->post('vaccine_status'),
    				"vaccine_brand_name" => $this->input->post('vaccine_brand_name'),
    				"vaccine_batch_no" => $this->input->post('vaccine_batch_no'),
    				"deworming_name" => $this->input->post('deworming_name'),
    				"deworming_status" => $this->input->post('deworming_status'),
    				"deworming_brand_name" => $this->input->post('deworming_brand_name'),
    				"deworming_batch_no" => $this->input->post('deworming_batch_no'),
    				"deworming_date" => $this->input->post('deworming_date'),
    				"parasite_control_status" => $this->input->post('parasite_control_status'),
 "parasite_control_brand_name" => $this->input->post('parasite_control_brand_name'),
    				"parasite_control_batch_no" => $this->input->post('parasite_control_batch_no'),
    				"diet" => $this->input->post('diet'),
    				"brief_medical_history" => $this->input->post('brief_medical_history'),
    				"allergy" => $this->input->post('allergy'),
    		);
    		 
    		$this->db->where('id',  $this->input->post('id'));
    		$this->db->update('health_record',$health_record);
    	}
    	
    }
    
    function update_notification($notification_id = "") 
    {
    	if (isset($_FILES['image_path']['name']) && !empty($_FILES['image_path']['name'])) {
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
    		);
    		 
    		$this->db->where('notification_id',  $notification_id);
    		$this->db->update('notification', $notification);
    	
    	}
    	else{
    		$notification = array(
    				"name" => $this->input->post('name'),
    				"description" => $this->input->post('description'),
    		);
    		 
    		$this->db->where('notification_id',  $notification_id);
    		$this->db->update('notification', $notification);
    	}
    	
    }
    
    function delete_health_record($health_record_id)
    {
    	$this->db->where('id', $health_record_id);
    	$this->db->delete('health_record');
    }
    function delete_notification_record($notification_id)
    {
    	$this->db->where('notification_id', $notification_id);
    	$this->db->delete('notification');
    }
    function delete_patient($patient_id)
    {
    	$this->db->where('patient_id', $patient_id);
    	$this->db->delete('patient');
    }
    function update_user() 
    {
	        $data['name']  = $this->input->post('name');
        $data['email']  = $this->input->post('email');
        $data['password']         = $this->input->post('password');
        $data['address'] = $this->input->post('address');
        $data['phone']      = $this->input->post('phone');
        $data['role']      = $this->input->post('role');
        $id = $this->input->post('id');
        
        $this->db->where('id',  $id );
        $this->db->update('users', $data);
    }
    
    function delete_user($user_id)
    {
    	$this->db->where('id', $user_id);
    	$this->db->delete('users');
    }
    
    function select_user_info($login_user_id = "",$login_type = "") 
    {
    	
         if($login_user_id != FALSE && $login_type !=  FALSE){
         	switch ($login_type) {
         		case "doctor":
         			$this->db->select('*');
         			$this->db->from('users');
         			$this->db->where('doctor_id',$login_user_id);
                                $this->db->order_by("id","desc");
         			$query = $this->db->get();
         			return $query->result_array();
         			break;
         		case "sub_doctor":
         			$this->db->select('*');
         			$this->db->from('users');
         			$this->db->where('doctor_id',$login_user_id);
                                $this->db->order_by("id","desc");
         			$query = $this->db->get();
         			return $query->result_array();
         			break;

         	}
         
         
         
         }
    }
    function select_health_record() 
    {
    		$query = $this->db->get('health_record');
    		$this->db->select('p.name,h.file_type,h.health_record,h.id,h.patient_id');
    		$this->db->from('health_record h');
    		$this->db->join('patient p', 'p.patient_id=h.patient_id', 'left');
    		$query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
    			return $query->result_array();
    		}
    		else
    		{
    			return false;
    		}
    }
  function create_invoice() 
    {
        $data['title']              = $this->input->post('title');
        $data['invoice_number']     = $this->input->post('invoice_number');
        $data['patient_id']         = $this->input->post('patient_id');
        $data['creation_timestamp'] = $this->input->post('creation_timestamp');
        $data['due_timestamp']      = $this->input->post('due_timestamp');
        $data['vat_percentage']     = $this->input->post('vat_percentage');
        $data['discount_amount']    = $this->input->post('discount_amount');
        $data['status']             = $this->input->post('status');

        $invoice_entries            = array();
        $descriptions               = $this->input->post('entry_description');
        $amounts                    = $this->input->post('entry_amount');
        $number_of_entries          = sizeof($descriptions);
        
        for ($i = 0; $i < $number_of_entries; $i++)
        {
            if ($descriptions[$i] != "" && $amounts[$i] != "")
            {
                $new_entry          = array('description' => $descriptions[$i], 'amount' => $amounts[$i]);
                array_push($invoice_entries, $new_entry);
            }
        }
        $data['invoice_entries']    = json_encode($invoice_entries);

        $this->db->insert('invoice', $data);
    }
    
    function check_avilabiltiy_of_product($data)
    {
    	 for($i=0;$i<count($data['quantity']);$i++){
    	 	
    	 	$medicine_id = $data['medicine_id'][$i];
    	 	$quantity = $data['quantity'][$i];
    	 	$this->db->select('quantity');
    	 	$this->db->from('medicine');
    	 	$this->db->where('medicine.medicine_id',$medicine_id);
    	 	$query = $this->db->get();
    	 	if($query->num_rows() != 0)
    	 	{
    	 		$data = $query->result_array();
    	 		if($data[0]['quantity'] >= $quantity){
    	 			return $query->result_array();
    	 		}else{
    	 			return false;
    	 		}
    	 	
    	 	}
    	 	else
    	 	{
    	 		return false;
    	 	}
    	 }
    }
    
    function select_invoice_info()
    {
    	
    	
    	
    	
    	
    	
    	$doctor_id = $this->session->userdata('login_user_id');
    	 
    	$query = $this->db->get('invoice');
    	$this->db->select('d.vat_percentage,d.service_tax,p.name          patient_name,p.patient_id,i.fees,i.total_amount,i.invoice_number,i.invoice_id,i.title,i.creation_timestamp,i.due_timestamp,i.status,im.price,im.quantity,m.name');
    	$this->db->from('invoice i');
    	$this->db->join('patient p', 'p.patient_id=i.patient_id', 'left');
    	$this->db->join('invoice_medicine im', 'im.invoice_id=i.invoice_id', 'left');
    	$this->db->join('doctor d', 'd.doctor_id=i.doctor_id', 'left');
    	$this->db->join('medicine m', 'm.medicine_id=im.medicine_id', 'left');
        $this->db->join('medicine_category mc', 'mc.medicine_category_id=m.medicine_category_id', 'left');
        $this->db->join('medicine_sub_category ms', 'ms.id=m.medicine_sub_category_id', 'left');
        $this->db->group_by('i.invoice_id');
    	$this->db->where('i.doctor_id', $doctor_id);
        $this->db->order_by("i.invoice_id","desc");
if(isset($_POST['medicine_category']) && !empty($_POST['medicine_category'])){
    		$this->db->where('mc.medicine_category_id', $_POST['medicine_category']);
    		
    	}
if(isset($_POST['medicine_sub_category']) && !empty($_POST['medicine_sub_category'])){
    		
    	  $this->db->where('ms.id', $_POST['medicine_sub_category']);	
    	}
if(isset($_POST['brand_name']) && !empty($_POST['brand_name'])){
    		
    		 $this->db->where('m.manufacturing_company', $_POST['brand_name']);
    		
    	}
if(isset($_POST['supplier']) && !empty($_POST['supplier'])){
    		
    		$this->db->where('m.supplier_id', $_POST['supplier']);
    		
    	}
    	$query = $this->db->get();
    	if($query->num_rows() != 0)
    	{


    		return $query->result_array();
    	}
    	else
    	{
    		return false;
    	}
    	
        
    }

    
    
    function select_supplier_info($login_user_id = "",$login_type = "")
    {
    	if($login_user_id != FALSE && $login_type !=  FALSE){
    		switch ($login_type) {
    			case "doctor":
    				$this->db->select('*');
			    	$this->db->from('supplier');
			    	$this->db->where('doctor_id',$login_user_id);
$this->db->order_by("id", "desc");
$this->db->where('doctor_id',$login_user_id);$this->db->order_by("id", "desc");
			    	$query = $this->db->get();
			    	return $query->result_array();
    				break;
    			case "sub_doctor":
    				$this->db->select('*');
			    	$this->db->from('supplier');
			    	$this->db->where('user_id',$login_user_id);

			    	$query = $this->db->get();
			    	return $query->result_array();
    				break;
    		}
    		
    		
    		
    	}
    }
    
    function select_invoice_info_by_patient_id()
    {
$this->db->select('*');
    	$this->db->from('invoice');
    	$this->db->where('patient_id',$this->session->userdata('login_user_id'));
$this->db->order_by("invoice_id", "desc");
    	$query = $this->db->get();
    	return $query->result_array();
       
    }

    function update_invoice($invoice_id)
    {
        $data = array(
    				"title" => $this->input->post('title'),
    				"fees" => $this->input->post('fees'),
    				"patient_id" => $this->input->post('patient_id'),
    				"creation_timestamp" => $this->input->post('creation_timestamp'),
    				"due_timestamp" => $this->input->post('due_timestamp'),
    				"total_amount" => $this->input->post('total_amount'),
    				"status" => $this->input->post('status'),
    		);
    		
        

        $invoice_entries            = array();
        $descriptions               = $this->input->post('entry_description');
        $amounts                    = $this->input->post('entry_amount');
        $number_of_entries          = sizeof($descriptions);
        
        for ($i = 0; $i < $number_of_entries; $i++)
        {
            if ($descriptions[$i] != "" && $amounts[$i] != "")
            {
                $new_entry          = array('description' => $descriptions[$i], 'amount' => $amounts[$i]);
                array_push($invoice_entries, $new_entry);
            }
        }
        $data['invoice_entries']    = json_encode($invoice_entries);

        $this->db->where('invoice_id', $invoice_id);
        $this->db->update('invoice', $data);
        
    	for($i=0;$i<count($_POST["quantity"]);$i++){
	    		$quantity = $this->input->post('quantity');
	    		$price = $this->input->post('price');
	    		$medicine_id = $this->input->post('medicine_id');
	    		$medicine_invoice_id = $this->input->post('medicine_invoice_id');
	    		$data1 = array(
	    				"quantity" => $quantity[$i],
	    				"price" => $price[$i],
	    				"medicine_id" => $medicine_id[$i],
	    		);
	    		 
	    		$this->db->where('id', $medicine_invoice_id[$i]);
	    		$query = $this->db->update('invoice_medicine', $data1);
	    		if ($query !== FALSE)
	    		{
	    		
	    			$this->db->set('quantity','`quantity` - '. $quantity[$i], FALSE); //value that used to update column
	    			$this->db->where('medicine_id', $medicine_id[$i]); //which row want to upgrade
	    			$this->db->update('medicine');
	    			$this->session->set_flashdata('message', get_phrase('invoice_info_saved_successfuly'));
	    		}
	    		else
	    		{
	    			echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message();
	    		}
	    	}
	    		
	    	}
    function delete_invoice($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice');
    }
    

    function calculate_invoice_total_amount($invoice_number)
    {
        $total_amount           = 0;
        $invoice                = $this->db->get_where('invoice', array('invoice_number' => $invoice_number))->result_array();
        foreach ($invoice as $row)
        {
            $invoice_entries    = json_decode($row['invoice_entries']);
            foreach ($invoice_entries as $invoice_entry)
                $total_amount  += $invoice_entry->amount;

            $vat_amount         = $total_amount * $row['vat_percentage'] / 100;
            $grand_total        = $total_amount + $vat_amount - $row['discount_amount'];
        }

        return $grand_total;
    }

  

    //////system settings//////
    function update_system_settings() {
        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('buyer');
        $this->db->where('type', 'buyer');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('purchase_code');
        $this->db->where('type', 'purchase_code');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description'] = $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);
    }
    
    // SMS settings.
    function update_sms_settings() {
        
        $data['description'] = $this->input->post('clickatell_user');
        $this->db->where('type', 'clickatell_user');
        $this->db->update('settings', $data);
        
        $data['description'] = $this->input->post('clickatell_password');
        $this->db->where('type', 'clickatell_password');
        $this->db->update('settings', $data);
        
        $data['description'] = $this->input->post('clickatell_api_id');
        $this->db->where('type', 'clickatell_api_id');
        $this->db->update('settings', $data);
    }

    /////creates log/////
    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }
    
    function save_department_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['description']    = $this->input->post('description');
        
        $this->db->insert('department',$data);
    }
    
    function select_department_info()
    {
        return $this->db->get('department')->result_array();
    }
    
    function update_department_info($department_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['description'] 	= $this->input->post('description');
        
        $this->db->where('department_id',$department_id);
        $this->db->update('department',$data);
    }
    
    function delete_department_info($department_id)
    {
        $this->db->where('department_id',$department_id);
        $this->db->delete('department');
    }
    
    function save_doctor_info($admin_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = base64_encode($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
$data['alternate_contact_no1']          = $this->input->post('alternate_contact_no1');
$data['alternate_contact_no2']          = $this->input->post('alternate_contact_no2');
$data['website_name']          = $this->input->post('website_name');
 $data['role']          = "Doctor";
$data['payment_amount']          = $this->input->post('payment_amount');
$data['payment_by']          = $this->input->post('payment_by');

         $data['admin_id']          = $admin_id;

        $data['registration_no'] 	= $this->input->post('registration_no');
$data['state_council_registration_no'] 	= $this->input->post('state_council_registration_no');
        $data['clinic_name'] 	= $this->input->post('clinic_name');
        $data['vat_percentage'] 	= $this->input->post('vat_percentage');
        $data['service_tax'] 	= $this->input->post('service_tax');
        $data['website_name'] 	= $this->input->post('website_name');
        
        
if ( isset( $_FILES["clinic_image"] ) && !empty( $_FILES["clinic_image"]["name"] ) ) {
   $timestamp = time();
        	move_uploaded_file($_FILES["clinic_image"]["tmp_name"], "uploads/doctor_image/" . $_FILES["clinic_image"]["name"]. '_'. $timestamp . '.jpg');
        	$data['clinic_image'] 	= $_FILES["clinic_image"]["name"] . '_'.$timestamp . '.jpg';
        	
        	
  }
if ( isset( $_FILES["image"] ) && !empty( $_FILES["image"]["name"] ) ) {
   $timestamp = time();
        	move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/doctor_image/" . $_FILES["image"]["name"]. '_'. $timestamp . '.jpg');
        	$data['profile_image'] 	= $_FILES["image"]["name"] . '_' .$timestamp . '.jpg';
        	
        	
  }


        
        
        
       $insert =  $this->db->insert('doctor',$data);
       $doctor_last_inserted_id = $this->db->insert_id();

      if($insert !== FALSE){
$date_time = $this->db->get_where('doctor', array('doctor_id' => $doctor_last_inserted_id))->row()->created_at;
$email_message = '<!DOCTYPE html>
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
			<table width="700" border="0" cellspacing="0" cellpadding="0">
    	
				<!-- Hero -->
    	
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
    	
								<td>
					
    	
									<div style="padding-bottom:0px;margin-bottom:20px;margin-top:35px;">
										<img src="'. base_url() .'assets/images/payment_image1.jpg" width="100%" height="auto;">
									</div>
									<div style="padding-bottom: 5px;padding-top: 10px;background-color:#ffc000;">
											<div style="color:#fff;text-align:center;font-size:18px;font-weight:600;">Dr. '. $this->input->post('name') .'</div>
											<div style="color:#fff;text-align:center;font-size:14px;font-weight:600;">Buyed Your Software!</div>
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
					<td class="img" valign="top" style="padding: 10px;font-size:0pt;width:100%;line-height:0pt; text-align:left">
						<div style="font-size:50px;font-weight:600;width: 530px;margin-top:60px;color:#c00000;height: auto;margin: 0 auto;border: 2px solid #6600cc;border-radius: 8px;background-color:#f2f2f2;">
						<div style="background-color:#6600cc;width:100%;height: 60px;color: #fff;font-size:18px;line-height: 3.5;padding-left: 14px;box-sizing: border-box;border-top-left-radius: 5px;border-top-right-radius: 5px;">
						Payment Receipt
						</div>
    	
						<div style="background-color: #ffffff;width: 400px;padding: 15px;margin: 0 auto;margin-top: 25px;border-radius: 7px;border: 2px solid #bfbfbf;text-align: center;">
							<div style="margin-top:20px;margin-bottom:0px;font-size:14px;color:#595959;">Thank you for the payment!</div>
							<div style="margin-top:20px;margin-bottom:20px;font-size:14px;color:#595959;">Your request was submitted for Pet Software!</div>
				
						</div>
    	
						<div style="background-color: #ffffff;width: 400px;padding: 15px;margin: 0 auto;margin-top: 10px;border-radius: 7px;border: 2px solid #bfbfbf;text-align: center;font-size:14px;">
							<table style="width:100%;border-collapse:collapse;">
								<caption style="padding:15px;background-color:#fff;border:1px solid #8064a2;color: #6600cc;">Dr. '. $this->input->post('name') .'</caption>
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;"></th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;"></td>
								</tr>
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#fff;border:1px solid #8064a2;">Order ID</th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#fff;border:1px solid #8064a2;">' . $this->input->post('order_id') .'</td>
								</tr>
    	
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;">Date & Time</th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;">' . $date_time .'</td>
								</tr>
    	
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#fff;border:1px solid #8064a2;">Mobile Number</th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#fff;border:1px solid #8064a2;">'.$this->input->post('phone').'</td>
								</tr>
    	
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;">Amount Paid(Rs.)</th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;">'.$this->input->post('payment_amount') .' (Rs.)</td>
								</tr>
    	
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#fff;border:1px solid #8064a2;">Mode Of Payment</th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#fff;border:1px solid #8064a2;">'.$this->input->post('payment_by').'</td>
								</tr>
    	
								<tr>
									<th style="color:#000000;text-align:right;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;"></th>
									<td style="color:#000000;text-align:left;width:50%;padding:15px;background-color:#e6e0ec;border:1px solid #8064a2;"></td>
								</tr>
							</table>
				
						</div>
						<div style="line-height:1.5;width: 400px;padding: 15px;margin: 0 auto;margin-top: 10px;text-align: center;font-size:14px;">
							<p style="font-size:13px;color:#000;">For Any Issues Regarding Your Payment,</p>
							<p style="font-size:13px;color:#000;">Call On +91 9011 855 666</p>
							<p style="font-size:13px;color:#000;">or e-mail us at <a href="#" style="color:#0000ff;">info@discovermypet.in</a>.</p>
							<p style="font-size:13px;color:#000;">We wish for the best experience!</p>
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
				<td>
					<div style="margin-top: 30px !important;color:#c4c4c4 !important;margin:10px;font-size: 14px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
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
	</style>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body class="body" style="font-family:\'open sans\' !important;padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
	<tr>
	
		<td align="center" valign="top">
			<table width="800" border="0" cellspacing="0" cellpadding="0">
				
				<!-- Hero -->
				<tr>
					<td class="img" style="font-size:0pt; line-height:0pt; text-align:left">
						<a href="#" target="_blank"><img src="'. base_url() .'assets/images/1.png" alt="" border="0" width="800" height="auto" /></a>
					</td>
				</tr>
				<!-- END Hero -->
				<!-- Content -->
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								
								<td>
									

									<div style="padding: 0px 10px;margin-top:20px;padding-bottom: 30px;">
									<div class="h2" style="color:#1f1f1f; font-size:20px;margin-bottom:20px; line-height:24px; font-weight:bold;text-center;">
											<div style="font-weight: 600;color: #000000;font-size: 20px; text-align:center;">Dr. '. $this->input->post('name') .'</div>
										</div>
										<div class="h2" style="color:#1f1f1f; font-size:20px; line-height:24px; font-weight:bold">
											<div style="font-weight: 600;color: #002060;font-size: 20px;">Thank You For Choosing Discover My Pet <sup>TM</sup></div>
										</div>
										
										<div class="h2" style="color:#1f1f1f; margin-top: 15px; font-size:13px; line-height:24px;">
											<div style="font-weight: 500;color: #002060;font-size: 14px;"><i style="margin-right:3px;">Congratulations!</i> Your pet management software is now activated and ready to use. To access this software, visit <a href="http://www.discovermypet/vet.in" style="color:#0000ff">www.discovermypet/vet.in</a> & login with the below details:</div>
										</div>
										
										<div class="h2" style="color:#1f1f1f; margin-top: 15px; font-size:13px; line-height:24px;">
											<div style="font-weight: 600;color: #002060;font-size: 14px;">Login ID: '.  $this->input->post('email').'</div>
											<div style="font-weight: 600;color: #002060;font-size: 14px;">Password: '.  $this->input->post('password') .'</div>
										</div>
										
										<div class="h2" style="color:#1f1f1f; margin-top: 15px; font-size:13px; line-height:24px;">
											<div style="font-weight: 500;color: #002060;font-size: 14px;">Our customer executive will provide you with a free demo for the usage. In case of any query, contact Discover My Pet<sup>TM</sup> at +91 9011 855 666 or email us at <a href="#" style="color:#0000ff;">info@discovermypet.in</a>!</div>
										</div>
										
										<div class="h2" style="color:#1f1f1f; margin-top: 15px; font-size:13px; line-height:24px;">
											<div style="font-weight: 400;color: #000000;font-size: 14px;">Kind Regards,</div>
											<div style="font-weight: 600;color: #000000;font-size: 14px;">Discover My Pet<sup style="color:#002060;">TM</sup> Team</div>
											<div style="font-weight: 400;color: #000000;font-size: 14px;">304, Amit Samruddhi Apartment,</div>
											<div style="font-weight: 400;color: #000000;font-size: 14px;">Opp. Balgandharv Rangmandir Police Station,</div>
											<div style="font-weight: 400;color: #000000;font-size: 14px;">Pune, India- 411004</div>
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
						<a href="#" target="_blank"><img src="'. base_url() .'assets/images/2.png" alt="" border="0" width="800" height="auto" /></a>
					</td>
				</tr>
				<tr>
				<td style="width:100%">
					<div style="color:#c4c4c4 !important;margin: 20px 0px;font-size: 14px;margin-bottom:30px;border:1px solid #f2f2f2;padding:10px">
											DISCLAIMER: This message, including any attachments may contain proprietary, confidential and privileged information for the sole use of the intended recipient(s),
and is protected by law. If you are not the intended recipient, please notify the sender immediately and destroy all copies of the original message and attachments, if any.
Any unauthorized review, use, disclosure, dissemination, forwarding, printing or copying of this email or any action taken in reliance on this e-mail is strictly prohibited and
may be unlawful. Discover My Pet TM  reserves the right to record, monitor and inspect all email communications through its internal and external networks.
Your messages can be subject to such lawful supervision as Discover My Pet TM deems necessary in order to protect their information, interests and reputation.
Discover My Pet TM  prohibits and may take steps to prevent their information systems from being used to view, store or forward offensive or discriminatory
material. If this message contains such material, please report it to  info@discovermypet.in. 
Please ensure you have adequate virus protection before you open or detach any documents from this transmission.
Discover My Pet <sup>TM</sup>  does not accept any liability for viruses.

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
       $doctor_sms_message = 'Thankyou for choosing VetNex Clinic Management Software! Amount payed: Rs.'. $this->input->post('payment_amount');

        $admin_sms_message = 'Dr. '.$this->input->post('name').' has taken VetNex.in. Amount payed: Rs. '.$this->input->post('payment_amount') .'.';

        $admin_email = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->email;

       $admin_phone = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->phone;

       $this->email_model->doctor_registration_email($message,$this->input->post('email'));

       $this->email_model->payment_received($email_message,$this->input->post('email'));

       $this->email_model->payment_received($email_message,$admin_email);

            $this->sms_model->sms($doctor_sms_message,$this->input->post('phone'));

            $this->sms_model->sms($admin_sms_message, $admin_phone);
      
      }
        
        $doctor_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/doctor_image/" . $doctor_id . '.jpg');
    }

    
    function select_doctor_info()
    {
        return $this->db->get('doctor')->result_array();
    }
 function select_doctor_info_by_admin()
    {
    	
$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('admin_id',$this->session->userdata('admin_login'));
$this->db->order_by("id", "desc");
    	$query = $this->db->get();
    	$query2 = $query->result_array();

        $this->db->from('doctor');
    	$this->db->where('admin_id',$this->session->userdata('admin_login'));
$this->db->order_by("doctor_id", "desc");
    	$query = $this->db->get();
    	$query1 = $query->result_array();

    	

        $appended = array_merge($query1,$query2);
        return $appended ;
    }
    
	function update_doctor_info($doctor_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
 $data['alternate_contact_no1']          = $this->input->post('alternate_contact_no1');
 $data['alternate_contact_no2']          = $this->input->post('alternate_contact_no2');
        $data['profile'] 	= $this->input->post('profile');
           $data['registration_no'] 	= $this->input->post('registration_no');
$data['state_council_registration_no'] 	= $this->input->post('state_council_registration_no');
        $data['clinic_name'] 	= $this->input->post('clinic_name');
        $data['vat_percentage'] 	= $this->input->post('vat_percentage');
        $data['service_tax'] 	= $this->input->post('service_tax');
        $data['website_name'] 	= $this->input->post('website_name');
 $data['payment_amount'] 	= $this->input->post('payment_amount');
 $data['payment_by'] 	= $this->input->post('payment_by');
        
        $this->db->where('doctor_id',$doctor_id);
        $this->db->update('doctor',$data);
if ( isset( $_FILES["clinic_image"] ) && !empty( $_FILES["clinic_image"]["name"] ) ) {
   $timestamp = time();
        	move_uploaded_file($_FILES["clinic_image"]["tmp_name"], "uploads/doctor_image/" .$_FILES["clinic_image"]["name"] . '_'. $timestamp . '.jpg');
        	$data['clinic_image'] 	= $_FILES["clinic_image"]["name"] . '_'. $timestamp . '.jpg';
        	
        	$this->db->where('doctor_id',$doctor_id);
        	$this->db->update('doctor',$data);
  }
if ( isset( $_FILES["image"] ) && !empty( $_FILES["image"]["name"] ) ) {
   $timestamp = time();
        	move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/doctor_image/" .$_FILES["image"]["name"] . '_'. $timestamp . '.jpg');
        	$data['profile_image'] 	= $_FILES["image"]["name"] . '_'. $timestamp . '.jpg';
        	
        	$this->db->where('doctor_id',$doctor_id);
        	$this->db->update('doctor',$data);
  }

       
          
        
    }
function update_user_info($doctor_id)
    {
    	$data['name'] 		= $this->input->post('name');
    	$data['email'] 		= $this->input->post('email');
    	$data['address'] 	= $this->input->post('address');
    	$data['phone']          = $this->input->post('phone');
    	$data['role'] 	= $this->input->post('role');
    	
    	$data['profile'] 	= $this->input->post('profile');
    	
    
    	$this->db->where('id',$doctor_id);
    	$this->db->update('users',$data);
    
    	move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/doctor_image/" . $doctor_id . '.jpg');
    }
    
    function update_patient_profile_info($patient_id)
    {
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
	    		
                       $data['parent_address']       = $this->input->post('parent_address');
	    		
	    		$data['phone']          = $this->input->post('parent_contact_no');
			
	    		$data['blood_group'] 	= $this->input->post('blood_group');
        
        $this->db->where('patient_id',$patient_id);
        $this->db->update('patient',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');
    }
    
    function delete_doctor_info($doctor_id)
    {
        $this->db->where('doctor_id',$doctor_id);
        $this->db->delete('doctor');
        
        $this->db->where('doctor_id',$doctor_id);
        $this->db->delete('patient');
    }
    
    
    function select_patient_info()
    {
        return $this->db->get('patient')->result_array();
    }
    
    function select_patient_info_by_patient_id( $patient_id = '' )
    {
        return $this->db->get_where('patient', array('patient_id' => $patient_id))->result_array();
    }
            
    
    function delete_patient_info($patient_id)
    {
        $this->db->where('patient_id',$patient_id);
        $this->db->delete('patient');
    }
    
    function save_nurse_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = base64_encode($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('nurse',$data);
        
        $nurse_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/nurse_image/" . $nurse_id . '.jpg');
    }
    
    function select_nurse_info()
    {
        return $this->db->get('nurse')->result_array();
    }
    
    function update_nurse_info($nurse_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('nurse_id',$nurse_id);
        $this->db->update('nurse',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/nurse_image/" . $nurse_id . '.jpg');
    }
    
    function delete_nurse_info($nurse_id)
    {
        $this->db->where('nurse_id',$nurse_id);
        $this->db->delete('nurse');
    }
    
    function save_pharmacist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = base64_encode($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('pharmacist',$data);
        
        $pharmacist_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/pharmacist_image/" . $pharmacist_id . '.jpg');
    }
    
    function select_pharmacist_info()
    {
        return $this->db->get('pharmacist')->result_array();
    }
    
    function update_pharmacist_info($pharmacist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('pharmacist_id',$pharmacist_id);
        $this->db->update('pharmacist',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/pharmacist_image/" . $pharmacist_id . '.jpg');
    }
    
    function delete_pharmacist_info($pharmacist_id)
    {
        $this->db->where('pharmacist_id',$pharmacist_id);
        $this->db->delete('pharmacist');
    }
    
    function save_laboratorist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = base64_encode($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('laboratorist',$data);
        
        $laboratorist_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/laboratorist_image/" . $laboratorist_id . '.jpg');
    }
    
    function select_laboratorist_info()
    {
        return $this->db->get('laboratorist')->result_array();
    }
    
    function update_laboratorist_info($laboratorist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('laboratorist_id',$laboratorist_id);
        $this->db->update('laboratorist',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/laboratorist_image/" . $laboratorist_id . '.jpg');
    }
    
    function delete_laboratorist_info($laboratorist_id)
    {
        $this->db->where('laboratorist_id',$laboratorist_id);
        $this->db->delete('laboratorist');
    }
    
    function save_accountant_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = base64_encode($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('accountant',$data);
        
        $accountant_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/accountant_image/" . $accountant_id . '.jpg');
    }
    
    function select_accountant_info()
    {
        return $this->db->get('accountant')->result_array();
    }
    
    function update_accountant_info($accountant_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('accountant_id',$accountant_id);
        $this->db->update('accountant',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/accountant_image/" . $accountant_id . '.jpg');
    }
    
    function delete_accountant_info($accountant_id)
    {
        $this->db->where('accountant_id',$accountant_id);
        $this->db->delete('accountant');
    }
    
    function save_receptionist_info()
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['password']       = base64_encode($this->input->post('password'));
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->insert('receptionist',$data);
        
        $receptionist_id  =   $this->db->insert_id();
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/receptionist_image/" . $receptionist_id . '.jpg');
    }
    
    function select_receptionist_info()
    {
        return $this->db->get('receptionist')->result_array();
    }
    
    function update_receptionist_info($receptionist_id)
    {
        $data['name'] 		= $this->input->post('name');
        $data['email'] 		= $this->input->post('email');
        $data['address'] 	= $this->input->post('address');
        $data['phone']          = $this->input->post('phone');
        
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->update('receptionist',$data);
        
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/receptionist_image/" . $receptionist_id . '.jpg');
    }
    
    function delete_receptionist_info($receptionist_id)
    {
        $this->db->where('receptionist_id',$receptionist_id);
        $this->db->delete('receptionist');
    }
    
    function save_bed_allotment_info()
    {
        $data['bed_id']                 = $this->input->post('bed_id');
        $data['patient_id'] 		    = $this->input->post('patient_id');
        $data['allotment_date'] 	= strtotime($this->input->post('allotment_date'));
        $data['allotment_time'] 	= strtotime($this->input->post('allotment_time'));
        $data['discharge_date']    = strtotime($this->input->post('discharge_date'));
        $data['discharge_time']    = strtotime($this->input->post('discharge_time'));
        
        $this->db->insert('bed_allotment',$data);
    }
    
    function select_bed_allotment_info()
    {
        return $this->db->get('bed_allotment')->result_array();
    }
    
    function update_bed_allotment_info($bed_allotment_id)
    {
        $data['bed_id']                 = $this->input->post('bed_id');
        $data['patient_id'] 		= $this->input->post('patient_id');
        $data['allotment_timestamp'] 	= strtotime($this->input->post('allotment_timestamp'));
        $data['discharge_timestamp']    = strtotime($this->input->post('discharge_timestamp'));
        
        $this->db->where('bed_allotment_id',$bed_allotment_id);
        $this->db->update('bed_allotment',$data);
    }
    
    function delete_bed_allotment_info($bed_allotment_id)
    {
        $this->db->where('bed_allotment_id',$bed_allotment_id);
        $this->db->delete('bed_allotment');
    }
    
    function select_blood_bank_info()
    {
        return $this->db->get('blood_bank')->result_array();
    }
    
    function update_blood_bank_info($blood_group_id)
    {
        $data['status']    = $this->input->post('status');
        
        $this->db->where('blood_group_id',$blood_group_id);
        $this->db->update('blood_bank',$data);
    }
    
    
    function select_report_info()
    {
        return $this->db->get('report')->result_array();
    }
    
    function update_report_info($report_id)
    {
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['patient_id']     = $this->input->post('patient_id');
        $data['parent_name']     = $this->input->post('parent_name');
        if(isset($_POST['death_location']) && isset($_POST['death_location'])){
        	$data['death_location']     = $this->input->post('death_location');
        	$data['death_reason']     = $this->input->post('death_reason');
        }
        
        $login_type             = $this->session->userdata('login_type');
        if($login_type=='nurse')
            $data['doctor_id']  = $this->input->post('doctor_id');
        else $data['doctor_id'] = $this->session->userdata('login_user_id');
        
        $this->db->where('report_id',$report_id);
        $this->db->update('report',$data);
    }
    
    function delete_report_info($report_id)
    {
        $this->db->where('report_id',$report_id);
        $this->db->delete('report');
    }
    
    function save_bed_info()
    {
        $data['bed_number']     = $this->input->post('bed_number');
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        
        $this->db->insert('bed',$data);
    }
    
    function select_bed_info()
    {
        return $this->db->get('bed')->result_array();
    }
    
    function update_bed_info($bed_id)
    {
        $data['bed_number']     = $this->input->post('bed_number');
        $data['type'] 		= $this->input->post('type');
        $data['description']    = $this->input->post('description');
        
        $this->db->where('bed_id',$bed_id);
        $this->db->update('bed',$data);
    }
    
    function delete_bed_info($bed_id)
    {
        $this->db->where('bed_id',$bed_id);
        $this->db->delete('bed');
    }
    
    
    function select_blood_donor_info()
    {
        return $this->db->get('blood_donor')->result_array();
    }
    
    function update_blood_donor_info($blood_donor_id)
    {
        $data['name']                       = $this->input->post('name');
        $data['email']                      = $this->input->post('email');
        $data['address']                    = $this->input->post('address');
        $data['phone']                      = $this->input->post('phone');
        $data['sex']                        = $this->input->post('sex');
        $data['age']                        = $this->input->post('age');
        $data['blood_group']                = $this->input->post('blood_group');
        $data['last_donation_timestamp']    = strtotime($this->input->post('last_donation_timestamp'));
        
        $this->db->where('blood_donor_id',$blood_donor_id);
        $this->db->update('blood_donor',$data);
    }
    
    function delete_blood_donor_info($blood_donor_id)
    {
        $this->db->where('blood_donor_id',$blood_donor_id);
        $this->db->delete('blood_donor');
    }
    
    function select_medicine_category_info()
    {
        return $this->db->get('medicine_category')->result_array();
    }
    
    function select_medicine_sub_category_info()
    {
    	$query = $this->db->get('medicine_sub_category');
    	$this->db->select('ms.id,ms.user_id,ms.doctor_id,ms.name,mc.medicine_category_id');
    	$this->db->from('medicine_sub_category ms');
    	$this->db->join('medicine_category mc', 'ms.medicine_category_id= mc.medicine_category_id', 'left');
    	$this->db->where('ms.user_id',$this->session->userdata('login_user_id'));
    	$query = $this->db->get();
    	if($query->num_rows() != 0)
    	{
    		return $query->result_array();
    	}
    	else
    	{
    		return false;
    	}
    }
    
    function update_medicine_category_info($medicine_category_id)
    {
        $data['name'] 		= $this->input->post('name');
        
        $this->db->where('medicine_category_id',$medicine_category_id);
        $this->db->update('medicine_category',$data);
    }
    function update_medicine_sub_category_info($medicine_sub_category_id)
    {
        $data['name'] 		= $this->input->post('name');
        
        $this->db->where('id',$medicine_sub_category_id);
        $this->db->update('medicine_sub_category',$data);
    }
    
    function delete_medicine_category_info($medicine_category_id)
    {
        $this->db->where('medicine_category_id',$medicine_category_id);
        $this->db->delete('medicine_category');
    }
    function delete_medicine_sub_category_info($medicine_sub_category_id)
    {
        $this->db->where('id',$medicine_sub_category_id);
        $this->db->delete('medicine_sub_category');
    }
    
    function select_medicine_info($login_type = "")
    {
    	if($login_type == 'doctor'){
    		$this->db->where('doctor_id',$this->session->userdata('login_user_id'));
       	 	return $this->db->get('medicine')->result_array();
    	}
    	else if($login_type == 'sub_doctor' || $login_type == 'kennel' || $login_type == 'groomer' || $login_type == 'trainers' || $login_type == 'breeder' || $login_type == 'ambulance_service' || $login_type == 'pet_relocation' || $login_type == 'pet_bakery'  || $login_type == 'obituary' || $login_type == 'ambulance_services' || $login_type == 'restaurants'){
    		$this->db->where('user_id',$this->session->userdata('login_user_id'));
       	 	return $this->db->get('medicine')->result_array();
    	}
    }
    
    function update_medicine_info($medicine_id)
    {
        $data['name']                   = $this->input->post('name');
        $data['medicine_category_id']   = $this->input->post('medicine_category_id');
        $data['medicine_sub_category_id']   = $this->input->post('medicine_sub_category_id');
        $data['description']            = $this->input->post('description');
        $data['quantity']                  = $this->input->post('quantity');
        $data['price']                  = $this->input->post('price');
        $data['manufacturing_company']  = $this->input->post('manufacturing_company');
        $data['supplier_id']  = $this->input->post('supplier_id');
        
        $this->db->where('medicine_id',$medicine_id);
        $this->db->update('medicine',$data);
    }
    
    function delete_medicine_info($medicine_id)
    {
        $this->db->where('medicine_id',$medicine_id);
        $this->db->delete('medicine');
    }
    
  
    
    function save_requested_appointment_info()
    {
        
        if($this->input->post('doctor_id') != ""){
        	$data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        	$data['doctor_id']  = $this->input->post('doctor_id');
        	$data['patient_id'] = $this->session->userdata('login_user_id');
        	$data['status']     = 'pending';
        	$data['appointment_type']     =  $this->input->post('appointment_type');
        	$data['bording_number']     =  $this->input->post('bording_number');
        	
        	$this->db->insert('appointment',$data);
        	
        }else{
        	$data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        	$data['doctor_id']  = $this->session->userdata('doctor_id');
        	$data['user_id']  = $this->input->post('user_id');
        	$data['patient_id'] = $this->session->userdata('login_user_id');
        	$data['status']     = 'pending';
        	$data['appointment_type']     =  $this->input->post('appointment_type');
        	$data['bording_number']     =  $this->input->post('bording_number');
        	
        	$this->db->insert('appointment',$data);
        }
    }
    
    function select_appointment_info_by_doctor_id()
    {
    	 
    	
        $doctor_id = $this->session->userdata('login_user_id');
        
        $this->db->order_by("appointment_id","desc");
        $this->db->where('doctor_id' , $doctor_id);
        $this->db->where('status' , 'approved');

        if (isset($_POST["appointment_type"]) && !empty($_POST["appointment_type"])) {
           $this->db->where('appointment_type' , $_POST["appointment_type"]);
        
        }else{
        	
        }
        if (isset($_POST["selected_patient"]) && !empty($_POST["selected_patient"])) {
        	$this->db->where('patient_id' ,  $_POST["selected_patient"]);
        
        }
       
        
        return $this->db->get('appointment')->result_array();
    }
    
    function select_appointment_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'approved'))->result_array();
    }
    
    function select_appointment_info($doctor_id = '', $start_timestamp = '', $end_timestamp = '')
    {
        $response = array();
        if($doctor_id == 'all') {
            $this->db->order_by('doctor_id', 'asc');
            $this->db->order_by('timestamp', 'desc');
            $appointments = $this->db->get_where('appointment', array('status' => 'approved'))->result_array();
            foreach ($appointments as $row) {
                if($row['timestamp'] >= $start_timestamp && $row['timestamp'] <= $end_timestamp)
                    array_push ($response, $row);
            }
        }
        else {
            $this->db->order_by('timestamp', 'desc');
            $appointments = $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'approved'))->result_array();
            foreach ($appointments as $row) {
                if($row['timestamp'] >= $start_timestamp && $row['timestamp'] <= $end_timestamp)
                    array_push ($response, $row);
            }
        }
        return $response;
    }
    
    function select_pending_appointment_info_by_patient_id()
    {
        $patient_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'pending'))->result_array();
    }
    
    function select_requested_appointment_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'pending'))->result_array();
    }
    
    function select_requested_appointment_info()
    {
        $this->db->order_by('doctor_id', 'asc');
        return $this->db->get_where('appointment', array('status' => 'pending'))->result_array();
    }
    
    function select_patient_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        
        $this->db->group_by('patient_id');
        return $this->db->get_where('appointment', array('doctor_id' => $doctor_id, 'status' => 'approved'))->result_array();
    }
    
    function select_appointments_between_loggedin_patient_and_doctor()
    {
        $patient_id = $this->session->userdata('login_user_id');
        
        $this->db->group_by('doctor_id');
        return $this->db->get_where('appointment', array('patient_id' => $patient_id, 'status' => 'approved'))->result_array();
    }
    
    function update_appointment_info($appointment_id)
    {
    $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id'] = $this->input->post('patient_id');
        $data['appointment_type'] = $this->input->post('appointment_type');
        $data['bording_number'] = $this->input->post('bording_number');
        
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointment',$data);
        
    	 $notify = $this->input->post('notify');
	        if($notify != '') {
	            $patient_name   =   $this->db->get_where('patient',
	                                array('patient_id' => $data['patient_id']))->row()->name;
	            $doctor_name    =   $this->db->get_where('doctor',
	                                array('doctor_id' => $this->session->userdata('doctor_login')))->row()->name;
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
    }
    function update_event_info($event_id)
    {
        $data['event_name'] = $this->input->post('event_name');
        $data['event_date'] = $this->input->post('event_date');
        $data['event_time'] = $this->input->post('event_time');
        
        $this->db->where('event_id',$event_id);
        $this->db->update('event',$data);
    }
    
    function approve_appointment_info($appointment_id)
    {
        $data['timestamp']  = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['status']     = 'approved';
        
        if($this->session->userdata('login_type') == 'receptionist')
            $data['doctor_id'] = $this->input->post('doctor_id');
        
        $this->db->where('appointment_id',$appointment_id);
        $this->db->update('appointment',$data);
        
        // Notify patient with sms.
        $notify = $this->input->post('notify');
        if($notify != '') {
            $doctor_id      =   $this->db->get_where('appointment',
                                array('appointment_id' => $appointment_id))->row()->doctor_id;
            $patient_id     =   $this->db->get_where('appointment',
                                array('appointment_id' => $appointment_id))->row()->patient_id;
            $patient_name   =   $this->db->get_where('patient',
                                array('patient_id' => $patient_id))->row()->name;
            $doctor_name    =   $this->db->get_where('doctor',
                                array('doctor_id' => $doctor_id))->row()->name;
            $date           =   date('l, d F Y', $data['timestamp']);
            $time           =   date('g:i a', $data['timestamp']);
            $message        =   $patient_name . ', your requested appointment with doctor ' . $doctor_name . ' on ' . $date . ' at ' . $time . ' has been approved.';
            $receiver_phone =   $this->db->get_where('patient',
                                array('patient_id' => $patient_id))->row()->phone;
            
            $this->sms_model->send_sms($message, $receiver_phone);
        }
    }
    
    function delete_appointment_info($appointment_id)
    {
        $this->db->where('appointment_id',$appointment_id);
        $this->db->delete('appointment');
    }
    function delete_event_info($event_id)
    {
        $this->db->where('event_id',$event_id);
        $this->db->delete('event');
    }
    
    function save_prescription_info()
    {

    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	
        $data['timestamp']      = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['patient_id']     = $this->input->post('patient_id');
        $data['doctor_id']      = $this->session->userdata('login_user_id');
        
        $this->db->insert('prescription',$data);
        $insert_id = $this->db->insert_id();
        $medicine = $order = array("medicine" => array());

        for($i=0; $i<count($this->input->post('quantity'));$i++){

        
        	$quantity = $this->input->post('quantity');
        	
        	$dose = $this->input->post('dose');
        	$medicine_id = $this->input->post('medicine_id');
        	
        	$product_prescreption = array(	
        			"precreption_id" => $insert_id,
        			"quantity" => $quantity[$i],
        			"dose" => $dose[$i],
        			"medicine_id" => $medicine_id[$i],
        			"doctor_id" => $this->session->userdata('login_user_id'),
        	);
        	 
        	$query = $this->crud_model->insert('product_prescreption',$product_prescreption,$login_user_id,$login_type);
        	if ($query !== FALSE)
        	{
        	$query = $this->db->get('prescription');
    		$this->db->select('m.name product_name,pp.dose dose,pp.quantity days');
    		$this->db->from('prescription p');
    		$this->db->join('product_prescreption pp', 'p.prescription_id= pp.precreption_id', 'left');
                $this->db->join('medicine m', 'm.medicine_id= pp.medicine_id', 'left');
    		$this->db->where('p.prescription_id', $insert_id);
               
                $query = $this->db->get();
    		if($query->num_rows() != 0)
    		{
                       $data = $query->result_array();
                      $medicine['medicine'][$i]['product_name'] .= $data[$i]['product_name'];
                      $medicine['medicine'][$i]['dose'] .= $data[$i]['dose'];
                      $medicine['medicine'][$i]['days'] .= $data[$i]['days'];

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
$medicine .= ")";

$this->db->select('*');
         			$this->db->from('patient');
         			$this->db->where('verify_dog',"true");
                                $this->db->where('patient_id',$this->input->post('patient_id'));
         			$query = $this->db->get();
         			$data = $query->result_array();

if(count($data)>0){
$medicine1 = json_encode($medicine,TRUE);
  $parameter = array("action" => "add_prescription","key" => "RGlzY292ZXJNeVBldEBiYWRhbA==","medicine" => $medicine1,"pet_code" =>"D2172","post_date" => "2017-02-02","post_time" => "11:12:12");
    $result = $this->crud_model->ApiDiscoverMyPet($parameter); 
if($result->success == '1'){
   $add_prescription = array("add_prescription" => "true");
         
         $this->db->where('prescription_id', $insert_id);
        $this->db->update('prescription', $add_prescription);

}  


}

        
    }
    
    function select_prescription_info_by_doctor_id()
    {
        $doctor_id = $this->session->userdata('login_user_id');
        return $this->db->get_where('prescription', array('doctor_id' => $doctor_id))->result_array();
    }
    
    function select_medication_history( $patient_id = '' )
    {
           $this->db->select('*');
    	$this->db->from('prescription');
    	$this->db->where('patient_id',$patient_id);
$this->db->order_by("prescription_id","desc");
    	$query = $this->db->get();
    	return $query->result_array();

       
    }
    
    function select_prescription_info_by_patient_id()
    {
$this->db->select('*');
    	$this->db->from('prescription');
    	$this->db->where('patient_id',$this->session->userdata('login_user_id'));
$this->db->order_by("prescription_id", "desc");
    	$query = $this->db->get();
    	return $query->result_array();

       
    }
    
    function update_prescription_info($prescription_id)
    {
    

$data = array(
    				"timestamp" => strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') ),
    				"fees" => $this->input->post('fees'),
    				"patient_id" => $this->input->post('patient_id'),
    				
    		);
    		
        $dose = $this->input->post('dose');
        $medicine_id = $this->input->post('medicine_id');
        $quantity = $this->input->post('quantity');
 $product_prescription_id = $this->input->post('product_prescription_id');
    	for($i=0;$i<count($_POST["quantity"]);$i++){


        		
        	
        		$product_prescreption = array(
        				"quantity" => $quantity[$i],
        				"dose" => $dose[$i],
        				"medicine_id" => $medicine_id[$i],
        		);

        	        
        		

                        $this->db->where('id', $product_prescription_id[$i]);
	    		
                        $this->db->update('product_prescreption',$product_prescreption);
	    		
	    	}


       
    }
    
    function delete_prescription_info($prescription_id)
    {
        $this->db->where('prescription_id',$prescription_id);
        $this->db->delete('prescription');
    }
    
    function save_diagnosis_report_info()
    {
        $data['timestamp']          = strtotime($this->input->post('date_timestamp').' '.$this->input->post('time_timestamp') );
        $data['report_type']        = $this->input->post('report_type');
        $data['file_name']          = $_FILES["file_name"]["name"];
        $data['document_type']      = $this->input->post('document_type');
        $data['description']        = $this->input->post('description');
        $data['prescription_id']    = $this->input->post('prescription_id');
        
        $this->db->insert('diagnosis_report',$data);
        
        $diagnosis_report_id        = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/diagnosis_report/" . $_FILES["file_name"]["name"]);
    }
    
    function select_diagnosis_report_info()
    {
        return $this->db->get('diagnosis_report')->result_array();
    }
    
    function delete_diagnosis_report_info($diagnosis_report_id)
    {
        $this->db->where('diagnosis_report_id',$diagnosis_report_id);
        $this->db->delete('diagnosis_report');
    }
    
    function save_notice_info()
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        if($this->input->post('start_timestamp') != '')
            $data['start_timestamp']    = strtotime($this->input->post('start_timestamp'));
        else 
            $data['start_timestamp']    = '';
        if($this->input->post('end_timestamp') != '')
            $data['end_timestamp']      = strtotime($this->input->post('end_timestamp'));
        else
            $data['end_timestamp']      = $data['start_timestamp'];
        
        $this->db->insert('notice',$data);
    }
    
    function select_notice_info()
    {
        return $this->db->get('notice')->result_array();
    }
    
    function update_notice_info($notice_id)
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        if($this->input->post('start_timestamp') != '')
            $data['start_timestamp']    = strtotime($this->input->post('start_timestamp'));
        else 
            $data['start_timestamp']    = '';
        if($this->input->post('end_timestamp') != '')
            $data['end_timestamp']      = strtotime($this->input->post('end_timestamp'));
        else
            $data['end_timestamp']      = $data['start_timestamp'];
        
        $this->db->where('notice_id',$notice_id);
        $this->db->update('notice',$data);
    }
    
    function delete_notice_info($notice_id)
    {
        $this->db->where('notice_id',$notice_id);
        $this->db->delete('notice');
    }
    
    function send_new_private_message() {
    	if (isset($_POST["reciever"]) && !empty($_POST["reciever"])) {
    		$message    = $this->input->post('message');
    		$timestamp  = strtotime(date("Y-m-d H:i:s"));
    		
    		$reciever   = $this->input->post('reciever');
    		$sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
    		
    		//check if the thread between those 2 users exists, if not create new thread
    		$num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
    		$num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
    		
    		if ($num1 == 0 && $num2 == 0) {
    			$message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
    			$data_message_thread['message_thread_code'] = $message_thread_code;
    			$data_message_thread['sender']              = $sender;
    			$data_message_thread['reciever']            = $reciever;
    			$this->db->insert('message_thread', $data_message_thread);
    		}
    		
    		if ($num1 > 0)
    			$message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
    			if ($num2 > 0)
    				$message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
    		
    		
    				$data_message['message_thread_code']    = $message_thread_code;
    				$data_message['message']                = $message;
    				$data_message['sender']                 = $sender;
    				$data_message['timestamp']              = $timestamp;
    				$this->db->insert('message', $data_message);
    				
    				$patient_id = str_replace("patient-","" , $_POST['reciever']);
    				$this->db->where("patient_id",$patient_id);
    				$query = $this->db->get('patient');
    				if($query->num_rows() != 0)
    				{
    					    $data = $query->result_array();
    						$email = $this->email_model->sendmail_to_patient($message,$data[0]['email']);
    					
    				}
    				else
    				{
    					return false;
    				}
    				
    	}else{
    		$id=array();
    		for($i = 0; $i < count($_POST['reciever1']); ++$i) {
    			$patient_id = str_replace("patient-","" , $_POST['reciever1'][$i]);
    			array_push($id, $patient_id);
    			
    			$message    = $this->input->post('message');
    			$timestamp  = strtotime(date("Y-m-d H:i:s"));
    			
    			$reciever   = $_POST['reciever1'][$i];
    			$sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
    			
    			//check if the thread between those 2 users exists, if not create new thread
    			$num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
    			$num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
    			
    			if ($num1 == 0 && $num2 == 0) {
    				$message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
    				$data_message_thread['message_thread_code'] = $message_thread_code;
    				$data_message_thread['sender']              = $sender;
    				$data_message_thread['reciever']            = $reciever;
    				$this->db->insert('message_thread', $data_message_thread);
    			}
    			
    			if ($num1 > 0)
    				$message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
    				if ($num2 > 0)
    					$message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
    			
    			
    					$data_message['message_thread_code']    = $message_thread_code;
    					$data_message['message']                = $message;
    					$data_message['sender']                 = $sender;
    					$data_message['timestamp']              = $timestamp;
    					$this->db->insert('message', $data_message);
    			
//     					return $message_thread_code;
    		}
    		
    		$message = $this->input->post('message');
    		
    		$this->db->where_in("patient_id",$id);
    		$query = $this->db->get('patient');
    		if($query->num_rows() != 0)
    		{
    			$data = $query->result_array();
    			for ($x = 0; $x < count($data); $x++) {
    				$email = $this->email_model->sendmail_to_patient($message,$data[$x]['email']);
    			}
    		}
    		else
    		{
    			return false;
    		}
    		
    		
    	}
    	
    
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }
    
    function get_all_event_of_doctor() {
    	$doctor_id = $this->session->userdata('login_user_id');
        
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get('event');
        if($query->num_rows() != 0)
        {
        	return $query->result_array();
        }
        else
        {
        	return false;
        }
    }
    
    function select_user_info_by_user_id()
    {
    	$user_id = $this->session->userdata('login_user_id');
    	$data = $this->db->get_where('users', array('id' => '1'))->result_array();
    	return   $data;         
    }
    
    }
