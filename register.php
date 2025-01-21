<?php
include 'config/config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $address = $conn->real_escape_string($_POST['address']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password
    $email = $conn->real_escape_string($_POST['email']);

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or Email already exists. Please try again.');</script>";
    } else {
        // Insert into database
        $sql = "INSERT INTO users (fullname, dob, address, username, password, email) 
                VALUES ('$fullname', '$dob', '$address', '$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page with a success message
            header("Location: signin.php?message=success");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
