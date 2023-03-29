<form method="post" class="form mx-auto" style="width: 100%;max-width:400px">
    <br>
    <h4>Add Lecturer</h4>
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
    <input autofocus class="form-control" type="text" name="name" placeholder="Lecturer Name" value="<?= get_var('name') ?>">
    <br>
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">
        <button class="btn btn-danger" type="button">Cancel</button>
    </a>
    <button class="btn btn-primary float-end" name="search">Search</button>
    <div class="clearfix"></div>
</form>

<form method="post">
    <div class="card-group">
        <?php if (isset($results) && $results) : ?>
            <br>
            <?php foreach ($results as $row) : ?>
                <?php include(views_path('user')) ?>
            <?php endforeach; ?>
        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>
                <center>
                    <hr>
                    <h4>No results were found</h4>
                </center>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <br>
</form>