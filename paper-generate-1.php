<!-- App -->
<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("papers/generate"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <title>Generate paper step 2 - Dashboard</title>
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
                <li class="breadcrumb-item text-dark">Paper</li>
                <li class="breadcrumb-item">
                    <a href="paper-generate-1.php" class="text-decoration-none text-dark"> Generate</a>
                </li>
                <li class="breadcrumb-item active">Step 2</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Content -->
        <section class="overflow-auto bg-light">
            <div class="container-fluid">
                <div class="row mt-5 mb-5">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <form class="card shadow" method="get" action="paper-generate-2.php">
                            <div class="card-header border-bottom bg-white py-3">
                                <h5 class="card-title m-0 d-flex align-items-center font-20">
                                    <span class="bx bx-plus-circle me-2 text-primary "></span><b>Generate</b>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class=" mb-0 font-14" for="assign_id"><b>Class or subject</b></label>
                                    <?php $assign_cs = module::assign_cs(); ?>
                                    <?php $assign = http::param("assign"); ?>
                                    <select name="assign_id" required class="form-select shadow-none border form-control-lg font-14" id="assign_id">
                                        <option value="" >Select</option>
                                        <?php foreach($assign_cs as $option): ?>
                                        <?php $selected = f::selected($option["id"], $assign); ?>
                                        <option value="<?php echo $option["id"]; ?>" <?php echo $selected; ?>>
                                            <?php echo $option["class"]; ?> - <?php echo $option["subject"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <?php $chapters = module::chapters(); ?>
                                    <?php  $params = http::param("chapter"); ?>
                                    <?php $disabled = f::disabled(http::param("assign")); ?>
                                    <label class=" mb-0 font-14" for="chapter_id"><b>Chapters</b></label>
                                    <select name="chapter_id[]" multiple required class="form-select shadow-none border form-control-lg font-14" id="chapter_id" <?php echo $disabled; ?>>
                                        <?php foreach($chapters as $option): ?>
                                        <?php $selected = f::selected($option["name"], $params, "multiple"); ?>
                                        <option value="<?php echo $option["name"]; ?>" <?php echo $selected; ?>>
                                            <?php echo $option["name"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class=" mb-0 font-14" for="topic_id"><b>Topics</b></label>
                                    <?php $topics = module::topics(); ?>
                                    <?php $disabled = f::disabled(http::param("chapter")); ?>
                                    <select name="topic_id[]" multiple required class="form-select shadow-none border form-control-lg font-14" <?php echo $disabled; ?>>
                                        <?php foreach($topics as $option): ?>
                                        <option value="<?php echo $option["id"]; ?>" >
                                        <?php echo $option["chapter"]; ?> - <?php echo $option["name"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" style="width:200px;"><b>Total time (Mins)</b></span>
                                    <input type="number" name="time" class="form-control shadow-none border form-control-lg font-14">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" style="width:200px;"><b>Total marks</b></span>
                                    <input type="number" name="marks" class="form-control shadow-none border form-control-lg font-14">
                                </div>
                                <div class="form-group mb-3">
                                <label class=" mb-0 font-14" for="topic_id"><b>Quantity</b></label>
                                <?php $categories = module::categories(); ?>
                                <?php foreach($categories as $category): ?>
                                    <?php $name = strtolower(str_replace(" ","_", $category["name"])); ?>
                                    <div class=" mb-3 ">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text" style="width:200px;"><b><?php echo $category["name"];?></b></span>
                                            <input type="number" name="<?php echo $name; ?>" class="form-control shadow-none border form-control-lg font-14">
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="card-footer border-top bg-light text-center">
                                <a href="papers.php" class="btn btn-light font-14 ps-5 pe-5 border"><b>Go back</b></a>
                                <button class="btn btn-primary font-14 ps-5 pe-5" type="submit"><b>Generate</b></button>
                            </div>
                        </form>
                    </div>
                </div>
                <form id="getparams">
                    <input type="hidden" id="assign" name="assign" value="<?php echo http::param("assign");?>">
                    <input type="hidden" id="chapter" name="chapter" value="<?php echo http::param("chapter");?>">
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

    <script>
        $(document).on("change","#assign_id", (e)=>{
            const value = $("#assign_id").val();
            $("#assign").val(value);
            $("#getparams").submit();
        });
        $(document).on("change","#chapter_id", (e)=>{
            const value = $("#chapter_id").val();
            $("#chapter").val(value);
            $("#getparams").submit();
        });
    </script>

</body>

</html>