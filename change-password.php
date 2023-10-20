<!-- App -->
<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("account/profile"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Change password - Dashboard</title>
    <!-- Seo tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="" />
    <!-- Common css -->
    <link rel="stylesheet" href="./src/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/libs/boxicons/css/boxicons.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="./src/css/stylesheet.css">
</head>

<body class="layout d-flex h-100">

    <?php f::component("sidenav"); ?>

    <?php $user = auth::user(); ?>

    <main class="content h-100 d-flex flex-column bg-white">
        <!-- Navbar -->
        <header class="bg-white">
            <nav class="d-md-none d-lg-none d-block w-100">
                <div class="d-flex align-items-center border-bottom py-2 px-3">
                    <a class="d-inline-block" href="home.php">
                        <img src="./src/images/logo.png" alt="logo" height="30" class="d-inline-block">
                    </a>
                    <div class="d-flex align-items-center ms-auto">
                        <button class="btn font-20 btn-sm shadow-none bx bx-menu  opensidenav"></button>
                    </div>
                </div>
            </nav>
            <nav class="d-flex align-items-center border-bottom py-2 px-3">
                <a class="font-20 text-dark text-decoration-none">
                    <b class="align-middle">Dashboard</b>
                </a>
            </nav>
        </header>
        <!-- Navbar -->
        <!-- Breadcrumb -->
        <nav  class="border-bottom px-3 py-2">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="home.php" class="text-decoration-none text-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="profile.php" class="text-decoration-none text-dark">Profile</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"> 
                <b><?php echo $user["firstname"]." ".$user["lastname"]; ?></b>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Alerts -->
        <?php msg::get(); ?>
        <!-- Alerts -->
        <!-- Content -->
        <section class="overflow-auto h-100">
            <ul class="nav nav-tabs bg-light mb-4 pt-3">
                <li class="nav-item ms-3">
                    <a class="nav-link" href="profile.php"><b>General</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="change-password.php"><b>Change password</b></a>
                </li>
            </ul>
            <?php module::change_password(); ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <form method="POST" class="card rounded border-0 mb-5 mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14" for="password"> <b>New password</b></label>
                                        <input class="form-control form-control-lg border-0 bg-light shadow-none font-14"
                                            name="npassword" type="password" required/>
                                    </div>
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14" for="password2"><b>Confirm password</b></label>
                                        <input
                                            class="form-control form-control-lg border-0 bg-light shadow-none font-14"
                                            name="cpassword" type="password" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center bg-white border-0">
                                <button class="btn btn-primary ps-5 pe-5" name="action" value="changepassword" type="submit">
                                    <span class="bx bx-lock me-2"></span> Change password
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Libraries -->
        <script src="./src/libs/jquery/jquery.min.js"></script>
        <script src="./src/libs/popper/popper.min.js"></script>
        <script src="./src/libs/bootstrap/js/bootstrap.min.js"></script>

        <!-- Common -->
        <script src="./src/js/base.js"></script>
</body>

</html>