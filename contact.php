<?php

// check if fields passed are empty
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   ($_POST['notcaptcha'] !== "on") ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = $_POST['name'];
$company = $_POST['company'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// create email body and send it	
$to = 'contactrequest@altainc.com'; 
$email_subject = "Contact form submitted by:  $name";
$email_body = "You have received a new message via the contact form on Alta's Web site. \n\n".
				  "Name: $name \n ".
                                  "Company: $company \n".
				  "Email: $email_address\n".
                                  "Phone: $phone\n".
                                  "Message: $message";
$headers = "From: contactrequest@altainc.com\n"; 
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
