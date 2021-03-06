<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}

?>
<?php
$users = User::find_all();
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
               
                <h1 class="page-header">
                    users
                </h1>
                <p class="bg-success">
                    <?php echo $message ; ?>
                </p>
                <a href="add_user.php" class="btn btn-primary" style="margin:0 5px 10px 0;">Add user</a>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First name</th>
                                <th>Last name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) : ?>


                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td ><img class="admin-photo-thumbnail" src="<?php echo $user->image_path_and_placeholder() ?>" width="auto" height="100px" alt="">
                                    <td ><?php echo $user->username ?>
                                        <div class="pictures_link">
                                            <a href="">View</a>
                                            <a href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
                                            <a class="delete_link" href="delete_user.php?id=<?php echo $user->id?>">Delete</a>
                                        </div>           
                                    </td>
                                    <td><?php echo $user->first_name ?></td>
                                    <td><?php echo $user->last_name ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>