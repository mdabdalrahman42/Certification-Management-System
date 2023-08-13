<html>

<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>

<body>
    <?php
    $id = $_GET['id'];
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
                            <a class="nav-link" href="login.html" onclick="alertFun(event)">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid mb-5" style="min-height: 78vh;">
            <div class="row justify-content-center align-items-center" style="min-height: 78vh;">
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <header>Upload</header>
                            </div>
                        </div>
                        <form class="form">
                            <div class="row">
                                <div class="col text-center">
                                    <img src="upload.png" alt="Upload" class="img-upload">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col justify-upload">
                                    <label class="content">You can upload any type of certificate, such as educational certificates,
                                        professional certificates, training certificates, internship certificates, etc.
                                        Start uploading your certificates now.</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-center">
                                    <a href="upload.php?id=<?php echo $id; ?>"><button type="button">Upload</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <header>View</header>
                            </div>
                        </div>
                        <form class="form">
                            <div class="row">
                                <div class="col text-center">
                                    <img src="view.png" alt="View" class="img-view">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col justify-view">
                                    <label class="content">With just one click, you can view all of your uploaded
                                        certificates and download to your local storage if necessary</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-center">
                                    <a href="view.php?id=<?php echo $id; ?>"><button type="button">View</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <header>Students Certifications</header>
                            </div>
                        </div>
                        <form class="form">
                            <div class="row">
                                <div class="col text-center">
                                    <img src="excel.png" alt="Student" class="img-upload">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col justify-upload">
                                    <label class="content">You can view all the certificates uploaded by students in your department at
                                        your college, and you can also export the required types of certificates in
                                        Excel format for further use.</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-center">
                                    <a href="viewstudents.php?id=<?php echo $id; ?>"><button type="button">View</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

                </div>
                <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <header>Employees Certifications</header>
                            </div>
                        </div>
                        <form class="form">
                            <div class="row">
                                <div class="col text-center">
                                    <img src="employee.png" alt="Employee" class="img-upload">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col justify-view">
                                    <label class="content">You can view all the certificates uploaded by employees in your department at
                                        your college, and you can also export the required types of certificates in
                                        Excel format for further use.</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-center">
                                    <a href="viewemployee.php?id=<?php echo $id; ?>"><button type="button">View</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2">

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