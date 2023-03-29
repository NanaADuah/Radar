<div class="card-group justify-content-center">
    <br>
    <br>
    <?php // show($test_rows);?>
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Test Name</th>
            <th>Created By</th>
            <th>Active</th>
            <th>Date</th>
            <th></th>
        </tr>
        <?php if (isset($test_rows) && $test_rows) : ?>
            <?php foreach ($test_rows as $test_row) : ?>
                <?php if(!empty($test_row)):?>
                    <tr>
                        <td>
                        <?php if(Auth::access('lecturer') || Auth::access('super_admin')):?>
                            <a href="<?= ROOT ?>/single_test/<?=$test_row->test_id ?>">
                                <button class="btn btn-sm btn-primary badge p-1 pe-0"><i class="fa fa-chevron-right"></i></button>
                            </a>
                            <?php endif;?>
                        </td>
                        <?php $active = $test_row->disabled ? "No":"Yes";
                        ?>
                        <td><?=$test_row->test?></td>
                        <td><?=$test_row->user->user->firstname?> <?=$test_row->user->user->lastname?></td>
                        <td><?=$active?></td>
                        <td><?= get_date($test_row->date) ?></td>
                        <td>
                        <?php if(can_take_test($test_row->test_id)):?>
                            <a href="<?= ROOT ?>/take_test/<?=$test_row->test_id ?>">
                                <button class="btn btn-sm btn-primary badge">Take test
                            </button>
                            </a>
                        <?php endif;?>
                        
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="5"><center>No tests were found</center></td></tr>
        <?php endif; ?>
    </table>
</div>