<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php
if(isset($_GET['id'])){
    
     $comment = Comments::find_by_id($_GET['id']);
     if($comment){
          $comment->delete();
          $session->message("The Comment: {$comment->id}  has been deleted");
          redirect("comments.php");
     } 
    
     
}else{
    redirect("comments.php");   
    echo"<h1>Can not delete Comment</h1>";
}
   
?>