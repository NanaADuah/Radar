<?php $this->view("includes/header") ?>

<div class="container-fluid">
    <form method="post">
        <div class="p-4 mr-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width: 340px;">
            <h2 class="text-center">Radar</h2>
            <img src="<?= ROOT ?>/assets/Logo.png" class="border p-2 d-block mx-auto rounded" style="width:70px;">
            <h3>Add User</h3>
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning p-1 alert-dismissable false show" role="alert">
                    <strong>Errors: </strong>
                    <?php foreach ($errors as $error) : ?>
                        <br> <?= $error ?>
                    <?php endforeach; ?>
                    <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
            <?php endif; ?>

            <input class="my-2 form-control" value="<?= get_var('firstname') ?>" type="firstname" name="firstname" placeholder="First Name">
            <input class="my-2 form-control" value="<?= get_var('lastname') ?>" type="lastname" name="lastname" placeholder="Last Name">
            <input class="my-2 form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email">
            <select class="my-2 form-control" name="gender">
                <option value="" <?= get_select('gender', '') ?>>--Select a Gender--</option>
                <option value="male" <?= get_select('gender', 'male') ?>>Male</option>
                <option value="female" <?= get_select('gender', 'female') ?>>Female</option>
            </select>
            <?php if ($mode == 'students') : ?>
                <input type="hidden" value="student" name="rank">
            <?php else : ?>
                <select class="my-2 form-control" name="rank">
                    <option value="" <?= get_select('rank', '') ?>>--Select a Rank--</option>
                    <option value="student" <?= get_select('rank', 'student') ?>>Student</option>
                    <option value="reception" <?= get_select('rank', 'reception') ?>>Reception</option>
                    <option value="lecturer" <?= get_select('rank', 'lecturer') ?>>Lecturer</option>
                    <option value="admin" <?= get_select('rank', 'admin') ?>>Admin</option>
                    <?php if (Auth::getRank() == "super_admin") : ?>
                        <option value="super_admin" <?= get_select('rank', 'super_admin') ?>>Super Admin</option>
                    <?php endif; ?>
                </select>
            <?php endif; ?>
            <input class="my-2 form-control" type="text" value="<?= get_var('password') ?>" name="password" placeholder="Password">
            <input class="my-2 form-control" type="text" value="<?= get_var('password2') ?>" name="password2" placeholder="Retype password">
            <br>
            <button class="btn btn-primary float-end ">Add User</button>
            <?php if ($mode == 'students') : ?>
                <a href="<?= ROOT ?>/students">
                    <button type="button" class="btn btn-danger float text-white">Cancel</button>
                </a>
                <?php else : ?>
                    <a href="<?= ROOT ?>/users">
                        <button type="button" class="btn btn-danger float text-white">Cancel</button>

                    <?php endif; ?>
                    </a>
        </div>
    </form>

</div>

<?php $this->view("includes/footer") ?>