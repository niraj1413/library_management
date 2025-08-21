   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
      include( DIR_URL."modles/loan.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
 
   // call getloan function to get loans in table
   $loans = getLoan($conn);

if ($loans && $loans->num_rows > 0) {
    $i = 1;
    // loop rows
} else {
    $_SESSION['error'] = "error:".$conn->error;
   }
  
   #delete books
   if(isset($_GET['action']) && $_GET['action']== 'delete' )
   {
     $del = deleteLoans($conn, $_GET['id']);
     if($del){
      $_SESSION['success'] = "Book Loan has been deleted successfully";

     }else{
       $_SESSION['error'] = "Something went wrong, try agin";
     }
      header("LOCATION:" . BASE_URL."loans");
      exit;
   }

   #status update of book
if(isset($_GET['action']) && $_GET['action'] == 'is_return')
{
    $update = updateLoanStatus($conn, $_GET['id'], $_GET['is_return']);

    if($update){
        if($_GET['is_return'] == 1)
            $msg = "Book Loan has been successfully activated";
        else 
            $msg = "Book Loan has been successfully inactivated";

        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong, try again";
    }  

    header("LOCATION:" . BASE_URL . "loans");
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
        <h4 class="text-uppercase fw-bold">Manage Loans</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
     All Loans
  </div>
  <div class="card-body">
       
                  <table id="example" class="table table-bordered table-striped text-center" style= "width:100%">
               <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Book Name</th>
      <th scope="col">Student Name</th>
      <th scope="col">Loan Date</th>
      <th scope="col">Return Date</th>
       <th scope="col">Status</th>
      <th scope="col">Created At </th>
      <th scope="col">Action</th>
    </tr>
              </thead>

<tbody>
<?php if($loans && $loans->num_rows > 0){ 
    while($row = $loans->fetch_assoc()){ ?>
        <tr>
            <th scope="row"><?php echo $i++ ?></th>
            <td><?php echo $row['book_title']?></td>
            <td><?php echo $row['student_name']?></td>
            <td><?php echo  date("d-m-y " ,strtotime(  $row['loan_date']))?></td>
            <td><?php echo  date("d-m-y " ,strtotime(  $row['return_date']))?></td>
            <td><?php 
                if($row['is_return'] == 1)
                {
                  echo '<span class="badge text-bg-success">Returned</span>';
                }else{
                  echo '<span class="badge text-bg-warning">ACTIVE</span>';
                 
                }
               ?>
            </td>
            <td><?php echo  date("d-m-y h:i A" ,strtotime(  $row['created_at']))?></td>
           
            <td>
                <a href="<?php echo  BASE_URL?>loans/edit.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-primary btn-small">Edit</a>
                <a onclick="return confirm('Are you sure')" href="<?php echo BASE_URL?>loans/?action=delete&id=<?php echo $row['id'] ?>"  type="button"  class="btn btn-danger btn-small">Delete</a>

    <?php if($row['is_return'] == 1){ ?>
  <a href="<?php echo BASE_URL ?>loans/index.php?action=is_return&id=<?php echo $row['id'] ?>&is_return=0" 
     type="button" class="btn btn-warning btn-small">ACTIVE</a>
<?php } else { ?>
  <a href="<?php echo BASE_URL ?>loans/index.php?action=is_return&id=<?php echo $row['id'] ?>&is_return=1" 
     type="button" class="btn btn-success btn-small">Returned</a>
<?php } ?> 

            </td>
        </tr>
<?php } } else { ?>
        <tr>
            <td colspan="6">No students found</td>
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