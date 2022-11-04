<?php include 'includes/header.php';
    include_once "includes/crud.php";
    include_once "includes/user.php";

    if (!isset($_SESSION['login'])) {
        header('location:login.php');
    }

    $crud = new crud();

    if (isset($_GET['logout'])) {

        $user = new user();        
        $user->logOut();
        header('location:login.php');
    }
?>
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler --> <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> </a> <!-- User menu (mobile) -->
            <div class="navbar-user d-lg-none">
                <!-- Dropdown -->
                <div class="dropdown">
                    <!-- Toggle --> <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a> <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar"> <a href="#" class="dropdown-item">Profile</a> <a href="#" class="dropdown-item">Settings</a> <a href="#" class="dropdown-item">Billing</a>
                        <hr class="dropdown-divider"> <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div> <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" href="?source=movies"> <i class="bi bi-house"></i> Movies </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="?source=categories"> <i class="bi bi-bookmarks"></i> Categories </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="?source=users"> <i class="bi bi-people"></i> Users </a> </li>
                </ul> <!-- Divider -->

                <div class="mt-auto"></div> <!-- User (md) -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" href="#"> <i class="bi bi-person-square"></i> <?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : "no one") ?> </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?logout"> <i class="bi bi-box-arrow-left"></i> Logout </a> </li>
                </ul>
            </div>
        </div>
    </nav> <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                            <!-- Title -->
                            <h1 class="h2 mb-3 ls-tight">Admin dashboard</h1>
                        </div> <!-- Actions -->
                        <div class="col-sm-6 col-12 text-sm-end">
                            <div class="mx-n1">
                                <a href="movies/addMovie.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2"> <i class="bi bi-plus"></i> </span> <span>add movie</span>
                                    <a href="categories/addCategory.php" class="btn d-inline-flex btn-sm btn-success mx-1"> <span class=" pe-2"> <i class="bi bi-plus"></i>
                                        </span> <span>add category</span> </a>
                            </div>
                        </div>
                    </div> <!-- Nav -->
                </div>
            </div>
        </header> <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container-fluid">
                <!-- Card stats -->
                <div class="row g-6 mb-6">
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"> <span class="h6 font-semibold text-muted text-sm d-block mb-2">Movies</span> <span class="h3 font-bold mb-0"><?php echo $crud->count_rows('movies') ?></span> </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle"> <i class="bi bi-film"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"> <span class="h6 font-semibold text-muted text-sm d-block mb-2">Categories</span> <span class="h3 font-bold mb-0"><?php echo $crud->count_rows('categories') ?></span> </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle"> <i class="bi bi-bookmark-heart"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"> <span class="h6 font-semibold text-muted text-sm d-block mb-2">Users</span> <span class="h3 font-bold mb-0"><?php echo $crud->count_rows('users') ?></span> </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle"> <i class="bi bi-people"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                if (isset($_GET['source'])) {

                    $source = $_GET['source'];
                } else {
                    $source = "";
                }

                switch ($source) {
                    case 'movies':
                        include "listMovies.php";
                        break;

                    case 'categories':
                        include "listCategories.php";
                        break;

                    case 'users':
                        include "listUsers.php";
                        break;

                    default:
                        include "listMovies.php";
                        break;
                }
                ?>
            </div>
        </main>
    </div>
</div>
<?php include 'includes/footer.php' ?>