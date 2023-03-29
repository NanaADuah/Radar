<?php if (isset($test_row) && is_object($test_row)) : ?>
<div>
    <form method="post" class="form mx-auto" style="width: 100%;max-width:400px">
        <br>
        <h3 class="text-center">Delete A Test</h3>
        <hr>
        <h5>Are you sure you want to delete this test permanently? </h5>  
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
        <?php

            $disabled = get_var('disabled',$test_row->disabled);
            $active_checked = $disabled ? "": "Checked";
            $inactive_checked = $disabled ? "Checked" : "";    
        ?>

        <input autofocus class="form-control" type="text" name="test" placeholder="Test Title" value="<?= get_var('test', $test_row->test)?>"><br>
        <textarea placeholder="Add a description for this test" name="description" class="form-control"><?=get_var('description', $test_row->description)?></textarea>
        <br><input type="radio" name="disabled" value="1" <?=$active_checked?>> Active |
        <input type="radio" name="disabled" value="0"  <?=$inactive_checked?>> Inactive <br><br>
        <input type="submit" value="Delete" class="btn btn-danger float-end">

        <a href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">
            <input class="btn btn-success" type="button" value="Back">
        </a>
    </form>
</div>
    <?php else:?>
        <div class="text-center justify-content-center">
        <br>
            Test not found<br><br>
        </div>
        <a href="<?=ROOT?>/single_class/<?=$row->class_id?>?tab=tests">
            <input class="btn btn-success" type="button" value="Back">
        </a>       
<?php endif;?>