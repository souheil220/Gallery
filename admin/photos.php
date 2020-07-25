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
                    <small>Subheading</small>
                </h1>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Photo</th>
                                <th>File name</th>
                                <th>Title</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($photos as $photo) : ?>


                                <tr>
                                    <td><?php echo $photo->id ?></td>
                                    <td><img src="<?php echo $photo->picture_path() ?>" width="auto" height="100px" alt=""></td>
                                    <td><?php echo $photo->file_name ?></td>
                                    <td><?php echo $photo->type ?></td>
                                    <td><?php echo $photo->size ?></td>
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