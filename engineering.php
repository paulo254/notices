<?php
session_start();
include_once 'dbconnect.php';


#admin login php code

if(isset($_POST['btn-login']))
{
 $email = mysql_real_escape_string($_POST['email']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM admins WHERE email='$email'");
 $row=mysql_fetch_array($res);
 if($row['password']==md5($upass))
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: upload.php");
 }
 else
 {
  ?>
        <script>alert('wrong details');</script>
        <?php
 }
 
}


 # logged in user
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

?>

<!DOCTYPE html>
<html>
<head>
<title>View_All.php</title>
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
<!--fonts<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,400,500,700,800,900,100italic,300italic,400italic,500italic,700italic,800italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!//fonts-->

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="style.css" type="text/css" />


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
						<div class="mepanel">
							<div class="row">
								<div class="col1 me-one">									
									<ul>
										<li><a href="engineering.php">Engineering</a></li>
										<li><a href="products.html">CIT</a></li>
										<li><a href="products.html">Business</a></li>
										<li><a href="products.html">FAMECO</a></li>
										<li><a href="products.html">SCIENCE</a></li>										
									</ul>
								</div>
								
								
							</div>
						</div>
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
					<li><a href="#">Home</a></li>
					<li class="active">Notices</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->

<!--quick link to upload
	Admin <a href="upload.php">  Try Upload</a>
-->

	<!--start-notices--> 

	<div class="product">
		<div class="container">
			<div class="product-main">
				<div class="col-md-9 p-left">
				<div class="product-one">

	<!--the array to get details-->
				<?php 
				$faculty = $_GET['faculty'];
				$faculty;

				$query= "SELECT * FROM notice WHERE category = '" . $faculty ."'";
		$result = mysql_query($query);
		$notices = array();
		while ($row = mysql_fetch_assoc($result)) {
			 array_push($notices, $row);
		}
?>
				<?php foreach ($notices as $key => $notice) { ?>

					<div class="col-md-4 product-left single-left"> 
					<div class="p-one simpleCart_shelfItem">
					<div id="imagery">
						<a href="outline.php?noticeID=<?php echo $notice['noticeID']; ?>">
								<img src="<?php echo $notice['picture_name']; ?>" alt="" />
								</div>
								</a>

								<script type="text/javascript">
									(function(){
										var img = document.getElementById('imagery').firstChild;
										img.onload=function(){
											if (img.height>img.width) {
												img.height='100%';
												img.width='auto';
											}
										};
									}());
								</script>
								<!--<div class="mask mask1">
									<span>Quick View</span>
								</div>-->
						
						<h4><?php echo $notice['name']; ?> <br/></h4>
						
						<?php 
						$timestamp =  $notice['edate'];
						
						$date = date("d/m/Y", $timestamp);
						$time = date("H:m:s", $timestamp);

						?>
						Date: <?php echo $date;?><br/>
						TIME: <?php echo $time;?><br/>
						
						<p>
						<span class=" item_price"> <?php 
						if ($notice['charges'] > 1) {
							# code...
							echo "KShs.". $notice['charges'];
						} else  echo "Free";  
						?>
						</span></p>
						

					</div>
					</div>

				<?php } ?>

		
				
				<div class="clearfix"> </div>
			</div>
			</div>
			<div class="col-md-3 p-right single-right">
				<h3>Sort by Category</h3>
					<ul class="product-categories">
						<li><a href="#">Administration</a> <span class="count">(14)</span></li>
						<li><a href="#">Faculties</a> <span class="count">(2)</span></li>
						<li><a href="#">MUKSA</a> <span class="count">(2)</span></li>
						<li><a href="#">Others</a> <span class="count">(11)</span></li>
					</ul>


<!-- login form for admins-->

			
			<div id="login-form">
			<h3>Admin login</h3>
			<form method="post">
			<table align="center" width="300" border="0">
			<tr>
			<td><input type="text" name="email" placeholder="Your Email" required /></td>
			</tr>
			<tr>
			<td><input type="password" name="pass" placeholder="Your Password" required /></td>
			</tr>
			<tr>
			<td><button type="submit" name="btn-login">Sign In</button></td>
			</tr>
			<tr>
			<td><a href="register.php">Sign Up Here</a></td>
			</tr>
			</table>
			</form>
			</div>

			<!--login form ends-->

					
					
					
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>
	<!--end-product-->
	<!--start-footer-->
<?php
include 'includes/footer.php';