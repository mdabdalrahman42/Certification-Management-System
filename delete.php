<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "Certifications";

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo '<link rel="stylesheet" href="styles.css" />';

$id=$_GET['id'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

echo "<br>";

if (isset($_POST['checked'])) 
{
    $selectedCertificates = $_POST['checked'];
    if (count($selectedCertificates) > 0) 
    {
        
        foreach ($selectedCertificates as $certificateId) 
        {
            $query = "DELETE FROM `certificates` WHERE `Title` = '$certificateId' AND `ID` = '$id'";
            $conn->query($query);
        }

        echo "<script>
                Swal.fire({
                    title: 'Delete Successful',
                    text: 'Redirecting...',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location = 'view.php?id=$id';
                });
            </script>";
    } 
}

$conn->close();
?>
