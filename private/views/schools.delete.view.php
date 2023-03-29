<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>

<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
<?php $this->view("includes/crumbs",['crumbs'=>$crumbs]) ?>

    <div class="card-group justify-content-center">
        <?php if ($row) : ?>
            <form method="post">
                <h3>Are you sure you want to delete? </h3>
                <input autofocus disabled class="form-control" name="school" placeholder="School Name" value="<?= get_var('school', $row[0]->school) ?>" type="text"><br><br>
                <input type="hidden" name="id">
                <input class="btn btn-danger float-end" type="submit" value="Delete">

                <a href="<?= ROOT ?>/schools">
                    <input class="btn btn-success text-white" type="button" value="Cancel">
                </a>
            </form>
        <?php else : ?>
            <div style="text-align: center;">
                <h3>That school was not found</h3>
                <div class="clearfix"></div>
                <br>
                <a href="<?= ROOT ?>/schools">
                    <input type="button" class="btn btn-danger" value="Cancel">
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->view("includes/footer") ?>