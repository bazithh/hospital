<?php
// Database connection
$cn = mysqli_connect("localhost", "root", "", "hospital_management");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Check if passwords match
if ($password != $confirmPassword) {
    echo "Passwords do not match.";
    exit();
}

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into admin table
$sql = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

if (mysqli_query($cn, $sql)) {
    echo "Admin account created successfully!";
    // Redirect to login page or dashboard
    header("Location: admin_login.html");
} else {
    echo "Error: " . mysqli_error($cn);
}

mysqli_close($cn);
?>
