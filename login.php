<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example hardcoded user credentials
    $validUsername = "admin";
    $validPassword = "password123";

    if ($username === $validUsername && $password === $validPassword) {
        echo "Login successful! Welcome, $username.";
    } else {
        echo "Invalid username or password.";
    }
}
?>
