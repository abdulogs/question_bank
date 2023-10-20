<?php require_once "./classes/app.php"; ?>
<!-- Login redirect -->
<?php middleware::logout("id", "index"); ?>
<!-- Home page -->
<?php f::module("index"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Home - Dashboard</title>
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
    <!-- Sidebar -->
    <?php f::component("sidenav"); ?>
    <!-- Sidebar -->
    <!-- Content -->
    <main class="content h-100 d-flex flex-column bg-light">
        <header class="d-md-none d-lg-none d-block">
            <nav class="d-flex align-items-center border-bottom py-2 px-3">
                <a class="d-inline-block" href="#">
                    <img src="./src/images/logo.png" alt="" height="30" class="d-inline-block">
                </a>
                <div class="d-flex align-items-center ms-auto">
                    <button class="btn font-20 btn-sm shadow-none bx bx-menu opensidenav"></button>
                </div>
            </nav>
        </header>
        <nav class="d-flex align-items-center border-bottom py-2 px-3 bg-white">
            <a class="font-20 text-dark text-decoration-none">
                <b class="align-middle">Dashboard</b>
            </a>
        </nav>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="border-bottom px-3 py-2 ">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="home.php" class="text-decoration-none text-dark">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Alerts -->
        <?php msg::get(); ?>
        <!-- Alerts -->
        <!-- Content -->
        <section class="overflow-auto h-100 container">
            <div class="row pt-3">
                <?php if(f::is_admin()): ?>
                <div class="col-sm-3 mb-3">
                <?php $data = module::admins();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Admins</b></h3><h4><b><?php echo $data["admins"]?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-group"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="u-admins.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <?php $data = module::teachers();   ?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Teachers</b></h3><h4><b><?php echo $data["teachers"]?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-user-circle"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="u-teachers.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <?php $data = module::classes();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Classes</b></h3><h4><b><?php echo $data["classes"];?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-flag"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="classes.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                    <?php $data = module::subjects();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Subjects</b></h3><h4><b><?php echo $data["subjects"];?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-book"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="subjects.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-sm-3 mb-3">
                    <?php $data = module::chapters();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Chapters</b></h3><h4><b><?php echo $data["chapters"];?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-list-ol"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="chapters.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                <?php $data = module::topics();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Topics</b></h3><h4><b><?php echo $data["topics"];?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-flag"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="topics.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                <?php $data = module::questions();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Questions</b></h3><h4><b><?php echo $data["questions"];?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-question-mark"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="questions.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 mb-3">
                <?php $data = module::papers();?>
                    <div class="card bg-white shadow-sm">
                        <div class="card-body text-muted position-relative">
                            <div><h3><b>Papers</b></h3><h4><b><?php echo $data["papers"];?></b></h4></div>
                            <div class="display-2 text-success position-absolute end-0 top-0 p-2">
                                <i class="bx bx-file"></i>
                            </div>
                        </div>
                        <a class="card-footer text-dark text-decoration-none" href="papers.php">
                            <span class="float-end font-14">
                                <b class="bx bx-right-arrow-circle me-1 allign-middle"></b> 
                                <b class="allign-middle">View details</b> 
                            </span>
                            <span class="float-right"><i class="bx bx-angle-right"></i></span>
                        </a>
                    </div>
                </div>
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