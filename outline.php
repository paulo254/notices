<?php
session_start();
include_once 'dbconnect.php';
require "noticefunc.php";

$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>

<!DOCTYPE html>
<html>
<head>
<title>Outline</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,400,500,700,800,900,100italic,300italic,400italic,500italic,700italic,800italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!--//fonts-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
					jQuery(document).ready(function($) {
						$(".scroll").click(function(event){		
							event.preventDefault();
							$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
						});
					});
				</script>	
<!-- start menu -->
<script src="js/simpleCart.min.js"> </script>
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/memenu.js"></script>
<script>$(document).ready(function(){$(".memenu").memenu();});</script>				
</head>
<body> 
	<!--top-header-->
	
<div class="top-header">
	<div class="container">
		<div class="top-header-main">
			<div class="col-md-4 top-header-left">
				<div class="search-bar">
					<div class="search-bar">
					<p>Multimedia University of Kenya</p>					
				</div> 
				</div>
			</div>

			<div class="col-md-4 top-header-middle">
				<a href="#"><img src="images/logo2.png" alt="" /></a>
			</div>

			<div class="col-md-4 top-header-right">
				<div class="cart box_1">						
						<p><a class="simpleCart_empty">Logged in as: <?php echo $userRow['username']; ?></a></p></class="simpleCart_empty">
						<div class="clearfix"> </div>
					</div>


			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>



<!--top-header-->
<!--bottom-header-->
<div class="header-bottom">
		<div class="container">
			<div class="top-nav">
				<ul class="memenu skyblue">
					<li class="grid"><a href="#">Administration</a>
					</li>

					<li class="grid"><a href="#">Faculties</a>
					</li>
					
					<li class="grid"><a href="#">MUKSA</a>						
					</li>

					<li class="grid"><a href="#">Others</a>						
					</li>	
					<li class="grid"><a href="logout.php?logout">Sign Out</a>					
					</li>				
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--bottom-header-->
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="view_all.php">Notices</a></li>
					<li class="active">New Notices</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->

	<!--start-notices--> 

<?php 
$noticeID =  $_GET['noticeID']; 
$selectedNotice = array();

foreach ($notices as $key => $notice) {
	if($notice['noticeID'] == $noticeID){
		array_push($selectedNotice, $notice); 	
	}
}

?>
<!--start-single-->
	<div class="single contact">
		<div class="container">
			<div class="single-main">
				<div class="col-md-9 single-main-left">
				<div class="sngl-top">
					<div class="col-md-5 single-top-left">	
						<div class="flexslider">
							<ul class="slides">
								<li data-thumb="images/s1.jpg">

									<img src="<?php 


											if ($selectedNotice[0]['picture_name']!=="") {
												echo $selectedNotice[0]['picture_name'];
												# code...
											}
											else{
												echo "images/viewall.jpg";
											} ?>"  />
								</li>
								
							</ul>
						</div>
<!-- FlexSlider -->
  <script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

	<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
				</div>	
				<div class="col-md-7 single-top-right">
					<div class="details-left-info simpleCart_shelfItem">
						<h3><?php echo $selectedNotice[0]['name']; ?></h3>
						

						
						<h3><span class="actual item_price"></span>							
					  </h3>
						<h2 class="quick">Event timing</h2>

						<?php 
						$timestamp =  $selectedNotice[0]['edate'];
						
						$date = date("d/m/Y", $timestamp);
						$time = date("H:m:s", $timestamp);


						?>
						<h5>Date:  <?php echo $date;?><br/>
						Time:   <?php echo $time;?><br/> 
						</h5>
						</span>
						</p>


						<!--code for event endi time-->

						<h2 class="quick">Event ends at</h2>

						<?php 
						$timestamp =  $selectedNotice[0]['endtime'];						
						$endtime = date("H:m:s", $timestamp);
						?>
						<h5>
						<?php echo $endtime;?><br/> 
						</h5>
						</span>
						</p>

						<!-- end -->
						<!-- <span class="color">In stock</span>-->
						
							
						<span class="actual item_price"></span>							
						<h2 class="quick">Cost</h2>
						 <?php 
						if ($selectedNotice[0]['charges'] > 1) {
							# code...
							$cost = $selectedNotice[0]['charges'];
						} else  $cost = "0";  
						?>
						<?php echo "KShs.".$cost; ?>
						</span>


							</a>
						

						<h2 class="quick">Venue</h2>
						<p class="quick_desc"><?php echo $selectedNotice[0]['venue']; ?></p>

						<h2 class="quick">Description</h2>
						<p class="quick_desc"><?php echo $selectedNotice[0]['description']; ?></p>

						<h2 class="quick">Contacts</h2>
						<p class="quick_desc"><?php echo $selectedNotice[0]['email']; ?></p>

					
						
					<div class="clearfix"> </div>

					<!--number of attendees-->
					<?php
					$eventid = $_GET['noticeID'];
					$numattending = mysql_query("SELECT * FROM attendance WHERE noticeID='$eventid'");
					$num_rows = mysql_num_rows($numattending);

					?>
					<p>Attending: <?php echo $num_rows?> </p>



					<!--number of attendees-->

					<!--add attendee-->

					<form  method="POST" >
						<div class="single-but item_add">				
							<input type="submit" value=" Add me to the list too" name="attending" />
						</div>
					</form>
					<?php
					
					if (isset($_POST['attending'])) {
						$id = $_GET['noticeID'];
						$email = $_SESSION['email'];
						$userid = $_SESSION['user'];

						$mysql_query = "INSERT INTO attendance (user_id, email, noticeID) VALUES ('$userid', '$email', '$id')";
						mysql_query($mysql_query);

				}
					?>


					<!--add attendee-->
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	</div>
	</div>

	
			<div class="col-md-3 p-right single-right">				
					<div class="single-but item_add">
					<a href="view_all.php">
					<input type="submit" value="Go Back"/>
					</a>
				</div>

					
					
					
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>
	<!--end-product-->
	<!--start-footer-->
<!--start-footer-->
<?php
include 'includes/footer.php';