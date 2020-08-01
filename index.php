<?php include("includes/header.php"); ?>
<?php
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$item_per_page = 4;
$item_total_count = count(Photo::find_all());
$paginate = new Pagination($page, $item_per_page, $item_total_count);
$sql = "SELECT * FROM photos LIMIT {$item_per_page} OFFSET {$paginate->offset()} ";
$photos = Photo::find_this_query($sql);

?>

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">

        <div class="thumbnails row">
            <?php foreach ($photos as $photo) : ?>

                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?php echo $photo->id ?>">
                        <img class="home_page_picture img-responsive" src="admin/<?php echo $photo->picture_path() ?>" alt="">
                    </a>
                </div>

            <?php endforeach; ?>

        </div>

        <div class="row">

            <ul class="pager">
                <?php
                if ($paginate->page_total() > 1) {

                    if ($paginate->has_next()) {

                        echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                    }

                    for ($i = 1; $i <= $paginate->page_total(); $i++) {
                        if ($i == $paginate->current_page) {
                            echo " <li class='active'><a href='index.php?page=$i'>$i</a></li>";
                        } else {
                            echo " <li><a href='index.php?page=$i'>$i</a></li>";
                        }
                    }



                    if ($paginate->has_previous()) {

                        echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                }
                ?>

            </ul>
        </div>




    </div>




    <!-- Blog Sidebar Widgets Column -->
    <!-- <div class="col-md-4"> -->


    <?php //include("includes/sidebar.php"); 
    ?>



    <!-- </div> -->
    <!-- /.row -->

    <?php include("includes/footer.php"); ?>