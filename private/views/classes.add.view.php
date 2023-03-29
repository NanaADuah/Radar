<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>

<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
<?php $this->view("includes/crumbs",['crumbs'=>$crumbs]) ?>
    <div class="card-group justify-content-center">

        <form method="post">
            <h3>Add New Class</h3>
            
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

            <input autofocus class="form-control" name="class" placeholder="Class Name" value="<?=get_var('class')?>" type="text"><br><br>
            <input class="btn btn-primary float-end" type="submit" value="Create">

            <a href="<?= ROOT ?>/classes">
                <input class="btn btn-danger text-white" type="button" value="Cancel">
            </a>
        </form>
    </div>
</div>

<?php $this->view("includes/footer") ?>