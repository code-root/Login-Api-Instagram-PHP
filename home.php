<?php
            session_start();
            include 'conn.php';
            $isUserLoggedIn = isset($_SESSION['username']  ) ? true : false;
            $Username =  $_SESSION['username'];

if (!$isUserLoggedIn) {    
                 // Is Not  Login Done 
         header("Location: index.php");
    exit;
}   

?>

<p>  Hi <?=$Username?> </p>