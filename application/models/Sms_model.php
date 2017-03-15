<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function send_sms($message = '' , $reciever_phone = '') {
        
        $clickatell_user       = $this->db->get_where('settings', array('type' => 'clickatell_user'))->row()->description;
        $clickatell_password   = $this->db->get_where('settings', array('type' => 'clickatell_password'))->row()->description;
        $clickatell_api_id     = $this->db->get_where('settings', array('type' => 'clickatell_api_id'))->row()->description;
        $clickatell_baseurl    = "http://api.clickatell.com";

        $text   = urlencode($message);
        $to     = $reciever_phone;

        // auth call
        $url = "$clickatell_baseurl/http/auth?user=$clickatell_user&password=$clickatell_password&api_id=$clickatell_api_id";

        // do auth call
        $ret = file($url);

        // explode our response. return string is on first line of the data returned
        $sess = explode(":",$ret[0]);
        print_r($sess);echo '<br>';
        if ($sess[0] == "OK") {

            $sess_id = trim($sess[1]); // remove any whitespace
            $url = "$clickatell_baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";

            // do sendmsg call
            $ret = file($url);
            $send = explode(":",$ret[0]);
            print_r($send);echo '<br>';
            if ($send[0] == "ID") {
                echo "successnmessage ID: ". $send[1];
            } else {
                echo "send message failed";
            }
        } else {
            echo "Authentication failure: ". $ret[0];
        }
    }
 function sms($message = '' , $reciever_phone = '') {

    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'http://smshorizon.co.in/api/sendsms.php');
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
        'user' => 'Discovermypet_sms',
        'apikey' => 'ExYBcTyZXOAnHhmcKfN7',
        'mobile' => $reciever_phone,
        'message' => $message,
        'senderid' => 'VN',
         'type' => 'txt',
    ));
     
    
     
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
     
    $result = json_decode($buffer);
 
    if(isset($result->status) && $result->status == 'success')
    {
        echo 'User has been updated.';
    }
     
    else
    {
        //echo 'Something has gone wrong';
    }

 }
}