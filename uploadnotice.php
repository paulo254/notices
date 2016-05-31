    <?php
//$size=$_FILES["file"]['size'];
//$type=$_FILES["file"]['type'];

if(isset($_FILES['file']))
{
    $name=$_FILES['file']['name'];
$tmp_name=$_FILES['file']['tmp_name'];

   if(!empty($name))
      {
 $location='uploads/';
 
        if(move_uploaded_file($tmp_name, $location.$name))
            {
                echo 'File successfully uploaded';
                 header("Location: content.php");
            
            } else{
                echo 'error occured when uploading your file';
            }  
      }

   else
    {
    echo 'please choose a file';
   
    }
}

?>