<?php

if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$email=$_POST['email'];
$uname=$_POST['uname'];
$p1=$_POST['p1'];
$token=rand(100000,999999);
$conn = new mysqli('localhost','root','','project_email_php');
if($conn->connect_error)
{
	die('Connection Failed : '.$conn->connect_error);
}

$result = mysqli_query($conn,"SELECT Username from registration where Username='$uname'") or die( mysqli_error($conn) );
$row =mysqli_fetch_array($result);
$result1 = mysqli_query($conn,"SELECT Email from registration where Email='$email'") or die( mysqli_error($conn) );
$row1 =mysqli_fetch_array($result1);

if($row1['Email']==$email)
{
    echo '<script>alert("Sorry ! This Email ID is Already Registered")</script>';
	echo '<script> window.location.href="Registration.php"</script>';
}
else
{
	if($row['Username']==$uname)
	{
		echo '<script>alert("This Username Is Already Taken ! \nTry Again With Different UserName ...")</script>';
		echo '<script> window.location.href="Registration.php"</script>';
	}
	else
	{
	$q="INSERT INTO registration(Name,Email,Username,Password,Token,Status) 
	VALUES('$fname','$email','$uname','$p1','$token','notvarified')";
	mysqli_query($conn,$q);
	echo '<script>alert("Registration Successfull ! \nNow You Have To Varify Your E-mailAddress ...")</script>';
	//echo '<script>alert("Now You have to Varify Your E-mailAddress")</script>';
	echo '<script> window.location.href="Varification.php"</script>';
	}
}
}
?>


<!DOCTYPE html>

<html>
<head>
<title>Registration Form</title>
<script type=text/javascript>
function validateform()
{
var x=document.a.fname.value;
var q=document.a.email.value;
var f=document.a.uname.value;
var m=document.a.p1.value;
var n=document.a.p2.value;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

if(x==""||x==null)
{
alert("Please Enter Your Name");
document.a.fname.focus();
return false;
}
if(!isNaN(x))
{
alert("Please Enter Your Name Properly");
document.a.fname.focus();
return false;
}

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

if(f==""||f==null)
{
alert("Please Enter UserName");
document.a.uname.focus();
return false;
}
if(!isNaN(f))
{
alert("Please Enter UserName Properly");
document.a.uname.focus();
return false;
}

if(m==""||m==null)
{
alert("Please Enter Your Password");
document.a.p1.focus();
return false;
}
if(m.length<8)
{
alert("Please Enter Your Password In more than 8 Digits");
document.a.p1.focus();
return false;
}

if(n==""||n==null)
{
alert("Please Enter Your Password One More Time Here");
document.a.p2.focus();
return false;
}
if(m!==n)
{
alert("Password & Confirm Password Don't Match");
document.a.p2.focus();
return false;
}

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
<div id="signup"><br>
<h3><b>Registration</b></h3><br>
<form method="post" action="Registration.php" name="a" onsubmit="return validateform()">
<label>Name</label>
<input type="text" name="fname" autocomplete="off" />
<label>Email</label>
<input type="text" name="email" autocomplete="off" />
<label>Username</label>
<input type="text" name="uname" autocomplete="off" />
<label>Password</label>
<input type="password" name="p1" autocomplete="off"/>
<label>Confirm Password</label>
<input type="password" name="p2" autocomplete="off"/>
<input type="submit" class="button" name="submit" value="Sign up">
<br>
<a href='login.php'><h4> Already have an account ? </h4></a><br>
</form>
</div>

</center>
</basefont>
</body>
</html>





