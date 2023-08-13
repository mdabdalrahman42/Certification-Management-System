<?php
$servername = "localhost";
$username = "root";
$password = "12345678";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$query = "SHOW DATABASES LIKE 'certifications'";
$result = $conn->query($query);

if ($result->num_rows == 0) 
{
    $createDBQuery = "CREATE DATABASE certifications";
    $conn->query($createDBQuery);
    $conn->select_db("certifications");
    create($conn);
} 

else 
{
    $conn->select_db("certifications");
    $checkUserDataQuery = "SHOW TABLES LIKE 'user_data'";
    $resultUserData = $conn->query($checkUserDataQuery);
    $checkCertificatesQuery = "SHOW TABLES LIKE 'certificates'";
    $resultCertificates = $conn->query($checkCertificatesQuery);
    
    if ($resultUserData->num_rows == 1 && $resultCertificates->num_rows == 1) 
    {
        echo "Tables exist";
    } 
    
    else 
    {
        create($conn);
    }
}

function create(mysqli $conn) 
{
    $createUserDataQuery = "CREATE TABLE `user_data` (
        `ID` VARCHAR(10) NOT NULL PRIMARY KEY,
        `First Name` VARCHAR(50) NOT NULL,
        `Last Name` VARCHAR(50) NOT NULL,
        `Email Id` VARCHAR(100) NOT NULL,
        `Phone` VARCHAR(20) NOT NULL,
        `Gender` VARCHAR(10) NOT NULL,
        `Dob` DATE NOT NULL,
        `Occupation` VARCHAR(50) NOT NULL,
        `College` VARCHAR(100) NOT NULL,
        `Branch` VARCHAR(50) NOT NULL,
        `Password` VARCHAR(255) NOT NULL
    )";
    $conn->query($createUserDataQuery);
    $createCertificatesQuery = "CREATE TABLE `certificates` (
        `ID` VARCHAR(10) NOT NULL,
        `Type` VARCHAR(20) NOT NULL,
        `Title` VARCHAR(100) NOT NULL,
        `Organization` VARCHAR(100) NOT NULL,
        `Duration` VARCHAR(50) NOT NULL,
        `Start Date` DATE NOT NULL,
        `End Date` DATE NOT NULL,
        `Certificate` LONGBLOB NOT NULL,
        `Extension` VARCHAR(10) NOT NULL,
        FOREIGN KEY (`ID`) REFERENCES `user_data`(`ID`)
    )";
    $conn->query($createCertificatesQuery);
    echo "Tables created successfully";
}

$conn->close();
?>