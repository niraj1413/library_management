   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   
function storePlans($conn, $param)
{
    extract($param);

    // validation
    if (empty($title)) {
        return ['error' => 'title selection is required'];
    } 
    else if (empty($amount)) {   // Make sure your form field is name="plan_id"
        return ['error' => 'amount selection is required'];
    } else if (empty($duration)) {   // Make sure your form field is name="plan_id"
        return ['error' => 'amount selection is required'];
    }

    $datetime   = date("Y-m-d H:i:s");
   
        $sql = "INSERT INTO subscription_plans(title, amount, duration, created_at) 
                VALUES ('$title', '$amount', '$duration', '$datetime')";

        if ($conn->query($sql)) {
            return ['success' => true];
        } else {
            return ['error' => 'Database insert failed: '.$conn->error];
        }
      }


  
  // function to store subscription

function storeSubscriptions($conn, $param)
{
    extract($param);

    // validation
    if (empty($student_id)) {
        return ['error' => 'student selection is required'];
    } 
    if (empty($plan_id)) {   // Make sure your form field is name="plan_id"
        return ['error' => 'plan selection is required'];
    }

    $datetime   = date("Y-m-d H:i:s");
    $start_date = date("Y-m-d");

    // Get plan details
    $plan = getPlanById($conn, $plan_id);
    if ($plan->num_rows > 0) {
        $plan = mysqli_fetch_assoc($plan);
        $duration = $plan['duration'];

        // Calculate end date
        $end_date = date("Y-m-d", strtotime("+$duration months", strtotime($start_date)));
           $amount = $plan['amount'];
        // Insert subscription
        $sql = "INSERT INTO subscriptions(student_id, plan_id, start_date, end_date,amount, created_at) 
                VALUES ('$student_id', '$plan_id', '$start_date', '$end_date' ,'$amount', '$datetime')";

        if ($conn->query($sql)) {
            return ['success' => true];
        } else {
            return ['error' => 'Database insert failed: '.$conn->error];
        }
    } else {
        return ['error' => 'Invalid plan selected'];
    }
}



  // function to store subscription ends here

  //function to get book for select option in add loan 

  function getActivePlans($conn)
  {
    $sql = " SELECT  *from subscription_plans where status = 1";
    $result = $conn->query($sql);
    return $result;
   
  }

   //function to get boook for select options ends here

 function getPlans($conn)
  {
    $sql = " SELECT  *from subscription_plans order by id asc";
    $result = $conn->query($sql);
    return $result;
   
  }

 //function to get students for select option in purchase history model form
    function getStudent($conn)
  {
    $sql = " SELECT *from students";
    $result = $conn->query($sql);
    return $result;
   
  }
   //function to get students for select option end here

   //function to get all subscription history on manage
function getSubscriptionPlans($conn,$from,$to)
{
    $sql = "SELECT s.* , p.title as plan_name, st.name as student_name from subscriptions s
     inner join subscription_plans p on p.id = s.plan_id 
     inner join students st on st.id = s.student_id 
     where s.id != 0 ";

    if (!empty($from) && !empty($to)) {
    $sql .= " AND s.start_date >= '$from' AND s.end_date <= '$to'";
} elseif (!empty($from)) {
    $sql .= " AND s.start_date >= '$from'";
} elseif (!empty($to)) {
    $sql .= " AND s.end_date <= '$to'";
}
    $sql.=" ORDER BY s.id DESC ";

    $result = $conn->query($sql);
    return $result;
}
  //function to get all subscription history on manage ends here



  // function to delete plans 
 
    function  deletePlans($conn, $id )
    {
     $sql ="delete from subscription_plans where id = $id";
      $result = $conn->query($sql);
      return $result;
    }

  // function delete plans ends here 


  //function to update status

  function updatePlanStatus($conn, $id , $status )
  {
     $sql = "update subscription_plans set status = '$status' where id = $id ";
     $result = $conn->query($sql);
     return $result;
  }

  //function to update status ends here 
   



  // function to get subscription plans details for editing 

   function getPlanById($conn,$id)
  {
    $sql = "SELECT * FROM subscription_plans WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
  }


    //function to get sloan details ends here 



  //function to update loan

 function updatePlan($conn, $param)
{
     extract($param);

    // validation
     if(empty($title)) {
        return ['error' => 'title is required'];
    } else if(empty($amount)) {
        return ['error' => ' amount is required'];
    } else if(empty($duration)) {
        return ['error' => 'duration is required'];
    } 

    $datetime = date("Y-m-d H:i:s");

    $sql = "UPDATE subscription_plans SET
                title='$title', 
                amount='$amount', 
                duration='$duration', 
                updated_at='$datetime'
            WHERE id = $id";

    $result['success'] = $conn->query($sql);

   

    if ($conn->affected_rows > 0) {
        // Success, row changed
        return $result;
    }
} 



  //function to update loan