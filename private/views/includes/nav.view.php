<style>
    nav ul li a {
        width: 110px;
        text-align: center;
        border-left: solid thin #eee;
        border-right: solid thin #fff;
    }

    nav ul li a:hover {
        background-color: grey;
        color: white !important;
    }
</style>
<?php
$row = $_SESSION['USER'];
$image = get_image($row->image, $row->gender);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light p-2 shadow">
    <a class="navbar-brand" href="#">
        <img src="<?= ROOT ?>/assets/Logo.png" class="" style="width:40px;">
        <!-- Radar -->
        <?= Auth::getSchool_name() ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style='font-weight:bold;' id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?=ROOT?>">DASHBOARD</a>
            </li>
            <?php if(Auth::access('super_admin')):?>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/schools">SCHOOLS</a>
            </li>
            <?php endif?>
            <?php if(Auth::access('admin')):?>

            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/users">STAFF</a>
            </li>
            <?php endif;?>
            <li class="nav-item ">
            <?php if(Auth::access('reception')):?>

                <a class="nav-link" href="<?= ROOT ?>/students">STUDENTS</a>
            </li>
            <?php endif ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/classes">CLASSES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/tests">TESTS</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle badge" style="cursor:pointer;padding-right:5px;"  id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="">
                <img class="card-img-top rounded-circle" src="<?= $image ?>" alt="card image cap" style="width:40px"> <?= Auth::getfirstname() ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?= ROOT ?>/profile">Profile</a>
                    <a class="dropdown-item" href="<?= ROOT ?>">Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= ROOT ?>/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>