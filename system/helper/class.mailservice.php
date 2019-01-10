<?php

class mailservice
{

	function __construct()
	{
		$this->initialize();
	}

	public function initialize($config = null)
	{

		$this->Host = 'banana.qwords.net';  
		$this->SMTPAuth = true;                            
		$this->Username = 'admin@maulanardy.com';             
		$this->Password = 'buk4buk4buk4';                           
		$this->SMTPSecure = 'tls';                           
		$this->Port = 587;                        
		$this->From = 'admin@berlianentertainment.com';
		$this->FromName = 'Berlian Entertainment';
		$this->To = 'email';
		$this->ToName = 'Ardy';
		$this->AddCC = '';
		$this->AddBCC = '';
		$this->isHTML = true;
		$this->Subject = 'subject';
		$this->Body    = 'body';
		$this->AltBody = 'body';
		


        if($config){
            foreach ($config as $key => $value) {
                $this->$key = $value;
            }
        }
	}

	public function send() {
		$this->setMailer();

		if(!$this->mailer->send()) {
		    // echo 'Message could not be sent.';
		    // echo 'Mailer Error: ' . $this->mailer->ErrorInfo;
		    return false;
		} else {
			return true;
		}
	}

	public function setMailer(){
		$this->mailer = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$this->mailer->isSMTP();                                      // Set mailer to use SMTP
		$this->mailer->Host = $this->Host;  // Specify main and backup SMTP servers
		$this->mailer->SMTPAuth = $this->SMTPAuth;                               // Enable SMTP authentication
		$this->mailer->Username = $this->Username;                 // SMTP username
		$this->mailer->Password = $this->Password;                           // SMTP password
		$this->mailer->SMTPSecure = $this->SMTPSecure;                            // Enable TLS encryption, `ssl` also accepted
		$this->mailer->Port = $this->Port;                                    // TCP port to connect to

		$this->mailer->From = $this->From; 
		$this->mailer->FromName = $this->FromName;
		$this->mailer->addAddress($this->To, $this->ToName);     // Add a recipient
		// $mail->addReplyTo('info@temansukses.co.id', 'Information');
		if($this->AddCC != "") $this->mailer->addCC($this->AddCC);
		if($this->AddBCC != "") $this->mailer->addBCC($this->AddBCC);

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$this->mailer->isHTML($this->isHTML);                                  // Set email format to HTML

		$this->mailer->Subject = $this->Subject;
		$this->mailer->Body    = $this->Body;
		$this->mailer->AltBody = $this->AltBody;
	}

}