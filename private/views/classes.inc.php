<div class="card-group justify-content-center">
    <br>
    <br>
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>Class Name</th>
            <th>Created By</th>
            <th>Date</th>
            <th>
                
            </th>
        </tr>
        <?php if (isset($rows) && $rows) : ?>
            <?php foreach ($rows as $row) : ?>

                <tr>
                    <td>
                        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>">
                            <button class="btn btn-sm btn-primary p-1 pe-0"><i class="fa fa-chevron-right ">
                            </i></button>
                        </a>
                    </td>
                    <td><?= $row->class ?></td>
                    <td><?= $row->user->firstname ?> <?= $row->user->lastname ?></td>
                    <td><?= get_date($row->date) ?></td>
                    <td>
                        <?php if (Auth::access('lecturer')) : ?>
                            <a href="<?= ROOT ?>/classes/edit/<?= $row->id ?>">
                                <button class="btn btn-sm btn-info text-white badge p-1 pe-0"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?=ROOT?>/classes/delete/<?= $row->id ?>">
                                <button class="btn btn-sm btn-danger p-1 pe-0 badge"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="5"><center>No tests were found</center></td></tr>
        <?php endif; ?>
    </table>
</div>