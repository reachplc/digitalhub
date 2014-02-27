<?php

####
#
#
#   Table of Contents
#
#   #  Global
#   #  Retrieve data from App
#   #  Add suffix to file
#   #  Create optimised file name
#   #  Supply data to editorial
#   #  Send thank-you email
#
#
####

if (!isset($_POST['submit'])){
header ('Location:index.html');
exit();
}else{

error_reporting(E_ALL);
//

###
#
# Collect data from DigitalHub Form
#
###

$sentYes = '<html lang="en">
<head>
<meta charset="utf-8">
<title>Trinity Mirror plc Digital Visual Request</title>
<meta charset="utf-8">
<meta name="generator" content="digitalForm">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
<link href="css/form-structure.css" rel="stylesheet">

<!-- JS -->
<script src="js/lib/jquery.js"></script><script src="http://jquery.bassistance.de/validate/lib/jquery-1.9.0.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/lib/dropzone.js"></script>

</head>
<body id="public">
<div class="hero">
  <header class="header-logo">
    <div class="container">
      <div class="logo"></div>
    </div>
  </header>
</div>
<div class="container">
  <div class="form-wrap">
    <h1>Digital Visual Request</h1>
    <h2 class="alpha">Thank you, your Digital Request has now been emailed to the admin team.</h2>
    </div>
    </div>
<footer class="home-foot">
  <div class="container">
    <div class="footer-logo"><img src="images/trinity-logo.png"></div>
  </div>
</footer>';

$sentNo = '<html lang="en">
<head>
<meta charset="utf-8">
<title>Digital Visual Request</title>
<meta charset="utf-8">
<meta name="generator" content="digitalForm">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">
<link href="css/form-structure.css" rel="stylesheet">

<!-- JS -->
<script src="js/lib/jquery.js"></script><script src="http://jquery.bassistance.de/validate/lib/jquery-1.9.0.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/lib/dropzone.js"></script>

</head>
<body id="public">
<div class="hero">
  <header class="header-logo">
    <div class="container">
      <div class="logo"></div>
    </div>
  </header>
</div>
<div class="container">
  <div class="form-wrap">
    <h1>Trinity Mirror plc Digital Visual Request</h1>
    <h2 class="alpha" style="color:#c00">Sorry there was a problem, your Digital Request has not been emailed to the admin team. Please Try Again.</h2>
    </div>
    </div>
<footer class="home-foot">
  <div class="container">
    <div class="footer-logo"><img src="images/trinity-logo.png"></div>
  </div>
</footer>';



//Sales Excutive Details
$firstname = $_POST['firstname']; 
$lastname = $_POST['lastname']; 
$repEmail = $_POST['repEmail'];
$area = $_POST['area']; 
$website = $_POST['web'];


//  Clients Details
$clientsName = $_POST['cname']; //  Submitters Name
$clientsEmail = $_POST['cemail'];  //  Submitters Email
$instructions = $_POST['instructions']; //  Submitters Phone Number

if ($website == NULL && $instructions == NULL){

  $website = 'Please use current website to design creatives.';
}

if ($instructions == NULL){

  $instructions = 'No instructions given!';
}


###
#
#  Supply email to booking and affinity
#
###

if( $firstname == true ) {

  $recipient = 'jonathan.masters@trinitymirror.com, daniel.richardson@trinitymirror.com';
  $subject =  'Digital Booking: ' . $clientsName;  //  Editorial Email
  $message = 'Sales Executive: ' . $firstname . ' ' . $lastname . "\r\n";
  $message .= 'Sales Executive Email: ' . $repEmail . "\r\n";
  $message .= 'Region: ' . $area . "\r\n";
  $message .= 'Clients Name: ' . $clientsName . "\r\n";
  $message .= 'Clients Email: ' . $clientsEmail . "\r\n";
  $message .= $website . "\r\n";
  $message .= 'Creative Instructions: ' . $instructions . "\r\n";

// boundary 
  //  Email attachments
$mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
         $headers = "From: $repEmail\r\n" .
         "MIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed;\r\n" .
            " boundary=\"{$mime_boundary}\"";
         $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";
         foreach($_FILES as $userfile)
         {
            $tmp_name = $userfile['tmp_name'];
            $type = $userfile['type'];
            $name = $userfile['name'];
            $size = $userfile['size'];
            if (file_exists($tmp_name))
            {
               if(is_uploaded_file($tmp_name))
               {
                  $file = fopen($tmp_name,'rb');
                  $data = fread($file,filesize($tmp_name));
                  fclose($file);
                  $data = chunk_split(base64_encode($data));
               }
               $message .= "--{$mime_boundary}\n" .
                  "Content-Type: {$type};\n" .
                  " name=\"{$name}\"\n" .
                  "Content-Disposition: attachment;\n" .
                  " filename=\"{$fileatt_name}\"\n" .
                  "Content-Transfer-Encoding: base64\n\n" .
               $data . "\n\n";
            }
         }
         $message.="--{$mime_boundary}--\n";
}


//  Email details
  if( mail( $recipient, $subject, $message, $headers)) {

    echo $sentYes;

   
  } else {

    echo $sentNo;

  }

}

?>