<?php
session_start();
include_once 'dbconnect.php';

$res=mysql_query("SELECT * FROM admins WHERE admin_id=".$_SESSION['admin']);
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
                <th>Poster</th>
                <th>Event Name</th>
                <th>Posted By</th>
                <th>Description</th>
                <th>Charges</th>
                <th>Venue</th>
                <th>Category</th>
                <th>Date</th>
                <th>Action</th>
                <th>Action</th>
                

                <?php
                $result = mysql_query("select * from notice");
                $notices = array();
                while ($row = mysql_fetch_assoc($result)) {
                     array_push($notices, $row);
                }
                foreach ($notices as $key => $notice) { ?>

                    
                <tr>
                    <td>
                        <?php echo $notice['noticeID']; ?></td>

                         <td>
                         <a href="admni_outline.php?noticeID=<?php echo $notice['noticeID']; ?>">
                        <img src=" <?php echo $notice['picture_name']; ?>
                        " 
                    height="50px" width="50px" class="img-polaroid" />
                    </a>
                    </td>

                    <td>
                        <?php echo $notice['name']; ?>
                    </td>
                      <td>
                        <?php echo $notice['email'];?>
                    </td>
                    <td>
                        <?php echo substr($notice['description'],0,30) ."...";?>
                    </td>
                    <td>
                        <?php 
                        if ($notice['charges'] > 1) {
                            # code...
                            echo "KShs.". $notice['charges'];
                        } else  echo "__________";  
                        ?>
                    </td>
                  
                    <td>
                        <?php echo $notice['venue'];?>
                    </td>

                    <td>
                        <?php echo $notice['category'];?>

                    </td>
                                         
                    <td>
                        <?php 
                        $timestamp =  $notice['edate'];
                        
                        $date = date("d/m/Y", $timestamp);
                        $time = date("H:m:s", $timestamp);

                        ?>
                        Date: <?php echo $date;?><br/>
                        Time: <?php echo $time;?><br/>

                     </td>

                     <td>
                        <a class="btn btn-info btn-small" href="editnotice.php?id=<?php echo $notice['noticeID'];?>
                            "> <i class="icon-edit"></i>
                            Edit
                        </a>
                    </td>

                    <td>
                    <a class="btn btn-danger btn-small"  href="deletenotice.php?id=<?php echo $notice['noticeID'];?>
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