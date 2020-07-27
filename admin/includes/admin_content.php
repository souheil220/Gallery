<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
        </h1>
        <?php
            // $user= new User();
            // $user->username = "amir123";   
            // $user->password = "123456";   
            // $user->first_name = "Amir";   
            // $user->last_name = "HH";
            // $user->create();
           
            // $user= User::find_by_id(4);
            // $user->username = "amir123";   
            // $user->password = "123456";   
            // $user->first_name = "amir";   
            // $user->last_name = "hh";
            // $user->update();

            $user= User::find_by_id(12);
            $user->delete();

            // $users = User::find_all();
            // print_r($users);

            // $photo= Photo::find_by_id(1);
            // print_r($photo);
            // $photo = Photo::find_all();
            // print_r($photo);

            echo INCLUDES_PATH;

        ?>

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

</div>
