<?php

require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime packge

$name = $_POST['name']; // form field
$email = $_POST['email']; // form field
$subject = $_POST['subject']; // subject
$message = $_POST['message']; // form field

//if ($_POST['submit']){
  $from = ""; //enter your email address
  $to = ""; //enter the email address of the contact your sending to
  $subject = "Contact Form: $subject"; // subject of your email

  $headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

  $text = ''; // text versions of email.
  $html = "<html><body>Name: $name <br> Email: $email <br>Message: $message <br></body></html>"; // html versions of email.

  $crlf = "\n";

  $mime = new Mail_mime($crlf);
  $mime->setTXTBody($text);
  $mime->setHTMLBody($html);

  //do not ever try to call these lines in reverse order
  $body = $mime->get();
  $headers = $mime->headers($headers);

  $host = "localhost"; // all scripts must use localhost
  $username = ""; //  your email address (same as webmail username)
  $password = ""; // your password (same as webmail password)

  $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => '25',  'auth' => false,
  'username' => $username,'password' => $password));
 

  $mail = $smtp->send($to, $headers, $body);

  if (PEAR::isError($mail)) {
    echo("<p>" . $mail->getMessage() . "</p>");
  }
  else {
    echo("<p>Message successfully sent!</p>");
   // header("refresh:3; url:http://");
    header("Location:https://");
  }
//}
 ?>
 
