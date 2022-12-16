<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//$mail = new PHPMailer();
//$mail->CharSet = "UTF-8";
//$mail->isSMTP();
//$mail->Host   = 'smtp.ub1.com.ua';
//$mail->SMTPAuth   = true;
//$mail->Username   = 'berta\info_ub1';//berta\info_ub1
//$mail->Password   = 'k8ApLeI0kY4sUCF';
//$mail->SMTPSecure = 'STARTTLS';//STARTTLS
//$mail->Port   = 587;
//
//$mail->setFrom('info_ub1@ub1.com.ua', 'UB1 Info');

$mail = new PHPMailer();
$mail->CharSet = "UTF-8";
$mail->isSMTP();
$mail->Host   = 'smtp.office365.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'tender@yarych.com';
$mail->Password   = 'Jon91103';
$mail->SMTPSecure = 'STARTTLS';
$mail->Port   = 587;

$mail->setFrom('tender@yarych.com', 'Yarych Tender');    // от кого
