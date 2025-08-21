   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
    include( DIR_URL."modles/student.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
   
    
// add student functionality 
if(isset($_POST['submit']))
{
   $result = storeStudent($conn,$_POST);

   if(isset($result['error'])) {
      $_SESSION['error'] = $result['error'];
      header("LOCATION:".BASE_URL."students/add.php");
      exit;
   } else {
      $_SESSION['success'] = "Book Loan has been created Successfully";
      header("LOCATION:".BASE_URL."students");
      exit;   
   }
}
    ?>

  <?php

    include( DIR_URL."include/header.php");
    include( DIR_URL."include/topbar.php");
    include( DIR_URL."include/sidebar.php");  
   ?>
   
     
      <!---main content starts -->
      
 <main class="mt-1 pt-3">
  <div class="container-fluid">
    <div class="row dashboard-counts">
      <div class="col-md-12">
        <?php include( DIR_URL."include/alert.php");   ?>
        <h4 class="text-uppercase fw-bold">Add students</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
    Fill the form
  </div>
  <div class="card-body">
      
<form method="post" action ="<?php echo BASE_URL?>students/add.php">

    <div class="row">
        <div class="col-md-6">
             <div class="mb-3">
 
              <label  class="form-label">Full Name </label>
              <input type="text" class="form-control"  name="name">
    
             </div>
        </div>

        <div class="col-md-6">
              <div class="mb-3">
                <label  class="form-label">Email</label>
                  <input type="email" class="form-control" name = "email" >
              </div>
        </div>
    
 
<div class="col-md-6">
  <div class="mb-3">
    <label  class="form-label">Phone Number</label>
    <input type="text" class="form-control" name = "phone_no" >
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" name ="address">
  </div>
</div>
</div>
  


<div class="col-md-6">
    <div class="mb-3">
  <button type="submit" name = "submit" class="btn btn-success">Save</button>
 <button type="submit" class="btn btn-secondary">Cancel</button>
</div>
</div>

</form>


  </div>
</div>

       </div>
      </div>
    </div>
</div>

</main>
<!---main content end -->

    
<?php include(DIR_URL."include/footer.php"); ?>