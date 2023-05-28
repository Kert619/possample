<?php 
    session_start();
    include_once 'conn.php';

    if(isset($_SESSION['loggedin'])){
        
        if(strtoupper($_SESSION['role']) == 'ADMIN'){
            header('location: admin/users.php');
        }
        
        exit;
    }

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $db = new DbConn();
        $pdo = $db->connect();
        $sql = "SELECT * FROM users WHERE username=:username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', strtolower($username));
        $stmt->execute();
        $user = $stmt->fetch();

        if($user && password_verify($password, $user['password'])){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $password;
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];
            
            if(strtoupper($user['role']) == 'ADMIN'){
                header('location: admin/users.php');
            }
            
            exit;
        } else{
            $_SESSION['message'] = "Invalid username or password";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System | Login</title>
    <link rel="stylesheet" href="Vendors/bootstrap/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control form-control-sm shadow-none" name="username" required
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control form-control-sm shadow-none" name="password" required
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary" name="submit">Login</button>
            </div>
        </form>
        <?php
            if(!isset($_SESSION['loggedin']) && isset($_SESSION['message'])){
            ?>
        <p class="text-danger"><?php echo $_SESSION['message'] ?></p>
        <?php
            unset($_SESSION['message']);
            }
        ?>
    </div>
    <script src="Vendors/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>