<?php 

if(isset($_SESSION['is_user_login'])){
    return true;
}else{
    
    $_SESSION['error'] = "please login";

    header("LOCATION:".BASE_URL );
    exit;
}
  