  <!--offcanva start-->

      <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
     
      <div class="offcanvas-body" >

         <ul class="navbar-nav">
          <li class="nav-item">
         <div class="text-uppercase text-secondary small fw-bold">core</div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL?>dashboard.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
        </li>

        <li class="nav-item ">
         <hr>
        </li>

        <li class="nav-item my-0">
       <div class="text-uppercase text-secondary small fw-bold">inventory</div>
        </li>
      
        <li class="nav-item ">
          <a class="nav-link sidebar-link" data-bs-toggle="collapse" href="#booksMgmt" role="button" aria-expanded="false" aria-controls="booksMgmt">
          
            <i class="fa-solid fa-book-open me-2"></i> Books Managment  <span class="right-icon float-end"><i class="fa-solid fa-chevron-down "></i>
          </span>
          </a>
         <div class="collapse" id="booksMgmt">
        <div>
           <ul class="navbar-nav ps-3">
              <li >
                <a class="nav-link" href="<?php echo BASE_URL ?>books/add.php"><i class="fa-solid fa-plus me-2"></i>Add New</a>
              </li>
              <li >
                 <a class="nav-link" href="<?php echo BASE_URL ?>books/"><i class="fa-solid fa-list"></i>Manage All</a>
              </li>

           </ul>
           
        </div>
        </div>

       </li>

          <li class="nav-item ">
          <a class="nav-link sidebar-link" data-bs-toggle="collapse" href="#studentMgmt" role="button" aria-expanded="false" aria-controls="studentMgmt">
          
            <i class="fa-solid fa-users me-2"></i> students Managment  <span class="right-icon float-end"><i class="fa-solid fa-chevron-down "></i>
          </span>
          </a>
         <div class="collapse" id="studentMgmt">
        <div>
           <ul class="navbar-nav ps-3">
              <li >
                <a class="nav-link" href="<?php echo BASE_URL ?>students/add.php"><i class="fa-solid fa-plus me-2"></i>Add New</a>
              </li>
              <li >
                 <a class="nav-link" href="<?php echo BASE_URL ?>students/"><i class="fa-solid fa-list"></i>Manage All</a>
              </li>
              </div>
          </div>

         </li>

          <li class="nav-item ">
         <hr>
        </li>

        <li class="nav-item my-0">
       <div class="text-uppercase text-secondary small fw-bold">business</div>
        </li>

                <li class="nav-item ">
          <a class="nav-link sidebar-link" data-bs-toggle="collapse" href="#booksloanMgmt" role="button" aria-expanded="false" aria-controls="booksloanMgmt">
          
            <i class="fa-solid fa-book-bible me-2"></i> Books loan  <span class="right-icon float-end"><i class="fa-solid fa-chevron-down "></i>
          </span>
          </a>
         <div class="collapse" id="booksloanMgmt">
        <div>
           <ul class="navbar-nav ps-3">
              <li >
                <a class="nav-link" href="<?php echo BASE_URL ?>loans/add.php"><i class="fa-solid fa-plus me-2"></i>Add New</a>
              </li>
              <li >
                 <a class="nav-link" href="<?php echo BASE_URL ?>loans"><i class="fa-solid fa-list"></i>Manage All</a>
              </li>
          </ul>
           
        </div>
        </div>

       </li>



        <li class="nav-item ">
          <a class="nav-link sidebar-link" data-bs-toggle="collapse" href="#subscriptionMgmt" role="button" aria-expanded="false" aria-controls="subscriptionMgmt">
          
           <i class="fa-solid fa-indian-rupee-sign me-2"></i>Subscription <span class="right-icon float-end"><i class="fa-solid fa-chevron-down "></i>
          </span>
          </a>
         <div class="collapse" id="subscriptionMgmt">
        <div>
           <ul class="navbar-nav ps-3">
              <li >
                <a class="nav-link" href="<?php echo BASE_URL ?>subscriptions"><i class="fa-solid fa-plus me-2"></i>Plans</a>
              </li>
              <li >
                 <a class="nav-link" href="<?php echo BASE_URL ?>subscriptions/purchase-history.php"><i class="fa-solid fa-list"></i>Purchase History</a>
              </li>
          </ul>
           
        </div>
        </div>

       </li>

        <li class="nav-item ">
         <hr>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL ?>logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
        </li>


      </ul>

      </div>
      </div>

      <!---offcanva  end -->