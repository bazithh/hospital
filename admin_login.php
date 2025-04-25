<?php
// session_start();
// $cn = mysqli_connect("localhost", "root", "", "hospital_management");

// if (!$cn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     // Check if admin credentials match
//     $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
//     $result = mysqli_query($cn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         // Store session variables to track login
//         $_SESSION['admin_logged_in'] = true;
//         header("Location: admin_dashboard.php");
//     } else {
//         echo "Invalid credentials!";
//     }
// }

// mysqli_close($cn);
?>
<?php
// Start the session to track the admin login status
session_start();

// Hard-coded admin credentials (for testing purposes)
$admin_username = "admin";   // Admin username
$admin_password = "admin123"; // Admin password

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if admin credentials match the hard-coded values
    if ($username === $admin_username && $password === $admin_password) {
        // Store session variables to track login
        $_SESSION['admin_logged_in'] = true;

        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit(); // Prevent further code execution
    } else {
        // If credentials don't match, show an error message
        echo "Invalid credentials!";
    }
}
?>




