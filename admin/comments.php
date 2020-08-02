<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}

?>
<?php
$comments = Comments::find_all();
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
                    Comments
                </h1>
                <p class="bg-success">
                    <?php echo $message ; ?>
                </p>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo ID</th>
                                <th>Author</th>
                                <th>Body</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($comments as $comment) : ?>


                                <tr>
                                    <td><?php echo $comment->id ?></td>
                                    <!-- <td ><img class="admin-photo-thumbnail" src="<?php //echo $user->image_path_and_placeholder() ?>" width="auto" height="100px" alt=""> -->
                                    <td ><?php echo $comment->photo_id ?>
                                        <div class="pictures_link">
                                            <a href="../photo.php?id=<?php echo $comment->photo_id?>">View</a>
                                            <a class="delete_link" href="delete_comment.php?id=<?php echo $comment->id?>">Delete</a>
                                        </div>           
                                    </td>
                                    <td><?php echo $comment->author ?></td>
                                    <td><?php echo $comment->body ?></td>
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