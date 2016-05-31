<?php
session_start();
include_once 'dbconnect.php';

$res=mysql_query("SELECT * FROM admins WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

?>

<?php include 'includes/header.php';
?>


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

<div class="product">
		<div class="container">
			<div class="product-main">
				<div class="col-md-9 p-left">
				<div class="product-one">

	<!--the array to get details-->	
				




					<div class="col-md-4 product-left single-left"> 
					<div class="p-one simpleCart_shelfItem">
					<div id="imagery">
						<a href="upload.php">
								<img src="images/upload.png" />
								</div>
								</a>
					</div>
					</div>
 

					<div class="col-md-4 product-left single-left"> 
					<div class="p-one simpleCart_shelfItem">
					<div id="imagery">
						<a href="adminview.php">
								<img src="images/viewall.jpg" />
								</div>
								</a>				

					</div>
					</div>



					<div class="col-md-4 product-left single-left"> 
					<div class="p-one simpleCart_shelfItem">
					<div id="imagery">
						<a href="adminview.php">
								<img src="images/viewall.jpg" />
								</div>
								</a>				

					</div>
					</div>
					<div class="col-md-4 product-left single-left"> 
					<div class="p-one simpleCart_shelfItem">
					<div id="imagery">
						<a href="adminview.php">
								<img src="images/viewall.jpg" />
								</div>
								</a>				

					</div>
					</div>



					<div class="col-md-4 product-left single-left"> 
					<div class="p-one simpleCart_shelfItem">
					
						<a href="admins.php">
								<img src="images/upload.png" />
								</a>
					</div>
					</div>




				
				<div class="clearfix"> </div>
			</div>
			</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
	</div>
	<!--end-product-->


<? 
include 'includes/footer.php';
?>
