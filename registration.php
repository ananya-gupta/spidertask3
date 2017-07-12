<!DOCTYPE html>
<html lang="en">
<head>
<style>
.error {color: #FF0000;}

</style>
  <title>Registration</title>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
include("config.php");
mysql_select_db($dbname)or die("cannot select DB");
// define variables and set to empty values
$nameErr  = $emailErr = $passwordErr = "";
$name;
$email;
$pwd;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
 
  if (empty($_POST["pwd"])) {
    $passwordErr = "Password is required";

  } else {
    $pwd = test_inputpwd($_POST["pwd"]);
  }

  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function test_inputpwd($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data =  MD5($data);
  return $data;
}


?>
<body>

<div class="w3-black" id="tour">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <CENTER><h2>REGISTER / <a href="login.php" >LOG IN</a></h2></CENTER>
  <p><span class="error">* required field.</span></p>
  <form class="form-horizontal" action="registration.php" method="post">
   <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        <span class="error">* <?php echo $nameErr;?></span>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        <span class="error">* <?php echo $emailErr;?></span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        <span class="error">* <?php echo $passwordErr;?></span>
      </div>
    </div>
   
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Register</button>
      </div>
    </div>
  </form>
     
    </div>
  </div>

<?php
if(isset($name)&&isset($email)&&isset($pwd)){
$sql="INSERT INTO `spider`.`registration` (`name`,  `email`, `password`) VALUES ('$name', '$email', '$pwd')";
$result=mysql_query($sql);

if($result){
	 echo "<div class='alert alert-success'>
  <strong>Success!</strong> Registered Successfully.
</div>" ;      
  
}

else {
echo mysql_error();
}}
// close connection 
mysql_close();
?>
</body>


</html>
