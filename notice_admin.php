<?php
session_start();
include_once 'dbconnect.php';


 # logged in admin
$res=mysql_query("SELECT * FROM admins WHERE admin_id=".$_SESSION['admin']);
$userRow=mysql_fetch_array($res);



?>

<!DOCTYPE html>
<html> 
<head>
<title>View all Notices</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link rel="icon" type="image/ico" href="images/favicon.png"/>
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
						<p><a class="simpleCart_empty">Admin Logged in as: <?php echo $userRow['username']; ?></a></p></class="simpleCart_empty">
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
                    <li class="grid"><a href="notice_admin.php">Home</a>
                    </li>

                    <li class="grid"><a href="upload.php">Upload</a>
                    </li>
                    
                    <li class="grid"><a href="choose.php">Edit</a>                      
                    </li>

                    <li class="grid"><a href="adminview.php">Delete</a>                     
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

	<div class="product text-center">
		<div class="container">
		<div class="row">
			<div class="product-main">
				<div class="col-md-9 p-left">
				<div class="product-one">

<!--images for admin functions start-->
					<div class="col-md-4 col-sm-6 col-xs-12 text-center"> 
					<div class="p-one simpleCart_shelfItem">
				
						<a href="upload.php">
								<img id="imagery" src="images/upload.png" class="img-responsive" /></a>

						<h4>Upload a notice</h4>
						</div>
					</div>

					<!--vuew all nootices-->
					<div class="col-md-4 col-sm-6 col-xs-12 text-center"> 
					<div class="p-one simpleCart_shelfItem">
				
						<a href="choose.php">
								<img id="imagery" src="images/edit.png" class="img-responsive" /></a>

						<h4>Edit Notice</h4>
						</div>
					</div>

					<!--vuew all nootices-->
					<div class="col-md-4 col-sm-6 col-xs-12 text-center"> 
					<div class="p-one simpleCart_shelfItem">
				
						<a href="adminview.php">
								<img id="imagery" src="images/view.png" class="img-responsive" /></a>

						<h4>View Notices</h4>
						</div>
					</div>
					<!--options end-->
				<div class="clearfix"> </div>
			</div>

			</div>					
					
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>
	<!--end-product-->
	
	<!--start-footer-->
<?php
include 'includes/footer.php';