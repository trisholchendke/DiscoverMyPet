<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	30th July, 2014
 * 	Creative Item
 * 	www.creativeitem.com
 * 	http://codecanyon.net/user/joyontaroy
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
        
        else if ($this->session->userdata('doctor_login') == 1)
            redirect(base_url() . 'index.php?doctor', 'refresh');
        
        else if ($this->session->userdata('patient_login') == 1)
            redirect(base_url() . 'index.php?patient', 'refresh');
        
        else if ($this->session->userdata('nurse_login') == 1)
            redirect(base_url() . 'index.php?nurse', 'refresh');
        
        else if ($this->session->userdata('pharmacist_login') == 1)
            redirect(base_url() . 'index.php?pharmacist', 'refresh');
        
        else if ($this->session->userdata('laboratorist_login') == 1)
            redirect(base_url() . 'index.php?laboratorist', 'refresh');
        
        else if ($this->session->userdata('accountant_login') == 1)
            redirect(base_url() . 'index.php?accountant', 'refresh');
        
        else if ($this->session->userdata('receptionist_login') == 1)
            redirect(base_url() . 'index.php?receptionist', 'refresh');
        else if ($this->session->userdata('sub_doctor_login') == 1)
            redirect(base_url() . 'index.php?sub_doctor', 'refresh');
        else if ($this->session->userdata('sub_doctor_login') == 1)
            redirect(base_url() . 'index.php?sub_doctor', 'refresh');
        else if ($this->session->userdata('kennel_login') == 1)
            redirect(base_url() . 'index.php?kennel', 'refresh');
        else if ($this->session->userdata('groomer_login') == 1)
            redirect(base_url() . 'index.php?groomer', 'refresh');
        else if ($this->session->userdata('trainers_login') == 1)
            redirect(base_url() . 'index.php?trainers', 'refresh');
        else if ($this->session->userdata('breeder_login') == 1)
            redirect(base_url() . 'index.php?breeder', 'refresh');
        else if ($this->session->userdata('ambulance_service_login') == 1)
            redirect(base_url() . 'index.php?ambulance_service', 'refresh');
        else if ($this->session->userdata('pet_relocation_login') == 1)
            redirect(base_url() . 'index.php?pet_relocation', 'refresh');
        else if ($this->session->userdata('pet_bakery_login') == 1)
            redirect(base_url() . 'index.php?pet_bakery', 'refresh');
        else if ($this->session->userdata('dog_walker_login') == 1)
            redirect(base_url() . 'index.php?dog_walker', 'refresh');
        else if ($this->session->userdata('obituary_login') == 1)
            redirect(base_url() . 'index.php?obituary', 'refresh');
        else if ($this->session->userdata('restaurants_login') == 1)
            redirect(base_url() . 'index.php?restaurants', 'refresh');
        else if ($this->session->userdata('receptionist_login') == 1)
            redirect(base_url() . 'index.php?receptionist', 'refresh');

        $this->load->view('backend/login');
    }

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = $this->session->userdata('last_page');
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => base64_encode($password));


        
        
        // Checking login credential for admin
        $query = $this->db->get_where('users', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
				 function objectToArray( $object ){
				   if( !is_object( $object ) && !is_array( $object ) ){
				    return $object;
				 }
				if( is_object( $object ) ){
				    $object = get_object_vars( $object );
				}
		    	return array_map( 'objectToArray', $object );
			}
	$array = objectToArray( $row  );
	$role = $array['role'];
	
		switch ($role) {
			case "Sub Doctor":
				$this->session->set_userdata('sub_doctor_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'sub_doctor');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Kennel":
				$this->session->set_userdata('kennel_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'kennel');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Groomer":
				$this->session->set_userdata('groomer_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'groomer');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Trainers":
				$this->session->set_userdata('trainers_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'trainers');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Breeder":
				$this->session->set_userdata('breeder_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'breeder');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Ambulance Service":
				$this->session->set_userdata('ambulance_service_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'ambulance_service');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Pet Relocation":
				$this->session->set_userdata('pet_relocation_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'pet_relocation');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Pet Bakery":
				$this->session->set_userdata('pet_bakery_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'pet_bakery');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Dog Walker":
				$this->session->set_userdata('dog_walker_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'dog_walker');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Obituary":
				$this->session->set_userdata('obituary_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'obituary');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Restaurants":
				$this->session->set_userdata('restaurants_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'restaurants');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
			case "Receptionist":
				$this->session->set_userdata('receptionist_login', '1');
	            $this->session->set_userdata('login_user_id', $array['id']);
	            $this->session->set_userdata('name', $array['name']);
	            $this->session->set_userdata('login_type', 'restaurants');
	            $this->session->set_userdata('doctor_id', $array['doctor_id']);
	            return 'success';
				break;
		}
	}
           
        
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }
        
        
        $query = $this->db->get_where('doctor', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('doctor_login', '1');
            $this->session->set_userdata('login_user_id', $row->doctor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'doctor');
            return 'success';
        }
        
        $query = $this->db->get_where('patient', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('patient_login', '1');
            $this->session->set_userdata('login_user_id', $row->patient_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'patient');
            $this->session->set_userdata('doctor_id', $row->doctor_id);
            return 'success';
        }
        
        $query = $this->db->get_where('nurse', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('nurse_login', '1');
            $this->session->set_userdata('login_user_id', $row->nurse_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'nurse');
            $this->session->set_userdata('doctor_id', $row->doctor_id);
            return 'success';
        }
        
        $query = $this->db->get_where('pharmacist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('pharmacist_login', '1');
            $this->session->set_userdata('login_user_id', $row->pharmacist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'pharmacist');
            $this->session->set_userdata('doctor_id', $row->doctor_id);
            return 'success';
        }
        
        $query = $this->db->get_where('laboratorist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('laboratorist_login', '1');
            $this->session->set_userdata('login_user_id', $row->laboratorist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'laboratorist');
            $this->session->set_userdata('doctor_id', $row->doctor_id);
            return 'success';
        }
        
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('accountant_login', '1');
            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'accountant');
            $this->session->set_userdata('doctor_id', $row->doctor_id);
            return 'success';
        }
        
        $query = $this->db->get_where('receptionist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('receptionist_login', '1');
            $this->session->set_userdata('login_user_id', $row->receptionist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'receptionist');
            $this->session->set_userdata('doctor_id', $row->doctor_id);
            return 'success';
        }

        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */

    function reset_password() {
        $account_type = $this->input->post('account_type');
        if ($account_type == "") {
            redirect(base_url(), 'refresh');
        }
        $email = $this->input->post('email');
        $result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
        if ($result == true) {
            $this->session->set_flashdata('flash_message', get_phrase('password_sent'));
        } else if ($result == false) {
            $this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
        }

        redirect(base_url(), 'refresh');
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
