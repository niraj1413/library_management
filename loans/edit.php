   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
   include( DIR_URL."modles/loan.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");


// update loan functionality 
if(isset($_POST['update']))
{
   $result = updateLoan($conn,$_POST);

   if(isset($result['success'])) {
       $_SESSION['success'] = "Book Loan has been Updated Successfully";
      header("LOCATION:".BASE_URL."loans");
      exit;   
   } else {
     $_SESSION['error'] = "something went wrong , please try again";
      header("LOCATION:".BASE_URL."loans/edit.php");
      exit;   
     
   }
}


   
//read get parameters to get book data 

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $loans = getLoanById($conn, (int)$_GET['id']);

    if ($loans && $loans->num_rows > 0) {
        $loans = mysqli_fetch_assoc($loans);
       // echo "<pre>"; print_r($book); exit;

    } else {
        echo "No student found with this ID.";
    }
} else {
    header("Location:" . BASE_URL . "loans");
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
        <h4 class="text-uppercase fw-bold">Edit Book Loan </h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
    Fill the form
  </div>
  <div class="card-body">
<form method="post" action ="<?php echo BASE_URL?>loans/edit.php">
  <input type="hidden" name="id" value="<?php echo $loans['id']; ?>">

  <div class="row">
    <div class="col-md-6"> 
      <div class="mb-3">
        <label class="form-label">Select Book</label>

        <?php $books = getBook($conn); ?>
        <select name="book_id" class="form-control">
          <option value="">please select</option>
          <?php 
          while ($row = $books->fetch_assoc()) {
              $selected = ((int)$row['id'] === (int)$loans['book_id']) ? "selected" : "";
              echo "<option value='{$row['id']}' $selected>{$row['title']}</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label class="form-label">Select Student</label>
        <?php $students = getStudent($conn); ?>
        <select name="student_id" class="form-control">
          <option value="">please select</option>
          <?php 
          while ($row = $students->fetch_assoc()) {
              $selected = ((int)$row['id'] === (int)$loans['student_id']) ? "selected" : "";
              echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="col-md-6">
  <div class="mb-3">
    <label  class="form-label">Loan Date</label>
    <input  type="date" class="form-control" name = "loan_date" value ="<?php echo  $loans['loan_date'] ?>" >
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Return/Due Date</label>
    <input type="date" class="form-control" name ="return_date" value ="<?php echo $loans['return_date'] ?>">
  </div>
</div>
</div>
    <div class="col-md-6">
      <div class="mb-3">
        <button name="update" type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo BASE_URL?>loans" class="btn btn-secondary">Back</a>
      </div>
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