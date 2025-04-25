<?php
$cn = mysqli_connect("localhost", "root", "", "hospital_management");
if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];
    $query = "DELETE FROM patients WHERE patient_id = $patient_id";
    if (mysqli_query($cn, $query)) {
        echo "Patient deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($cn);
    }
} else {
    echo "Invalid patient ID.";
}

mysqli_close($cn);
?>

