


<?php
// Keep executing even if you close your browser
ignore_user_abort(true);

// Execute for an unlimited timespan
//set_time_limit(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$con=mysqli_connect('localhost','root','');
if(!$con)
{
	echo "server not found";
}

if(!mysqli_select_db($con,'yagna'))
{
	echo"database not found";
}

//echo "am here";
$sql="SELECT * FROM `assignment` WHERE CURDATE() = dates && status=1 && emailstatus=1";
$query=mysqli_query($con,$sql);
while($fetch=mysqli_fetch_array($query))
{


		 $a=$fetch['id'];
		 $b=$fetch['task'];
		 $c=$fetch['dates'];
		 $d=$fetch['message'];
		 $e=$fetch['email'];

 $to_email = "$e";  
 
 $addresses = explode(',', $to_email);
 
 print_r ($addresses);
 
//foreach ($addresses as $address) {
   // $email->AddAddress($address);
//}
//die();
$subject = " REGARDING $b";

$body = nl2br("A REMINDER TO YOU !  \n A TASK NAMED <b> $b </b> IS TO BE COMPLETED TODAY DATE  $c.");
$headers = "From: E-Reminder";



$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'jobsreminderschema@gmail.com';				
	$mail->Password = 'Misheba@25';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

	$mail->setFrom('jobsreminderschema@gmail.com', 'JobsReminder');
    foreach ($addresses as $address) {
   // $email->AddAddress($address);
//}	
	$mail->addAddress($address);
	$mail->addAddress('vululea@gmail.com', 'JobsReminder');
}
	$mail->isHTML(true);								
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AltBody = $body;
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

	 $qry="SELECT * FROM assignment WHERE id='$a'";
	$rs=mysqli_query($con,$qry);
	$row=mysqli_fetch_array($rs);
	$emailstatus=$row['emailstatus'];
	if($emailstatus==1)
	{
		$qry1="UPDATE assignment SET emailstatus=0 where id='$a'";
		$rs1=mysqli_query($con,$qry1);
	}
}	

?>	
	
