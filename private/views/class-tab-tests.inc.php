<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-grou-text" id="basic-addon1"><i class="fa fa-search"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
        </div>
    </form>
    <?php if(Auth::access('lecturer')):?>
    <a href="<?=ROOT?>/single_class/testadd/<?=$row->class_id?>?tab=test-add">
        <button class="btn btn-sm btn-primary badge"><i class="fa fa-plus"></i>Add Test</button>
    </a>
    <?php endif; ?>
</nav>

<table class="table table-striped table-hover">
    <tr>
        <th></th>
        <th>Test Name</th>
        <th>Created By</th>
        <th>Active</th>
        <th>Date</th>
        <th>Written</th> 
        <th></th>
    </tr>

    <?php if (isset($tests) && $tests) : ?>
        <?php foreach ($tests as $row) : ?>
            <tr>
                <td><?php if(Auth::access('lecturer')):?>
                    <a href="<?=ROOT?>/single_test/<?=$row->test_id?>">
                        <button class="btn btn-sm btn-primary p-1 pe-0"><i class="fa fa-chevron-right"></i></button>
                    </a>
                    <?php endif;?>
                </td>
                <?php $active = $row->disabled?"No":"Yes";?>
                <td><?= $row->test?></td>
                <td><?= $row->user->firstname ?> <?=$row->user->lastname ?></td>
                <td><?= $active ?></td>
                <td><?= get_date($row->date) ?></td>
                <td><?= $taken = has_taken_test($row->test_id) ?></td>
                <td>
                    <?php if (Auth::access('lecturer')) : ?>
                        <a href="<?=ROOT?>/single_class/testedit/<?= $row->class_id ?>/<?=$row->test_id?>?tab=tests">
                            <button class="btn btn-sm btn-info text-white p-1 pe-0"><i class="fa fa-edit"></i></button>
                        </a>
                        <a href="<?=ROOT?>/single_class/testdelete/<?= $row->class_id ?>/<?=$row->test_id?>?tab=tests">
                            <button class="btn btn-sm btn-danger p-1 pe-0"><i class="fa fa-trash-alt"></i></button>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>
    <?php else : ?>
        <tr><td colspan="7"><center>No tests were found</center></td></tr>
    <?php endif; ?>
</table>
