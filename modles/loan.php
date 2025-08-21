   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   
   
   
  // function to store books 

  function storeBookLoan($conn,$param)
{
    extract($param);

    // validation
    if(empty($book_id)) {
        return ['error' => 'Book is required'];
    } else if(empty($student_id)) {
        return ['error' => ' Student is required'];
    } else if(empty($loan_date)) {
        return ['error' => 'Loan Date is required'];
    } else if(empty($return_date)) {
        return ['error' => 'Return date  is required'];
    } 

    $datetime = date("Y-m-d H:i:s");
    $sql ="INSERT INTO book_loans (book_id, student_id, loan_date, return_date, created_at) 
           VALUES ('$book_id', '$student_id', '$loan_date', '$return_date', '$datetime')";

    if($conn->query($sql)) {
        return ['success' => true];
    } else {
        return ['error' => 'Database insert failed: '.$conn->error];
    }
}


  // function to store books ends here
  
  //function to get book for select option in add loan 

  function getBook($conn)
  {
    $sql = " SELECT  *from books";
    $result = $conn->query($sql);
    return $result;
   
  }
   //function to get boook for select options ends here


 //function to get students for select option in add loan 
    function getStudent($conn)
  {
    $sql = " SELECT *from students";
    $result = $conn->query($sql);
    return $result;
   
  }
   //function to get students for select option end here

   //function to get all books on manage

  function getLoan($conn)
{
    $sql = "SELECT l.*, 
                   b.title AS book_title, 
                   s.name AS student_name 
            FROM book_loans l
            INNER JOIN books b ON b.id = l.book_id 
            INNER JOIN students s ON s.id = l.student_id  
            ORDER BY l.id DESC";
    
    $result = $conn->query($sql);
    return $result;
}
  //function to get all books on manage ends here



  // function to delete books 
 
    function  deleteLoans($conn, $id )
    {
     $sql ="delete from book_loans where id = $id";
      $result = $conn->query($sql);
      return $result;
    }

  // function delete book ends here 


  //function to update status

  function updateLoanStatus($conn, $id , $is_return )
  {
     $sql = "update book_loans set is_return = '$is_return' where id = $id ";
     $result = $conn->query($sql);
     return $result;
  }

  //function to update status ends here 
   



  // function to get loan details for editing 

   function getLoanById($conn,$id)
  {
    $sql = "SELECT * FROM book_loans WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
  }


    //function to get sloan details ends here 



  //function to update loan

 function updateLoan($conn, $param)
{
     extract($param);

    // validation
    if(empty($book_id)) {
        return ['error' => 'Book is required'];
    } else if(empty($student_id)) {
        return ['error' => ' Student is required'];
    } else if(empty($loan_date)) {
        return ['error' => 'Loan Date is required'];
    } else if(empty($return_date)) {
        return ['error' => 'Return date  is required'];
    } 

    $datetime = date("Y-m-d H:i:s");

    $sql = "UPDATE book_loans SET
                book_id = '$book_id',
                student_id = '$student_id',
                 loan_date = '$loan_date', 
                return_date = '$return_date',
                updated_at = '$datetime' 
            WHERE id = $id";

    $result['success'] = $conn->query($sql);

   

    if ($conn->affected_rows > 0) {
        // Success, row changed
        return $result;
    }
} 



  //function to update loan