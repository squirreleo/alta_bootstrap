<?php
  include_once("wsp_captcha.php");

  if (WSP_CheckImageCode() != "OK") {
    die("The image code you have entered is incorrect. Please, click the 'Back' button of your browser and type the correct one.");
  }
  
  $to = "alynch1224@yahoo.com"; 
  $from = $_REQUEST['inputEmail'] ; 
  $name = $_REQUEST['inputName'] ; 
  $headers = "From: $name"; 
  $subject = "Web Contact Form Data"; 
 
  $fields = array(); 
  $fields{"inputName"} = "Name"; 
  $fields{"inputCompany"} = "Company"; 
  $fields{"inputEmail"} = "Email"; 
  $fields{"inputPhone"} = "Phone"; 
  $fields{"inputNotes"} = "Message"; 
 
  $body = "The following information was submitted via the Contact form on Alta's Web site:\n\n"; foreach($fields as $a => $b){ 	$body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); } 
 
  if($from == '') {header('Location: http://www.angeladowns.com/alta/error.html');} 
  else { 
  if($name == '') {header('Location: http://www.angeladowns.com/alta/error.html');} 
  else { 
  $send = mail($to, $subject, $body, $headers); 
  
  if($send) 
  {
      header('Location: http://www.angeladowns.com/alta/thankyou.html'); exit;
  } 
  else 
  {
      header('Location: http://www.angeladowns.com/alta/error.html'); exit;
  }
  }
 }