<?php
session_start();
include_once 'dbconnect.php';

 # logged in user
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

?>

<title>Notices</title>
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  

    <!--<link rel="stylesheet" href="assets/demo.css">-->
    <!-- style sheet for form-->
    <link rel="stylesheet" href="assets/form-labels-on-top.css">

<!--scripts for form validation-->
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
                <a href="view_all.php"><img src="images/logo2.png" alt="" /></a>
            </div>

            <div class="col-md-4 top-header-right">
                <div class="cart box_1">                        
                        <p><class="simpleCart_empty">Admin Logged in as: <?php echo $userRow['username']; ?></a></p></class="simpleCart_empty">
                        
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
					<li class="grid"><a href="administration.php?category=administration">Administration</a>
					</li>

					<li class="grid"><a href="faculties.php?category=Faculty">Faculties</a>
						
					</li>
					
					<li class="grid"><a href="muksa.php?category=muksa">MUKSA</a>						
					</li>

					<li class="grid"><a href="others.php?category=others">Others</a>						
					</li>
					<li class="grid"><a href="#">user options</a>	
					<div class="mepanel">
							<div class="row">
								<div class="col1 me-one">									
									<ul>
										<li><a href="#">change password</a></li>
										<li><a href="logout.php?logout">LOGOUT</a></li>										
									</ul>
								</div>								
							</div>
						</div>				
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
					<li><a href="view_all.php">Home</a></li>
					<li class="active">Admin Notices</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->

	<!--start-notices--> 

	
	<div class="product text-center">
		<div class="container">
		<div class="row">
			<div class="product-main">
				<div class="col-md-9 p-left">
				<div class="product-one">

	<!--the array to get details-->
				<?php 
				$category = $_GET['category'];
				$category;

				$query= "SELECT * FROM notice WHERE category = '" . $category ."'";
		$result = mysql_query($query);
		$notices = array();
		while ($row = mysql_fetch_assoc($result)) {
			 array_push($notices, $row);
		}
?>
				<?php foreach ($notices as $key => $notice) { ?>


					<div class="col-md-4 col-sm-6 col-xs-12 text-center"> 
					<div class="p-one simpleCart_shelfItem">
						<a href="outline.php?noticeID=<?php echo $notice['noticeID']; ?>">
								<img id="imagery" src="<?php
								if($notice['picture_name']!==""){
									echo $notice['picture_name'];
									} 
									 else{
									 	echo "images/viewall.jpg";
									 } 
									?>" alt="" class="img-responsive" />
								
								</a>							
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
					<li><a href="administration.php?category=administration">Administration</a> <span class="count">
					<!--number of attendees-->
					<?php
					
					$numadmin = mysql_query("SELECT * FROM notice WHERE Category='Administration'");
					$num_rows = mysql_num_rows($numadmin);

					?>
					<p>( <?php echo $num_rows?> )</p>

					</span></li>
					<li><a href="faculties.php?category=Faculty">Faculties</a> <span class="count"><?php
					
					$numadmin = mysql_query("SELECT * FROM notice WHERE Category='Faculty'");
					$num_rows = mysql_num_rows($numadmin);

					?>
					<p>( <?php echo $num_rows?> )</p></span></li>
					<li><a href="muksa.php?category=muksa">MUKSA</a> <span class="count"><?php
					
					$numadmin = mysql_query("SELECT * FROM notice WHERE Category='muksa'");
					$num_rows = mysql_num_rows($numadmin);

					?>
					<p>( <?php echo $num_rows?> )</p></span></li>
					<li><a href="others.php?category=others">Others</a> <span class="count"><?php
					
					$numadmin = mysql_query("SELECT * FROM notice WHERE Category='Others'");
					$num_rows = mysql_num_rows($numadmin);

					?>
					<p>( <?php echo $num_rows?> )</p></span></li>
					</ul>


					
					
					
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>
	</div>
	<!--end-product-->
	
	<!--start-footer-->
<?php
include 'includes/footer.php';