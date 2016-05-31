<?php
session_start();
include_once 'dbconnect.php';

$res=mysql_query("SELECT * FROM admins WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

?>

<?php include 'includes/header.php';
?>

<?php


        $noticeID = $_GET["id"];
    // make sure the show exists (not strictly necessary)
    // it gives some extra security and allows use of 
    // the show's subject_id for the redirect
    if ($notice = $noticeID) {
        // LIMIT 1 isn't necessary but is a good fail safe
        $query = "DELETE FROM `notice` WHERE noticeID = $noticeID LIMIT 1";
        $result = mysql_query ($query);
        if ($result) {
            // Successfully deleted
            $_SESSION['message'] = "notice successfully deleted.";
            header("location:adminview.php");
        } else {
            // Deletion failed
            $_SESSION['message'] = "notice deletion failed: " . mysqli_error($connection);
             header("location:adminview.php");
        }
    } else {
        // show didn't exist, deletion was not attempted
         header("location:adminview.php");;
    }
?>
<?php 
// because this file didn't include footer.php we need to add this manually
mysql_close();
?>
