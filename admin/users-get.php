<?php
    include 'includes/session.php';

    if(isset($_GET['id'])){
        
        $id = $_GET['id'];
        $db = new DbConn();
        $pdo = $db->connect();
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id' ,$id);
        $stmt->execute();
        $result = $stmt->fetch();

        if($stmt->rowCount() > 0){
            header('Content-Type: application/json');
            echo json_encode($result);
        } else{
            http_response_code(404);
             echo json_encode(['error' => 'User not found']);
        }

    } else{
        http_response_code(400);
         echo json_encode(['error' => 'Invalid request']);
    }