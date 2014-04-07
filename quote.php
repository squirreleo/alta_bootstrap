<?php

// check if fields passed are empty
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['details'])	||
   empty($_POST['quantity']) ||
   empty($_POST['date']) ||
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
$quantity = $_POST['quantity'];
$proj_name = $_POST['project_name'];
$date = $_POST['date'];
$details = $_POST['details'];

// create email body and send it	
$to = 'sales@altainc.com'; 
$email_subject = "Quote request form submitted by:  $name";
$email_body = "You have received a new message via the quote request form on Alta's Web site. \n\n".
				  "Name: $name \n ".
                                  "Company: $company \n".
				  "Email: $email_address\n".
                                  "Phone: $phone\n".
                                  "Quantity: $quantity\n".
                                  "Project Name: $proj_name\n".
                                  "Date Needed: $date\n".
                                  "Details: $details";
$headers = "From: sales@altainc.com\n";  // change to sales@altainc.com to avoid junk folder?
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
