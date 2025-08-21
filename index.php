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

// login check
if(isset($_POST['submit']))
{
   $result = login($conn, $_POST);

   if(isset($result['status']) && $result['status'] == true){
      $_SESSION['is_users_login'] = "true";
      $_SESSION['users'] = $result['users'];
      header("Location: ".BASE_URL."dashboard.php");
      exit;
   } else {
      $_SESSION['error'] = "Invalid details";
      header("Location: ".BASE_URL."");
      exit;   
   }
}

include(DIR_URL."include/header.php");
?>
<body style="background-color: #212529;">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-md-12 login-form">
                <div class="card mb-3" style="max-width: 900px;">
                  <div class="row g-0">
                    <div class="col-md-5">
                      <img src="./assets/images/login2.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-7">
                      <div class="card-body">
                        <h2 class="card-title text-uppercase">NJ LIBRARY</h2>
                        <?php include(DIR_URL."include/alert.php"); ?>
                        <p class="card-text">Enter email and password to login</p>

                        <form method="post" action="<?php echo BASE_URL ?>">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                          </div>
                          <button type="submit" name="submit" class="btn btn-primary">Login</button>
                        </form> 

                        <hr>
                        <a href="./forgot-password.php" class="link-underline-light card-link">Forgot Password?</a>
                      </div>
                    </div>
                  </div>
                </div>                
            </div>
        </div>
    </div>
<?php include(DIR_URL."include/footer.php"); ?>  
