   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
      include( DIR_URL."modles/student.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
 
   // call getbook function to get books in table
   
   $students = getStudents($conn);
    $i = 1;
   if(!($students->num_rows > 0))
   {
    $_SESSION['error'] = "error:".$conn->error;
   }
  
   #delete books
   if(isset($_GET['action']) && $_GET['action']== 'delete' )
   {
     $del = deleteStudents($conn, $_GET['id']);
     if($del){
      $_SESSION['success'] = "Student has been deleted successfully";

     }else{
       $_SESSION['error'] = "Something went wrong, try agin";
     }
      header("LOCATION:" . BASE_URL."students");
      exit;
   }

   #status update of book
if(isset($_GET['action']) && $_GET['action'] == 'status')
{
    $update = updateStudentStatus($conn, $_GET['id'], $_GET['status']);

    if($update){
        if($_GET['status'] == 1)
            $msg = "Student has been successfully activated";
        else 
            $msg = "Student has been successfully inactivated";

        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong, try again";
    }  

    header("LOCATION:" . BASE_URL . "students");
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
        <h4 class="text-uppercase fw-bold">Manage Students</h4>
       <div class="col-md-12">

<div class="card">
  <div class="card-header">
     All Students 
  </div>
  <div class="card-body">
       
                  <table id="example" class="table table-bordered table-striped text-center" style= "width:100%">
               <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full Name</th>
      <th scope="col">Phone number</th>
      <th scope="col">Email </th>
      <th scope="col">Address</th>
       <th scope="col">Status</th>
      <th scope="col">Created At </th>
      <th scope="col">Action</th>
    </tr>
              </thead>

<tbody>
<?php if($students && $students->num_rows > 0){ 
    while($row = $students->fetch_assoc()){ ?>
        <tr>
            <th scope="row"><?php echo $i++ ?></th>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['phone_no']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['address']?></td>
            <td><?php 
                if($row['status'] == 1)
                {
                  echo '<span class="badge text-bg-success">ACTIVE</span>';
                }else{
                  echo '<span class="badge text-bg-danger">INACTIVE</span>';
                 
                }
               ?>
            </td>
            <td><?php echo  date("d-m-y h:i A" ,strtotime(  $row['created_at']))?></td>
           
            <td>
                <a href="<?php echo  BASE_URL?>students/edit.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-primary btn-small">Edit</a>
                <a onclick="return confirm('Are you sure')" href="<?php echo BASE_URL?>students/?action=delete&id=<?php echo $row['id'] ?>"  type="button"  class="btn btn-danger btn-small">Delete</a>

    <?php if($row['status'] == 1){ ?>
  <a href="<?php echo BASE_URL ?>students/index.php?action=status&id=<?php echo $row['id'] ?>&status=0" 
     type="button" class="btn btn-warning btn-small">INACTIVE</a>
<?php } else { ?>
  <a href="<?php echo BASE_URL ?>students/index.php?action=status&id=<?php echo $row['id'] ?>&status=1" 
     type="button" class="btn btn-success btn-small">ACTIVE</a>
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