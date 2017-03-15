<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	date	: 1 August, 2014
 * 	http://codecanyon.net/user/Creativeitem
 * 	http://creativeitem.com
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('sms_model');

        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /*     * *default function, redirects to login page if no admin logged in yet** */

    public function index() {
       
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
 
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    /*     * ***LANGUAGE SETTINGS******** */

    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]	=	$this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {
            $this->crud_model->update_system_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // SMS settings.
    function sms_settings($param1 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'do_update') {
            $this->crud_model->update_sms_settings();
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        $page_data['page_name'] = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $this->load->view('backend/index', $page_data);
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');

            $this->db->where('admin_id', $this->session->userdata('login_user_id'));
            $this->db->update('admin', $data);

            $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
            redirect(base_url() . 'index.php?admin/manage_profile');
        }
        if ($param1 == 'change_password') {
            $current_password_input = base64_encode($this->input->post('password'));
            $new_password = base64_encode($this->input->post('new_password'));
            $confirm_new_password = base64_encode($this->input->post('confirm_new_password'));

            $current_password_db = $this->db->get_where('admin', array('admin_id' =>
                        $this->session->userdata('login_user_id')))->row()->password;

            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', array('password' => $new_password));

                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(base_url() . 'index.php?admin/manage_profile');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(base_url() . 'index.php?admin/manage_profile');
            }
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function department($task = "", $department_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_saved_successfuly'));
            redirect(base_url() . 'index.php?admin/department');
        }

        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect(base_url() . 'index.php?admin/department');
        }

        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
            redirect(base_url() . 'index.php?admin/department');
        }

        $data['department_info'] = $this->crud_model->select_department_info();
        $data['page_name'] = 'manage_department';
        $data['page_title'] = get_phrase('department');
        $this->load->view('backend/index', $data);
    }

    function doctor($task = "", $doctor_id = "") {
    	$admin_id = $this->session->userdata('admin_login');

    	
        if ($this->session->userdata('admin_login') != 1) {
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
    			$this->session->set_flashdata('message', get_phrase('doctor_is_already_present'));
    		}else{
    			 
    			 
    			$insert = $this->crud_model->save_doctor_info($admin_id);

                     



    			$this->session->set_flashdata('message', get_phrase('doctor_info_saved_successfuly'));
    			redirect(base_url() . 'index.php?admin/doctor');
        
    		}		
        }

        if ($task == "update_doctor") {
          
                $this->crud_model->update_doctor_info($doctor_id);
                $this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
            
                redirect(base_url() . 'index.php?admin/doctor');
        }
        
        if ($task == "update_user") {
        
        	$this->crud_model->update_user_info($doctor_id);
        	$this->session->set_flashdata('message', get_phrase('user_info_updated_successfuly'));
        
        	redirect(base_url() . 'index.php?admin/doctor');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect(base_url() . 'index.php?admin/doctor');
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info_by_admin();
        $data['page_name'] = 'manage_doctor';
        $data['page_title'] = get_phrase('Doctor');
        $this->load->view('backend/index', $data);
    }

    function staff_message($task = "", $doctor_id = "", $param1 = "") {
 
    	if ($task == 'send_new') {
    		$message = $this->input->post('message');
    		$subject = $this->input->post('subject');
    		$query = $this->db->get('doctor')->result_array();
    		$query1 = $this->db->get('patient')->result_array();
    			
    			$data = $query;
    			$data1 = $query1;
    			
    			$appended = array_merge($data,$data1);
    		
    			for($i=0;$i<sizeof($appended);$i++){
    				$email = $this->email_model->sendmail_to_staff_by_admin($message,$subject,$appended[$i]['email']);
    			}
    		
    			
    			if($email == TRUE){
    				$this->session->set_flashdata('message', get_phrase('email_send_sucessfully'));
    				redirect(base_url() . 'index.php?admin/doctor/staff_message');
    			}
    			return $query->result_array();
    			
    	}
    	$data['page_name'] = 'staff_message';
    	$data['page_title'] = get_phrase('Message');
    	$this->load->view('backend/index', $data);
    
    }
    
    
    function display_doctor($task = "", $doctor_id = "") {
    	$doctor_id =  $this->uri->segment(3);
    	
    	
    	if ($task == "update") {
    	
    		$this->crud_model->update_doctor_info($doctor_id);
    		$this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
    	
    		redirect(base_url() . 'index.php?admin/doctor');
    	}
   			$data['doctor_info'] = $this->crud_model->display_doctor_user_info($doctor_id);
   			$data['staff'] = $this->crud_model->display_doctor_staff_info($doctor_id);
    	   $data['page_name'] = 'manage_sub_doctor';
    	   $data['page_title'] = get_phrase('Display');
    	   $this->load->view('backend/index', $data);
    
    }
    
    function display_user($task = "", $user_id = "") {
    
    	$user_id =  $this->uri->segment(3);
    
    	if ($task == "update") {
    		 
    		$this->crud_model->update_doctor_info($doctor_id);
    		$this->session->set_flashdata('message', get_phrase('doctor_info_updated_successfuly'));
    		 
    		redirect(base_url() . 'index.php?admin/doctor');
    	}
    
    		$data['doctor_info'] = $this->crud_model->display_user_info($user_id);
    		$data['staff'] = $this->crud_model->display_user_staff_info($user_id);
    		
	    	$data['page_name'] = 'manage_sub_doctor';
	    	$data['page_title'] = get_phrase('Display');
	    	$this->load->view('backend/index', $data);
	    
    }
    
    
function patient($task = "", $patient_id = "") {
    	$login_user_id =  $this->session->userdata('login_user_id');
    	$login_type =  $this->session->userdata('login_type');
    	 
    	if ($this->session->userdata('admin_login') != 1) {
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
	    		$data['age']            = $this->input->post('age');
	    		$data['blood_group'] 	= $this->input->post('blood_group');
	    		$this->crud_model->insert($tbl_name,$data,$login_user_id,$login_type);
	    		$patient_id  =   $this->db->insert_id();
	    		move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');
	    		$this->session->set_flashdata('message', get_phrase('new_patient_created_sucessfully'));
	    		 redirect(base_url() . 'index.php?admin/patient');
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
        
       			 move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/patient_image/" . $patient_id . '.jpg');
       			 
	    		$this->crud_model->update_patient_info($tbl_name,$data,$patient_id);
	    		$this->session->set_flashdata('message', get_phrase('patient_info_updated_sucessfully'));
	    		redirect('admin/patient');
	    	}
	    	
	    	
	    	if ($task == "delete") {
	    		$this->crud_model->delete_patient($patient_id);
	    		redirect('admin/patient');
	    	}
	    	$data['patient_info'] = $this->crud_model->select_patient_info();
	        $data['page_name'] = 'manage_patient';
	        $data['page_title'] = get_phrase('patient');
	        $this->load->view('backend/index', $data);
    }

    function nurse($task = "", $nurse_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $nurse = $this->db->get_where('nurse', array('email' => $email))->row()->name;
            if ($nurse == null) {
                $this->crud_model->save_nurse_info();
                $this->session->set_flashdata('message', get_phrase('nurse_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?admin/nurse');
        }

        if ($task == "update") {
                $this->crud_model->update_nurse_info($nurse_id);
                $this->session->set_flashdata('message', get_phrase('nurse_info_updated_successfuly'));
                redirect(base_url() . 'index.php?admin/nurse');
        }

        if ($task == "delete") {
            $this->crud_model->delete_nurse_info($nurse_id);
            redirect(base_url() . 'index.php?admin/nurse');
        }

        $data['nurse_info'] = $this->crud_model->select_nurse_info();
        $data['page_name'] = 'manage_nurse';
        $data['page_title'] = get_phrase('nurse');
        $this->load->view('backend/index', $data);
    }

    function pharmacist($task = "", $pharmacist_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $pharmacist = $this->db->get_where('pharmacist', array('email' => $email))->row()->name;
            if ($pharmacist == null) {
                $this->crud_model->save_pharmacist_info();
                $this->session->set_flashdata('message', get_phrase('pharmacist_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?admin/pharmacist');
        }

        if ($task == "update") {
                $this->crud_model->update_pharmacist_info($pharmacist_id);
                $this->session->set_flashdata('message', get_phrase('pharmacist_info_updated_successfuly'));
                redirect(base_url() . 'index.php?admin/pharmacist');
        }

        if ($task == "delete") {
            $this->crud_model->delete_pharmacist_info($pharmacist_id);
            redirect(base_url() . 'index.php?admin/pharmacist');
        }

        $data['pharmacist_info'] = $this->crud_model->select_pharmacist_info();
        $data['page_name'] = 'manage_pharmacist';
        $data['page_title'] = get_phrase('pharmacist');
        $this->load->view('backend/index', $data);
    }

    function laboratorist($task = "", $laboratorist_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $laboratorist = $this->db->get_where('laboratorist', array('email' => $email))->row()->name;
            if ($laboratorist == null) {
                $this->crud_model->save_laboratorist_info();
                $this->session->set_flashdata('message', get_phrase('laboratorist_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?admin/laboratorist');
        }

        if ($task == "update") {
                $this->crud_model->update_laboratorist_info($laboratorist_id);
                $this->session->set_flashdata('message', get_phrase('laboratorist_info_updated_successfuly'));
                redirect(base_url() . 'index.php?admin/laboratorist');
        }

        if ($task == "delete") {
            $this->crud_model->delete_laboratorist_info($laboratorist_id);
            redirect(base_url() . 'index.php?admin/laboratorist');
        }

        $data['laboratorist_info'] = $this->crud_model->select_laboratorist_info();
        $data['page_name'] = 'manage_laboratorist';
        $data['page_title'] = get_phrase('laboratorist');
        $this->load->view('backend/index', $data);
    }

    function accountant($task = "", $accountant_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $email = $_POST['email'];
            $accountant = $this->db->get_where('accountant', array('email' => $email))->row()->name;
            if ($accountant == null) {
                $this->crud_model->save_accountant_info();
                $this->session->set_flashdata('message', get_phrase('accountant_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('message', get_phrase('duplicate_email'));
            }
            redirect(base_url() . 'index.php?admin/accountant');
        }

        if ($task == "update") {
                $this->crud_model->update_accountant_info($accountant_id);
                $this->session->set_flashdata('message', get_phrase('accountant_info_updated_successfuly'));
                redirect(base_url() . 'index.php?admin/accountant');
        }

        if ($task == "delete") {
            $this->crud_model->delete_accountant_info($accountant_id);
            redirect(base_url() . 'index.php?admin/accountant');
        }

        $data['accountant_info'] = $this->crud_model->select_accountant_info();
        $data['page_name'] = 'manage_accountant';
        $data['page_title'] = get_phrase('accountant');
        $this->load->view('backend/index', $data);
    }

    function receptionist($task = "", $receptionist_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
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
            redirect(base_url() . 'index.php?admin/receptionist');
        }

        if ($task == "update") {
                $this->crud_model->update_receptionist_info($receptionist_id);
                $this->session->set_flashdata('message', get_phrase('receptionist_info_updated_successfuly'));
                redirect(base_url() . 'index.php?admin/receptionist');
        }

        if ($task == "delete") {
            $this->crud_model->delete_receptionist_info($receptionist_id);
            redirect(base_url() . 'index.php?admin/receptionist');
        }

        $data['receptionist_info'] = $this->crud_model->select_receptionist_info();
        $data['page_name'] = 'manage_receptionist';
        $data['page_title'] = get_phrase('receptionist');
        $this->load->view('backend/index', $data);
    }

    function payment_history($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['invoice_info'] = $this->crud_model->select_invoice_info();
        $data['page_name'] = 'show_payment_history';
        $data['page_title'] = get_phrase('payment_history');
        $this->load->view('backend/index', $data);
    }

    function bed_allotment($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
        $data['page_name'] = 'show_bed_allotment';
        $data['page_title'] = get_phrase('bed_allotment');
        $this->load->view('backend/index', $data);
    }

    function blood_bank($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
        $data['page_name'] = 'show_blood_bank';
        $data['page_title'] = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }

    function blood_donor($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name'] = 'show_blood_donor';
        $data['page_title'] = get_phrase('blood_donor');
        $this->load->view('backend/index', $data);
    }

    function medicine($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['medicine_info'] = $this->crud_model->select_medicine_info();
        $data['page_name'] = 'show_medicine';
        $data['page_title'] = get_phrase('medicine');
        $this->load->view('backend/index', $data);
    }

    function operation_report($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'show_operation_report';
        $data['page_title'] = get_phrase('operation_report');
        $this->load->view('backend/index', $data);
    }

    function birth_report($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'show_birth_report';
        $data['page_title'] = get_phrase('birth_report');
        $this->load->view('backend/index', $data);
    }

    function death_report($task = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $data['page_name'] = 'show_death_report';
        $data['page_title'] = get_phrase('death_report');
        $this->load->view('backend/index', $data);
    }

    function notice($task = "", $notice_id = "") {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        if ($task == "create") {
            $this->crud_model->save_notice_info();
            $this->session->set_flashdata('message', get_phrase('notice_info_saved_successfuly'));
            redirect(base_url() . 'index.php?admin/notice');
        }

        if ($task == "update") {
            $this->crud_model->update_notice_info($notice_id);
            $this->session->set_flashdata('message', get_phrase('notice_info_updated_successfuly'));
            redirect(base_url() . 'index.php?admin/notice');
        }

        if ($task == "delete") {
            $this->crud_model->delete_notice_info($notice_id);
            redirect(base_url() . 'index.php?admin/notice');
        }

        $data['notice_info'] = $this->crud_model->select_notice_info();
        $data['page_name'] = 'manage_notice';
        $data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $data);
    }

}
