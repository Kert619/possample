<?php
session_start();
include_once 'conn.php';

if (isset($_SESSION['loggedin'])) {

    if (strtoupper($_SESSION['role']) == 'ADMIN') {
        header('location: admin/users.php');
    }

    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DbConn();
    $pdo = $db->connect();
    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', strtolower($username));
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $password;
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        if (strtoupper($user['role']) == 'ADMIN') {
            header('location: admin/users.php');
        }

        exit;
    } else {
        $_SESSION['message'] = "Invalid username or password";
    }
}