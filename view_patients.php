<?php
$cn = mysqli_connect("localhost", "root", "", "hospital_management");
if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM patients";
$result = mysqli_query($cn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($cn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styling */
        body {
            background: #f3f4f7; /* Light grey background */
            color: #333;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: #4CAF50;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .container {
            margin-top: 50px;
        }

        /* Table Styling */
        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: center;
            padding: 12px;
        }

        th {
            background-color: #6c757d; /* Dark grey background */
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f8f9fa; /* Light background for table cells */
        }

        /* Hover Effect on Table Rows */
        tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Action Buttons */
        .btn {
            padding: 6px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            margin: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
            }
            h2 {
                font-size: 24px;
            }
            .btn {
                font-size: 12px;
            }
        }

    </style>
</head>
<body>
<div class="container">
    <h2>Patient List</h2>
    <div class=" mb-4">
        <a href="index.html" class="btn btn-success btn-lg">Go to Home</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['patient_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo isset($row['contact']) ? htmlspecialchars($row['contact']) : 'N/A'; ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td>
                        <a href="edit_patient.php?id=<?php echo $row['patient_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_patient.php?id=<?php echo $row['patient_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php mysqli_close($cn); ?>
