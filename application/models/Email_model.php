<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function account_opening_email($account_type = '', $email = '') {
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;

        $email_msg = "Welcome to " . $system_name . "<br />";
        $email_msg .= "Your account type : " . $account_type . "<br />";
        $email_msg .= "Your login password : " . $this->db->get_where($account_type, array('email' => $email))->row()->password . "<br />";
        $email_msg .= "Login Here : " . base_url() . "<br />";

        $email_sub = "Account opening email";
        $email_to = $email;

        $this->do_email($email_msg, $email_sub, $email_to);
    }

function promotional_mail($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Promotional Email');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    function payment_received($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Payment Recieved');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    function pet_add_successfully($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Pet Add Successfully');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
 function Schedule_of_the_day($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Schedule Of The Day');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    function sendmail_of_appointment($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Appointment Booking Successfully');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
function sendmail_to_patient($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Pet Private Messaging');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }


    function appointment_close_email($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Appointment Close Successfully');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    function sendmail_to_staff($message,$receiver_email)
    {
    	
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Staff Private Messaging');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }

function sendmail_to_staff_by_admin($message,$subject,$receiver_email)
    {
    	 
    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject($subject);
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    function sendmail($message,$receiver_email)
    {

    	
    

    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Staff Private Messaging');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
function doctor_registration_email($message,$receiver_email)
    {

    	
    

    	$this->load->library('email'); // load email library
    	$this->email->from('admin@solutionner.com', 'VetNex');
    	$this->email->to($receiver_email);
    	$this->email->cc('admin@solutionner.com');
    	$this->email->subject('Doctor Registration Successfully');
    	$this->email->message($message);
    	if ($this->email->send())
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    function password_reset_email($account_type = '', $email = '') {
        $query = $this->db->get_where($account_type, array('email' => $email));
        if ($query->num_rows() > 0) {
            $password = $query->row()->password;
            $email_msg = "Your account type is : " . $account_type . "<br />";
            $email_msg .= "Your password is : " . $password . "<br />";

            $email_sub = "Password reset request";
            $email_to = $email;
            $this->do_email($email_msg, $email_sub, $email_to);
            return true;
        } else {
            return false;
        }
    }

    /*     * *custom email sender*** */

    function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL) {

        $config = array();
        $config['useragent'] = "CodeIgniter";
        $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "localhost";
        $config['smtp_port'] = "25";
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
        if ($from == NULL)
            $from = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;

        $this->email->from($from, $system_name);
        $this->email->from($from, $system_name);
        $this->email->to($to);
        $this->email->subject($sub);

        $msg = $msg . "<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://codecanyon.net/item/ekattor-school-management-system-pro/6087521?ref=joyontaroy\">&copy; 2013 Ekattor School Management System Pro</a></center>";
        $this->email->message($msg);

        $this->email->send();

        //echo $this->email->print_debugger();
    }

}