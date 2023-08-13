<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "Certifications";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['title']) && isset($_GET['id'])) 
{
    $title = $_GET['title'];
    $id = $_GET['id'];

    $query = "SELECT `Certificate`,`Extension` FROM `certificates` WHERE `Title` = '$title' AND `ID` = '$id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        $certificate = base64_decode($row['Certificate']);
        $extension = $row['Extension'];

        $contentType = getContentTypeFromExtension($extension);

        header('Content-Type: '.$contentType);
        header('Content-Disposition: attachment; filename="' . $title . '.' . $extension . '"');
        echo $certificate;
    }
}

$conn->close();

function getContentTypeFromExtension($extension) {
    $mimeToExtension = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
    ];
    return $mimeToExtension[$extension] ?? 'application/octet-stream';
}
?>
