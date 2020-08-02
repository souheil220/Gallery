<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}

?>

<?php

if (isset($_GET['id'])) {
    $photo = Photo::find_by_id($_GET['id']);
    if (isset($_POST['update'])) {
        $photo->title = $_POST['title'];
        $photo->caption = $_POST['caption'];
        $photo->alternate_text = $_POST['alternate_text'];
        $photo->description = $_POST['description'];
        $photo->save();
        $session->message("The Photo: {$photo->id}  has been updated");
        redirect('photos.php');
    }
} else {
    redirect('photos.php');
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
                <h1 class="page-header">
                    Edit Photo
                </h1>
                <form action="" method="POST">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input value="<?php echo $photo->title ?>" type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <a class="thumbnail" href="#"><img src="<?php echo $photo->picture_path()?>" width="auto" height="100px" alt="" ></a>
                        </div>

                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input value="<?php echo $photo->caption ?>" type="text" name="caption" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="caption">Alternate Text</label>
                            <input value="<?php echo $photo->alternate_text ?>" type="text" name="alternate_text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="caption">Description</label>
                            <textarea class="form-control" type="text" name="description" class="form-control" rows="10"><?php echo $photo->description ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside" id="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?php echo $photo->id ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photo->file_name ?></span>
                                    </p>
                                    <p class="text">
                                        File Type: <span class="data"><?php echo $photo->type ?></span>
                                    </p>
                                    <p class="text">
                                        File Size: <span class="data"><?php echo $photo->size ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>