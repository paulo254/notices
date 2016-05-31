
<!--
/*
if(!isset($_SESSION['user']))
{
 header("Location: content.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
*/
-->


<?php
session_start();
include_once 'dbconnect.php';


if(!isset($_SESSION['user']))
{
 header("Location: updatenotice.php");
}
$res=mysql_query("SELECT * FROM admins WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>





<? 
#code for update





if ( isset( $_POST['submit'] ) ) {

    //Update record
   
    $notice_name = trim( $_POST['name'] );
    $description = trim($_POST['description']);
    $id = $_GET['id'];
    //$noticeID = mysql_prep( $_POST['noticeID'] );
    $venue =  $_POST['venue'] ;
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
                              


                   else
                    {
                    echo 'please choose a file';
                   
                    }
                } 

    //$data = file_get_contents($_FILES['picture']['tmp_name']);
    //$data = mysql_real_escape_string($data);

    $query = "UPDATE `notice` SET
                name = '{$notice_name}',
                description = '{$description}',
                venue = '{$venue}',
                picture_name = '{$image_name}'
              WHERE noticeID = {$id}";
   echo $query; 

    if (mysql_query($query)) {
        //Update Success
        $_SESSION['message'] = "The notice was updated successfully";
        header("Location:adminview.php");
        //redirect_to("edit_show.php?id=".$id);
    } else {
        //Update Failed
        $_SESSION['message'] = "The notice update failed";
        header("Location:editnotice.php?id=".$id);
    }

} 
?>


<?php

$noticeID = $_GET["id"];
$query = "SELECT * FROM `notice` WHERE noticeID =" . $noticeID . " ";
$result = mysql_query($query);
 $row = mysql_fetch_array($result);

?>
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
                <li>Admin</li>
                    <li><a href="view_all.php">Notices</a></li>
                    <li class="active">update notice</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->



    <header><center>
        <h1>update Notice</h1>       
     </center></header>

<!--php for uploading-->

 
<!--uploading php-->


    <div class="main-content">
        <form class="form-labels-on-top" action= "upload.php" method= "POST" enctype="multipart/form-data">
      
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
                    <input type="text" name="charges" required placeholder="Enter amount to be charged ">
                </label>
            </div>

              <div class="form-row">
               <label>
                <span>Event date</span>
					<input type="date" placeholder="DATE" required name="edate">
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
<!--way out after uploading-->

<div class="col-md-3 p-left single-left">             
                    <div class="single-but item_add">
                    <a href="view_all.php">
                    <input type="submit" value=" GO Back"/>
                    </a>
                </div>
<!--way out-->


<!--start-footer-->
    <div class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="col-md-3 footer-left">
                    <h3>ABOUT US</h3>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="#">Our Sites</a></li>
                        <li><a href="#">In The News</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Carrers</a></li>                     
                    </ul>
                </div>
                <div class="col-md-3 footer-left">
                    <h3>YOUR ACCOUNT</h3>
                    <ul>
                        <li><a href="account.html">Your Account</a></li>
                        <li><a href="#">Personal Information</a></li>
                        <li><a href="contact.html">Addresses</a></li>
                        <li><a href="#">Discount</a></li>
                        <li><a href="#">Track your order</a></li>                                        
                    </ul>
                </div>
                <div class="col-md-3 footer-left">
                    <h3>CUSTOMER SERVICES</h3>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Cancellation</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Bulk Orders</a></li>
                        <li><a href="#">Buying Guides</a></li>                   
                    </ul>
                </div>
                <div class="col-md-3 footer-left">
                    <h3>CATEGORIES</h3>
                    <ul>
                        <li><a href="#">Sports Shoes</a></li>
                        <li><a href="#">Casual Shoes</a></li>
                        <li><a href="#">Formal Shoes</a></li>
                        <li><a href="#">Party Shoes</a></li>
                        <li><a href="#">Ethnic</a></li>              
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--end-footer-->
    <!--end-footer-text-->
    <div class="footer-text">
        <div class="container">
            <div class="footer-main">
                <p class="footer-class">© 2015 Free Style All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
            </div>
        </div>
        <script type="text/javascript">
                                    $(document).ready(function() {
                                        /*
                                        var defaults = {
                                            containerID: 'toTop', // fading element id
                                            containerHoverID: 'toTopHover', // fading element hover id
                                            scrollSpeed: 1200,
                                            easingType: 'linear' 
                                        };
                                        */
                                        
                                        $().UItoTop({ easingType: 'easeOutQuart' });
                                        
                                    });
                                </script>
        <a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    </div>
    <!--end-footer-text-->  
</body>
</html>