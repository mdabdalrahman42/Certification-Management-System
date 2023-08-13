<html>

<head>
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script>
        function validateForm() {
            document.getElementById("error_message").innerHTML = "";
            var type = document.getElementById("type").value;
            var title = document.getElementById("title").value;
            var organization = document.getElementById("organization").value;
            var duration = document.getElementById("duration").value;
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;
            var certificate = document.getElementById("certificate").value;
            if (type === "") {
                document.getElementById("error_message").innerHTML = "Please select a Certificate Type!!!";
                return false;
            }
            var nameReg = /^[A-Za-z0-9.][A-Za-z0-9. ]*[A-Za-z0-9.]$/;
            if (!nameReg.test(title)) {
                document.getElementById("error_message").innerHTML = "Title should be of correct format!!!";
                return false;
            }
            if (!nameReg.test(organization)) {
                document.getElementById("error_message").innerHTML = "Organization should be of correct format!!!";
                return false;
            }
            if (startDate === "") {
                document.getElementById("error_message").innerHTML = "Please select a Start Date!!!";
                return false;
            }
            if (endDate === "") {
                document.getElementById("error_message").innerHTML = "Please select a End Date!!!";
                return false;
            }
            if (duration === "" || duration <= 0) {
                document.getElementById("error_message").innerHTML = "Duration should be of correct format!!!";
                return false;
            }
            if (certificate === "") {
                document.getElementById("error_message").innerHTML = "Please choose a file to upload!!!";
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
                        <img src="images/logo.png" alt="Logo" class="logo">CloudVault
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse links" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="<?php echo $redirect ?>">Home</a>
                            <a class="nav-link" href="view.php?id=<?php echo $_GET['id']; ?>">View</a>
                            <a class="nav-link" href="login.html" onclick="alertFun(event)">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid" style="min-height: 82vh;">
            <div class="row justify-content-center align-items-center mt-3 mb-4" style="min-height: 82vh;">
                <div class="col-xl-4 col-lg-3 col-md-2 col-sm-1">

                </div>
                <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <header>Upload</header>
                            </div>
                        </div>
                        <form action="upload_certificate.php" method="POST" enctype="multipart/form-data"
                            onsubmit="return validateForm()" class="form">
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="input-box">
                                        <label>ID<span class="req"> *</span></label>
                                        <input type="text" id="id" name="id" value="<?php echo $_GET['id']; ?>"
                                            readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>Certificate Type<span class="req"> *</span></label>
                                        <div class="select-box">
                                            <select id="type" name="type">
                                                <option value="" hidden>Select Certificate Type</option>
                                                <option value="Internship">Internship</option>
                                                <option value="NPTEL">NPTEL</option>
                                                <option value="Educational">Educational Certificate</option>
                                                <option value="Professional">Professional Certificate</option>
                                                <option value="Training">Training Certificate</option>
                                                <option value="Others">Other Certification</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>Title<span class="req"> *</span></label>
                                        <input type="text" placeholder="Enter certificate title" id="title" name="title"
                                            title="Eg: 'Programming in Java', 'Cloud Computing'" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>Organization<span class="req"> *</span></label>
                                        <input type="text" placeholder="Enter organization name" id="organization"
                                            name="organization" title="Eg: 'Amazon', 'TCS', 'IIT Kharagpur'" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>Start Date<span class="req"> *</span></label>
                                        <input class="form-select" type="date" id="start_date" name="start_date" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>End Date<span class="req"> *</span></label>
                                        <input class="form-select" type="date" id="end_date" name="end_date" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>Duration<span class="format"> (in weeks)</span><span class="req">
                                                *</span></label>
                                        <input type="number" placeholder="Enter duration" id="duration" name="duration"
                                            title="Eg: '4', '6'" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-box">
                                        <label>Certificate<span class="req"> *</span></label>
                                        <input type="file" id="certificate" name="certificate" accept=".pdf,image/*"
                                            class="file form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col text-center">
                                    <div id="error_message" class="error text-danger"></div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <button type="submit">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-2 col-sm-1">

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