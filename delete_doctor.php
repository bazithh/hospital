<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}

$cn = mysqli_connect("localhost", "root", "", "hospital_management");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

    // Delete the doctor record
    $delete_query = "DELETE FROM doctors WHERE doctor_id = '$doctor_id'";

    if (mysqli_query($cn, $delete_query)) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($cn);
    }
} else {
    echo "No doctor ID provided!";
    exit();
}

mysqli_close($cn);
?>
