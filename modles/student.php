   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   
   
   
  // function to store students 

  function storeStudent($conn,$param)
{
    extract($param);

    // validation
    if(empty($name)) {
        return ['error' => 'Name is required'];
    } else if(empty($email)) {
        return ['error' => 'Email  is required'];
    }else if(empty($phone_no)) {
        return ['error' => 'phone number is required'];
    } else if(empty($address)) {
        return ['error' => 'address is required'];
    } else if(isEmailUnique($conn, $email)) {
        return ['error' => 'Email should be unique'];
    } else if(isPhone_noUnique($conn, $phone_no)) {
        return ['error' => 'Phone number should be unique'];
    } else if(isPhone_noValid($phone_no)) {
        return ['error' => 'Phone number is not Valid'];
    } else if(isEmailValid( $email)) {
        return ['error' => 'Email is not Valid'];
    }
    $datetime = date("Y-m-d H:i:s");
    $sql ="INSERT INTO students (name, email, phone_no, address,  created_at) 
           VALUES ('$name', '$email', '$phone_no', '$address', '$datetime')";

        $result['success' ] =($conn->query($sql)) ;
   
        return $result;
    }



  // function to store students ends here
  
  //function to get book category

  function getCategorie($conn)
  {
    $sql = " SELECT id,name from categories";
    $result = $conn->query($sql);
    return $result;
   
  }
   //function to get book category ends here

   //function to get all student on manage

   function getStudents($conn)
  {
    $sql = " SELECT * FROM students ORDER BY id DESC ";
    $result = $conn->query($sql);
    return $result;
  }

  //function to get all books on manage ends here



  // function to get student details for editing 

   function getStudentById($conn,$id)
  {
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
  }


    //function to get student details ends here 



  // function to delete books 
 
    function  deleteStudents($conn, $id )
    {
     $sql ="delete from students where id = $id";
      $result = $conn->query($sql);
      return $result;
    }

  // function delete book ends here 


  //function to update status

  function updateStudentStatus($conn, $id , $status )
  {
     $sql = "update students set status = '$status' where id = $id ";
     $result = $conn->query($sql);
     return $result;
  }

  //function to update status ends here 
   


  //function to update student

 function updateStudent($conn, $param)
{
     extract($param);

    // validation
    if(empty($name)) {
        return ['error' => 'Name is required'];
    } else if(empty($email)) {
        return ['error' => 'Email  is required'];
    }else if(empty($phone_no)) {
        return ['error' => 'phone number is required'];
    } else if(empty($address)) {
        return ['error' => 'address is required'];
    } else if(isEmailUnique($conn, $email,$id)) {
        return ['error' => 'Email should be unique'];
    } else if(isPhone_noUnique($conn, $phone_no,$id)) {
        return ['error' => 'Phone number should be unique'];
    } 

    $datetime = date("Y-m-d H:i:s");

    $sql = "UPDATE students SET
                name = '$name',
                phone_no = '$phone_no',
                email = '$email', 
                address = '$address',
                updated_at = '$datetime' 
            WHERE id = $id";

    $result['success'] = $conn->query($sql);

   

    if ($conn->affected_rows > 0) {
        // Success, row changed
        return $result;
    }
} 



  //function to update book ends here 
   




  //function to check uniqueness email

 function isEmailUnique($conn,$email, $id = null){

    
     $sql = "SELECT id FROM students  WHERE email = '$email'";
     if($id)
    {
        $sql.= " and id!=$id";
    }
     $result = $conn->query($sql);
     //echo"<pre>";
     //print_r($result);
     //exit;
     if( $result->num_rows > 0){
         return true;
     } else {
         return false;
     }
}
  //function to check uniqueness of email  ends here

   //function to check uniqueness phone number

 function isPhone_noUnique($conn,$phone_no, $id = null){

    
     $sql = "SELECT id FROM students  WHERE phone_no = '$phone_no'";
     if($id)
    {
        $sql.= " and id!=$id";
    }
     $result = $conn->query($sql);
     //echo"<pre>";
     //print_r($result);
     //exit;
     if( $result->num_rows > 0){
         return true;
     } else {
         return false;
     }
}
  //function to check uniqueness of phone number  ends here

  //function ro check phone number is valid or not 

   function isPhone_noValid($phone_no)
   {
    if(is_numeric($phone_no) && (strlen($phone_no)==10))
        return false;
    else return true;
   }
  //function ro check phone number is valid or not ends here 


  ///function ro check email is valid
     function isEmailValid($email)
   {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        return false; // valid 
    else return true; // unvalid
   }
   //function ro check email is valid or not ends here 