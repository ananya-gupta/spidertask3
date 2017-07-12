<?php
   include("config.php");
  mysql_select_db($dbname)or die("cannot select DB");
session_start(); // Starting Session
$error=""; // Variable To Store Error Message
$email="";
$password="";
 if(isset($_POST['email'])){
  $email = test_input($_POST['email']);
 }
 if (isset($_POST['pwd'])) {
  $password = test_inputpwd($_POST['pwd']);

 }
echo $email;
echo $password;


// SQL query to fetch information of registerd users and finds user match.

$sql=("SELECT * from `spider`.`registration` WHERE password='$password' AND email='$email'");
if($queryrun=mysql_query($sql))
{
	if(mysql_num_rows($queryrun)==NULL)
	{
		echo '<html><span>Invalid Email or Password</span></html>';
		header('Location: registration.php');
	}
	else
	{
	while($row=mysql_fetch_assoc($queryrun))
	{
		$username=$row['name'];
		$email=$row['email'];
		
		
	}
	session_regenerate_id();
  $_SESSION['sess_username'] = $username;
  $_SESSION['sess_email'] = $email;
       
  session_write_close();

 
   header('Location: newjournal.php');
  
	}

	}
else
{
	//echo 'not run';
		echo mysql_error();
}
mysql_close($conn); // Closing Connection


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function test_inputpwd($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data =  MD5($data);
  return $data;
}
?>
