<?php require_once("init.php");
$user= new User();


if(isset($_POST['photo_name'])){
   $user->ajax_save_user_image($_POST['photo_name'],$_POST['user_id']);
}
if(isset($_POST['photo_id'])){
    Photo::display_side_bar($_POST['photo_id']);
}

?>