   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
   include( DIR_URL."modles/student.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");


// update book functionality 
if(isset($_POST['update']))
{
   $result = updateStudent($conn,$_POST);

   if(isset($result['success'])) {
       $_SESSION['success'] = "Student has been Updated Successfully";
      header("LOCATION:".BASE_URL."students");
      exit;   
   } else {
     $_SESSION['error'] = "something went wrong , please try again";
      header("LOCATION:".BASE_URL."students/edit.php");
      exit;   
     
   }
}


   
//read get parameters to get book data 

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $student = getStudentById($conn, (int)$_GET['id']);

    if ($student && $student->num_rows > 0) {
        $student = mysqli_fetch_assoc($student);
       // echo "<pre>"; print_r($book); exit;

    } else {
        echo "No student found with this ID.";
    }
} else {
    header("Location:" . BASE_URL . "students");
    exit;  
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
        <h4 class="text-uppercase fw-bold">Edit Students</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
    Fill the form
  </div>
  <div class="card-body">
    
<form method="post" action ="<?php echo BASE_URL?>students/edit.php">
  <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
    <div class="row">
        <div class="col-md-6">
             <div class="mb-3">
 
              <label for="exampleInputEmail1"  class="form-label">Full Name </label>
              <input type="text" name ="name"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value ="<?php echo $student['name']?>">
    
             </div>
        </div>

        <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleInputPassword1"  class="form-label">Phone Number</label>
                  <input type="text" name ="phone_no" class="form-control" id="exampleInputPassword1"  value ="<?php echo $student['phone_no']?>">
              </div>
        </div>
    
 
<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1"  class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="exampleInputPassword1"  value ="<?php echo $student['email']?>" >
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Address</label>
    <input type="text" name="address"class="form-control" id="exampleInputPassword1"  value ="<?php echo $student['address']?>">
  </div>
</div>
</div>

<div class="col-md-6">
    <div class="mb-3">
  <button name ="update" type="submit" class="btn btn-primary">Update</button>
 <a   href="<?php echo BASE_URL?>students" type="submit" class="btn btn-secondary">Back</a>
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