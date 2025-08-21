   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
    include( DIR_URL."modles/loan.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
   
    
// add student functionality 
if(isset($_POST['submit']))
{
   $result = storeBookLoan($conn,$_POST);

   if(isset($result['error'])) {
      $_SESSION['error'] = $result['error'];
      header("LOCATION:".BASE_URL."loans/add.php");
      exit;
   } else {
      $_SESSION['success'] = "Book Loan has been created Successfully";
      header("LOCATION:".BASE_URL."loans");
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
        <h4 class="text-uppercase fw-bold">Add Loan</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
    Fill the form
  </div>
  <div class="card-body">
      
<form method="post" action ="<?php echo BASE_URL?>loans/add.php">

    <div class="row">

        <div class="col-md-6">
  <div class="mb-3">
    <label  class="form-label">Select Book</label>

    <?php $book = getBook($conn); // echo "<pre>" ; print_r($book) ?>
    <select name="book_id"  class="form-control" > 
     
        <option value="">please select </option>
         <?php while($row = $book->fetch_assoc()){  ?>t
        <option value="<?php echo $row['id'] ?>"> <?php echo $row['title'] ?>  </option>

        <?php 
      }
        ?>
    </select>
  </div>
</div>

           <div class="col-md-6">
  <div class="mb-3">
    <label  class="form-label">Select Student</label>

    <?php $student = getStudent($conn); // echo "<pre>" ; print_r($student) ?>
    <select name="student_id"  class="form-control" > 
     
        <option value="">please select </option>
         <?php while($row = $student->fetch_assoc()){  ?>
        <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?>  </option>

        <?php 
      }
        ?>
    </select>
  </div>
</div>
    
 
<div class="col-md-6">
  <div class="mb-3">
    <label  class="form-label">Loan Date</label>
    <input type="date" class="form-control" name = "loan_date" >
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Return/Due Date</label>
    <input type="date" class="form-control" name ="return_date">
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