<?php
    include 'includes/session.php';

    if(isset($_POST['submit'])){
        $id = $_POST['id'];


        $db = new DbConn();
        $pdo = $db->connect();
        $sql = "DELETE FROM users WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    
    }

    header('location: users.php');