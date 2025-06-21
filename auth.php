<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'register') {
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $second_name = $conn->real_escape_string($_POST['second_name']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            header("Location: register.php?error=Passwords do not match");
            exit();
        }

        if (strlen($password) < 4) {
            header("Location: register.php?error=Password must be at least 4 characters");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, second_name, username, password) 
                VALUES ('$first_name', '$second_name', '$username', '$hashed_password')";

        if ($conn->query($sql)) {
            header("Location: register.php?success=Registration successful. Please login.");
        } else {
            if ($conn->errno === 1062) {
                header("Location: register.php?error=Username already exists");
            } else {
                header("Location: register.php?error=Registration failed");
            }
        }
    } elseif ($action === 'login') {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['second_name'] = $user['second_name'];
                header("Location: home.php");
            } else {
                header("Location: index.php?error=Invalid credentials");
            }
        } else {
            header("Location: index.php?error=Invalid credentials");
        }
    }
}

$conn->close();
?>