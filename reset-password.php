<?php 


// $base_url ="http://localhost/niraj_library_project/";
// $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

include("config/config.php");
include("config/database.php");
include(DIR_URL."modles/login.php");

//if already logged in 

if(isset($_SESSION['is_users_login'])){
   
header("Location: ".BASE_URL."dashboard.php");
exit;
}
// include( DIR_URL."include/topbar.php");
    //include( DIR_URL."include/sidebar.php");  
    
/*    // password hashing 
 $password = "1234niraj";
   $hash = password_hash($password,PASSWORD_DEFAULT);
   if(password_verify($password , $hash))
   {
     echo "verified";
   }else { echo" in valid";} */

// forgot password functionality check
if(isset($_POST['submit']))
{
   $result = resetPassword($conn, $_POST);

   if(isset($result['status']) && $result['status'] == true){
        $_SESSION['success'] = $result['msg'];
          header("LOCATION:".BASE_URL);
      exit;
   } else {
      $_SESSION['error'] = $result['msg'];
          header("LOCATION:".BASE_URL."forgot-password.php");
      exit;
     
   }
}

include(DIR_URL."include/header.php");
?>

<body style="background-color: #212529;">
  
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <dic class="col-md-12 login-form ">
<div class="card mb-3" style="max-width: 900px;">
  <div class="row g-0">
    <div class="col-md-6">
      <img src="./assets/images/login2.jpg" class="img-fluid rounded-start " alt="...">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h2 class="card-title text-uppercase">NJ LIBRARY</h2>
        <?php include(DIR_URL."include/alert.php"); ?>
        <p class="card-text">Reset password </p>
<form method="post" action="<?php echo BASE_URL ?>reset-password.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Reset Password Code</label>
    <input type="email" class="form-control" name="reset_code" aria-describedby="emailHelp">
    
  </div>

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">New Password</label>
    <input type="email" class="form-control" name = "passworsd" aria-describedby="emailHelp">
    
  </div>

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
    <input type="email" class="form-control" name="conf_password" aria-describedby="emailHelp">
    
  </div>
  
  <button type="submit" name ="submit" class="btn btn-primary">submit</button>
</form> 

    <hr>
    <a href="./index.php" class="link-underline-light card-link" >LOGIN</a>
    




      </div>
    </div>
  </div>
</div>                

            </dic>
        </div>
    </div>

    

    <?php include(DIR_URL."include/footer.php"); ?> 