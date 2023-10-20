<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("question_bank/questions"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Question details - Dashboard</title>
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
    <main class="content h-100 d-flex flex-column bg-light">
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
                <li class="breadcrumb-item text-dark">Question bank</li>
                <li class="breadcrumb-item">
                    <a href="questions.php" class="text-decoration-none text-dark"> Question</a>
                </li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Content -->
        <?php $data = module::single(); ?>
        <section class="overflow-auto container-fluid bg-light">
           <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="card  shadow mt-5 mb-5">
                        <div class="card-header border-bottom bg-white py-3">
                            <h5 class="card-title m-0 d-flex align-items-center font-20">
                                <span class="bx bx-show me-2 text-primary "></span><b>Question details</b>
                            </h5>
                        </div>
                        <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td style="width:100px;"><b>ID</b></td>
                                <td><?php echo $data["id"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Type</b></td>
                                <td><?php echo $data["category"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Class</b></td>
                                <td><?php echo $data["class"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Subject</b></td>
                                <td><?php echo $data["subject"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Chapter no</b></td>
                                <td><?php echo $data["chapter"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Topic name</b></td>
                                <td><?php echo $data["topic"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Statement</b></td>
                                <td><?php echo $data["statement"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Answer</b></td>
                                <td><?php echo $data["answer"]; ?></td>
                            </tr>
                            <?php if($data["is_options"] == 0): ?>
                                <tr>
                                <td><b>Options</b></td>
                                <td>
                                    <?php echo $data["opt1"]; ?>,
                                    <?php echo $data["opt2"]; ?>,
                                    <?php echo $data["opt3"]; ?>,
                                    <?php echo $data["opt4"]; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            
                            <tr>
                                <td><b>Marks</b></td>
                                <td><?php echo $data["marks"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Estimated time</b></td>
                                <td><?php echo $data["estimated_time"]; ?> Min</td>
                            </tr>
                            <tr>
                                <td><b>Teacher</b></td>
                                <td><?php echo $data["firstname"]; ?> <?php echo $data["lastname"]; ?></td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td><?php echo f::is_active($data["is_active"]); ?></td>
                            </tr>
                            <tr>
                                <td><b>Created at</b></td>
                                <td><?php echo DT::format($data["created_at"]); ?></td>
                            </tr>
                            <tr>
                                <td><b>Updated at</b></td>
                                <td><?php echo DT::format($data["updated_at"]); ?></td>
                            </tr>
                        </table>     
                        </div>
                        <div class="card-footer border-top text-center bg-light">
                            <a href="questions.php" class="btn btn-light font-14 ps-5 pe-5 border">
                                <b>Go back</b>
                            </a>
                        </div>
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