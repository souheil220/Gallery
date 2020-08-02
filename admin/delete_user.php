<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php
if(isset($_GET['id'])){
    
     $user = User::find_by_id($_GET['id']);
     if($user){
          $user->delete_user();
          redirect("users.php");
          
          $session->message("The User: {$user->username}  has been deleted");
     } 
    
     
}else{
    redirect("users.php");   
    echo"<h1>Can not delete User</h1>";
}
   
?>