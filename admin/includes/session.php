<?php 
    session_start();
    include 'includes/conn.php';
    if(!isset($_SESSION['loggedin'])){
        $_SESSION['message'] = "Please login to continue";
        header('Location: ../index.php');
        exit;
    }
    