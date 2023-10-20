<!-- App -->
<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("papers/generate"); ?>

<!-- Settings -->
<?php $settings = module::settings(); ?>
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
                <li class="breadcrumb-item"><a href="home.php" class="text-decoration-none text-dark">Home</a></li>
                <li class="breadcrumb-item text-dark">Papers</li>
                <li class="breadcrumb-item active">Generate</li>
                <li class="breadcrumb-item active">Step 2</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        <!-- Content -->

        <?php module::create();  ?>

        <?php $cs = module::class_subject();  ?>
        <section class="overflow-auto bg-light">
            <div class="container-fluid">
                <div class="row mt-5 mb-5">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <form class="card mb-5 shadow" method="POST">
                            <input type="hidden" name="assign_id" value="<?php echo http::param("assign_id"); ?>">
                            <input type="hidden" name="chapter_id" value="<?php echo http::param("chapter_id"); ?>">
                            <input type="hidden" name="total_marks" value="<?php echo http::param("marks"); ?>">
                            <input type="hidden" name="total_time" value="<?php echo http::param("time"); ?>">
                            <div style="padding:10px 20px;background:white;">           
                                <table style="font-size:14px;font-family:arial;width:100%;">    
                                    <tr>
                                        <td style="padding:20px;text-align:center;" colspan="8">
                                            <h2 style="font-size:30px;margin:5px 0;"><b><?php echo $settings["name"]; ?></b></h2>
                                            <p style="font-size:18px;margin:0;"><?php echo $settings["tagline"]; ?></p>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td style="padding:5px;width:100px;"><b>Total Marks:</b></td>
                                        <td style="width:80px;padding:5px;">
                                            <span style="border-bottom:1px solid #000;display:block;">
                                                <?php echo http::param("marks");?>
                                            </span>
                                        </td>
                                        <td style="padding:5px;"><b>Total time:</b></td>
                                        <td style="width:150px;padding:5px;">
                                            <span style="border-bottom:1px solid #000;display:block;">
                                                <?php echo http::param("time");?> mins
                                            </span>
                                        </td>
                                        <td style="padding:5px;"><b>Class:</b></td>
                                         <td style="width:150px;padding:5px;">
                                            <span style="border-bottom:1px solid #000;display:block;">
                                                <?php echo $cs["class"];?>
                                            </span>
                                        </td>
                                        <td style="padding:5px;"><b>Subject:</b></td>
                                         <td style="width:150px;padding:5px;">
                                            <span style="border-bottom:1px solid #000;display:block;">
                                                <?php echo $cs["subject"];?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php $categories = module::categories(); ?>
                            <div style="padding:0px 20px;background:white;">
                                <ol style="padding:20px;">
                                    <?php foreach($categories as $category): ?>
                                    <?php $limit = $_GET[strtolower(str_replace(" ","_", $category["name"]))];?>
                                    <?php $questions = module::questions($category["id"], $limit); ?>
                                    <input type="hidden" name="categories[]" value="<?php echo $category["id"]; ?>">
                                    <li style="padding:10px 0;">
                                        <b style="font-size:14px;"><?php echo $category["statement"]?>.</b>
                                        <ol type="I" style="font-size:14px;font-family:arial;">
                                            <?php foreach($questions as $question): ?>
                                                <input type="hidden" name="questions[]" value="<?php echo $question["id"]; ?>">
                                                <li style="padding:10px 0;">
                                                    <div style="display:flex;align-items:center;align-content:center;justify-content:space-between;">
                                                        <b><?php echo $question["statement"]; ?></b>
                                                        <b style="font-size:12px;padding-left:20px;">
                                                            [<?php echo $question["marks"]; ?> 
                                                            <?php echo f::is_plural($question["marks"],"Mark") ?>, 
                                                            <?php echo $question["estimated_time"]; ?>
                                                            <?php echo f::is_plural($question["estimated_time"],"Min") ?>]
                                                        </b>
                                                    </div>
                                                    <?php if($question["image"]): ?>
                                                    <p style="margin:0px;padding:10px;">
                                                        <img src="<?php echo $question["image"]; ?>" width="100">
                                                    </p>
                                                    <?php endif; ?>
                                                    <ol style="display:flex;flex-wrap:wrap;margin-top:10px;" type="a">
                                                        <?php if($question["is_options"] == 1): ?>
                                                            <li style="width:50%;"><?php echo $question["opt1"]; ?></;>
                                                            <li style="width:50%;"><?php echo $question["opt2"]; ?></;>
                                                            <li style="width:50%;"><?php echo $question["opt3"]; ?></;>
                                                            <li style="width:50%;"><?php echo $question["opt4"]; ?></;>
                                                        <?php endif;?>
                                                    </ol>
                                                </li>
                                            <?php endforeach;?>
                                        </ol>
                                    </li>
                                    <?php endforeach;?>   
                                </ol>        
                            </div>
                            
                            <div class="card-footer border-top bg-light text-center">
                                <a href="paper-generate-1.php" class="btn btn-light font-14 ps-5 pe-5 border">
                                    <b>Go back</b>
                                </a>
                                <a href="paper-generate-2.php?<?php echo $_SERVER['QUERY_STRING'];?>" class="btn btn-dark font-14 ps-5 pe-5">
                                    <b>Regenerate</b>
                                </a>
                                <button class="btn btn-primary font-14 ps-5 pe-5" name="action" value="create" type="submit">
                                    <b>Create</b>
                                </button>
                            </div>
                        </form>
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