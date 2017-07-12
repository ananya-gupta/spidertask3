<!DOCTYPE html>
<html>
<title>Public Journals</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
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
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="newjournal.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    
   <a href="journals.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">PUBLIC JOURNALS</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">LOGOUT</a>
    
</div>
</div>



<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">



  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
        
<div id="googleMap" style="width:100%;height:550px;"></div>
<center><button id="show" type="submit" class="btn btn-success" >Show Journal</button></center>
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

function myMap() {
map = new google.maps.Map(document.getElementById('googleMap'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
		var geocoder = new google.maps.Geocoder();
        	document.getElementById('show').addEventListener('click', function() {
				<?php
	
  			$sql1 = "SELECT journal,location FROM spider.journals WHERE journal_type='public'";
			
			
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
};
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVcA8AwyUkedvJlnEcXF5BFUaq7d5IbUo&callback=myMap"
  type="text/javascript"></script>
    
  </div>
  </body>
</html>
