   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
   include( DIR_URL."modles/book.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");


// update book functionality 
if(isset($_POST['update']))
{
   $result = updateBook($conn,$_POST);

   if(isset($result['success'])) {
       $_SESSION['success'] = "Book has been Updated Successfully";
      header("LOCATION:".BASE_URL."books");
      exit;   
   } else {
     $_SESSION['error'] = "something went wrong , please try again";
      header("LOCATION:".BASE_URL."books/edit.php");
      exit;   
     
   }
}


   
//read get parameters to get book data 

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $book = getBookById($conn, (int)$_GET['id']);

    if ($book && $book->num_rows > 0) {
        $book = mysqli_fetch_assoc($book);
       // echo "<pre>"; print_r($book); exit;

    } else {
        echo "No book found with this ID.";
    }
} else {
    header("Location:" . BASE_URL . "books");
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
        <h4 class="text-uppercase fw-bold">Edit Book</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
    Fill the form
  </div>
  <div class="card-body">
    
<form method="post" action ="<?php echo BASE_URL?>books/edit.php">
  <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
    <div class="row">
        <div class="col-md-6">
             <div class="mb-3">
 
              <label for="exampleInputEmail1"  class="form-label">Books Name </label>
              <input type="text" name ="title"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value ="<?php echo $book['title']?>">
    
             </div>
        </div>

        <div class="col-md-6">
              <div class="mb-3">
                <label for="exampleInputPassword1"  class="form-label">Author</label>
                  <input type="text" name ="author" class="form-control" id="exampleInputPassword1"  value ="<?php echo $book['author']?>">
              </div>
        </div>
    
 
<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1"  class="form-label">Publication Year</label>
    <input type="text" name="publication_year" class="form-control" id="exampleInputPassword1"  value ="<?php echo $book['publication_year']?>" >
  </div>
</div>

<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">ISBN</label>
    <input type="number" name="isbn"class="form-control" id="exampleInputPassword1"  value ="<?php echo $book['isbn']?>">
  </div>
</div>
</div>
<div class="col-md-6">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Catogary / Course</label>

    <?php $cats = getCategorie($conn); // echo "<pre>" ; print_r($cats) ?>
    <select name="category_id" class="form-control">
    <option value="">please select</option>
    <?php 
    while ($row = $cats->fetch_assoc()) {
        $selected = ($row['id'] == $book['category_id']) ? "selected" : "";
        ?>
        <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>>
            <?php echo $row['name']; ?>
        </option>
    <?php 
    }
    ?>
</select>
  </div>
</div>

<div class="col-md-6">
    <div class="mb-3">
  <button name ="update" type="submit" class="btn btn-primary">Update</button>
 <a   href="<?php echo BASE_URL?>books" type="submit" class="btn btn-secondary">Back</a>
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