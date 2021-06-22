<?php
$servername = "sql300.epizy.com";
$username = "epiz_28936132";
$password = "HQpuWwu4bw";
$dbname = "epiz_28936132_GithubTimilinerDB";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
echo "Connected successfully<br>";
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error;
}

$selectdb = "USE $dbname";
if ($conn->query($selectdb) === TRUE) {
    echo "Database selected successfully<br>";
  } else {
    echo "Error creating database: " . $conn->error;
  }

$subscription = "CREATE TABLE IF NOT EXISTS subscription (
Email VARCHAR(255),
Password VARCHAR(255),
Status VARCHAR(255)
)";

if ($conn->query($subscription) === TRUE) {
    echo "Table subscription created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$registration = "CREATE TABLE IF NOT EXISTS registration (
Name VARCHAR(255),
Email VARCHAR(255),
Username VARCHAR(255),
Password VARCHAR(255),
Token VARCHAR(255),
Status VARCHAR(255)
)";

if ($conn->query($registration) === TRUE) {
    echo "Table registration created successfully<br>";
	echo '<script>alert("All Set ! Now You Can Run The Project ...")</script>';
	echo '<script> window.location.href="Registration.php"</script>';
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>