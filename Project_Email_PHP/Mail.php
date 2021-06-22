<?php
require 'phpMailer/PHPMailerAutoload.php';
require 'simple_html_dom.php';

//$conn = new mysqli('localhost','root','','project_email_php');
$conn = new mysqli('sql300.epizy.com','epiz_28936132','HQpuWwu4bw','epiz_28936132_GithubTimilinerDB');
if($conn->connect_error)
{
	die('Connection Failed : '.$conn->connect_error);
}
$html = file_get_html('https://github.com/search?q=https%3A%2F%2Fgithub.com%2Ftimeline');
$str = $html->find('.repo-list',0)->innertext;

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; 					  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'jadugarklal777@gmail.com';         // SMTP username
$mail->Password = 'jadugar@king';                     // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom('jadugarklal777@gmail.com', 'Jadugar K Lal');
//$mail->addAddress($row['Email']);    				  // Add a recipient
$result = mysqli_query($conn,"SELECT Email from subscription where Status='yes'") or die( mysqli_error($conn) );
//$row =mysqli_fetch_array($result);
while ($row = $result->fetch_assoc()) {
 echo $row['Email'];
 echo '<br>';
 $mail->addAddress($row['Email']);
}
//$mail->addAddress('ellen@example.com');              // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
//$mail->addStringAttachment(file_get_contents($url), 'myfile.pdf');
$mail->isHTML(true);                                   // Set email format to HTML
$mail->Subject = 'Github Timeline Update';
$mail->Body    = $str;
$mail->AltBody = $str;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mail Has Been Sent !!!';
	echo '<script>alert("Update Has been Sent !")</script>';
}

?>