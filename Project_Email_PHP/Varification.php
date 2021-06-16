<?php
require 'phpMailer/PHPMailerAutoload.php';
session_start();

if(isset($_POST['submit']))
{
$email=$_POST['email'];
$_SESSION['email']=$email;
$token=rand(100000,999999);
$conn = new mysqli('localhost','root','','project_email_php');
if($conn->connect_error)
{
	die('Connection Failed : '.$conn->connect_error);
}
if(mysqli_num_rows(mysqli_query($conn,"SELECT Email from registration where Email='$email' AND Status='varified'")) > 0 )
{
	echo '<script>alert("This E-mail Address is Already Varified")</script>';
	echo '<script> window.location.href="login.php"</script>';
}
else
{
$result1 = mysqli_query($conn,"SELECT Email from registration where Email='$email'") or die( mysqli_error($conn) );
$row1 =mysqli_fetch_array($result1);

if($row1['Email']==$email)
{
		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';						  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'jadugarklal777@gmail.com';         // SMTP username
		$mail->Password = 'jadugar@king';                     // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->setFrom('jadugarklal777@gmail.com', 'Jadugar K Lal');
		$mail->addAddress($email);     						  // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML
		$html="http://localhost/New%20folder/Project_Email_PHP/EnterCode.php?code=".$token;
		$nohtml="http://localhost/New%20folder/Project_Email_PHP/EnterCode.php?token=".$token;
		$mail->Subject = 'Email Varification';
		$mail->Body    = $html;
		$mail->AltBody = $nohtml;

		if(!$mail->send()) {
			echo '<script>alert("Message could not be sent"</script>';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo '<script>alert("Varification Code is Sent to Your E-mail Address")</script>';
			echo '<script> window.location.href="EnterCode.php"</script>';
		}
	$q="UPDATE `registration` SET Token='$token' WHERE Email='$email'";
	mysqli_query($conn,$q);
}
else
{
	echo '<script>alert("E-mail is not Regestered")</script>';
	echo '<script> window.location.href="Varification.php"</script>';
	}	
}
}
?>


<html>
<head>
<title>E-mail Varification</title>
<script type=text/javascript>
function validateform()
{
var q=document.a.email.value;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

if(q==""||q==null)
{
alert("Please Enter Your E-mail Address");
document.a.email.focus();
return false;
}
if(q.match(mailformat))
{
document.a.email.focus();	
}
else
{
alert("You have entered an invalid email address!");
document.a.email.focus();
return false;
}

alert("Processing ...");
return true;
}
</script>
<style>
#login,#signup{
width: 300px; border: 1px solid #d6d7da;
padding: 0px 15px 15px 15px;
border-radius: 5px;font-family: arial;
line-height: 16px;color: #333333; font-size: 14px;
background: #ffffff;rgba(200,200,200,0.7) 0 4px 10px -1px
}
#login{float:center;}
#signup{float:center;}
h3{color:#365D98}
form label{font-weight: bold;}
form label, form input{display: block;margin-bottom: 5px;width: 90%}
form input{
border: solid 1px #666666;padding: 10px;
border: solid 1px #BDC7D8; margin-bottom: 20px
}
.button {
background-color: #5fcf80 ;
border-color: #3ac162;
font-weight: bold;
padding: 12px 15px;
max-width: 100px;
color: #ffffff;
}
.errorMsg{color: #cc0000;margin-bottom: 10px}
</style>

</head>
<body>
<center><br><br><br><br>
<div id="login"><br>
<h3><b>E-mail Varification</b></h3><br>
<form method="post" action="Varification.php" name="a" onsubmit="return validateform()">
<label>Email</label>
<input type="text" name="email"  autocomplete="off" />
<input type="submit" class="button" name="submit" value="Send Code">
</form>
</div>
</body>
</html>