   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   include( "config/config.php");
    include( "config/database.php");
    include( DIR_URL."modles/dashboard.php");
    include( DIR_URL."include/middleware.php");

   $counts = getCount($conn);

if (!$counts || 
    ($counts['total_book'] === '' && 
     $counts['total_student'] === '' && 
     $counts['total_loan'] === '' && 
     $counts['total_amount'] === '')) {
    
    $_SESSION['error'] = "No data found.";
}


   $tabs = getTabData($conn);
    

   include( DIR_URL."include/header.php");
    include( DIR_URL."include/topbar.php");
    include( DIR_URL."include/sidebar.php");  
    
    ?>
  

      <!---main content starts -->
 <main class="mt-1 pt-3">
  <div class="container-fluid">
    <div class="row dashboard-counts">
      <div class="col-md-12">
        <h4 class="text-uppercase fw-bold">dashboard</h4>
        <p>statistics of system!</p>
      </div>

      <!-- Card 1 -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Total Books</h6>
            <h1><?php echo $counts['total_book']  ?></h1>
            <a href="<?php echo BASE_URL ?>books" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
       <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Total students</h6>
            <h1><?php echo $counts['total_student']  ?></h1>
            <a href="<?php echo BASE_URL ?>students" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
       <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Total revenue</h6>
            <h1><i class="fa-solid fa-indian-rupee-sign small"></i><?php echo number_format( $counts['total_amount'] ) ?></h1>
            <a href="<?php echo BASE_URL ?>subscriptions/purchase-history.php" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>

       <!-- Card 4 -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Total book loan</h6>
            <h1><?php echo $counts['total_loan']  ?></h1>
            <a href="<?php echo BASE_URL ?>loans" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>

    </div>

<!-- Tabs -->
<div class="row mt-5 dashboard-tabs">
  <div class="col-md-12">

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">

      <li class="nav-item" role="presentation">
        <button class="nav-link text-uppercase active" id="new-student-tab" data-bs-toggle="tab"
          data-bs-target="#new-student-tab-pane" type="button" role="tab"
          aria-controls="new-student-tab-pane" aria-selected="true">
          New Students
        </button>
      </li>

      <li class="nav-item" role="presentation">
        <button class="nav-link text-uppercase" id="recent-loan-tab" data-bs-toggle="tab"
          data-bs-target="#recent-loan-tab-pane" type="button" role="tab"
          aria-controls="recent-loan-tab-pane" aria-selected="false">
          Recent Loans
        </button>
      </li>

      <li class="nav-item" role="presentation">
        <button class="nav-link text-uppercase" id="recent-subs-tab" data-bs-toggle="tab"
          data-bs-target="#recent-subs-tab-pane" type="button" role="tab"
          aria-controls="recent-subs-tab-pane" aria-selected="false">
          Recent Subscription
        </button>
      </li>

    </ul>

    <!-- Tab Content -->

  

    <div class="tab-content p-3 border border-top-0" id="myTabContent">
      <div class="tab-pane fade show active" id="new-student-tab-pane" role="tabpanel"
        aria-labelledby="new-student-tab" tabindex="0">

            <table class="table">
               <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Phone no</th>
      <th scope="col">Registerd On</th>
      <th scope="col">Status</th>
    </tr>
              </thead>
               <tbody>

                 <?php
     $i = 1;
     foreach($tabs['students'] as $st){
     ?>
    <tr>

      <th scope="row"> <?php echo $i++ ?></th>
      <td><?php echo $st['name'] ?></td>
      <td><?php echo $st['phone_no'] ?></td>
      <td><?php  echo date("d-m-y H:i:a " ,strtotime($st['created_at'])) ?></td>
      <td>
     <?php
           if($st['status'] == 1)
                {
                  echo '<span class="badge text-bg-success">ACTIVE</span>';
                }else{
                  echo '<span class="badge text-bg-warning">INACTIVE</span>';
                 
                }
      ?>
      </td>
    </tr>
    <?php } ?>
   
               </tbody>
             </table>
        </div>

      <div class="tab-pane fade" id="recent-loan-tab-pane" role="tabpanel"
        aria-labelledby="recent-loan-tab" tabindex="0">
            <table class="table">
               <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Book Nmae</th>
      <th scope="col">Student Name</th>
      <th scope="col">Loan Date </th>
      <th scope="col">Due Date </th>
      <th scope="col">Status</th>
    </tr>
              </thead>
               <tbody>

      <?php
     $i = 1;
     foreach($tabs['loans'] as $loan){
     ?>
    <tr>
      <th scope="row"><?php $i++ ?></th>
      <td><?php echo $loan['book_title'] ?></td>
      <td><?php echo $loan['student_name'] ?></td>
      <td><?php echo $loan['loan_date'] ?></td>
       <td><?php echo $loan['return_date'] ?></td>

      <td><?php 
                if($loan['is_return'] == 1)
                {
                  echo '<span class="badge text-bg-success">Returned</span>';
                }else{
                  echo '<span class="badge text-bg-warning">ACTIVE</span>';
                 
                }
               ?>
            </td>
    </tr>
   <?php } ?>
               </tbody>
             </table>
      </div>

      <div class="tab-pane fade" id="recent-subs-tab-pane" role="tabpanel"
        aria-labelledby="recent-loan-tab" tabindex="0">
            <table class="table">
               <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Amount</th>
      <th scope="col">Start Date </th>
       <th scope="col">End Date </th>
      <td scop ="col">Status</td>
    </tr>
              </thead>
               <tbody>
                <?php
     $i = 1;
     foreach($tabs['subscriptions'] as $sub){
     ?>
    <tr>
      <th scope="row"><?php echo $i++ ?></th>
      <td><?php echo $sub['student_name'] ?></td>
      <td><i class="fa-solid fa-indian-rupee-sign small"></i><?php echo $sub['amount'] ?></td>
      <td><?php echo $sub['start_date'] ?></td>
      <td><?php echo $sub['end_date'] ?></td>
       
       <td>
                <?php 
$today = date("Y-m-d"); 

if (strtotime($sub['end_date']) >= strtotime($today)) { ?>
    <span class="badge bg-success">Active</span>
<?php } else { ?>
    <span class="badge bg-warning">Expired</span>
<?php } ?> </td>


    </tr>
   <?php } ?>
               </tbody>
             </table>
      </div>

      
    </div>
  </div>
</div>

</main>


      <!---main content end -->

    

<?php include( DIR_URL."include/footer.php"); ?>