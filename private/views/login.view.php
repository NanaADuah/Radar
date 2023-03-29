<?php $this->view("includes/header") ?>

<div class="container-fluid">
    <form method="post">
        <div class="p-4 mr-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width: 340px;">
            <h2 class="text-center">Radar</h2>
            <img src="<?= ROOT ?>/assets/Logo.png" class="border p-2 d-block mx-auto rounded" style="width:70px;">
            <h3>Login</h3>
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
            <input class="form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email" autofocus>
            <br>
            <input class="form-control" value="<?= get_var('password') ?>" type="password" name="password" placeholder="Password">
            <br>
            <button class="btn btn-primary">Login</button>
        </div>
    </form>
</div>

<?php $this->view("includes/footer") ?>