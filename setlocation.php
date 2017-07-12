<?php
include("config.php");
mysql_select_db($dbname)or die("cannot select DB");
			$location;
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
  		    	$location = test_input($_POST["address1"]);
				
				}
			
			function test_input($data) {
  				$data = trim($data);
  				$data = stripslashes($data);
  				$data = htmlspecialchars($data);
  				return $data;
			}
			if(isset($location)){
				$sql="INSERT INTO `spider`.`journals` (`location`) VALUES ('$location')";
				$result=mysql_query($sql);
				echo "location set";
				}
?>