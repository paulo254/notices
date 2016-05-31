<?php
include 'includes/admin_header.php';
?>
<?php
include 'includes/connection.php';
?>
<?php confirm_logged_in();?>
<?php confirm_user_is_admin($connection); ?>
<ul class="breadcrumb">
    <li>
        <a href="index.php" title="Home">Home</a>
        <span class="divider">/</span>
    </li>
    <li>
        <a href="admin.php" title="Admin">Admin</a>
        <span class="divider">/</span>
    </li>
    <li class="active">Station</li>
</ul>
<div class="row-fluid">
    <?php if (@$_SESSION['unauthorized']){
                echo "<p class=\"alert alert-error\">{$_SESSION['unauthorized']}</p>";
        }
            if ( !empty( $_SESSION['message'] ) ) {
            echo "<p class=\"alert alert-success\">{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>
<div class="page-header">Station</div>

<div class="row-fluid">
	    <?php
        if ( !empty( $message ) ) {
            echo "<p class=\"alert\"> {$message} </p>";
            unset($message);
        }
        if ( !empty( $_SESSION['message'] ) ) {
            echo "<p class=\"alert alert-success\"> {$_SESSION['message']} </p>";
            unset($_SESSION['message']);
        }
?>
    <div class="well">
        <div class="row-fluid">
            <div class="span3 offset10">
                <a href="add_users.php" class="btn btn-primary"> <i class="icon-plus"></i>
                    Add user
                </a>
            </div>
        </div>
        <div class="row-fluid">
            <table class='table table-stripped table-bordered table-hover'>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
               <th>Action</th>
               <th>Action</th>
                <?php
            $query = "SELECT * FROM `users`";
            $result = mysqli_query($connection, $query);
            while($user = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <td>
                        <?php echo $user['id'];?></td>
                    <td>
                        <?php echo $user['fname'];?></td>
                    <td>
                        <?php echo $user['lname'];?></td>
                    <td>
                        <?php echo $user['email'];?>
                    </td> 
                    <td>
                        <?php echo $user['phone'];?>
                    </td>

                       
                    <td>
                        <a class="btn btn-info btn-small" href="edit_users.php?id=<?php echo $user['id'];?>
                            "> <i class="icon-edit"></i>
                            Edit
                        </a>
                    </td>  
                    
                    <td>  
                        <a class="btn btn-danger btn-small"  href="delete_user.php?id=<?php echo $user['id'];?>
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