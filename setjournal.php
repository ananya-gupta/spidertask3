<?php
include("config.php");
mysql_select_db($dbname)or die("cannot select DB");
session_start();
$email1=$_SESSION['sess_email'];
// define variables and set to empty values
$journalErr = $typeErr = "";
$journal;
$type;
$location;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $location = test_input($_POST["address1"]);
  if (empty($_POST["journal1"])) {
    $journalErr = "journal is required";

  } 
  else {
    $journal = test_input($_POST["journal1"]);
    }
  
  if (empty($_POST["type1"])) {
    $typeErr = "type is required";
  }
  else {
    $type = test_input($_POST["type1"]);
   }
 }

 
if(isset($journal)&&isset($type)){
	$sql2="UPDATE `spider`.`journals` SET journal='$journal',journal_type='$type',username='$email1' WHERE location='$location'";
	$result2=mysql_query($sql2);
	if($result2){
	
	 echo " New journal Created Successfully" ;      
	
	}

	else {
		echo mysql_error();
	}
	}
	function test_input($data) {
  				$data = trim($data);
  				$data = stripslashes($data);
  				$data = htmlspecialchars($data);
  				return $data;
			}
	?>
