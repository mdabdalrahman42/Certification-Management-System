<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "Certifications";

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo '<link rel="stylesheet" href="styles.css" />';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$type = $_POST['type'];
$title = $_POST['title'];
$organization = $_POST['organization'];
$duration = $_POST['duration'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

$checkExistingQuery = "SELECT * FROM `certificates` WHERE `ID` = '$id' AND `Title` = '$title' AND `Start Date` = '$startDate' AND `End Date` = '$endDate'";
$resultExisting = $conn->query($checkExistingQuery);

$queryocc = "SELECT Occupation FROM `user_data` WHERE `ID` = '$id'";
$result = $conn->query($queryocc);
$row = $result->fetch_assoc();
$occupation = $row["Occupation"];

echo "<br>";

if ($resultExisting->num_rows > 0) {
  echo "<script>
            Swal.fire({
              title: 'Upload Failed',
              text: 'Certificate already exists',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then(function() {
                var redirectUrl = '';
                if ('$occupation' === 'Student') 
                {
                  redirectUrl = 'student.php?id=$id';
                } 
                else if ('$occupation' === 'Employee') 
                {
                  redirectUrl = 'employee.php?id=$id';
                }
                window.location.href = redirectUrl;
            });
          </script>";
} else {
  $file = $_FILES['certificate']['tmp_name'];
  $certificate = base64_encode(file_get_contents($file));

  $file = $_FILES['certificate']['name'];
  $extension = pathinfo($file, PATHINFO_EXTENSION);

  $insertQuery = "INSERT INTO `certificates` (`ID`, `Type`, `Title`, `Organization`, `Duration`, `Start Date`, `End Date`, `Certificate`,`Extension`)
                    VALUES ('$id', '$type', '$title', '$organization', '$duration', '$startDate', '$endDate', '$certificate','$extension')";

  if ($conn->query($insertQuery) === TRUE) {
    echo "<script>
                Swal.fire({
                  title: 'Upload Successful',
                  text: 'Good Job',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(function() {
                    var redirectUrl = '';
                    if ('$occupation' === 'Student') 
                    {
                      redirectUrl = 'student.php?id=$id';
                    } 
                    else if ('$occupation' === 'Employee') 
                    {
                      redirectUrl = 'employee.php?id=$id';
                    }
                    window.location.href = redirectUrl;
                });
              </script>";
  } else {
    echo "<script>
                Swal.fire({
                  title: 'Upload Failed',
                  text: 'Error occured',
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then(function() {
                    var redirectUrl = '';
                    if ('$occupation' === 'Student') 
                    {
                      redirectUrl = 'student.php?id=$id';
                    } 
                    else if ('$occupation' === 'Employee') 
                    {
                      redirectUrl = 'employee.php?id=$id';
                    }
                    window.location.href = redirectUrl;
                });
              </script>";
  }
}

$conn->close();
?>