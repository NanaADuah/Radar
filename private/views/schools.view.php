<?php $this->view("includes/header") ?>
<?php $this->view("includes/nav") ?>

<div class="container-fluid p-4 mx-auto shadow" style="max-width: 1000px;">
    <?php $this->view("includes/crumbs",['crumbs'=>$crumbs]) ?>
    <center>
        <hr>
        <h5>SCHOOLS</h5>
        <hr>
    </center>
    <div class="card-group justify-content-center">
        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Schools</th>
                <th>Created By</th>
                <th>Date</th>
                <th>
                    <a href="<?= ROOT ?>/schools/add">
                        <button class="btn btn-primary btn-sm badge"><i class="fa fa-plus"></i>Add New</button>
                    </a>
                </th>
            </tr>
            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td><button class="btn btn-sm btn-primary badge"><i class="fa fa-chevron-right"></i>View</button></td>
                        <td><?= $row->school ?></td>
                        <td><?= $row->user->firstname ?> <?=$row->user->lastname ?></td>
                        <td><?= get_date($row->date) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/schools/edit/<?=$row->id?>">
                                <button class="btn btn-sm btn-info text-white p-1 pe-0 badge"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/schools/delete/<?=$row->id?>">
                                <button class="btn btn-sm btn-danger p-1 pe-0 badge"><i class="fa fa-trash-alt"></i></button>
                            </a> 
                            <a href="<?= ROOT ?>/switch_school/<?=$row->id?>">
                                <button class="btn btn-sm btn-success badge p-1 pe-0">Switch to <i class="fa fa-chevron-right"></i></button>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else : ?>
                <h4> No schools were found</h4>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php $this->view("includes/footer") ?>