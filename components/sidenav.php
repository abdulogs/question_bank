<?php $user = auth::user(); ?>

<aside class="sidebar h-100 bg-light border" id="sidebar">
    <div class="card border-0 h-100">
        <div class="card-header bg-light border-0 p-0">
            <nav class="d-flex align-items-center py-2 px-3">
                <a class="d-inline-block ms-2" href="home.php">
                    <img src="./src/images/logo.png" alt="" height="50" class="d-inline-block">
                </a>
                <div class="d-flex align-items-center ms-auto">
                    <button class="btn font-20 btn-sm shadow-none bx bx-x closesidenav ms-2 d-md-none d-lg-none d-inline"></button>
                </div>
            </nav>
        </div>
        <div class="card-header px-3 border-0 bg-light">
            <div class="dropdown d-grid mt-3">
                <button
                    class="btn btn-sm shadow-none d-flex d-block align-items-center align-content-center justify-content-between text-start"
                    type="button" data-bs-toggle="dropdown">
                    <div class="d-block sidenav-avatar">
                        <img src="<?php echo media::image($user["image"])?>"  class="img-thumbnail rounded-circle avatar-image p-1 d-inline-block" alt="">
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-1">
                            <b><?php echo $user["firstname"]." ".$user["lastname"]; ?></b>
                        </h6>
                        <?php if(session::role("is_role", 0)):?>
                        <span class="badge bg-danger">Admin</span>
                        <?php else: ?>
                        <span class="badge bg-danger">Teacher</span>
                        <?php endif;?>
                    </div>
                    <span class="bx bx-dots-vertical-rounded font-20 ms-auto text-muted"></span>
                </button>
                <ul class="dropdown-menu w-100 shadow border-0">
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center" href="profile.php">
                            <span class="bx bx-user-circle font-20 me-2"></span> My profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center" href="change-password.php">
                            <span class="bx bx-lock font-20 me-2"></span> Change password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center" href="settings.php">
                            <span class="bx bx-cog font-20 me-2"></span> Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center" href="logout.php">
                            <span class="bx bx-log-out font-20 me-2"></span> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body border-0 bg-light h-100 px-3">
            <div class="accordion" id="sidebarmenu">
                <ul class="menu-list">
                    <li class="menu-title">Modules</li>
                    <li class="menu-item <?php f::active_page("home", "active")?>">
                        <a href="home.php" class="menu-link">
                            <i class="bx bx-tv font-20"></i> <span> Dashboard </span>
                        </a>
                    </li>
                    <?php if(f::is_admin()): ?>
                    <!-- Users menu -->
                    <li class="menu-item <?php f::active_page(["u-admins", "u-teachers"], "active")?>">
                        <a href="javascript: void(0);" data-bs-toggle="collapse" data-bs-target="#usersmenu"
                            class="menu-link">
                            <i class="bx bx-user font-20"></i>
                            <span> All users </span>
                            <span class="bx bx-chevron-down font-20"></span>
                        </a>
                        <ul class="nav-second-level sub-menu-list collapse <?php f::active_page(["u-admins", "u-teachers"], "show")?>"
                            id="usersmenu" data-bs-parent="#sidebarmenu" class="menu-link">
                            <li class="sub-menu-item <?php f::active_page("u-admins", "sub-active")?>">
                                <a href="u-admins.php" class="sub-menu-link ">Admins</a>
                            </li>
                            <li class="sub-menu-item <?php f::active_page("u-teachers", "sub-active")?>">
                                <a href="u-teachers.php" class="sub-menu-link">Teachers</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Users menu -->

                    <!-- Management menu -->
                    <li class="menu-item <?php f::active_page(["classes","subjects", "assign-cs"], "active")?>">
                        <a href="javascript: void(0);" data-bs-toggle="collapse" data-bs-target="#managemenu"
                            class="menu-link">
                            <i class="bx bx-edit font-20"></i>
                            <span> Management </span>
                            <span class="bx bx-chevron-down font-20"></span>
                        </a>
                        <ul class="nav-second-level sub-menu-list collapse <?php f::active_page(["classes","subjects", "assign-cs"], "show")?>"
                            id="managemenu" data-bs-parent="#sidebarmenu" class="menu-link">
                            <li class="sub-menu-item <?php f::active_page("classes", "sub-active")?>">
                                <a href="classes.php" class="sub-menu-link ">Classes</a>
                            </li>
                            <li class="sub-menu-item <?php f::active_page("subjects", "sub-active")?>">
                                <a href="subjects.php" class="sub-menu-link ">Subjects</a>
                            </li>
                            <li class="sub-menu-item <?php f::active_page("assign-cs", "sub-active")?>">
                                <a href="assign-cs.php" class="sub-menu-link">Assign</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Management menu -->
                    <?php endif; ?>

                    <!-- Chapters menu -->
                    <li class="menu-item <?php f::active_page(["topics", "chapters"], "active")?>">
                        <a href="javascript: void(0);" data-bs-toggle="collapse" data-bs-target="#syllabusmenu"
                            class="menu-link">
                            <i class="bx bx-menu font-20"></i>
                            <span> Syllabus </span>
                            <span class="bx bx-chevron-down font-20"></span>
                        </a>
                        <ul class="nav-second-level sub-menu-list collapse <?php f::active_page(["topics", "chapters"], "show")?>"
                            id="syllabusmenu" data-bs-parent="#sidebarmenu" class="menu-link">
                            <li class="sub-menu-item <?php f::active_page("chapters", "sub-active")?>">
                                <a href="chapters.php" class="sub-menu-link">Chapters</a>
                            </li>
                            <li class="sub-menu-item <?php f::active_page("topics", "sub-active")?>">
                                <a href="topics.php" class="sub-menu-link ">Topics</a>
                            </li>
                        </ul>
                    </li>
                    <!-- chapters menu -->

                    <!-- Questions bank menu -->
                    <li class="menu-item <?php f::active_page(["categories", "questions"], "active")?>">
                        <a href="javascript: void(0);" data-bs-toggle="collapse" data-bs-target="#questionsbankmenu"
                            class="menu-link">
                            <i class="bx bx-info-circle font-20"></i>
                            <span> Question bank </span>
                            <span class="bx bx-chevron-down font-20"></span>
                        </a>
                        <ul class="nav-second-level sub-menu-list collapse <?php f::active_page(["categories", "questions"], "show")?>"
                            id="questionsbankmenu" data-bs-parent="#sidebarmenu" class="menu-link">
                            <li class="sub-menu-item <?php f::active_page("categories", "sub-active")?>">
                                <a href="categories.php" class="sub-menu-link">Categories</a>
                            </li>
                            <li class="sub-menu-item <?php f::active_page("questions", "sub-active")?>">
                                <a href="questions.php" class="sub-menu-link">Questions</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Questions bank menu -->

                    <!-- Papers menu -->
                    <li class="menu-item <?php f::active_page(["papers", "paper-generate-1","paper-generate-2"], "active")?>">
                        <a href="javascript: void(0);" data-bs-toggle="collapse" data-bs-target="#papersmenu"
                            class="menu-link">
                            <i class="bx bx-file font-20"></i>
                            <span> Papers </span>
                            <span class="bx bx-chevron-down font-20"></span>
                        </a>
                        <ul class="nav-second-level sub-menu-list collapse <?php f::active_page(["papers", "paper-generate-1","paper-generate-2"], "show")?>"
                            id="papersmenu" data-bs-parent="#sidebarmenu" class="menu-link">
                            <li class="sub-menu-item <?php f::active_page(["paper-generate-1","paper-generate-2"], "sub-active")?>">
                                <a href="paper-generate-1.php" class="sub-menu-link">Generate</a>
                            </li>
                            <li class="sub-menu-item <?php f::active_page("papers", "sub-active")?>">
                                <a href="papers.php" class="sub-menu-link">Generated papers</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Papers menu -->
                </ul>
            </div>
        </div>
    </div>
</aside>