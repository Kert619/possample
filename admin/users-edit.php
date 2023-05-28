<?php
    include 'includes/session.php';

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $role = $_POST['role'];

        $db = new DbConn();
        $pdo = $db->connect();
        $sql = "UPDATE users SET username=:username, fullname=:fullname, role=:role WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

     
    }

    header('location: users.php');