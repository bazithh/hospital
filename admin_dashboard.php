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

// Fetch data for dashboard (patients, doctors, appointments)
$patients_query = "SELECT * FROM patients";
$patients_result = mysqli_query($cn, $patients_query);

$doctors_query = "SELECT * FROM doctors";
$doctors_result = mysqli_query($cn, $doctors_query);

$appointments_query = "SELECT * FROM appointments";
$appointments_result = mysqli_query($cn, $appointments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom Styles for Bright Background */
        body {
            background: linear-gradient(to bottom right, #6a11cb, #2575fc); /* Gradient from purple to blue */
            color: #fff;
        }

        /* Add spacing to the container */
        .container {
            margin-top: 60px;
        }

        /* Table Styling */
        .table {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        /* Table Header */
        .table th {
            background-color: #ff6f61;
            color: #fff;
            font-weight: bold;
        }

        /* Hover Effect on Table Rows */
        .table tbody tr:hover {
            background-color: #f39c12;
            color: white;
            cursor: pointer;
        }

        /* Buttons Styling */
        .btn {
            transition: all 0.3s ease;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Primary Button Styling */
        .btn-primary {
            background-color: #4caf50;
            border-color: #4caf50;
        }

        .btn-warning {
            background-color: #ffcc00;
            border-color: #ffcc00;
        }

        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        /* Hover Effect on Buttons */
        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        .btn-warning:hover {
            background-color: #f39c12;
            border-color: #f39c12;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        /* Header and Section Titles */
        h2, h3 {
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.4);
        }

        /* Mobile Responsiveness */
        .table-responsive {
            overflow-x: auto;
        }

        /* Logout Button */
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Admin Dashboard</h2>
    <a href="admin_logout.php" class="btn btn-danger btn-sm logout-btn">Logout</a>

    <h3 class="mt-4">Manage Patients</h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($patients_result)) { ?>
                    <tr>
                        <td><?php echo $row['patient_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td>
                            <a href="edit_patient.php?id=<?php echo $row['patient_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_patient.php?id=<?php echo $row['patient_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <h3 class="mt-4">Manage Doctors</h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($doctors_result)) { ?>
                    <tr>
                        <td><?php echo $row['doctor_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['specialization']; ?></td>
                        <td>
                            <a href="edit_doctor.php?id=<?php echo $row['doctor_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_doctor.php?id=<?php echo $row['doctor_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <h3 class="mt-4">Manage Appointments</h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Doctor ID</th>
                    <th>Appointment Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($appointments_result)) { ?>
                    <tr>
                        <td><?php echo $row['appointment_id']; ?></td>
                        <td><?php echo $row['patient_id']; ?></td>
                        <td><?php echo $row['doctor_id']; ?></td>
                        <td><?php echo $row['appointment_date']; ?></td>
                        <td>
                            <a href="edit_appointment.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_appointment.php?id=<?php echo $row['appointment_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php mysqli_close($cn); ?>
