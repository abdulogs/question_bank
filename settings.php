<!-- App -->
<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("settings"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Settings - Dashboard</title>
    <!-- Common css -->
    <link rel="stylesheet" href="./src/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/libs/boxicons/css/boxicons.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="./src/css/stylesheet.css">
</head>

<body class="layout d-flex h-100">

    <?php f::component("sidenav"); ?>

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
                    <a href="settings.php" class="text-decoration-none text-dark">Settings</a>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Alerts -->
        <?php msg::get(); ?>
        <!-- Alerts -->
        <!-- Content -->
        <section class="overflow-auto h-100">
            <?php $data = module::single(); ?>
            <?php if($data){ 
                module::update();
            } else {
                module::create();
            } ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <form method="POST" class="card rounded border-0 mb-5 mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="mb-0 font-14 fw-bold" for="name">Name</label>
                                        <input class="form-control form-control-lg border-0 bg-light shadow-none font-14"
                                            name="name" value="<?php echo $data["name"]; ?>"/>
                                    </div>
                                    <div class="form-group col-sm-6 mb-3">
                                    <label class="mb-0 font-14 fw-bold" for="tagline">Tagline</label>
                                        <input
                                            class="form-control form-control-lg border-0 bg-light shadow-none font-14"
                                            name="tagline" value="<?php echo $data["tagline"]; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center bg-white border-0">
                                <?php if($data): ?>
                                    <button class="btn btn-primary px-3 rounded-pill" name="action" value="update" type="submit">
                                         Update
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-primary px-3 rounded-pill" name="action" value="create" type="submit">
                                         Update
                                    </button>
                                <?php endif; ?>
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