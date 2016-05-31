<?php
session_start();
include_once 'dbconnect.php';

 # logged in admin
$res=mysql_query("SELECT * FROM admins WHERE admin_id=".$_SESSION['admin']);
$userRow=mysql_fetch_array($res);
?>

<?php include 'includes/header.php';
?>



<?php


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
                            }  
                      }

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
                 

  <div class="container">

<div class="row-fluid">
    


    <div class="page-header">
   
    <h3>Update Notice: <?php echo $row['name'];?></h3>
    </div>
    <div class"md-offset" >
    <form class="well" action="editnotice.php?id=<?php echo $row['noticeID'];?>" method="POST" enctype="multipart/form-data">


        <label>Name</label><br/>       
        <input class="form-control" type="text" name="name" value="<?php echo $row['name'];?>" class="span3" placeholder="Notice Name"><br/>

        <label>Description</label><br/>
        <textarea class="form-control"  name="description" rows="6" cols="25"><?php echo $row['description'];?></textarea><br/>

        <label>Venue</label><br/>
        <input class="form-control"  type="text" name="venue" value="<?php echo $row['venue'];?>" class="span3" /> <br/>
        <br />

        <label>Date</label><br/>
        <input class="form-control" type="date" value="<?php echo $date;?> "></input>  <br/> 

        <label>Time</label><br/>
        <input class="form-control" type="time" value="<?php echo $time;?>"></input>  <br/> 

        <label>Picture</label><br/>

        <img src="<?php echo $row['picture_name'];?>" 
                    height="200px" width="200px" class="img-polaroid" />
        <input class="form-control" type="file" name="file" value="<?php echo $row['picture_name'];?>"><br/>

        <input class="form-control" type="submit" name="submit" value="Update Notice" class="btn-primary btn-large span3" />
    </form>
    <div class"md-offset-2" >
 
</div>
</div>
<?php

include 'includes/footer.php';
?>
