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
    $appointment_id = $_GET['id'];

    // Fetch the appointment details
    $query = "SELECT * FROM appointments WHERE appointment_id = '$appointment_id'";
    $result = mysqli_query($cn, $query);
    $appointment = mysqli_fetch_assoc($result);

    if (!$appointment) {
        echo "Appointment not found!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $patient_id = $_POST['patient_id'];
        $doctor_id = $_POST['doctor_id'];
        $appointment_date = $_POST['appointment_date'];

        // Update the appointment details
        $update_query = "UPDATE appointments SET patient_id = '$patient_id', doctor_id = '$doctor_id', appointment_date = '$appointment_date' WHERE appointment_id = '$appointment_id'";

        if (mysqli_query($cn, $update_query)) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($cn);
        }
    }
} else {
    echo "No appointment ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="date"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="date"]:focus {
            border-color: #5cb85c;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Edit Appointment</h2>

<div class="container">
    <form method="POST">
        <!-- Removed patient_id and doctor_id fields, as per the original code comment -->
        <div class="form-group">
            <label for="appointment_date">Appointment Date</label>
            <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>
        </div>
        <button type="submit">Update Appointment</button>
    </form>
</div>

</body>
</html>

<?php
mysqli_close($cn);
?>
