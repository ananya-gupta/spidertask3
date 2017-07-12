<!DOCTYPE html>
<html>
<head>
<title>Online Travel Diary</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
</head>
<body>
   
<?php
include("config.php");
mysql_select_db($dbname)or die("cannot select DB");
session_start();

if(!isset($_SESSION['sess_email'])){
	header('Location:  login.php');
	;}
	else{
 	$email1=$_SESSION['sess_email'];
}
?>
<!-- Navbar -->
<div class="w3-top">
	<div class="w3-bar w3-black w3-card-2">
    	<a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" 		           title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    	<a href="#" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    	<a href="journals.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Public Journals</a>
    	<a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">logout</a>
	</div>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">
	<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
		<div id="floating-panel">
			<form  method="post" name="setlocation">
      			<input id="address" name="address" type="textbox" value="Sydney, NSW">
      			<input  type="submit" value="Geocode" >
      		</form >
        </div>
    	<div id="map"  style="width:100%;height:450px;">
		</div>
    	
		

			
			

	</div>
 </div>

<div class="w3-black" id="tour">
	<div class="w3-container w3-content w3-padding-64" style="max-width:800px">
		<h2 class="w3-wide w3-center">ADD JOURNAL</h2>
		<p class="w3-opacity w3-center"><i>Share your experience!</i></p><br>  
		<p><span class="error">* required field.</span></p>
		
		<form class="form-horizontal"  method="post" name="setjournal">
  
			<div class="form-group">
				<label class="control-label col-sm-2" for="journal">Your Experience:</label>
					<div class="col-sm-10">          
						<textarea type="text" class="form-control" id="journal" placeholder="Your Experience" name="journal"></textarea>
						<span class="error">*</span>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="type">Journal Type:</label>
					<div class="col-sm-10">          
						<input type="text" class="form-control" id="type" placeholder="Enter Type" name="type">
						<span class="error">*</span>
					</div>
			</div>
			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-10">
					<button id="submit" type="submit" class="btn btn-success" >Create Journal</button>
				</div>
			</div>
		</form>

      
	</div>
</div>

	
			
			
			<script>
      				function geocodeAddress(location,journal,geocoder, resultsMap) {
               			geocoder.geocode({'address': location}, function(results, status) {
          					if (status === 'OK') {
            					
			            		var marker = new google.maps.Marker({
             						 map: resultsMap,
             						 position: results[0].geometry.location
            					});
			 					var infowindow = new google.maps.InfoWindow({
    									content: journal
 								});
								infowindow.open(map,marker);
								}
    						else{
								alert('Geocode was not successful for the following reason: ' + status);
								}
							});
						}
						</script>

	<script>

      	function initMap() {
        	var map = new google.maps.Map(document.getElementById('map'), {
          		zoom: 8,
          		center: {lat: -34.397, lng: 150.644}
		   		});
				
				 var geocoder = new google.maps.Geocoder();
        	document.getElementById('submit').addEventListener('click', function() {
				<?php
	
  			$sql1 = "SELECT journal,location FROM spider.journals WHERE username='$email1'";
			
			
			if($queryrun=mysql_query($sql1))
{	
	if(mysql_num_rows($queryrun)==NULL)
	{
		
	}
	else
	{
    			while($row = mysql_fetch_assoc($queryrun)) {
			?>
          		geocodeAddress('<?php echo $row["location"];?>','<?php echo $row["journal"];?>',geocoder, map);
        		
		    <?php
					}
				} }

			?> 
			});
      		}
			</script>
    <script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyP6emY7B-d39v8jHrwl5Nh_kX9oPuKCY&callback=initMap">
    </script>
     <script>
	$('form[name=setjournal]').submit(function(e) {
		 e.preventDefault();
var journal = document.getElementById("journal").value;
var type = document.getElementById("type").value;
var address = document.getElementById("address").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString1 = 'journal1=' + journal + '&type1=' + type + '&address1=' + address;

// AJAX code to submit form.
$.ajax({
type: "POST",
url: "setjournal.php",
data: dataString1,
cache: false,
success: function(mydata){
    alert(mydata);
  }
});

return false;
})


$('form[name=setlocation]').submit(function(e) {
	 e.preventDefault();
	 
var address = document.getElementById("address").value;

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'address1=' + address ;

// AJAX code to submit form.
$.ajax({
type: "POST",
url: "setlocation.php",
data: dataString,
cache: false,
success: function(mydata){
    alert(mydata);
  }
});

return false;
})
    </script>

	<?php
	
// close connection 
mysql_close();
  ?>
 
</body>
</html>