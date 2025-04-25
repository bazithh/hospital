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

    // Fetch the doctor's current details
    $query = "SELECT * FROM doctors WHERE doctor_id = '$doctor_id'";
    $result = mysqli_query($cn, $query);
    $doctor = mysqli_fetch_assoc($result);

    if (!$doctor) {
        echo "Doctor not found!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $specialization = $_POST['specialization'];

        // Update the doctor's details
        $update_query = "UPDATE doctors SET name = '$name', specialization = '$specialization' WHERE doctor_id = '$doctor_id'";

        if (mysqli_query($cn, $update_query)) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($cn);
        }
    }
} else {
    echo "No doctor ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
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

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
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

<h2>Edit Doctor</h2>

<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Doctor Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" value="<?php echo htmlspecialchars($doctor['specialization']); ?>" required>
        </div>
        <button type="submit">Update Doctor</button>
    </form>
</div>

</body>
</html>

<?php
mysqli_close($cn);
?>
