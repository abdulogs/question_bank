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
    <title>Profile - Dashboard</title>
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
    <style>
    .avatar {
        width: 150px;
        min-width: 150px;
        max-width: 150px;
        height: 150px;
        min-height: 150px;
        max-height: 150px;
    }
</style>

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
        <nav aria-label="breadcrumb" class="border-bottom px-3 py-2">
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
                    <a class="nav-link active" href="profile.php"><b>General</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change-password.php"><b>Change password</b></a>
                </li>
            </ul>
            <?php module::general(); ?>
            <?php module::image(); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3">
                        <form enctype="multipart/form-data" method="POST">
                            <div class="mt-5 text-center">
                                <img src="<?php echo media::image($user["image"])?>" class="rounded-circle border p-1 avatar" id="output">
                                <div class="mt-3 d-flex justify-content-center">
                                    <label class="btn btn-primary ps-3 pe-3 m-0 mr-2" for="file">
                                        <input  name="file" id="file" type="file" accept="image/*" onchange="loadFile(event)" hidden /> 
                                        <i class="bx bx-camera"></i> Upload
                                    </label>
                                    <div id="uploadbtn" class="ms-2"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form method="POST" class="card rounded border-0">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14 lato-bold" for="firstname"><b>Firstname</b></label>
                                        <input
                                            class="form-control form-control-lg border-0 bg-light shadow-none lato-bold font-14 bg-light"
                                            name="firstname" type="text" value="<?php echo $user["firstname"]; ?>" />
                                    </div>
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14 lato-bold" for="lastname"><b>Lastname</b></label>
                                        <input
                                            class="form-control form-control-lg border-0 bg-light shadow-none lato-bold font-14"
                                            name="lastname" type="text" value="<?php echo $user["lastname"]; ?>" />
                                    </div>
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14 lato-bold" for="username"><b>Username</b></label>
                                        <input
                                            class="form-control form-control-lg border-0 bg-light shadow-none lato-bold font-14"
                                            name="username" type="text" value="<?php echo $user["username"]; ?>" />
                                    </div>
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14 lato-bold" for="email"><b>Email</b></label>
                                        <input
                                            class="form-control form-control-lg border-0 bg-light shadow-none lato-bold font-14"
                                            name="email" type="email" value="<?php echo $user["email"]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center bg-white border-0">
                                <button class="btn btn-primary ps-5 pe-5" name="action" value="general" type="submit">
                                    <span class="bx bx-pencil me-2"></span> Update profile
                                </button>
                            </div>
                        </form>

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
        <script src="./src/js/image.js"></script>

        <script>
            $(document).on('change', '#file', function (e) {
                e.preventDefault();
                $("#uploadbtn").html(`<button type="submit" name="action" value="image" class="btn btn-light ms-2 font-14">Change</button>`)
            });
        </script>
        
</body>

</html>