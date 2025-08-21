   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
   include( DIR_URL."modles/book.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
   
    
// add book functionality 
if(isset($_POST['publish']))
{
   $result = storeBook($conn,$_POST);

   if(isset($result['error'])) {
      $_SESSION['error'] = $result['error'];
   } else {
      $_SESSION['success'] = "Book has been created Successfully";
      header("LOCATION:".BASE_URL."books");
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
        <h4 class="text-uppercase fw-bold">Add Book</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
    Fill the form
  </div>
  <div class="card-body">
    
<form method="post" action ="<?php echo BASE_URL?>books/add.php">

    <div class="row">
        <div class="col-md-6">
             <div class="mb-3">
 
              <label for="exampleInputEmail1"  class="form-label">Books Name </label>
              <input type="text" name ="title"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
    
             </div>
        </div>

        <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleInputPassword1"  class="form-label">Author</label>
                  <input type="text" name ="author" class="form-control" id="exampleInputPassword1" >
              </div>
        </div>
    
 
<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1"  class="form-label">Publication Year</label>
    <input type="text" name="publication_year" class="form-control" id="exampleInputPassword1" >
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">ISBN</label>
    <input type="number" name="isbn"class="form-control" id="exampleInputPassword1">
  </div>
</div>
</div>
<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Catogary / Course</label>

    <?php $cats = getCategorie($conn); // echo "<pre>" ; print_r($cats) ?>
    <select name="category_id"  class="form-control" > 
     
        <option value="">please select </option>
         <?php while($row = $cats->fetch_assoc()){  ?>t
        <option value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?>  </option>

        <?php 
      }
        ?>
    </select>
  </div>
</div>

<div class="col-md-6">
    <div class="mb-3">
  <button name ="publish" type="submit" class="btn btn-primary">Publish</button>
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