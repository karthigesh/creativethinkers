<?php
class Stallioni_Contactsave_IndexController extends Mage_Core_Controller_Front_Action
{
	
      public function IndexAction()
    {
		$postvalues = $this->getRequest()->getParams();
		$name = $postvalues['fname']." ".$postvalues['lname'];
		$email = $postvalues['email'];
		$companyname = $postvalues['companyname'];
		$phone = $postvalues['phone'];
		$fax = $postvalues['fax'];
		$address = "";
		if($postvalues['street'] !=""){
			$address .= $postvalues['street'].',';
		}
		if($postvalues['city'] !=""){
			$address .= $postvalues['city'].',';
		}
		if($postvalues['state'] !=""){
			$address .= $postvalues['state'].',';
		}
		if($postvalues['zipcode'] !=""){
			$address .= $postvalues['zipcode'].',';
		}
		if($postvalues['country'] !=""){
			$address .= $postvalues['country'];
		}
		$enquirymessage = $postvalues['message'];
		$adminemail = $postvalues['adminemail'];
		$vendorurl = $postvalues['vendorurl'];
		$to      = $adminemail;
		$subject = 'Direct Contact from your store';
		$message = '<table>';
		$message .= '<tr><td>Name: </td><td>'.$name.'</td></tr>';
		$message .= '<tr><td>Email: </td><td>'.$email.'</td></tr>';
		$message .= '<tr><td>Company name: </td><td>'.$companyname.'</td></tr>';
		$message .= '<tr><td>Phone: </td><td>'.$phone.'</td></tr>';
		$message .= '<tr><td>Fax: </td><td>'.$fax.'</td></tr>';
		$message .= '<tr><td>Address:</td><td>'.$address.'</td></tr>';
		$message .= '<tr><td>Message:</td><td>'.$enquirymessage.'</td></tr>';
		$message .= '</table>';
		$message .= '<table><tr><td>This message have been from the contact form on your web store '.$vendorurl.' </td></tr></table>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'. $email . "\r\n" .
		'Reply-To:'. $email .  "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$mail=mail($to, $subject, $message, $headers);
		if($mail){
			echo 'success';
		}
	}
    
 }
