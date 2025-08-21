   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   
   
   
  // function to store books 

  function storeBook($conn,$param)
{
    extract($param);

    // validation
    if(empty($title)) {
        return ['error' => 'Title is required'];
    } else if(empty($author)) {
        return ['error' => 'Author is required'];
    } else if(empty($publication_year)) {
        return ['error' => 'Publication year is required'];
    } else if(empty($isbn)) {
        return ['error' => 'ISBN is required'];
    } else if(empty($category_id)) {
        return ['error' => 'Book category is required'];
    } else if(isUnique($conn, $isbn)) {
        return ['error' => 'ISBN should be unique'];
    }

    $datetime = date("Y-m-d H:i:s");
    $sql ="INSERT INTO books (title, author, publication_year, isbn, category_id, created_at) 
           VALUES ('$title', '$author', '$publication_year', '$isbn', '$category_id', '$datetime')";

    if($conn->query($sql)) {
        return ['success' => true];
    } else {
        return ['error' => 'Database insert failed: '.$conn->error];
    }
}


  // function to store books ends here
  
  //function to get book category

  function getCategorie($conn)
  {
    $sql = " SELECT id,name from categories";
    $result = $conn->query($sql);
    return $result;
   
  }
   //function to get book category ends here

   //function to get all books on manage

   function getBooks($conn)
  {
    $sql = " SELECT b.* , c.name as cat_name FROM books b 
    left join categories c on c.id = b.category_id 
    ORDER BY id DESC ";
    $result = $conn->query($sql);
    return $result;
  }

  //function to get all books on manage ends here



  // function to get book details for editing 

   function getBookById($conn,$id)
  {
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($sql);
    return $result;
  }


    //function to get book details ends here 



  // function to delete books 
 
    function  deleteBooks($conn, $id )
    {
     $sql ="delete from books where id = $id";
      $result = $conn->query($sql);
      return $result;
    }

  // function delete book ends here 


  //function to update status

  function updateBookStatus($conn, $id , $status )
  {
     $sql = "update books set status = '$status' where id = $id ";
     $result = $conn->query($sql);
     return $result;
  }

  //function to update status ends here 
   


  //function to update book

 function updateBook($conn, $param)
{
     extract($param);

    // validation
    if(empty($title)) {
        return ['error' => 'Title is required'];
    } else if(empty($author)) {
        return ['error' => 'Author is required'];
    } else if(empty($publication_year)) {
        return ['error' => 'Publication year is required'];
    } else if(empty($isbn)) {
        return ['error' => 'ISBN is required'];
    } else if(empty($category_id)) {
        return ['error' => 'Book category is required'];
    } else if(isUnique($conn, $isbn,$id)) {
        return ['error' => 'ISBN should be unique'];
    }

    $datetime = date("Y-m-d H:i:s");

    $sql = "UPDATE books SET
                title = '$title',
                author = '$author',
                publication_year = '$publication_year', 
                isbn = '$isbn',
                category_id = '$category_id',
                updated_at = '$datetime' 
            WHERE id = $id";

    $result['success'] = $conn->query($sql);

   

    if ($conn->affected_rows > 0) {
        // Success, row changed
        return $result;
    }
}

  //function to update book ends here 
   




  //function to check uniqueness of isbn

 function isUnique($conn, $isbn, $id = null){

    
     $sql = "SELECT id FROM books  WHERE isbn = '$isbn'";
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
  //function to check uniqueness of isbn ends here
