<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "certifications";

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo '<link rel="stylesheet" href="styles.css" />';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$occupation = $_POST['occupation'];
$college = $_POST['college'];
$branch = $_POST['branch'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$confirmPassword = $_POST['confirm_password'];

$checkExistingQuery = "SELECT * FROM `user_data` WHERE `ID`='$id';";
$resultExisting = $conn->query($checkExistingQuery);

echo "<br>";

if ($resultExisting->num_rows > 0) 
{
  echo "<script>
          Swal.fire({
            title: 'Registration failed',
            text: 'User already exists',
            icon: 'error',
            confirmButtonText: 'OK'
          }).then(function() {
              window.location.href = 'login.html';
          });
        </script>";
}

else 
{
  $insertQuery = "INSERT INTO `user_data` VALUES ('$id', '$firstName', '$lastName', '$email', '$phone', '$gender', '$dob', '$occupation', '$college', '$branch', '$password')";

  if ($conn->query($insertQuery) === TRUE) 
  {
    echo "<script>
            Swal.fire({
              title: 'Registration Successful',
              text: 'Redirecting...',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'login.html';
            });
          </script>";
  }
}

$conn->close();
?>