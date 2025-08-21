   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
      include( DIR_URL."modles/subscription.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
 


    // add subscription  functionality 
if(isset($_POST['submit']))
   {
   $result = storeSubscriptions($conn,$_POST);

   if(isset($result['error'])) {
      $_SESSION['error'] = $result['error'];
      header("LOCATION:".BASE_URL."subscriptions/purchase-history.php");
      exit;
   } else {
      $_SESSION['success'] = "subscription has been created Successfully";
      header("LOCATION:".BASE_URL."subscriptions/purchase-history.php");
      exit;   
   }
  }

   // call getplans function to get plans in table
   $from = "";
   if(isset($_GET['from']))
    $from = $_GET['from'];

      $to = "";
   if(isset($_GET['to']))
    $to = $_GET['to'];

   $history = getSubscriptionPlans($conn,$from,$to);

if ($history && $history->num_rows > 0) {
    $i = 1;
    // loop rows
} else {
    $_SESSION['error'] = "no data found";

   }


  
     include( DIR_URL."include/header.php");
    include( DIR_URL."include/topbar.php");
    include( DIR_URL."include/sidebar.php");  
    ?>
    

     
      <!---main content starts -->
 <main class="mt-1 pt-3">
  <div class="container-fluid">
    <div class="row dashboard-counts">

        <?php include( DIR_URL."include/alert.php");   ?>
        <h4 class="text-uppercase fw-bold">  PURCHASE HISTORY  
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subsModal"style="float:right">
            Create Subscription
          </button>
        </h4>
            
          
          <div class="col-md-12">
        <!-- Card Container -->
        <div class="card">
          <div class="card-header">
            SUBSCRIPTION PURCHASE HISTORY
          </div>

          <div class="card-body">
            <!-- search form -->
              <form method="get">
            <div class="row mb-4">
             
              <div class="col-md-3">
                <label for="fromDate" class="form-label">From</label>
                <input type="date" class="form-control" id="fromDate" name ="from" value= "<?php echo $from ?>">
              </div>
              <div class="col-md-3">
                <label for="toDate" class="form-label">To</label>
                <input type="date" class="form-control" id="toDate" name ="to" value ="<?php echo $to ?>">
              </div>
              <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">Search</button>
              
                </form>
              </div>
              
            </div>
            
            <!-- End Filter Form Row -->

            <!-- Table -->
            <table id="example"  class="table table-bordered table-striped text-center" >
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Plan</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                   <th scope="col">Amount</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr> <?php if($history && $history->num_rows > 0){
                     while($row = $history->fetch_assoc() ){ ?>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row['student_name'] ?></td>
                  <td>
                    <span class="badge text-bg-info"><?php echo $row['plan_name'] ?></span>
              
                </td>
                  <td><?php echo date("d-m-y" , strtotime( $row['start_date']))?></td>
                  <td><?php echo date("d-m-y" , strtotime( $row['end_date']))?></td>
                  <td><?php echo $row['amount']?></td>
                  
                  <td>
                <?php 
$today = date("Y-m-d"); 

if (strtotime($row['end_date']) >= strtotime($today)) { ?>
    <span class="badge bg-success">Active</span>
<?php } else { ?>
    <span class="badge bg-warning">Expired</span>
<?php } ?> </td>

                 
                </tr>
               <?php } }?>

              </tbody>
            </table>
            <!-- End Table -->

          </div>
        </div>
        <!-- End Card -->


      </div>
    </div>
  </div>
</main>



      <!---main content end -->

              
<!-- Modal to create subscription-->
<div class="modal fade" id="subsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Fill the form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
             
<form method="post" action ="<?php echo BASE_URL?>subscriptions/purchase-history.php">

    <div class="row">


           <div class="col-md-12">
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
    
 <div class="col-md-12">
  <div class="mb-3">
    <label  class="form-label">Select Plan</label>

    <?php $plans = getActivePlans($conn); // echo "<pre>" ; print_r($student) ?>
    <select name="plan_id"  class="form-control" > 
      
        <option value="">please select </option>
         <?php while($row = $plans->fetch_assoc()){  ?>
        <option value="<?php echo $row['id'] ?>"> <?php echo $row['title'] ?>  </option>

        <?php 
      }
        ?>
    </select>
</div>
</div>



<div class="col-md-6">
    <div class="mb-3">
  <button type="submit" name = "submit" class="btn btn-success">Save</button>
 <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>
</div>

</form>

      </div>
    
    </div>
  </div>
</div>
        


    

<?php include(DIR_URL."include/footer.php"); ?>