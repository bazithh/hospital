<?php
// Database connection
$cn = mysqli_connect("localhost", "root", "", "hospital_management");

if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Collect form data
$patientId = $_POST['patientId'];
$doctorId = $_POST['doctorId'];
$appointmentDate = $_POST['appointmentDate'];
$appointmentTime = $_POST['appointmentTime'];

// Check if the patient exists
$query = "SELECT patient_id FROM patients WHERE patient_id = ?";
$stmt = $cn->prepare($query);
$stmt->bind_param("i", $patientId);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    // Check if the doctor exists
    $query = "SELECT doctor_id FROM doctors WHERE doctor_id = ?";
    $stmt = $cn->prepare($query);
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        // If both patient and doctor exist, insert the appointment
        $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time) 
                VALUES (?, ?, ?, ?)";
        $stmt = $cn->prepare($sql);
        $stmt->bind_param("iiss", $patientId, $doctorId, $appointmentDate, $appointmentTime);

        if ($stmt->execute()) {
            echo "Appointment booked successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: The doctor with ID $doctorId does not exist.";
    }
} else {
    echo "Error: The patient with ID $patientId does not exist.";
}

// Close the connection
$stmt->close();
mysqli_close($cn);
?>
