<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>

<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
    <?php $this->view("includes/crumbs", ['crumbs' => $crumbs]) ?>
    <?php if ($row) : ?>
        <?php
        $image = get_image($row->image, $row->gender);
        ?>
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <img src="<?= $image ?>" class="border border-primary d-block mx-auto rounded-circle" style="width:150px">
                <h3 class="text-center"><?= esc($row->firstname) ?> <?= esc($row->lastname) ?></h3>
                <?php if(Auth::access('admin') || (Auth::access('reception') && ($row->rank == "student"))): ?>
                <br>
                <div class=text-center>
                <a href="<?=ROOT?>/profile/edit/<?=$row->user_id?>">
                <button class="btn btn-sm btn-success text-white">Edit</button>
                </a>
                <a href="<?=ROOT?>/profile/delete/<?=$row->user_id?>">
                <button class="btn btn-sm btn-danger">Delete</button>
                </a>
                </div>
                <?php endif;?>
            </div>
            <div class="col-sm-8 col-md-9 bg-light p-2">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>First Name: </th>
                        <td><?= esc($row->firstname) ?></td>
                    </tr>
                    <tr>
                        <th>Last Name: </th>
                        <td><?= esc($row->lastname) ?></td>
                    </tr>
                    <tr>
                        <th>Email address: </th>
                        <td><?= esc($row->email) ?></td>
                    </tr>
                    <tr>
                        <th>Gender: </th>
                        <td><?= esc(ucfirst($row->gender)) ?></td>
                    </tr>
                    <tr>
                        <th>Rank: </th>
                        <td><?= ucwords(str_replace("_", " ", $row->rank)) ?></td>
                    </tr>
                    <tr>
                        <th>Date Created: </th>
                        <td><?= get_date($row->date) ?></td>
                    </tr>

                </table>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'info' ? 'active' : ''; ?> " href="<?= ROOT ?>/profile/<?= $row->user_id ?>">Basic Information</a>
                </li>
                <?php if (Auth::access('lecturer') || Auth::owned_content($row)) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'classes' ? 'active' : ''; ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>?tab=classes">My Classes</a>
                </li>
                <?php endif;?>

                <?php if (Auth::access('lecturer') || Auth::owned_content($row)) : ?>

                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'tests' ? 'active' : ''; ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>?tab=tests">Tests</a>
                </li>
                <?php endif; ?>
            </ul>

            <?php

            switch ($page_tab) {
                case 'classes':
                    if (Auth::access('lecturer') || Auth::owned_content($row)) {
                        include(views_path('profile-tab-classes'));
                    } else {
                        include(views_path("access-denied"));
                    }
                    break;

                case 'tests':
                    include(views_path('profile-tab-tests'));
                    break;

                case 'info':
                    include(views_path('profile-tab-info'));
                    break;
            }

            ?>

        </div>
    <?php else : ?>
        <center>
            <h4>User profile not found</h4>
        </center>
    <?php endif; ?>
</div>

<?php $this->view("includes/footer") ?>