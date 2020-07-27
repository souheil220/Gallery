<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}

?>

<?php
$message="";
if (isset($_GET['id'])) {
   
    $user = User::find_by_id($_GET['id']);
    if (isset($_POST['update'])) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        if(empty($_FILES['user_image'])){
            $message = "lol";
            $user->save();
        }else{
          
            $user->set_file($_FILES["user_image"]);
            $user->save();
            redirect('edit_user.php?id='.$user->id);
        }
       
        
        
    }
} else {
    redirect('users.php');
}






?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <!-- Top Menu Items -->
    <?php include "includes/admin_navbar.php" ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "includes/admin_sidebar.php" ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo $message?>
                <h1 class="page-header">
                    Update User
                </h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6 col-md-offset-3">
                    
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" value="<?php echo $user->first_name?>" name="first_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" value="<?php echo $user->last_name?>" name="last_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $user->username?>" name="username" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" value="<?php echo $user->password?>" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            
                         <img class="thumbnail" src="<?php echo $user->image_path_and_placeholder()?>" style="height: 100px; width: 200px;">
                        </div>

                        <div class="form-group">
                            <input type="file" name="user_image">
                        </div>
                        <input type="submit" value="Update" class="btn btn-primary pull-right" name="update">
                        <a class="btn btn-danger pull-left" href="delete_user.php?id=<?php echo $user->id?>">Delete</a>


                    </div>

                </form>
            </div>
        </div>



        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>