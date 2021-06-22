<?php
if(isset($_POST['submit']))
{
$email=$_POST['email'];
$p1=$_POST['p1'];

$//conn = new mysqli('localhost','root','','project_email_php');
$conn = new mysqli('sql300.epizy.com','epiz_28936132','HQpuWwu4bw','epiz_28936132_GithubTimilinerDB');
if($conn->connect_error)
{
	die('Connection Failed : '.$conn->connect_error);
}

$result = mysqli_query($conn,"SELECT * from subscription where Email='$email'") or die( mysqli_error($conn) );
$row =mysqli_fetch_array($result);
if($row['Email'] == $email){
    if($row['Password'] == $p1)
	{
	$q="UPDATE `subscription` SET Status='yes' WHERE Email='$email'";
	mysqli_query($conn,$q);
	echo '<script>alert("Subscription Successfull")</script>';
	echo '<script> window.location.href="Subscribe.php"</script>';
	}else{
	echo '<script>alert("Wrong Password : Try Again")</script>';
	echo '<script> window.location.href="Subscribe.php"</script>';
	}
}
else
{
	echo '<script>alert("Login Requried To Active Subscription !")</script>';
	echo '<script> window.location.href="Subscribe.php"</script>';
	}	
}
?>

<html>
<head>
<title>Subscribe</title>
<script type=text/javascript>
function validateform()
{
var f=document.a.email.value;
var m=document.a.p1.value;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

if(f==""||f==null)
{
alert("Please Enter Your Email Address");
document.a.email.focus();
return false;
}
if(!isNaN(f))
{
alert("Please Enter Your Email Address Properly");
document.a.email.focus();
return false;
}
if(f.match(mailformat))
{
document.a.email.focus();	
}
else
{
alert("You have entered an invalid email address!");
document.a.email.focus();
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
<h3><b>Subscribe Github Timeline</b></h3><p style="color:green">This Subscription Will Help You To Get Update About Github Timeline Regularly</p><br>
<form method="post" action="Subscribe.php" name="a" onsubmit="return validateform()">
<label>Email</label>
<input type="text" name="email" autocomplete="off" />
<label>Password</label>
<input type="password" name="p1" autocomplete="off"/>
<input type="submit" class="button" name="submit" value="Subscribe">
<br>
<a href='login.php'><h4>Click here to Login</h4></a><br>
</form>
</div>
</body>
</html>