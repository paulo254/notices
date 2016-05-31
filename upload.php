
<?php
session_start();
include_once 'dbconnect.php';
/*
if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}*/
$res=mysql_query("SELECT * FROM admins WHERE admin_id=".$_SESSION['admin']);
$userRow=mysql_fetch_array($res);
?>

<!DOCTYPE html>
<html>

<head>


<title>Upload Notice</title>
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
                <a href="#"><img src="images/logo2.png" alt="" /></a>
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
                <li>Admin</li>
                    <li><a href="notice_admin.php">Admin Home</a></li>
                    <li class="active">Upload Notice</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->



    <header><center>
        <h1>Upload a Notice</h1>       
     </center></header>

<!--php for uploading-->

 
<!--uploading php-->


    <div class="main-content">
    <div class"md-offset" >
        <form class="form-labels-on-top well" action= "upload.php" method= "POST" enctype="multipart/form-data">
      
           <!-- <div class="form-title-row">
                <h1>Upload a Notice</h1>
            </div>-->

            <div class="form-row">
                <label>
                    <span>Notice Name</span>
                    <input type="text" name="n_name" required placeholder="Enter Name for Notice ">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required placeholder="contact email">
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Notice Category</span>
                    <select name="category">
                        <option>Administration</option>
                        <option>Faculty</option>
                        <option>MUKSA</option>
                        <option>Others</option>
                    </select>
                </label>
            </div>

             <div class="form-row">
                <label>
                    <span>Describe Event</span>
                   <textarea cols="35" rows="5" placeholder="Brief Description" name="description"></textarea>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span>Venue</span>
                    <input type="text" name="venue" required placeholder="Event venue ">
                </label>
            </div>

             <div class="form-row">
                <label>
                    <span>Charges (leave empty if free)</span>
                    <input type="text" name="charges" placeholder="Enter amount to be charged ">
                </label>
            </div>

            

              <div class="form-row">
               <label>
                <span>Event date</span>
					<input type="date" id="edate" placeholder="DATE" required name="edate" min="<?php echo date("Y-m-d"); ?>" >
					</label>
                    
                     
            </div>



               <div class="form-row">
               <label>
                <span>Kick-Off Time</span>
					<input type="time"  required name="etime">
					</label>
            </div>


            <div class="form-row">
               <label>
                <span>Ends At</span>
                    <input type="time"  required name="endtime">
                    </label>
            </div>



            <div class="form-row">
                <label>
                    <span>Poster</span>
                    <input type="file" name="file">

                </label>
            </div>


              <div class="form-row">
               
                    <label>
                   <input type= "submit" value= "UPLOAD" name="submit">
                   </label> 
                
            </div>
</form>
</div>

<!--code for database connection-->


<?php

require_once "dbconnect.php";

if(isset($_POST['submit']))
{
 $n_name = mysql_real_escape_string($_POST['n_name']);
 $email = mysql_real_escape_string($_POST['email']); 
 $category = mysql_real_escape_string($_POST['category']);
 $description = mysql_real_escape_string($_POST['description']);
 $venue = mysql_real_escape_string($_POST['venue']);
 $charges = mysql_real_escape_string($_POST['charges']);
 $edate = mysql_real_escape_string($_POST['edate']);
 $etime = mysql_real_escape_string($_POST['etime']);
  $endtime = mysql_real_escape_string($_POST['endtime']);
 $image_name = "";
 /*$file = mysql_real_escape_string($_POST['uploads/file']);*/

 

				if(isset($_FILES['file']))
				{
					$name=$_FILES['file']['name'];
				$tmp_name=$_FILES['file']['tmp_name'];

				   if(!empty($name))
				      {
				 $location='uploads/';
				 
				 		if(move_uploaded_file($tmp_name, $location.$name))
				 			{

                                $image_name = $location.$name;
				 				

				 				/*echo 'File successfully uploaded';*/
				 			
				 		    } else{
				 		    	
                                ?>
                                <script>alert('Image not uploaded. Try again... ');</script>

                                <?php
        /*echo 'error occured when uploading your file';*/
				 		    }  
				      }

				   else
				    {
				  	echo 'please choose a file';
				   
				    }
				} 

$edate =  strtotime($edate." ".$etime);
$endtime =  strtotime($endtime);


$mysql_query = "INSERT INTO notice (name, email, category, description, venue, charges, edate, endtime, picture_name) VALUES ('$n_name', '$email', '$category', '$description', '$venue', '$charges', '$edate', '$endtime', '$image_name')";

mysql_select_db("mmue_notice");

if(mysql_query($mysql_query))
{
    ?>
        <script>alert('Notice Uploaded Successfully. Click OK to proceed ');
        location.href='adminview.php';

        </script>

        <?php
      /*  header("Location: content.php");*/

    /*echo "successfully executed query";*/
} else {

    ?>
        <script>alert('Ooooops!! Notice not uploaded. Try again... ');
        location.href='upload.php';

        </script>

        <?php
        


    /*echo "Query not working";*/
}
}
 
 
?>


<!--way out after uploading-->

<div class="col-md-3 p-left single-left">             
                    <div class="single-but item_add">
                    <a href="notice_admin.php">
                    <input type="submit" value=" GO Back"/>
                    </a>
                </div>
<!--way out-->


<!--start-footer-->
<?php
include 'includes/footer.php';