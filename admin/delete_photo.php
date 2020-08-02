<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php
if(isset($_GET['id'])){
    
     $photo = Photo::find_by_id($_GET['id']);
     if($photo){
          $photo->delete_photo();
          redirect("photos.php");
          $session->message("The Photo: {$photo->id}  has been deleted");
     } 
    
     
}else{
    redirect("photos.php");   
    echo"<h1>Can not delete photo</h1>";
}
   
?>