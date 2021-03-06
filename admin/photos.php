<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}

?>
<?php
$photos = Photo::find_all();
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
                    Photos
                </h1>
                <p class="bg-success">
                    <?php echo $message ; ?>
                </p>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Photo</th>
                                <th>File name</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($photos as $photo) : ?>


                                <tr>
                                    <td><?php echo $photo->id ?></td>
                                    <td ><img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path() ?>" width="auto" height="100px" alt="">
                                        <div class="pictures_link">
                                            <a href="../photo.php?id=<?php echo $photo->id?>">View</a>
                                            <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                                            <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id?>">Delete</a>
                                        </div>           
                                    </td>
                                    <td><?php echo $photo->file_name ?></td>
                                    <td><?php echo $photo->type ?></td>
                                    <td><?php echo $photo->size ?></td>
                                    <td><?php echo count(Comments::find_the_comments($photo->id)) ?></td>
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