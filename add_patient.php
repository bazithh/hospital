<?php
// Database connection
$cn = mysqli_connect("localhost", "root", "", "hospital_management");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect form data
$patientName = $_POST['patientName'];
$patientAge = $_POST['patientAge'];
$patientGender = $_POST['patientGender'];
$patientContact = $_POST['patientContact'];
$patientEmail = $_POST['patientEmail'];  // Added the email field

// Prepare an SQL statement to insert data into patients table
$stmt = $cn->prepare("INSERT INTO patients (name, age, gender, contact, email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisss", $patientName, $patientAge, $patientGender, $patientContact, $patientEmail);  // Added the email field

// Execute the statement
if ($stmt->execute()) {
    echo "New patient added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
mysqli_close($cn);
?>
