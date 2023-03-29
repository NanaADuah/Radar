<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>

<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
    <?php $this->view("includes/crumbs", ['crumbs' => $crumbs]) ?>

    <center>
        <h4>Edit Profile</h4>
    </center>
    <?php if ($row) : ?>
        <?php
        $image = get_image($row->image, $row->gender);
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <img src="<?= $image ?>" class="border border d-block mx-auto " style="width:150px">
                    <?php if (Auth::access('reception') && Auth::owned_content($row)) : ?>
                        <br>
                        <div class=text-center>
                            <label for="img_browser" class="btn btn-sm btn-success text-white">
                                <input onchange="display_image_name(this.files[0].name)" id="img_browser" type="file" name="image" style="display: none;">
                                Browse Image
                            </label>
                            <br>
                            <small class="text-muted file_info "></small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-8 col-md-9 bg-light p-2">

                    <div class="p-4 mr-4 mx-auto shadow rounded">
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
                        <input class="my-2 form-control" value="<?= get_var('firstname', $row->firstname) ?>" type="firstname" name="firstname" placeholder="First Name">
                        <input class="my-2 form-control" value="<?= get_var('lastname', $row->lastname) ?>" type="lastname" name="lastname" placeholder="Last Name">
                        <input class="my-2 form-control" value="<?= get_var('email', $row->email) ?>" type="email" name="email" placeholder="Email">
                        <select class="my-2 form-control" name="gender">
                            <option <?= get_select('gender', $row->gender) ?> value="<?= $row->gender ?>"><?= ucwords($row->gender) ?></option>
                            <option value="male" <?= get_select('gender', 'male') ?>>Male</option>
                            <option value="female" <?= get_select('gender', 'female') ?>>Female</option>
                        </select>

                        <select class="my-2 form-control" name="rank">
                            <option value="<?= $row->rank ?>" <?= get_select('rank', $row->rank) ?>><?= ucwords($row->rank) ?></option>
                            <option value="student" <?= get_select('rank', 'student') ?>>Student</option>
                            <option value="reception" <?= get_select('rank', 'reception') ?>>Reception</option>
                            <option value="lecturer" <?= get_select('rank', 'lecturer') ?>>Lecturer</option>
                            <option value="admin" <?= get_select('rank', 'admin') ?>>Admin</option>
                            <?php if (Auth::getRank() == "super_admin") : ?>
                                <option value="super_admin" <?= get_select('rank', 'super_admin') ?>>Super Admin</option>
                            <?php endif; ?>
                        </select>
                        <input class="my-2 form-control" type="text" value="<?= get_var('password') ?>" name="password" placeholder="Password">
                        <input class="my-2 form-control" type="text" value="<?= get_var('password2') ?>" name="password2" placeholder="Retype password">
                        <div>
                            <button class="btn btn-primary float-end">Save changes</button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </form>
        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>">
            <button class="btn btn-sm btn-danger text-white">Back to profile</button>
        </a>
        <div>
        <?php else : ?>
            <br>
            <center>
                <h4>User profile not found</h4>
            </center>
        <?php endif; ?>
        </div>

        <script>
            function display_image_name(filename) {
                var file_info = document.querySelector(".file_info").innerHTML = "<b>Selected file: </b><br>" + filename;
            }
        </script>

        <?php $this->view("includes/footer") ?>