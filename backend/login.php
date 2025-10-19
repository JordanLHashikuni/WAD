<?php
session_start();
require 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(["status"=>"success"]);
    } else {
        echo json_encode(["status"=>"error", "message"=>"Invalid username or password"]);
    }
}
?>
