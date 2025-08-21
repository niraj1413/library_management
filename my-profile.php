   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "../config/config.php");
     include(DIR_URL."modles/login.php");
    include( DIR_URL."config/database.php");
    include( DIR_URL."include/middleware.php");
 

    


    // add-edit plans  functionality 
if(isset($_POST['submit']))
{
   if($_POST['id'] == ''){
   $result = storePlans($conn,$_POST);

   if(isset($result['error'])) {
      $_SESSION['error'] = $result['error'];
      header("LOCATION:".BASE_URL."subscriptions");
      exit;
   } else {
      $_SESSION['success'] = "Plan  has been created Successfully";
      header("LOCATION:".BASE_URL."subscriptions");
      exit;   
   }
}else{ #update plans
 $result = updatePlan($conn,$_POST);

   if(isset($result['success'])) {
       $_SESSION['success'] = "Plan has been Updated Successfully";
      header("LOCATION:".BASE_URL."subscriptions");
      exit;   
   } else {
     $_SESSION['error'] = "something went wrong , please try again";
      header("LOCATION:".BASE_URL."subscriptions");
      exit;   
     
   }
}

}

   // call getplans function to get plans in table
   $plans = getPlans($conn);

if ($plans && $plans->num_rows > 0) {
    $i = 1;
    // loop rows
} else {
    $_SESSION['error'] = "error:".$conn->error;
   }



 #get data for updating  plans
if(isset($_GET['action']) && $_GET['action'] == 'edit'  &&  isset($_GET['id']) && $_GET['id'] > 0)
{
    $plan = getPlanById($conn, (int)$_GET['id']);

     if ($plan && $plan->num_rows > 0) {
        $plan = mysqli_fetch_assoc($plan);
       // echo "<pre>"; print_r($plan); exit;

    } 

  }else{
    $plan = array('title' => '' , 'amount' => '' , 'duration'=>'' ,'id'=>'');
}


  
   #delete plans
   if(isset($_GET['action']) && $_GET['action']== 'delete' )
   {
     $del = deletePlans($conn, $_GET['id']);
     if($del){
      $_SESSION['success'] = "Plan has been deleted successfully";

     }else{
       $_SESSION['error'] = "Something went wrong, try agin";
     }
      header("LOCATION:" . BASE_URL."subscriptions");
      exit;
   }

   #status update of plans
if(isset($_GET['action']) && $_GET['action'] == 'status')
{
    $update = updatePlanStatus($conn, $_GET['id'], $_GET['status']);

    if($update){
        if($_GET['status'] == 1)
            $msg = "plan has been successfully activated";
        else 
            $msg = "plan has been successfully deactivated";

        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong, try again";
    }  

    header("LOCATION:" . BASE_URL . "subscriptions");
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
<h4 class="text-uppercase fw-bold">my profile</h4>         

<!-- Row with table and form -->
        <div class="row">
          
          
          <!-- Form (col-6) -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
             Account Information
              </div>
              <div class="card-body">
                <form  method="post" action ="<?php echo BASE_URL?>subscriptions/index.php">
                 <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                  <div class="mb-3">
                    <label for="planTitle" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="planTitle" placeholder="Enter Plan Title" name = "name" >
                  </div>
                  <div class="mb-3">
                    <label for="planAmount" class="form-label">Email</label>
                    <input type="text" class="form-control" id="planAmount" placeholder="Enter Amount" name = "email">
                  </div>
                  <div class="mb-3">
                    <label for="planTitle" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="planTitle" placeholder="Enter Plan Title" name = "phone_no" >
                  </div>
<div class="mb-3">
  <label for="planDuration" class="form-label">Duration</label>
  <select class="form-select" id="planDuration" name="duration">
    <option selected disabled>Select Duration</option>
    <?php    
      for($i = 1; $i <= 12; $i++) { 
          $selected = ((int)$i === (int)($plan['duration'] ?? 0)) ? "selected" : "";  //isset($plan['duration']) ? $plan['duration'] : 0
          echo "<option value='{$i}' $selected>{$i} month(s)</option>";
      }  
    ?>
  </select>
</div>

                  <div class="mt-3">
                    <button type="submit" name = "submit" class="btn btn-success">Save</button>

                  <?php  if($plan == ''){ ?>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    <?php } else{  ?> <a  class="btn btn-secondary" href="<?php echo BASE_URL?>subscriptions">cancel</a>  <?php } ?>


                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Form (col-6) -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Change Password
              </div>
              <div class="card-body">
                <form  method="post" action ="<?php echo BASE_URL?>subscriptions/index.php">
                 <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                  <div class="mb-3">
                    <label for="planTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="planTitle" placeholder="Enter Plan Title" name = "title" value ="<?php echo $plan['title'] ?>">
                  </div>
                  <div class="mb-3">
                    <label for="planAmount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="planAmount" placeholder="Enter Amount" name = "amount" value ="<?php echo $plan['amount'] ?>">
                  </div>
<div class="mb-3">
  <label for="planDuration" class="form-label">Duration</label>
  <select class="form-select" id="planDuration" name="duration">
    <option selected disabled>Select Duration</option>
    <?php    
      for($i = 1; $i <= 12; $i++) { 
          $selected = ((int)$i === (int)($plan['duration'] ?? 0)) ? "selected" : "";  //isset($plan['duration']) ? $plan['duration'] : 0
          echo "<option value='{$i}' $selected>{$i} month(s)</option>";
      }  
    ?>
  </select>
</div>

                  <div class="mt-3">
                    <button type="submit" name = "submit" class="btn btn-success">Save</button>

                  <?php  if($plan == ''){ ?>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    <?php } else{  ?> <a  class="btn btn-secondary" href="<?php echo BASE_URL?>subscriptions">cancel</a>  <?php } ?>


                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
        <!-- End Row -->

      </div>
    </div>
  </div>
</main>



      <!---main content end -->


    

<?php include(DIR_URL."include/footer.php"); ?>
