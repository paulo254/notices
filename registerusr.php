<?php
session_start();

include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $email = mysql_real_escape_string($_POST['email']); 
 $upass = md5(mysql_real_escape_string($_POST['pass']));
 
 if(mysql_query("INSERT INTO users(username,email,password) VALUES('$uname','$email','$upass')"))
 {
  ?>
        <script>alert('successfully registered ');</script>

        <?php
        header("Location: login.php");
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MMU E_Notice</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<!--icon-->
<link rel="icon" type="image/ico" href="images/favicon.png"/>
<!--// icon-->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Free Style Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,400,500,700,800,900,100italic,300italic,400italic,500italic,700italic,800italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<!--//fonts-->



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




<script language="JavaScript">
function IsNotNull(){
	if (document.form1.email == null ||
		document.form1.name == null ||
		document.form1.password == null ||
		document.form1.password2 == null) {
		alert("Please fill out all the fields.");
		return false;
	}
		if (document.form1.email.value.length == 0 ||
			document.form1.name.value.length == 0 ||
			document.form1.password.value.length == 0 ||
			document.form1.password2.value.length == 0) {
			alert("Please fill out all the fields.");
			return false;
		}
		return true;
}

function IsValidEmail(){
	var email = document.form1.email.value;
	var myreg
		= /^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/
	if (myreg.test(email)) {
		return true;
	}
	else {
		alert("The email address is invalid.");
		return false;
	}
}

/*function CheckForMatch() {
	if (document.form1.password.value !=
		document.form1.password2.value) {
		alert("The passwords do not match.\n"+
			"Please re-enter them. Thanks");
		return false;
	}
	return true;
}*/

function checkfields() {
	if (IsNotNull() == false) {
		return false;
	}
	if (IsValidEmail() == false) {
		return false;
	}
	if (CheckForMatch() == false) {
		return false;
	}
	return true;
}
</script>



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
				<a href="index.html"><img src="images/logo2.png" alt="" /></a>
			</div>

			<div class="col-md-4 top-header-right">
				<div class="cart box_1">						
						<p><a href="login.php" class="simpleCart_empty">Not Logged in</a></p>
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
				<ul class="memenu skyblue"><li class="active"><a href="index.html">Home</a></li>
					<li class="grid"><a href="#">Administration</a>
					</li>

					<li class="grid"><a href="#">Faculties</a>
					</li>
					
					<li class="grid"><a href="#">MUKSA</a>						
					</li>

					<li class="grid"><a href="#">Others</a>						
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
					<li><a href="index.html">Home</a></li>
					<li class="active">Login</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->



<center>
<div id="login-form">
<form method="post">
<p>REGISTER</p>
<table align="center" width="300" border="0">
<tr>
<td width="316">
<h5>Username</h5>
<input type="text" name="uname" placeholder="Username" required /></td>
</tr>
<tr>
<td>
<h5>email</h5>
<input type="email" name="email" placeholder="eg@example.com" required /></td>
</tr>
<tr>
<td>
<h5>Password</h5>
<input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="login.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
	<!--start-footer-->
<?php
include 'includes/footer.php';