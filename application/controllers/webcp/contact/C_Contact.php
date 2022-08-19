<?php

include './assets/webcp/assets/vendor/php-email-form/php-email-form.php';

class C_Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('webcp/contact/M_Contact', 'contact');
    }

    public function index(){
        renderwebcp('webcp/contact/V_Contact', '', '', null);
    }

    public function sendMessageContact(){
        $data = $this->input->post();
        $this->contact->insert('t_contact_message', $data);

        // $mail = new PHP_Email_Form;
        // $mail->ajax = true;
  
        // $mail->to = RECEIVING_EMAIL_ADDRESS;
        // $mail->from_name = $data['name'];
        // $mail->from_email = $data['email'];
        // $mail->subject = $data['subject'];

        // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
        /*
        $mail->smtp = array(
            'host' => 'example.com',
            'username' => 'example',
            'password' => 'pass',
            'port' => '587'
        );
        */

        // $mail->add_message( $data['name'], 'From');
        // $mail->add_message( $data['email'], 'Email');
        // $mail->add_message( $data['message'], 'Message', 10);

        // $rs = $mail->send();
        // dd($rs);
    }
}
