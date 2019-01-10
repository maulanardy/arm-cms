<?php 
namespace Ma\Controller\Contact;

/**
* 
*/
class Main
{	
	function __construct(){}

	public static function send($name, $email, $phone, $message){
		$firstName = explode(" ", $name);
		$firstName = $firstName[0];

		$body  = '<p>NAMA : '. $name .'</p>';
		$body  .= '<p>EMAIL : '. $email .'</p>';
		$body  .= '<p>PHONE : '. $phone .'</p>';
		$body  .= '<p>PESAN : '. $message .'</p>';

		$subject = 'Pesan dari Kontak Rumah Peradaban';

		$mailer = new \mailservice();
		//trianggoro.k@ffi.co.id
		$mailer->initialize(array(
				"From" => $email,
				"FromName" => $name,
				"To" => "arbomb.serv@gmail.com",
				"ToName" => "Admin",
				"isHTML" => true,
				"Subject" => $subject,
				"Body" => $body,
				"AltBody" => $body
			));
		if($mailer->send()){
		    return true;
		} else {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		}
	}
}