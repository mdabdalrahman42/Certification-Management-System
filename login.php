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
$password = $_POST['password'];

$query = "SELECT * FROM `user_data` WHERE `ID` = '$id'";
$result = $conn->query($query);

echo "<br>";

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['Password'];
    $occupation = $row['Occupation'];

    echo "<br>";

    if (password_verify($password, $storedPassword)) {
        echo "<script>
                Swal.fire({
                    title: 'Login Successful',
                    text: 'Redirecting...',
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
    } 
    else 
    {
        echo "<script>
                Swal.fire({
                    title: 'Login Failed',
                    text: 'Invalid ID or Password',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'login.html';
                });
             </script>";
    }
} 

else {
    echo "<script>
            Swal.fire({
                title: 'Login Failed',
                text: 'Invalid ID or Password',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'login.html';
            });
         </script>";
}

$conn->close();
?>