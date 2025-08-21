<?php
$conn = @new mysqli(SERVER_NAME,USERNAME, PASSWORD , DATABASE);

    global $conn;

if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}

?>