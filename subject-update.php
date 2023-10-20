<!-- App -->
<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Redirect teacher to access denied page-->
<?php middleware::is_teacher("403"); ?>
<!-- Module -->
<?php f::module("management/subjects"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Subject update - Dashboard</title>
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
    <!-- Sidenav -->
    <?php f::component("sidenav"); ?>
    <!-- Sidenav -->
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
        <nav class="border-bottom px-3 py-2 bg-light">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="home.php" class="text-decoration-none text-dark">Home</a>
                </li>
                <li class="breadcrumb-item text-dark">Management</li>
                <li class="breadcrumb-item">
                    <a href="subjects.php" class="text-decoration-none text-dark">Subject</a>
                </li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Content -->
        <?php module::update(); ?>
        <?php $data = module::single(); ?>
        <section class="overflow-auto h-100 bg-light d-flex align-items-center justify-content-center flex-column">
            <div class="col-sm-5">
                <form class="card shadow"  method="post">
                    <div class="card-header border-bottom bg-white py-3">
                        <h5 class="card-title m-0 d-flex align-items-center font-20">
                            <span class="bx bx-pencil me-2 text-primary "></span><b>Update</b>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3 col-sm-6">
                                <label class=" mb-0 font-14" for="name"><b>Name</b></label>
                                <input class="form-control form-control-lg shadow-none border font-14" value="<?php echo $data["name"]; ?>" name="name" type="text" />
                                <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
                            </div>
                            <div class="form-group mb-3 col-sm-6">
                                <label class=" mb-0 font-14" for="is_active"><b>Active</b></label>
                                <select name="is_active" class="form-select shadow-none border form-control-lg font-14">
                                    <?php f::is_active($data["is_active"], "option"); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top bg-light text-center">
                        <a href="subjects.php" class="btn btn-light font-14 ps-5 pe-5 border"><b>Go back</b></a>
                        <button class="btn btn-primary font-14 ps-5 pe-5" name="action" value="update" type="submit"><b>Update</b></button>
                    </div>
                </form>           
            </div>    
        </section>
        <!-- Content -->
    </main>

    <!-- Libraries -->
    <script src="./src/libs/jquery/jquery.min.js"></script>
    <script src="./src/libs/popper/popper.min.js"></script>
    <script src="./src/libs/bootstrap/js/bootstrap.min.js"></script>

    <!-- Common -->
    <script src="./src/js/base.js"></script>
   

</body>

</html>