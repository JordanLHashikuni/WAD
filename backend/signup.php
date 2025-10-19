<?php
session_start();
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username/email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->execute([$username, $email]);
    if($stmt->rowCount() > 0){
        echo json_encode(["status"=>"error", "message"=>"Username or email already exists"]);
        exit;
    }

    // Insert user
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);

    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $pdo->lastInsertId();

    echo json_encode(["status"=>"success"]);
}
?>
