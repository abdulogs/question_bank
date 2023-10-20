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
    <title>Question update - Dashboard</title>
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
                <li class="breadcrumb-item text-dark">Question bank</li>
                <li class="breadcrumb-item">
                    <a href="questions.php" class="text-decoration-none text-dark">Question</a>
                </li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </nav>
        <!-- Breadcrumb -->
        
        <!-- Content -->
        <?php module::update(); ?>
        <?php $data = module::single(); ?>
        <section class="overflow-auto h-100 bg-light container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form class="card shadow mt-5 mb-5" method="post">
                        <div class="card-header border-bottom bg-white py-3">
                            <h5 class="card-title m-0 d-flex align-items-center font-20">
                                <span class="bx bx-plus-circle me-2 text-primary "></span><b>Update</b>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group mb-3 col-sm-6">
                                    <label class=" mb-0 font-14" for="category_id"><b>Question type</b></label>
                                    <?php $categories = module::categories(); ?>
                                    <select name="category_id" required class="form-select shadow-none border form-control-lg font-14">
                                        <?php foreach($categories as $option): ?>
                                        <?php $selected = f::selected($option["id"], $data["category_id"]); ?>
                                        <option value="<?php echo $option["id"]; ?>" <?php echo $selected; ?>> 
                                            <?php echo $option["name"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <label class=" mb-0 font-14" for="assign_id"><b>Class or subject</b></label>
                                    <?php $assign_cs = module::assign_cs(); ?>
                                    <?php $assign = http::param("assign"); ?>
                                    <select name="assign_id" required class="form-select shadow-none border form-control-lg font-14" id="assign_id">
                                        <option value="" >Select</option>
                                        <?php foreach($assign_cs as $option): ?>
                                        <?php $selected = f::selected($option["id"], $data["assign_id"]); ?>
                                        <option value="<?php echo $option["id"]; ?>" <?php echo $selected; ?>>
                                            <?php echo $option["class"]; ?> - <?php echo $option["subject"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <label class=" mb-0 font-14" for="chapter_id"><b>Chapter no</b></label>
                                    <?php $chapters = module::chapters(); ?>
                                    <?php $chapter = http::param("chapter"); ?>
                                    <select name="chapter_id" required class="form-select shadow-none border form-control-lg font-14" id="chapter_id" <?php echo $disabled; ?>>
                                        <option value="" >Select</option>
                                        <?php foreach($chapters as $option): ?>
                                        <?php $selected = f::selected($option["id"], $data["chapter_id"]); ?>
                                        <option value="<?php echo $option["id"]; ?>" <?php echo $selected; ?>>
                                            <?php echo $option["name"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <label class=" mb-0 font-14" for="topic_id"><b>Topic name</b></label>
                                    <?php $topics = module::topics(); ?>
                                    <select name="topic_id" required class="form-select shadow-none border form-control-lg font-14" <?php echo $disabled; ?>>
                                    <option value="" >Select</option>
                                        <?php foreach($topics as $option): ?>
                                        <?php $selected = f::selected($option["id"], $data["chapter_id"]); ?>
                                        <option value="<?php echo $option["id"]; ?>" <?php echo $selected; ?>>
                                            <?php echo $option["name"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3  col-sm-6">
                                    <label class=" mb-0 font-14" for="marks"><b>Marks</b></label>
                                    <input class="form-control form-control-lg shadow-none border font-14" value="<?php echo $data["marks"]; ?>"  name="marks"/>
                                </div>
                                <div class="form-group mb-3  col-sm-6">
                                    <label class=" mb-0 font-14" for="estimated_time"> <b>Estimated time</b></label>
                                    <input name="estimated_time" value="<?php echo $data["estimated_time"]; ?>" class="form-control form-control-lg shadow-none border font-14"/>
                                </div>
                                <div class="form-group mb-3  col-sm-12">
                                    <label class=" mb-0 font-14" for="statement"><b>Statement</b></label>
                                    <textarea class="form-control form-control-lg shadow-none border font-14" name="statement"><?php echo $data["statement"]; ?></textarea>
                                </div>
                                <div class="form-group mb-3  col-sm-12">
                                    <label class=" mb-0 font-14" for="answer"><b>Answer</b></label>
                                    <textarea class="form-control form-control-lg shadow-none border font-14" name="answer"><?php echo $data["answer"]; ?></textarea>
                                </div>
                                <div class="form-group mb-3  col-sm-12">
                                    <label class=" mb-0 font-14" for="image"> <b>Image url (For labeling)</b></label>
                                    <input name="image" class="form-control form-control-lg shadow-none border font-14" value="<?php echo $data["image"]; ?>"/>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-2">
                                        <label class=" mb-0 font-14" for="options"><b>Options</b></label>
                                        <select name="is_options" id="options" required class="form-select shadow-none border form-control-lg font-14">
                                            <?php f::is_active($data["is_options"], "option"); ?>
                                        </select>
                                    </div>
                                    <?php $display = ($data["is_options"] == 1) ? "" : "display:none;" ; ?>
                                    <table class="table table-sm" id="opttable" style="<?php echo $display; ?>">
                                        <tr>
                                            <td class="border-0">
                                                <div class="form-group">
                                                    <label class=" mb-0 font-14" for="opt1"><b>Option 1</b></label>
                                                    <input class="form-control form-control-lg shadow-none border font-14" name="opt1" id="opt1" value="<?php echo $data["opt1"]; ?>" />
                                                </div>
                                            </td>
                                            <td class="border-0">
                                                <div class="form-group">
                                                    <label class=" mb-0 font-14" for="opt2"><b>Option 2</b></label>
                                                    <input class="form-control form-control-lg shadow-none border font-14" name="opt2" id="opt2" value="<?php echo $data["opt2"]; ?>" />
                                                </div>
                                            </td>
                                            <td class="border-0">
                                                <div class="form-group">
                                                    <label class=" mb-0 font-14" for="opt3"><b>Option 3</b></label>
                                                    <input class="form-control form-control-lg shadow-none border font-14" name="opt3" id="opt3" value="<?php echo $data["opt3"]; ?>" />
                                                </div>
                                            </td>
                                            <td class="border-0">
                                                <div class="form-group">
                                                    <label class=" mb-0 font-14" for="opt4"><b>Option 4</b></label>
                                                    <input class="form-control form-control-lg shadow-none border font-14" name="opt4" id="opt4" value="<?php echo $data["opt4"]; ?>" />
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <label class=" mb-0 font-14" for="teacher_id"><b>Teacher</b></label>
                                    <?php $teachers = module::teachers(); ?>
                                    <select name="teacher_id" required class="form-select shadow-none border form-control-lg font-14">
                                        <?php foreach($teachers as $option): ?>
                                        <?php $selected = f::selected($option["id"], $data["created_by"]); ?>
                                        <option value="<?php echo $option["id"]; ?>">
                                            <?php echo $option["firstname"]; ?> <?php echo $option["lastname"]; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <label class=" mb-0 font-14" for="is_active"><b>Active</b></label>
                                    <select name="is_active" required class="form-select shadow-none border form-control-lg font-14">
                                        <?php f::is_active($data["is_active"], "option"); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top bg-light text-center">
                            <a href="questions.php" class="btn btn-light font-14 ps-5 pe-5 border"><b>Go back</b></a>
                            <button class="btn btn-primary font-14 ps-5 pe-5" name="action" value="update" type="submit"><b>Update</b></button>
                        </div>
                    </form>
                    <form id="getparams">
                        <input type="hidden" id="assign" name="assign" value="<?php echo http::param("assign");?>">
                        <input type="hidden" id="chapter" name="chapter" value="<?php echo http::param("chapter");?>">
                    </form>
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

    $(document).on("change","#options", (e)=>{
        const value = $("#options").val();
        if(value == 1 ){
            $("#opttable").show();
            $("#opt1").prop("required", true);
            $("#opt2").prop("required", true);
            $("#opt3").prop("required", true);
            $("#opt4").prop("required", true);
        } else if(value == 0){
            $("#opttable").hide();
            $("#opt1").prop("required", false);
            $("#opt2").prop("required", false);
            $("#opt3").prop("required", false);
            $("#opt4").prop("required", false);
        }
    });
</script>


</body>

</html>