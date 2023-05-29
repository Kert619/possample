<?php include 'login.php' ?>

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
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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
        if (!isset($_SESSION['loggedin']) && isset($_SESSION['message'])) {
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