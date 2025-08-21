<?php 

include("config/config.php");

session_destroy();
 header("LOCATION:".BASE_URL );
exit;
