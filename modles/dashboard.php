   <?php 

// $base_url ="http://localhost/niraj_library_project/";
  // $dir_url = $_SERVER['DOCUMENT_ROOT']."/niraj_library_project/";

   
   
  
  //function to get book category

  function getCategorie($conn)
  {
    $sql = " SELECT id,name from categories";
    $result = $conn->query($sql);
    return $result;
   
  }
   //function to get book category ends here

   //function to get all books on manage

    function getCount($conn)
    {
        $counts= array(
            'total_book' =>'',
            'total_student'=>'',
            'total_loan' =>'',
            'total_amount' =>''
        );

        //  total book count 
        $sql = " SELECT count(id) as total_book from books";
        $result = $conn->query($sql);

        if($result && $result->num_rows >0){
            $books = mysqli_fetch_assoc($result );
            $counts['total_book'] = $books['total_book'];

        }
        
        //  total studnet count 
        $sql = " SELECT count(id) as total_student from students";
        $result = $conn->query($sql);

        if($result && $result->num_rows >0){
            $students = mysqli_fetch_assoc($result );
            $counts['total_student'] = $students['total_student'];

        }

        //  total loan book  count 
        $sql = " SELECT count(id) as total_loan from book_loans";
        $result = $conn->query($sql);

        if($result && $result->num_rows >0){
            $book_loans = mysqli_fetch_assoc($result );
            $counts['total_loan'] = $book_loans['total_loan'];

        }

        //  total amount revennue calcukate  
        $sql = " SELECT sum(amount) as total_amount from subscriptions";
        $result = $conn->query($sql);

        if($result && $result->num_rows >0){
            $revenue = mysqli_fetch_assoc($result );
            $counts['total_amount'] = $revenue['total_amount'];

        }
            return $counts;
            


    }

  //function to get all books on manage ends here



    function getTabData($conn)
  {

         $tabs = array(
            'students' =>array(),
            'loans'=>array(),
            'subscriptions' =>array()
          );


    $sql = " SELECT * from students order by id desc  limit 5";
    $result = $conn->query($sql);

     if($result && $result->num_rows >0){
        while($row = $result->fetch_assoc()){
            
            $tabs['students'][] = $row;

        }}

    
 
    //function getloans($conn)

    $sql = "SELECT l.*, 
                   b.title AS book_title, 
                   s.name AS student_name 
            FROM book_loans l
            INNER JOIN books b ON b.id = l.book_id 
            INNER JOIN students s ON s.id = l.student_id  
            ORDER BY l.id DESC limit 5";

    $result = $conn->query($sql);
     if($result && $result->num_rows >0){
        while($row = $result->fetch_assoc()){
            $tabs['loans'][] = $row;


        }}
  
   
    //function getsubscriptions($conn)

    $sql = " SELECT sub.* ,s.name AS student_name , p.amount as amount from subscriptions sub
    inner join students s ON s.id = sub.student_id     
     INNER JOIN subscription_plans p ON p.id = sub.plan_id  
      order by id desc limit 5";
 

     $result = $conn->query($sql);
     if($result && $result->num_rows >0){
        while($row = $result->fetch_assoc()){
            $tabs['subscriptions'][] = $row;


        }}
    
    return $tabs;
   
  }

