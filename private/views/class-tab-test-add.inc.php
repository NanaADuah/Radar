<div>
    <form method="post" class="form mx-auto" style="width: 100%;max-width:400px">
        <br>
        <h4>Add A Test</h4>
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
        <input autofocus class="form-control" type="text" name="test" placeholder="Test Title" value="<?= get_var('test') ?>"><br>
        <textarea placeholder="Add a description for this test" name="description" class="form-control"><?=get_var('description')?></textarea><br>
        <input type="submit" value="Create" class="btn btn-primary float-end">

        <a href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">
            <input class="btn btn-danger" type="button" value="Cancel">
        </a>
    </form>
</div>