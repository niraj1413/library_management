   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
      include( DIR_URL."modles/book.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
 
   // call getbook function to get books in table
   
   $books = getBooks($conn);
    $i = 1;
   if(!($books->num_rows > 0))
   {
    $_SESSION['error'] = "error:".$conn->error;
   }
  
   #delete books
   if(isset($_GET['action']) && $_GET['action']== 'delete' )
   {
     $del = deleteBooks($conn, $_GET['id']);
     if($del){
      $_SESSION['success'] = "Book has been deleted successfully";

     }else{
       $_SESSION['error'] = "Something went wrong, try agin";
     }
      header("LOCATION:" . BASE_URL."books");
      exit;
   }

   #status update of book
if(isset($_GET['action']) && $_GET['action'] == 'status')
{
    $update = updateBookStatus($conn, $_GET['id'], $_GET['status']);

    if($update){
        if($_GET['status'] == 1)
            $msg = "Book has been successfully activated";
        else 
            $msg = "Book has been successfully inactivated";

        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong, try again";
    }  

    header("LOCATION:" . BASE_URL . "books");
    exit;
}


  
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
        <h4 class="text-uppercase fw-bold">Manage Books</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
     All books 
  </div>
  <div class="card-body">
       
                  <table id="example" class=" table table-bordered table-striped text-center" style= "width:100%">
               <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Book Name</th>
      <th scope="col">Publisher Name</th>
      <th scope="col">Author Name </th>
      <th scope="col">ISBN Number </th>
      <th scope="col">Category</th>
      <th scope="col">Stauts </th>
      <th scope="col">Created At </th>
      <th scope="col">Action</th>
    </tr>
              </thead>

<tbody>
<?php if($books && $books->num_rows > 0){ 
    while($row = $books->fetch_assoc()){ ?>
        <tr>
            <th scope="row"><?php echo $i++ ?></th>
            <td><?php echo $row['title']?></td>
            <td><?php echo $row['author']?></td>
            <td><?php echo $row['publication_year']?></td>
            <td><?php echo $row['isbn']?></td>
            <td><?php echo $row['cat_name'] ?></td>
            <td><?php 
                if($row['status'] == 1)
                {
                  echo '<span class="badge text-bg-success">ACTIVE</span>';
                }else{
                  echo '<span class="badge text-bg-danger">INACTIVE</span>';
                 
                }
               ?></td>
            <td><?php echo  date("d-m-y h:i A" ,strtotime(  $row['created_at']))?></td>
            <td>
                <a href="<?php echo  BASE_URL?>books/edit.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-primary btn-small">Edit</a>
                <a onclick="return confirm('Are you sure')" href="<?php echo BASE_URL?>books/?action=delete&id=<?php echo $row['id'] ?>"  type="button"  class="btn btn-danger btn-small">Delete</a>

                <?php if($row['status'] == 1){ ?>
  <a href="<?php echo BASE_URL ?>books/index.php?action=status&id=<?php echo $row['id'] ?>&status=0" 
     type="button" class="btn btn-warning btn-small">INACTIVE</a>
<?php } else { ?>
  <a href="<?php echo BASE_URL ?>books/index.php?action=status&id=<?php echo $row['id'] ?>&status=1" 
     type="button" class="btn btn-success btn-small">ACTIVE</a>
<?php } ?>

            </td>
        </tr>
<?php } } else { ?>
        <tr>
            <td colspan="6">No books found</td>
        </tr>
<?php } ?>
</tbody>

             </table>
      

  </div>
</div>

       </div>
      </div>
    </div>
</div>

</main>


      <!---main content end -->


    

<?php include(DIR_URL."include/footer.php"); ?>