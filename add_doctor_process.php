<?php
// Database connection
$cn = mysqli_connect("localhost", "root", "", "hospital_management");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect form data
$doctorName = $_POST['doctorName'];
$specialization = $_POST['specialization'];
$contact = $_POST['contact'];
$email = $_POST['email'];

// Prepare SQL statement to insert doctor data into the doctor table
$sql = "INSERT INTO doctors (name, specialization, contact, email) VALUES ('$doctorName', '$specialization', '$contact', '$email')";

if (mysqli_query($cn, $sql)) {
    echo "Doctor added successfully!";
    // Optionally, you can redirect back to the dashboard or doctor list page after insertion
    // header("Location: admin_dashboard.php");
} else {
    echo "Error: " . mysqli_error($cn);
}

// Close the database connection
mysqli_close($cn);
?>
