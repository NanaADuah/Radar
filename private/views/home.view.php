<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>


<style>
    h1 {
        color: green;
        font-size: 80px;
    }

    .card-header {
        font-weight: bold;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .card {
        min-width: 200px;
    }
</style>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 850px;">
    <div class="row">

        <?php if(Auth::access('super_admin')):?>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">SCHOOLS</div>
            <a href="<?= ROOT ?>/schools">
                <h1 class="text-center">
                    <i class="fa fa-graduation-cap"></i>
                </h1>
                <div class="card-footer">View all schools</div>
            </a>
        </div>
        <?php endif;?>
        <?php if(Auth::access('admin')):?>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">STAFF</div>
            <a href="<?= ROOT ?>/users">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-chalkboard-teacher"></i>
                </h1>
                <div class="card-footer">View all staff members</div>
            </a>
        </div>
        <?php endif;?>
        <?php if(Auth::access('admin')):?>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">STUDENTS</div>
            <a href="<?= ROOT ?>/students">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-user-graduate"></i>
                </h1>
                <div class="card-footer">View all students</div>
            </a>
        </div>
        <?php endif; ?>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">CLASSES</div>
            <a href="<?= ROOT ?>/classes">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-university"></i>
                </h1>
                <div class="card-footer">View classes</div>
            </a>
        </div>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">TESTS</div>
            <a href="<?= ROOT ?>/tests">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-file-signature"></i>
                </h1>
                <div class="card-footer">View tests</div>
            </a>
        </div>
        <?php if(Auth::access('admin')):?>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">STATISTICS</div>
            <a href="<?= ROOT ?>/statistics">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-chart-pie"></i>
                </h1>
                <div class="card-footer">View student staticstics</div>
            </a>
        </div>
        <?php endif;?>
        <?php if(Auth::access('admin')):?>

        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">SETTINGS</div>
            <a href="<?= ROOT ?>/settings">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-cogs"></i>
                </h1>
                <div class="card-footer">View settings</div>
            </a>
        </div>
        <?php endif;?>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">PROFILE</div>
            <a href="<?= ROOT ?>/profile">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-id-card"></i>
                </h1>
                <div class="card-footer">View user profile</div>
            </a>
        </div>
        <div class="card col-3  border shadow rounded m-4 p-0">
            <div class="card-header">LOGOUT</div>
            <a href="<?= ROOT ?>/logout">
                <h1 class="text-center" style="font-size: 80px;">
                    <i class="fa fa-sign-out-alt"></i>
                </h1>
                <div class="card-footer">Log user out</div>
            </a>
        </div>
    </div>
</div>

<?php $this->view("includes/footer") ?>