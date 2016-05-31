<?php
session_start();
include_once 'dbconnect.php';

 # logged in user
/*$res=mysql_query("SELECT * FROM admins WHERE admin_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
*/

?>
<!DOCTYPE html>
<html xmlns>
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
                <a href="#"><img src="images/logo2.png" alt="" /></a>
            </div>

            <div class="col-md-4 top-header-right">
                <div class="cart box_1">                        
                        <p>All Admins</class="simpleCart_empty">
                        <div class="clearfix"> </div>
                    </div>


            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>



<!--top-header-->

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
                    <li><a href="#">Home</a></li>
                    <li class="active">Notices</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->




<div class="row-fluid">
    <?php if (@$_SESSION['unauthorized']){
                echo "<p class=\"alert alert-error\">{$_SESSION['unauthorized']}</p>";
        }
            if ( !empty( $_SESSION['message'] ) ) {
            echo "<p class=\"alert alert-success\">{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>


<div class="row-fluid">
    <div class="well">        
        <div class="row-fluid">
            <table class='table table-stripped table-bordered table-hover'>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>category</th>
                <th>Action</th>
                <th>Action</th>
                

                <?php
                $result = mysql_query("select * from admins");
                $admins = array();
                while ($row = mysql_fetch_assoc($result)) {
                     array_push($admins, $row);
                }
                foreach ($admins as $key => $admins) { ?>

                    
                <tr>
                    <td>
                        <?php echo $admins['admin_id']; ?></td>

                        

                    <td>
                        <?php echo $admins['username']; ?>
                    </td>
                      <td>
                        <?php echo $admins['email'];?>
                    </td>
                   <td>
                        <?php echo $admins['category'];?>
                    </td>
                   

                     <td>
                        <a class="btn btn-info btn-small" href="editadmin.php?id=<?php echo $admins['admin_id'];?>
                            "> <i class="icon-edit"></i>
                            Edit
                        </a>
                    </td>

                    <td>
                    <a class="btn btn-danger btn-small"  href="deleteadmin.php?id=<?php echo $admins['admin_id'];?>
                            ">
                            <i class="icon-trash"></i>
                            Delete
                    </a>
                    </td>

                </tr>
                <?php
            }
            ?></table>
        </div>
    </div>
</div>
</div>
<?php include 'includes/footer.php'
?>