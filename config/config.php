<?php 

session_start();

  if($_SERVER['HTTP_HOST'] == "localhost"){
define("BASE_URL","http://localhost/niraj_library_project/"); //for css and js 
  define("DIR_URL" ,$_SERVER['DOCUMENT_ROOT']."/niraj_library_project/"); //for direction of file
  
  define("SERVER_NAME","localhost");
  define("USERNAME","root");
  define("PASSWORD","");
  define("DATABASE","lms");

}


?>