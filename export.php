<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new Mpdf\Mpdf();

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "Certifications";

$constraintType = $_POST['type'];
$filter = $_POST['filter'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

$id = $_GET['id'];
$queryocc = "SELECT * FROM `user_data` WHERE `ID` = '$id'";
$result = $conn->query($queryocc);
$row = $result->fetch_assoc();
$occupation = $row["Occupation"];
$college = $row['College'];
$branch = $row['Branch'];

if ($filter !== "") {
    $sql = "SELECT * FROM certificates WHERE Type = '$constraintType' AND ID LIKE '%$filter%'";
} else {
    $sql = "SELECT * FROM certificates WHERE Type = '$constraintType'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $html = '
    
    <html>

    <head>
    
        <style>
        body {
            padding: 35px 20px;
            font-family: "Times New Roman", Times, serif;
        }
        
        .header {
            text-align: center;
        }
        
        .header-text {
            font-size: 19px;
            margin: 0;
        }
        
        .sub-header {
            text-align: center;
        }
        
        .sub-header-text {
            margin-top: 23px;
        }
        
        .outer-border {
            border: 1px solid black;
        }
        
        .table {
            margin-top: 15px;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th {
            border: 1px solid black;
            text-align: left;
            padding: 5px;
        }
        
        td {
            border: 1px solid black;
            padding: 5px;
            font-size: 15px;
        }
        
        thead {
            background-color: red;
        }
        </style>
    
    </head>
    
    <body>
    
        <div class="container">
            <div class="header">
                <h3 class="header-text">'.$college.'</h3>
            </div>';

            if ($filter !== "") {
                $html = $html . '<div class="sub-header">
                    <h4 class="sub-header-text">Department of '.$branch.' '.$filter.' '.$_GET['Occupation'].' '.$constraintType.' Data</h4>
                </div>';
            } else {
                $html = $html . '<div class="sub-header">
                    <h4 class="sub-header-text">Department of '.$branch.' '.$_GET['Occupation'].' Internship Data</h4>
                </div>';
            }
            $html = $html . '
            <div class="table">
                <table class="outer-border" align="center">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Email Id</th>
                            <th>Title</th>
                            <th>Organization</th>
                            <th>Duration</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>';
            $sno = 0;
    while ($row = $result->fetch_assoc()) {
        $id = $row['ID'];
        $querycheck = "SELECT * FROM `user_data` WHERE `ID`='$id'";
        $check = $conn->query($querycheck);
        $output = $check->fetch_assoc();
        
        if ($output['Occupation'] === $_GET['Occupation'] && $output['College'] === $college && $output['Branch'] === $branch) {

            $sno = $sno+1;
            $html = $html . '
                            <tr>
                                <td>'.$sno.'</td>
                                <td>'.$id.'</td>
                                <td>'.$output['First Name'].'</td>
                                <td>'.$output['Email Id'].'</td>
                                <td>'.$row['Title'].'</td>
                                <td>'.$row['Organization'].'</td>
                                <td>'.$row['Duration'].' Weeks</td>
                                <td>'.$row['Start Date'].'</td>
                                <td>'.$row['End Date'].'</td>
                            </tr>';
        }
    }

    $html = $html . '</table>
                    </div>
                </div>
            </div>

        </body>

    </html>';

    if ($filter !== "") {
        $file = $filter.'_'.$constraintType.'.pdf';
    } else {
        $file = $constraintType.'.pdf';
    }
    
    $mpdf -> WriteHTML($html);
    $mpdf -> output($file,'D');

} 
else {
    
    echo "<br>";
    
    $id = $_GET['id'];
    $occupation_export = $_GET['Occupation'];
    
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <link rel='stylesheet' href='styles.css' />
        <script>
            Swal.fire({
                title: 'Download Failed',
                text: 'No match for type and filter',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
                var redirectUrl = '';
                if ('$occupation_export' === 'Student') 
                {
                    redirectUrl = 'viewstudents.php?id=$id';
                } 
                else if ('$occupation_export' === 'Employee') 
                {
                    redirectUrl = 'viewemployee.php?id=$id';
                }
                window.location.href = redirectUrl;
            });
        </script>";
}

$conn->close();

?>
