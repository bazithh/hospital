<?php
// Check if the patient ID is provided
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Database connection
    $cn = mysqli_connect("localhost", "root", "", "hospital_management");
    if (!$cn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch patient data based on the patient ID
    $query = "SELECT * FROM patients WHERE patient_id = $patient_id";
    $result = mysqli_query($cn, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Patient not found.";
        exit;
    }

    $patient = mysqli_fetch_assoc($result);

    // Check if form is submitted to update patient data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get updated data from the form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $gender = $_POST['gender'];

        // Update query
        $update_query = "UPDATE patients SET name = '$name', email = '$email', contact = '$contact', gender = '$gender' WHERE patient_id = $patient_id";

        if (mysqli_query($cn, $update_query)) {
            header("location:view_patients.php");
            exit;
        } else {
            echo "Error updating patient: " . mysqli_error($cn);
        }
    }

    mysqli_close($cn);
} else {
    echo "Patient ID is required.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
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

        input[type="text"],
        input[type="email"],
        select {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #5cb85c;
            outline: none;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
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

<h2>Edit Patient</h2>

<div class="container">
    <form action="edit_patient.php?id=<?php echo $patient_id; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($patient['email']); ?>" required>

        <label for="contact">Phone:</label>
        <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($patient['contact']); ?>" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php echo ($patient['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($patient['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo ($patient['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>

        <input type="submit" value="Update Patient">
    </form>
</div>

</body>
</html>
