<?php
// $cn=mysqli_connect("localhost","root","");
// if (!$cn) {
//    die("connection failed :".mysqli_connect_error());
// }
// $sql="create database hospital_management";
// if (mysqli_query($cn,$sql)) {
//     echo "database created successfully";
// }
// else {
//     echo "error creating database :".mysqli_error($cn);
// }
// mysqli_close($cn);
?>
<?php
// $cn=mysqli_connect("localhost","root","","hospital_management");
// if (!$cn) {
//     die("connection failed :".mysqli_connect_error());
// }
// $sql="CREATE TABLE doctors (
// doctor_id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100),
//     specialization VARCHAR(50),
//     contact VARCHAR(20),
//     email VARCHAR(100))";
//     if (mysqli_query($cn,$sql)) {
//         echo "table created successfully";
//     }
//     else{
//         echo "error creating table :".mysqli_error($cn);
//     }
//     mysqli_close($cn);
?>

<?php
// $cn=mysqli_connect("localhost","root","","hospital_management");
// if (!$cn) {
//     die("connection failed :".mysqli_connect_error());
// }
// $sql="CREATE TABLE patients (
//     patient_id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100),
//     age INT,
//     gender VARCHAR(10),
//     contact VARCHAR(20),
//     email VARCHAR(100)
// )";
//     if (mysqli_query($cn,$sql)) {
//         echo "table created successfully";
//     }
//     else{
//         echo "error creating table :".mysqli_error($cn);
//     }
//     mysqli_close($cn);
?>


<?php
// $cn=mysqli_connect("localhost","root","","hospital_management");
// if (!$cn) {
//     die("connection failed :".mysqli_connect_error());
// }
// $sql="CREATE TABLE appointments (
//     appointment_id INT AUTO_INCREMENT PRIMARY KEY,
//     patient_id INT,
//     doctor_id INT,
//     appointment_date DATE,
//     appointment_time TIME,
//     FOREIGN KEY (patient_id) REFERENCES patients(patient_id),
//     FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id)
// )";
//     if (mysqli_query($cn,$sql)) {
//         echo "table created successfully";
//     }
//     else{
//         echo "error creating table :".mysqli_error($cn);
//     }
//     mysqli_close($cn);


?>
<?php
// $cn=mysqli_connect("localhost","root","","hospital_management");
//  if (!$cn) {
//      die("connection failed :".mysqli_connect_error());
//  }
//  $sql="CREATE TABLE admin (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(255) NOT NULL,
//     email VARCHAR(255) NOT NULL,
//     password VARCHAR(255) NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";
// if (mysqli_query($cn,$sql)) {
//              echo "table created successfully";
//          }
//          else{
//              echo "error creating table :".mysqli_error($cn);
//          }
//          mysqli_close($cn);
?>
<?php
$cn=mysqli_connect("localhost","root","","hospital_management");
 if (!$cn) {
    die("connection failed :".mysqli_connect_error());
 }
$sql="CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (mysqli_query($cn,$sql)) {
               echo "table created successfully";
           }
       else{
               echo "error creating table :".mysqli_error($cn);
      }
          mysqli_close($cn);
?>



