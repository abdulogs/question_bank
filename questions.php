<!-- App -->
<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("question_bank/questions"); ?>
<?php module::delete(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Questions - Dashboard</title>
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
                <div class="ms-auto d-flex align-items-center">
                    <a href="question-create.php" class="d-flex align-items-center btn btn-primary">
                        <b class="bx bx-plus-circle me-2 font-20"></b> <b>Create</b>
                    </a>
                </div>
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
                    <a href="questions.php" class="text-decoration-none text-dark">Questions</a>
                </li>
                <li class="breadcrumb-item active">All</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Alerts -->
        <?php msg::get(); ?>
        <!-- Alerts -->
        <!-- Content -->
        <section class="overflow-auto h-100">
        <table class="table table-card  mb-0 font-12">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-bottom text-uppercase text-muted" scope="col">ID</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Statement</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Type</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Class</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Subject</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">marks</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Teacher</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Status</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Created at</th>
                        <th class="border-bottom text-uppercase text-muted" scope="col">Updated at</th>
                        <th class="px-3 border-bottom text-uppercase text-muted" scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody class="font-12">
                <?php $listing = module::listing(); ?>
                    <?php if($listing): ?>
                    <?php foreach($listing as $item): ?>
                    <tr>
                        <td class="align-middle px-4" data-label="ID">
                            <?php echo $item["id"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Statement">
                            <?php echo $item["statement"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Type">
                            <?php echo $item["category"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Class">
                            <?php echo $item["class"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Subject">
                            <?php echo $item["subject"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Marks">
                            <?php echo $item["marks"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Teacher">
                            <?php echo $item["firstname"]; ?> <?php echo $item["lastname"]; ?>
                        </td>
                        <td class="align-middle text-break" data-label="Status">
                            <?php echo f::is_active($item['is_active']); ?>
                        </td>
                        <td class="align-middle" data-label="Created at">
                        <?php echo DT::format($item["created_at"]); ?>
                        </td>
                        <td class="align-middle" data-label="Updated at">
                            <?php echo DT::format($item["updated_at"]); ?>
                        </td>
                        <td class="align-middle px-4" data-label="Controls">
                            <?php module::actions($item["id"]);  ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td class="text-center text-danger" colspan="11"><b>No records found!</b></td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </section>
        <footer class=" border-top px-3 py-2 text-center bg-light">
            <?php DB::btns("questions", $listing);  ?>
        </footer>
        <!-- Content -->
    </main>

    <!-- Libraries -->
    <script src="./src/libs/jquery/jquery.min.js"></script>
    <script src="./src/libs/popper/popper.min.js"></script>
    <script src="./src/libs/bootstrap/js/bootstrap.min.js"></script>

    <!-- Common -->
    <script src="./src/js/base.js"></script>

    <!-- Remove params from url -->
    <script>
    clearparams("id");
    clearparams("action");
    </script>

</body>

</html>