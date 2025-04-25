<?php
// // Database connection
// $cn = mysqli_connect("localhost", "root", "", "hospital_management");

// if (!$cn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// // Collect form data
// $email = $_POST['email'];
// $password = $_POST['password'];

// // SQL query to fetch the stored hashed password for the given email
// $sql = "SELECT * FROM admin WHERE email = ?";
// $stmt = mysqli_prepare($cn, $sql);

// if ($stmt === false) {
//     die("Error preparing the SQL query: " . mysqli_error($cn));
// }

// // Bind parameters to the prepared statement
// mysqli_stmt_bind_param($stmt, "s", $email);

// // Execute the prepared statement
// mysqli_stmt_execute($stmt);

// // Get the result
// $result = mysqli_stmt_get_result($stmt);
// $user = mysqli_fetch_assoc($result);

// if ($user) {
//     // User found, now verify the password
//     if (password_verify($password, $user['password'])) {
//         // Password is correct, login success
//         echo "Login successful!";
//         // You can redirect to the admin dashboard or home page here
//         header("Location: admin_dashboard.php");
//         exit(); // Prevent further execution
//     } else {
//         // Incorrect password
//         echo "Invalid email or password.";
//     }
// } else {
//     // No user found with the given email
//     echo "Invalid email or password.";
// }

// // Close the statement and the connection
// mysqli_stmt_close($stmt);
// mysqli_close($cn);// Database connection
// $cn = mysqli_connect("localhost", "root", "", "hospital_management");

// if (!$cn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// // Collect form data
// $email = $_POST['email'];
// $password = $_POST['password'];

// // SQL query to fetch the stored hashed password for the given email
// $sql = "SELECT * FROM admin WHERE email = ?";
// $stmt = mysqli_prepare($cn, $sql);

// if ($stmt === false) {
//     die("Error preparing the SQL query: " . mysqli_error($cn));
// }

// // Bind parameters to the prepared statement
// mysqli_stmt_bind_param($stmt, "s", $email);

// // Execute the prepared statement
// mysqli_stmt_execute($stmt);

// // Get the result
// $result = mysqli_stmt_get_result($stmt);
// $user = mysqli_fetch_assoc($result);

// if ($user) {
//     // User found, now verify the password
//     if (password_verify($password, $user['password'])) {
//         // Password is correct, login success
//         echo "Login successful!";
//         // You can redirect to the admin dashboard or home page here
//         header("Location: admin_dashboard.php");
//         exit(); // Prevent further execution
//     } else {
//         // Incorrect password
//         echo "Invalid email or password.";
//     }
// } else {
//     // No user found with the given email
//     echo "Invalid email or password.";
// }

// // Close the statement and the connection
// mysqli_stmt_close($stmt);
// mysqli_close($cn);
?>


                           

<?php
// Hard-coded admin credentials
$admin_email = "admin@example.com";  // Define the admin's email
$admin_password = "admin123";        // Define the admin's password

// Collect form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the entered credentials match the hard-coded ones
if ($email === $admin_email && $password === $admin_password) {
    // Credentials match, login success
    echo "Login successful!";
    // Redirect to the admin dashboard
    header("Location: admin_dashboard.php");
    exit(); // Prevent further execution
} else {
    // Credentials don't match
    echo "Invalid email or password.";
}
?>
