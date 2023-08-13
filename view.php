<html>

<head>
    <title>View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script>
        function validateForm() {
            document.getElementById("error_message").innerHTML = "";
            var checked = document.querySelector('input[name="checked[]"]:checked');
            if (!checked) {
                document.getElementById("error_message").innerHTML = "Please select a certification to delete!!!";
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "Certifications";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $queryocc = "SELECT Occupation FROM `user_data` WHERE `ID` = '$id'";
    $result = $conn->query($queryocc);
    $row = $result->fetch_assoc();
    $occupation = $row["Occupation"];

    if ($occupation === 'Student') {
        $redirect = "student.php?id=$id";
    } else {
        $redirect = "employee.php?id=$id";
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand text-primary" href="#">
                        <img src="logo.png" alt="Logo" class="logo">CloudVault
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse links" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="<?php echo $redirect ?>">Home</a>
                            <a class="nav-link" href="upload.php?id=<?php echo $_GET['id']; ?>">Upload</a>
                            <a class="nav-link" href="login.html" onclick="alertFun(event)">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid outer" style="min-height: 67vh;">
            <div class="row justify-content-center align-items-center mt-3 mb-4" style="min-height: 67vh;">
                <div class="col">
                    <div class="inner">
                        <?php
                        $query = "SELECT * FROM `certificates` WHERE `ID`='$id' ORDER BY `Type`";
                        $result = $conn->query($query);

                        echo "
                        <table class='table'>
                        <thead>
                            <tr>
                                <th scope='col'> </th>
                                <th scope='col'><label>Type</label></th>
                                <th scope='col'><label>Title</label></th>
                                <th scope='col'><label>Organization</label></th>
                                <th scope='col'><label>Weeks</label></th>
                                <th scope='col'><label>Start</label></th>
                                <th scope='col'><label>End</label></th>
                                <th scope='col'><label>Download</label></th>
                            </tr>
                        </thead>
                        ";
                        if ($result->num_rows > 0) {

                            echo "<form  onsubmit='return validateForm()' action='delete.php?id=$id' method='POST' class='form'>
                        <tbody>";

                            while ($row = $result->fetch_assoc()) {
                                $type = $row['Type'];
                                $title = $row['Title'];
                                $organization = $row['Organization'];
                                $duration = $row['Duration'];
                                $startDate = $row['Start Date'];
                                $endDate = $row['End Date'];
                                $extension = $row['Extension'];

                                $date = new DateTime($startDate);
                                $startDate = $date->format("d-m-y");
                                $date = new DateTime($endDate);
                                $endDate = $date->format("d-m-y");


                                echo "<tr>
                            <th scope='row'>
                                <div class='check'>
                                    <input type='checkbox' value='$title' name='checked[]'>
                                </div>
                            </th>
                            <td>
                                <label>$type</label>
                            </td>
                            <td>
                                <label>$title</label>
                            </td>
                            <td>
                                <label>$organization</label>
                            </td>
                            <td>
                                <label>$duration</label>
                            </td>
                            <td>
                                <label>$startDate</label>
                            </td>
                            <td>
                                <label>$endDate</label>
                            </td>";
                                if ($extension === "pdf") {
                                    echo "<td>
                                <label><img src='pdf.png' alt='pdf' class='pdf'> <a class='pdf-download' href='download.php?title=" . urlencode($title) . "&id=" . urlencode($id) . "'>Download<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='#0d6efd' class='bi bi-box-arrow-in-up-right' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd' d='M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5z'/>
                                <path fill-rule='evenodd' d='M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0v-5z'/>
                                </svg></a>
                                </label>
                            </td>";
                                } else {
                                    echo "<td>
                                <label><img src='image.png' alt='image' class='image'> <a href='download.php?title=" . urlencode($title) . "&id=" . urlencode($id) . "'>Download<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='#0d6efd' class='bi bi-box-arrow-in-up-right' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd' d='M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5z'/>
                                <path fill-rule='evenodd' d='M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0v-5z'/>
                                </svg></a>
                                </label>
                            </td>";
                                }
                                echo "</tr>";
                            }
                            echo "</tbody>
                    </table>";
                            echo "<div class='row mt-4'>
                        <div class='col text-center text-danger'>
                            <div id='error_message' class='error'></div>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col text-center form'>
                            <button type='submit'>Delete</button>
                        </div>
                    </div>
                    </form>";
                        } else {
                            echo "</table>
                    <div class='row mt-4'>
                        <div class='col mt-3 text-center text-danger'>
                            <p class='error'>No certifications found<p>
                        </div>
                     </div>";
                        }
                        $conn->close();
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script>
        function alertFun(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Logout Successful',
                text: 'Redirecting...',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function () {
                window.location.href = 'login.html';
            });
        }
    </script>
</body>

</html>