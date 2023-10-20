<?php require_once "./classes/app.php"; ?>

<?php middleware::login("id", "home"); ?>

<?php f::module("account/login"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Login - Dashboard</title>
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

<body class="h-100 overflow-hidden">
    <!-- Alerts -->
    <?php msg::get(); ?>
    <!-- Alerts -->
    <main class="container">
        <h1 class="m-0 py-3 text-center mb-5 font-20 fw-bold">Automatic <span class="text-primary">question paper</span> generator</h1>
        <div class="row justify-content-center mt-5">
        <?php module::login(); ?>
            <form class="card border-0 col-sm-3 mt-5" method="POST">
                <br><br><br>
                <h1 class="text-center mb-2 m-0 fw-bold font-40">Login</h1>
                <p class="text-center text-muted mb-3">Welcome back! login to your account!</p>
                <div class="form-group mb-2">
                    <input type="email" class="form-control form-control-lg border-0 bg-light font-12 shadow-none"
                        name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <input type="password"
                        class="form-control form-control-lg border-0 bg-light font-12 shadow-none" name="password"
                        placeholder="Enter your password" required>
                </div>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary mt-2 fw-bold font-14 rounded" name="action" value="login">Login</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Libraries -->
    <script src="./src/libs/jquery/jquery.min.js"></script>
    <script src="./src/libs/popper/popper.min.js"></script>
    <script src="./src/libs/bootstrap/js/bootstrap.min.js"></script>

    <!-- Common -->
    <script src="./src/js/base.js"></script>

</body>

</html>