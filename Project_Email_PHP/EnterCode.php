<?php
session_start();
if(isset($_POST['submit']))
{
$token=$_POST['code'];

$email=$_SESSION['email'];
echo ($email) ;
//$conn = new mysqli('localhost','root','','project_email_php');
$conn = new mysqli('sql300.epizy.com','epiz_28936132','HQpuWwu4bw','epiz_28936132_GithubTimilinerDB');
if($conn->connect_error)
{
	die('Connection Failed : '.$conn->connect_error);
}

$result = mysqli_query($conn,"SELECT * from registration where Email='$email' and Token=$token") or die( mysqli_error($conn) );
$row = mysqli_fetch_array($result);
$count=mysqli_num_rows($result);

if($count>0)
{
	$q="UPDATE `registration` SET Status='varified' WHERE Email='$email'";
	mysqli_query($conn,$q);
	echo '<script>alert("Varification Successfull")</script>';
	echo '<script> window.location.href="login.php"</script>';
}
else
{
	echo '<script>alert("Wrong Varification Code")</script>';
	echo '<script> window.location.href="EnterCode.php"</script>';
	}	
}

?>

<html>
<head>
<title>Enter Code</title>
<script type=text/javascript>
function validateform()
{
var x=document.a.code.value;

if(x==""||x==null)
{
alert("Please Enter Varification Code");
document.a.code.focus();
return false;
}
if(isNaN(x))
{
alert("Please Enter Varification Code in Digits");
document.a.code.focus();
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
<div id="login">
<h3><b>Enter Code Here</b></h3><br>
<form method="post" action="EnterCode.php" name="a" onsubmit="return validateform()">
<label>Varification Code</label>
<input type="text" name="code"  autocomplete="off" />
<input type="submit" class="button" name="submit" value="Varify">
</form>
</div>
</body>
</html>