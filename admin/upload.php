<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}

?>

<?php
    $message = "";
    if(isset($_POST['submit'])){
        $photo = new Photo();
        $photo->title = $_POST["title"];
        $photo->set_file($_FILES["file_upload"]);

        if($photo->save()){
            $message = "Photo uploaded successfully";
        }else{
            $message = join("<br>",$photo->errors);
        }
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
                    Upload
                </h1>
                <div class="col-md-6">
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="file_upload" >
                        </div>
                        <input type="submit" name="submit">
                    </form>
                </div> 
            </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>