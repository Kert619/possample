<?php
    include 'includes/session.php';

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $role = $_POST['role'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $db = new DbConn();
        $pdo = $db->connect();
        $sql = "INSERT INTO users (username, password, fullname, role) VALUES (:username, :password, :fullname, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    header('location: users.php');