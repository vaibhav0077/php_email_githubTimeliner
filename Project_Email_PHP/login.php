<?php
if(isset($_POST['submit']))
{
$ue=$_POST['usernameEmail'];
$password=$_POST['password'];
//$conn = new mysqli('localhost','root','','project_email_php');
$conn = new mysqli('sql300.epizy.com','epiz_28936132','HQpuWwu4bw','epiz_28936132_GithubTimilinerDB');
if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
        exit;
    }
        $result = mysqli_query($conn,"SELECT * from registration where Username='$ue' OR Email='$ue'") or die( mysqli_error($conn) );
        $row =mysqli_fetch_array($result);
        if($row['Username'] == $ue || $row['Email'] == $ue){
            if($row['Password'] == $password && $row['Status'] == 'varified'){
				$email=$row['Email'];
				$result1 = mysqli_query($conn,"SELECT * from subscription where Email='$email'") or die( mysqli_error($conn) );
				$row1 =mysqli_fetch_array($result1);
				if($row1['Email']!=$email){
					mysqli_query($conn,"INSERT INTO subscription(Email,Password,Status) VALUES('$email','$password','no')");
				}	
				echo '<script>alert("You are Successfully Loged In")</script>';
				echo '<script> window.location.href="login.php"</script>';
            }elseif($row['Password'] == $password && $row['Status'] == 'notvarified'){
				echo '<script>alert("Your E-mail Address is not Varified")</script>';
				echo '<script>alert("Please Varify it and Try to Login Again")</script>';
				echo '<script> window.location.href="Varification.php"</script>';
			}else{
                echo '<script>alert("Wrong Password : Try Again")</script>';
				echo '<script> window.location.href="login.php"</script>';
            }
        }else{
            echo '<script>alert("You Are Not Registrated")</script>';
			echo '<script> window.location.href="login.php"</script>';
        }
}
?>

<html>
<head>
<title>Login Form</title>
<script type=text/javascript>
function validateform()
{
var f=document.a.usernameEmail.value;
var m=document.a.password.value;

if(f==""||f==null)
{
alert("Please Enter UserName or Email Address");
document.a.usernameEmail.focus();
return false;
}
if(!isNaN(f))
{
alert("Please Enter UserName or Email Properly");
document.a.usernameEmail.focus();
return false;
}

if(m==""||m==null)
{
alert("Please Enter Your Password");
document.a.password.focus();
return false;
}
if(m.length<8)
{
alert("Please Enter Your Password In more than 8 Digits");
document.a.password.focus();
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
<h3><b>Login</b></h3><br>
<form method="post" action="login.php" name="a" onsubmit="return validateform()">
<label>Username or Email</label>
<input type="text" name="usernameEmail" autocomplete="off" />
<label>Password</label>
<input type="password" name="password" autocomplete="off"/>
<input type="submit" class="button" name="submit" value="Login">
<br>
<a href='Registration.php'><h4> Don't have any account ? </h4></a>
<br>
<a href='Subscribe.php'><h4>Click here to Subscribe Github Timeline</h4></a><br>
</form>
</div>
</body>
</html>